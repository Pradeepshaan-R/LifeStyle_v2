<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Variation;
use App\Models\VariationType;
use Exception;
use Livewire\Component;

class ProductCreate extends Component
{
    public $brands = [];
    public $brand = 0;
    public $variationTypes = [];

/*
    public function updatedBrand($b)
    {
        $this->brand = $b;
        try {
            $this->categories = Category::where('brand_id', $this->brand)->get();
        } catch (Exception $ex) {

        }
    }


    public function updatedType($t){
        $this->type = $t;
        try {
            $this->variations = Variation::where('variation_type_id', $this->type)->get();
        } catch (Exception $ex) {

        }
    }
*/



 
    public function mount()
    {
        $this->brands = Brand::where('status', 'Available')->get();
        $this->variationTypes = VariationType::get();
    }

    public function render()
    {
        return view('livewire.product-create');
    }
}
