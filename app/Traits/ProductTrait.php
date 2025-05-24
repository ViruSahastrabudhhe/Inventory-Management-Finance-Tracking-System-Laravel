<?php

namespace App\Traits;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

trait ProductTrait
{
    public function getProducts() {
        return Product::where('user_id', '=', Auth::user()->id)->get();
    }
    public function getProductCount() {
        $total = Product::where('user_id', '=', Auth::user()->id)->count();
        return $total;
    }

    public function getProductCategories() {
        $categories = Category::where('user_id', '=', Auth::user()->id)->count();
        return $categories;
    }
}
