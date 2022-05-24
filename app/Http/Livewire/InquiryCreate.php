<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Log;
use App\Models\Product;
use App\Models\Inquiry;
use Illuminate\Support\Facades\DB;
use Exception;

class InquiryCreate extends Component
{

    public $type = "roofing"; //roofing|ceiling|both
    public $roof_area = 0;
    public $roof_unit = "sqft";
    public $ceiling_area = 0;
    public $ceiling_unit = "sqft";
    public $defaultProducts = []; //show only these for temp estimate
    public $allProducts = []; //show all products for detail estimate
    public $name;
    public $phone;
    public $message;
    public $isRegistered = false; //has the user registered by entering name/phone. If this is true, we show the detail estimate page
    public $tab = "area";//to control active tab status

    public function register(){
        DB::beginTransaction();
        try {
            $inquiry = new Inquiry();
            $inquiry->name = $this->name;
            $inquiry->phone = $this->phone;
            $inquiry->roof_area = $this->roof_area;
            $inquiry->roof_unit = $this->roof_unit;
            $inquiry->ceiling_area = $this->ceiling_area;
            $inquiry->ceiling_unit = $this->ceiling_unit;
            $inquiry->products = "product list will be here";
            $inquiry->save();
            DB::commit();
            $this->isRegistered = true;
            $this->message = 'Adding Successful';
            $this->tab = "register";
        } catch (Exception $ex) {
            DB::rollBack();
            dd($ex);
            $this->message = 'Adding Unsuccessful';
        }
    }

    public function mount(){
        //Log::alert('inside mount');
        $this->defaultProducts = Product::where('isDefault',true)->get();
        $this->allProducts = Product::where('status','Available')->get();

    }

    public function updatedType($t){
        $this->type = $t;
    }

    public function updatedTab($t){
        $this->tab = $t;
    }

    public function render()
    {
        return view('livewire.inquiry-create');

    }



}
