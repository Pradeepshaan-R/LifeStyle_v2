<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\VariationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariationTypeController extends Controller
{
    protected $code = 200;
    protected $message;

    public function __construct()
    {
        $this->authorizeResource(VariationType::class, 'variation_type');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $variation_type_list = VariationType::select('id', 'title');
        if ($title) {
            $variation_type_list = $variation_type_list->where("variation_types.title", "LIKE", '%' . $title . '%');
        }

        $variation_type_list = $variation_type_list->paginate(config('app.pagination'));
        return view('backend.variation_type.list', ['variation_type_list' => $variation_type_list, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.variation_type.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, VariationType::$rules);

        DB::beginTransaction();
        try {
            $variationType = new VariationType();
            $variationType->title = $request->title;
            $variationType->save();
            DB::commit();
            $this->message = 'Adding Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/variation_type')->withFlashSuccess($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Http\Response
     */
    public function show(VariationType $variationType)
    {
        return view('backend.variation_type.view', ['variation_type' => $variationType ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Http\Response
     */
    public function edit(VariationType $variationType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VariationType $variationType)
    {
        $validatedData = $this->validate($request, VariationType::$rules);
        DB::beginTransaction();
        try {
            $variationType->title = $request->title;

            $variationType->save();
            DB::commit();
            $this->message = 'Update Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/variation_type')->withFlashSuccess($this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VariationType  $variationType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VariationType $variationType)
    {
        try {
            $variationType->delete();
            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/variation_type')->withFlashInfo($this->message);
    }
}
