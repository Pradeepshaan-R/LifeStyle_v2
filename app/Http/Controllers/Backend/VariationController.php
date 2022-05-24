<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Variation;
use App\Models\VariationType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VariationController extends Controller
{
    protected $code = 200;
    protected $message;

    public function __construct()
    {
        $this->authorizeResource(Variation::class, 'variation');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = $request->title;
        $variation_type_id = $request->variation_type_id;

        $variation_list = Variation::select('variations.id','variations.title','variations.variation_type_id','variation_types.title as variation_type_title')
        ->join('variation_types','variation_types.id','=','variations.variation_type_id');

        if ($title) {
            $variation_list = $variation_list->where("variations.title", "LIKE", '%' . $title . '%');
        }
        if ($variation_type_id) {
            $variation_list = $variation_list->where("variation_type_id", $variation_type_id);
        }

        $variation_list = $variation_list->paginate(config('app.pagination'));
        return view('backend.variation.list', ['variation_list' => $variation_list, 'title' => $title, 'variation_type_id' => $variation_type_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $variation_type = VariationType::select('title', 'id')->get();
        return view('backend.variation.create', ['variation_type' => $variation_type]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validate($request, Variation::$rules);

        DB::beginTransaction();
        try {
            $variation = new Variation();
            $variation->variation_type_id = $request->variation_type_id;
            $variation->title = $request->title;
            $variation->save();

            DB::commit();
            $this->message = 'Adding Successful';

        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
        return redirect('admin/variation')->withFlashSuccess($this->message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function show(Variation $variation)
    {
        return view('backend.variation.view', ['variation' => $variation ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function edit(Variation $variation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Variation $variation)
    {
        $validatedData = $this->validate($request, VariationType::$rules);
        DB::beginTransaction();
        try {
            $variation->title = $request->title;

            $variation->save();
            DB::commit();
            $this->message = 'Update Successful';
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Update Unsuccessful';
        }
        return redirect('admin/variation')->withFlashSuccess($this->message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Variation  $variation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Variation $variation)
    {
        try {
            $variation->delete();
            $this->message = "Delete successful";
        } catch (Exception $ex) {
            $this->message = "Delete unsuccessful. You may not be the owner.";
            $this->code = 401;
        }
        return redirect('admin/variation')->withFlashInfo($this->message);
    }
}
