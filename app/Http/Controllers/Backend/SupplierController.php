<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $name = $request->name;
        $supplier_list = Supplier::select('*');

        if ($name) {
            $supplier_list = $supplier_list->where("user_name", "LIKE", '%' . $name . '%');
        }
        $supplier_list = $supplier_list->paginate(config('app.pagination'));

        return view('backend.supplier.list', ['supplier_list' => $supplier_list, 'name' => $name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.supplier.create');
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

            //SAVE SUPPLIER
            $supplier = new Supplier();
            $supplier->user_name = $request->first_name . " " . $request->last_name;
            $supplier->company_name = $request->company_name;
            $supplier->email = $request->email;
            if ($request->address) {
                $supplier->address = $request->address;
            }
            $supplier->phone = $request->phone;
            if ($request->company_phone) {
                $supplier->company_phone = $request->company_phone;
            }
            $supplier->save();

            DB::commit();
            $this->message = 'Adding Successful';

        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/supplier')->withFlashSuccess($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('backend.supplier.view', ['supplier' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        DB::beginTransaction();
        try {
            //UPDATE SUPPLIER
            $supplier->user_name = $request->user_name;
            $supplier->company_name = $request->company_name;
            $supplier->email = $request->email;
            $supplier->address = $request->address;
            $supplier->phone = $request->phone;
            $supplier->company_phone = $request->company_phone;
            $supplier->save();

            DB::commit();
            $this->message = 'Update Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/supplier')->withFlashSuccess($this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();

            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/supplier')->withFlashInfo($this->message);
    }
}
