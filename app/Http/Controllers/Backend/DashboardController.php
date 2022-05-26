<?php

namespace App\Http\Controllers\Backend;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Supplier;
use App\Domains\Auth\Models\User;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::get();
        $suppliers = Supplier::get();
        $customers = Customer::get();

        $categories = Category::get();
        $categoryActive = Category::where('status', 'Active')->get();

        $categoryCount = count($categories);
        $categoryActiveCount = count($categoryActive);

        if($categoryCount > 0) {
            $categoryActivePercentage = ($categoryActiveCount / $categoryCount) * 100;
        } else {
            $categoryActivePercentage = ($categoryActiveCount / 1) * 100;
        }

        $products = Product::get();
        $productAvailable = Product::where('status', 'Available')->get();

        $productCount = count($products);
        $productAvailableCount = count($productAvailable);

        if($productCount > 0) {
            $productAvailablePercentage = ($productAvailableCount / $productCount) * 100;
        } else {
            $productAvailablePercentage = ($productAvailableCount / 1) * 100;
        }

        $stocks = Stock::get();

        return view('backend.dashboard',
            [
                'users' => $users,
                'suppliers' => $suppliers,
                'products' => $products,
                'productAvailablePercentage' => $productAvailablePercentage,
                'categories' => $categories,
                'categoryActivePercentage' => $categoryActivePercentage,
                'stocks' => $stocks,
                'customers' => $customers,
            ]);
    }
}
