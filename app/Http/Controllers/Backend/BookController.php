<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Traits\Common;
use DB;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

/**
 * @group Books
 *
 * APIs for managing books
 */
class BookController extends Controller
{
    use Common;
    protected $code = 200;
    protected $message;

    public function __construct()
    {
        $this->authorizeResource(Book::class, 'book');
    }

    /**
     * index
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function index(Request $request)
    {
        $viewmode = $request->viewmode;
        $title = $request->title;
        $author_id = $request->author_id;
        $role = auth()->user()->roles[0]->name;

        $book_list = Book::select('books.id', 'qty', 'status', 'isbn', 'title', 'photo', 'author_id', 'books.user_id', 'a.name')
            ->join('authors as a', 'a.id', 'books.author_id');

        if ($title) {
            $book_list = $book_list->where("title", "LIKE", '%' . $title . '%');
        }
        if ($author_id) {
            $book_list = $book_list->where("author_id", $author_id);
        }
        $book_list = $book_list->paginate(config('app.pagination'));

        return view('backend.book.list', ['book_list' => $book_list, 'title' => $title, 'author_id' => $author_id, 'viewmode' => $viewmode]);
    }

    /**
     * create
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function create()
    {
        return view('backend.book.create');
    }

    /**
     * store
     *
     * Store a newly created resource in storage.
     * Uses transactions to prevent partial data updates
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, Book::$rules);

        DB::beginTransaction();
        try {
            $book = new Book();
            $book->status = $request->status;
            $book->isbn = $request->isbn;
            $book->title = $request->title;
            $book->author_id = $request->author_id;
            $book->user_id = auth()->user()->id;
            //optional fields
            if ($request->qty) {
                $book->qty = $request->qty;
            }
            $book->save();

            if ($request->file('photo')) {
                //$fileName = time() . '_' . $request->file('photo')->getClientOriginalName();
                $fileExt = $request->file('photo')->extension();
                $fileName = $book->id . '.' . $fileExt;
                $filePath = $request->file('photo')->storeAs('covers/', $fileName, 'public');
                $book->photo = $fileName;
                $book->save();
            }

            DB::commit();
            $this->message = 'Adding Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/book')->withFlashSuccess($this->message);
    }

    /**
     * show
     *
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     * @urlParam $id integer required id of the book to view. Example: 1
     * @authenticated
     */
    public function show(Book $book)
    {
        return view('backend.book.view', ['book' => $book]);
    }

    /**
     * edit
     *
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * update
     *
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function update(Request $request, Book $book)
    {
        //dump($request);
        $validatedData = $this->validate($request, Book::$rules);

        DB::beginTransaction();
        try {
            $book->status = $request->status;
            $book->isbn = $request->isbn;
            $book->title = $request->title;
            $book->author_id = $request->author_id;

            //optional fields
            if ($request->qty) {
                $book->qty = $request->qty;
            }

            if ($request->file('photo')) {
                $fileExt = $request->file('photo')->extension();
                $fileName = $book->id . '.' . $fileExt;
                $filePath = $request->file('photo')->storeAs('covers/', $fileName, 'public');
                $book->photo = $fileName;
            }

            $book->save();
            DB::commit();
            $this->message = 'Update Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/book')->withFlashSuccess($this->message);
    }

    /**
     * destroy
     *
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     * @authenticated
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/book')->withFlashInfo($this->message);
    }

    /**
     * csvImport
     *
     * Import CSV to database into 'books' table
     * Validation (for duplicate) is done on frontend via Javascript
     * TODO: have a new bool column 'isDuplicate' and store duplicate status. Pass it to frontend
     */
    public function csvImport_show(Request $request)
    {
        $csv_data = [];
        $user_id = auth()->user()->id;
        if (!$request->file('books')) {
            return redirect('admin/book')->withFlashSuccess("Nothing to import.");
        }
        try {
            $table_name = 'book_import_temp_' . $user_id;
            Schema::dropIfExists($table_name);
            Schema::create($table_name, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('qty')->default(0); //no of copies avalable
                $table->enum('status', ['Available', 'Lended', 'Damaged'])->default('Available');
                $table->string('isbn', 30)->nullable();
                $table->string('title', 100)->nullable();
                $table->integer('author_id')->nullable();
                $table->boolean('isDuplicate')->default(0); //is this record duplicated
            });
            $file = $request->file('books');
            // dd($file);
            // clean the file
            $handle = fopen($file, "r+");
            $row_no = 0;
            while (($row = fgetcsv($handle)) !== false) {
                $data = array();
                if ($row_no != 0) {
                    // dd($row);
                    foreach ($row as $column) {
                        $column = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $column); //clean non-ascii chars
                        array_push($data, $column);
                    }
                    //import to temp table
                    DB::table('book_import_temp_' . $user_id)->insert([
                        'qty' => $data[0],
                        'status' => $data[1],
                        'isbn' => $data[2],
                        'title' => $data[3],
                        'author_id' => $data[4],
                    ]);
                }
                $row_no += 1;
            }
            $csv_data = DB::table($table_name)->get();
        } catch (Exception $ex) {

        }
        return view('backend.book.import', ['csv_data' => $csv_data]);
    }

    /**
     * csvImport_store
     *
     * Store the imported/validated CSV file in the 'books' table
     */
    public function csvImport_store(Request $request)
    {
        //dump($request);
        $count = count($request->qty);
        $user_id = auth()->user()->id;
        //dump($count);
        DB::beginTransaction();
        try {
            for ($i = 0; $i < $count; $i++) {
                $book = new Book();
                $book->qty = $request->qty[$i];
                $book->status = $request->status[$i];
                $book->isbn = $request->isbn[$i];
                $book->title = $request->title[$i];
                $book->author_id = $request->author_id[$i];
                $book->user_id = $user_id;
                $book->save();
            }
            DB::commit();
            $this->message = "Imported $i records successfully.";
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Import Unsuccessful';
        }
        return redirect('admin/book')->withFlashSuccess($this->message);
    }
    /**
     * checkDuplicate
     *
     * Checks for same ISBN in the books table
     * Used by csvImport()
     */
    public function checkDuplicate($isbn)
    {
        $book = Book::where('isbn', $isbn)->exists();

        $duplicate = false;
        if ($book) {
            $duplicate = true;
        }

        return response(["duplicate" => $duplicate]);
    }

    /**
     * autocomplete
     *
     * Return result for typeahead search function on List page
     * @authenticated
     */
    public function autocomplete(Request $request)
    {
        $result = Book::where('title', 'LIKE', "%{$request->input('query')}%")->select('title')->pluck('title');
        return response()->json($result);
    }
}
