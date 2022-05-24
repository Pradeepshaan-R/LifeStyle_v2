<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariation;
use DB;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $code = 200;
    protected $message;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $product_list = Product::join('categories as c', 'c.id', 'products.category_id')
            ->select('products.id', 'products.title', 'products.price', 'products.description', 'products.status', 'c.title as category');

        if ($title) {
            $product_list = $product_list->where("products.title", "LIKE", '%' . $title . '%');
        }
        $product_list = $product_list->paginate(config('app.pagination'));

        return view('backend.product.list', ['product_list' => $product_list, 'title' => $title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.product.create');
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

            //SAVE PRODUCT
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->title = $request->title;
            $product->description = $request->description;
            $product->price = $request->price;

            // SAVE PRODUCT IMAGE
            if ($request->file('document')) {
                $fileName = time() . '_' . $request->file('document')->getClientOriginalName();
                $filePath = $request->file('document')->storeAs('uploads/', $fileName, 'public');
                $product->filename = $fileName;
            }
            $product->save();

            DB::commit();
            $this->message = 'Adding Successful';

        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/product')->withFlashSuccess($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('backend.product.view', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
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
    public function update(Request $request, Product $product)
    {
        DB::beginTransaction();
        try {
            //UPDATE PRODUCT
            $product->title = $request->title;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            if ($request->status) {
                $product->status = $request->status;
            }
            // SAVE PRODUCT IMAGE
            if ($request->file('document')) {
                $fileName = time() . '_' . $request->file('document')->getClientOriginalName();
                $filePath = $request->file('document')->storeAs('uploads/', $fileName, 'public');
                $product->filename = $fileName;
            }
            $product->save();

            DB::commit();
            $this->message = 'Update Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/product')->withFlashSuccess($this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ProductVariation $productVariation)
    {
        try {
            $product->delete();

            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/product')->withFlashInfo($this->message);
    }
}
