<?php

namespace App\Http\Controllers\Backend;

use App\Models\Inquiry;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class InquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $role = auth()->user()->roles[0]->name;
        $inquiry_list = Inquiry::select('*');
        $product=Product::select('*');

        if ($name) {
            $inquiry_list = $inquiry_list->where("name", "LIKE", '%' . $name . '%');
        }
        $inquiry_list = $inquiry_list->paginate(config('app.pagination'));
        return view('backend.inquiry.list', ['inquiry_list' => $inquiry_list, 'name' => $name,'product'=>$product]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $product = Product::select('*')->get();
        $categoryTop = Category::select('*')->where('id', '<', '8')->get();
        $categoryBottom = Category::select('*')->where('id', '>=', '8')->get();

        return view('frontend.pages.inquiry',['product' => $product, 'categoryTop' => $categoryTop, 'categoryBottom' => $categoryBottom]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, Inquiry::$rules);
        DB::beginTransaction();
        try {
            $inquiry = new Inquiry();
            $inquiry->name = $request->name;
            $inquiry->phone = $request->contact_number;
            $inquiry->save();


            DB::commit();
            $this->message = 'Adding Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/inquiry')->withFlashSuccess($this->message);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Inquiry $inquiry)
    {
        return view('backend.inquiry.view', ['inquiry' => $inquiry]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Inquiry $inquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inquiry $inquiry)
    {

        $validatedData = $this->validate($request, Inquiry::$updateRules);

        DB::beginTransaction();
        try {
            //update product info
            $inquiry->name = $request->name;
            $inquiry->phone = $request->phone;
            $inquiry->roof_area = $request->roof_area;
            $inquiry->roof_unit = $request->roof_unit;
            $inquiry->ceiling_area = $request->ceiling_area;
            $inquiry->ceiling_unit = $request->ceiling_unit;
            $inquiry->products = $request->products;
            $inquiry->save();


            DB::commit();
            $this->message = 'Update Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/inquiry')->withFlashSuccess($this->message);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inquiry  $inquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inquiry $inquiry)
    {
        //
    }
}
