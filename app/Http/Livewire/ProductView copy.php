<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Variation;
use App\Models\Brand;
use App\Models\VariationType;
use Exception;
use Illuminate\Support\Facades\Request;

class ProductView extends Component
{
    public $products= [];

    public $sku, $title,$price,$fixing_cost,$notes,$status,$category_id,$variation_id;
    public $note = "nothing";
    public $brands = [];
    public $brand = 0;
    public $categories = [];
    public $category = 0;
    public $variationTypes = [];
    // public $variationType = 0;
    public $variations = [];
    public $variation = 0;
    public $type = 0;
    public $product_id=3;
    public $product;


    public function updatedBrand($b)
    {
        $this->brand = $b;
        try {
            $this->categories = Category::where('brand_id', $this->brand)->get();
        } catch (Exception $ex) {

        }
        $this->note = "brand changed to $b";
    }

    public function updatedType($t){
        $this->type = $t;
        try {
            $this->variations = Variation::where('variation_type_id', $this->type)->get();
        } catch (Exception $ex) {

        }
        $this->note = "type changed to $t";
    }

    public function mount($product)
    {
        $this->product = $product;
        $this->id = $product->id;

        $this->category_id = $this->product->category_id;
        $this->variation_id = $this->product->variation_id;
        $this->brand = $this->product->category->brand_id; //find the brand id of the product

        $this->categories = Category::where('brand_id', $this->brand)->get();
        $category = Category::where('id', $product->category_id)->first();
        //$this->brand = $category->brand_id; //find the brand id of the product

        $this->variations = Variation::where('variation_type_id', $this->variation_id)->get();
        $variation = Variation::where('id', $product->variation_id)->first();
        $this->variationType = $variation->variationType->id; //find the variation id of the product

        $this->brands = Brand::where('status', 'Available')->get();
        $this->variationTypes = VariationType::get();
    }

    public function render(Product $product)
    {
        return view('livewire.product-view');
    }

}
