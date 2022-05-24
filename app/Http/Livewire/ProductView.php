<?php

namespace App\Http\Livewire;

use App\Models\Brand;
use App\Models\Variation;
use App\Models\VariationType;
use App\Models\Category;
use App\Models\ProductVariation;
use Exception;
use Livewire\Component;

class ProductView extends Component
{
    public $brands = [];
    public $brand = 0;
    public $product_variations = []; //all variations of selected product
    public $product_id;
    public $product;


    // public function updatedBrand($b)
    // {
    //     $this->brand = $b;
    //     try {
    //         $this->categories = Category::where('brand_id', $this->brand)->get();
    //     } catch (Exception $ex) {

    //     }
    // }

    /*
    public function updatedType($t){
        $this->type = $t;
        try {
            $this->variations = Variation::where('variation_type_id', $this->type)->get();
        } catch (Exception $ex) {

        }
    }
*/

/**
 * Load data for the selected product
 */
    public function mount($product)
    {
        $this->product = $product;
        $this->product_id = $product->id;
        $this->brand_id = $product->brand_id;
        $this->product_variations = ProductVariation::getVariations($this->product_id);
        // $this->categories = Category::where('brand_id', $this->brand)->get();
        $this->brands = Brand::where('status', 'Available')->get();
        $this->variationTypes = VariationType::get();
    }

    public function render()
    {
        return view('livewire.product-view');
    }
}
