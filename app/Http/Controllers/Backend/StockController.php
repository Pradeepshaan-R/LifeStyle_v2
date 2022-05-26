<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Exception;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stock_list = Stock::join('products as p', 'p.id', 'stocks.product_id')
            ->join('suppliers as s', 's.id', 'stocks.supplier_id')
            ->select('stocks.id', 'stocks.quantity', 'stocks.registration_date', 'stocks.expiry_date', 'p.title', 's.user_name');

        $stock_list = $stock_list->paginate(config('app.pagination'));

        return view('backend.stock.list', ['stock_list' => $stock_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.stock.create');
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

            //SAVE STOCK
            $stock = new Stock();
            $stock->quantity = $request->quantity;
            $stock->registration_date = $request->registration_date;
            $stock->expiry_date = $request->expiry_date;
            $stock->description = $request->description;
            $stock->product_id = $request->product_id;
            $stock->supplier_id = $request->supplier_id;
            $stock->save();

            DB::commit();
            $this->message = 'Adding Successful';

        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/stock')->withFlashSuccess($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        return view('backend.stock.view', ['stock' => $stock]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        DB::beginTransaction();
        try {
            //UPDATE PRODUCT
            $stock->product_id = $request->product_id;
            $stock->supplier_id = $request->supplier_id;
            $stock->registration_date = $request->registration_date;
            $stock->expiry_date = $request->expiry_date;
            $stock->description = $request->description;
            $stock->save();

            DB::commit();
            $this->message = 'Update Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/stock')->withFlashSuccess($this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        try {
            $stock->delete();

            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/stock')->withFlashInfo($this->message);
    }
}
