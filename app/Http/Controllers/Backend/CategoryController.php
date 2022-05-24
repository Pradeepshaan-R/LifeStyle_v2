<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $category_list = Category::select('id', 'title', 'status', 'filename');

        if ($title) {
            $category_list = $category_list->where("title", "LIKE", '%' . $title . '%');
        }

        $category_list = $category_list->paginate(config('app.pagination'));

        return view('backend.category.list', ['category_list' => $category_list, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->title = $request->title;

            // SAVE CATEGORY IMAGE
            if ($request->file('document')) {
                $fileName = time() . '_' . $request->file('document')->getClientOriginalName();
                $filePath = $request->file('document')->storeAs('uploads/', $fileName, 'public');
                $category->filename = $fileName;
            }
            $category->save();

            DB::commit();
            $this->message = 'New Category added Successfully';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/category')->withFlashInfo($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('backend.category.view', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        DB::beginTransaction();
        try {
            $category->title = $request->title;
            $category->status = $request->status;

            // SAVE CATEGORY IMAGE
            if ($request->file('document')) {
                $fileName = time() . '_' . $request->file('document')->getClientOriginalName();
                $filePath = $request->file('document')->storeAs('uploads/', $fileName, 'public');
                $category->filename = $fileName;
            }
            $category->save();

            DB::commit();
            $this->message = 'Update Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/category')->withFlashSuccess($this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/category')->withFlashInfo($this->message);
    }
}
