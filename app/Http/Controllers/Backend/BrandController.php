<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Exception;
use DB;

class BrandController extends Controller
{
    protected $code = 200;
    protected $message;

    public function __construct()
    {
        $this->authorizeResource(Brand::class, 'brand');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $brand_list = Brand::select('id', 'title', 'status');
        if ($title) {
            $brand_list = $brand_list->where("title", "LIKE", '%' . $title . '%');
        }

        $brand_list = $brand_list->paginate(config('app.pagination'));
        return view('backend.brand.list', ['brand_list' => $brand_list, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, Brand::$rules);

        DB::beginTransaction();
        try {
            $brand = new Brand();
            $brand->status = $request->status;
            $brand->title = $request->title;
            $brand->save();

            if ($request->file('photo')) {
                //$fileName = time() . '_' . $request->file('photo')->getClientOriginalName();
                $fileExt = $request->file('photo')->extension();
                $fileName = $brand->id . '.' . $fileExt;
                $filePath = $request->file('photo')->storeAs('brands/', $fileName, 'public');
                $brand->photo = $fileName;
                $brand->save();
            }

            DB::commit();
            $this->message = 'Adding Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/brand')->withFlashSuccess($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        
        return view('backend.brand.view', ['brand' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $this->validate($request, Brand::$rules);

        DB::beginTransaction();
        try {
            $brand->status = $request->status;
            $brand->title = $request->title;

            if ($request->file('photo')) {
                $fileExt = $request->file('photo')->extension();
                $fileName = $brand->id . '.' . $fileExt;
                $filePath = $request->file('photo')->storeAs('brands/', $fileName, 'public');
                $brand->photo = $fileName;
            }

            $brand->save();
            DB::commit();
            $this->message = 'Update Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/brand')->withFlashSuccess($this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        try {
            $brand->delete();
            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/brand')->withFlashInfo($this->message);
    }
}
