<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class Shop extends Component
{
    public $product = [];
    public $categoryTop = [];
    public $categoryBottom = [];
    
    public $search = '';

    public function mount()
    {
        $this->product = Product::select('*')->get();
        $this->categoryTop = Category::select('*')->where('id', '<', '8')->get();
        $this->categoryBottom = Category::select('*')->where('id', '>=', '8')->get();
    }

    public function filter()
    {
        dd('ok');
        $this->product = Product::select('*');
        
        if ($this->search) {
            $this->product = $this->product->where("title", "LIKE", '%' . $this->search . '%');
        }
        $this->product = $this->product->get();
    }

    public function render()
    {
        return view('livewire.shop');
    }
}
