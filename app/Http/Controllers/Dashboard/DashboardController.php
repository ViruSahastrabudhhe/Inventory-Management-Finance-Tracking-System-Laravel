<?php

namespace App\Http\Controllers\Dashboard;

use App\Traits\ProductTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    use ProductTrait;

    public function showManagerDashboard() {
        $totalProducts = $this->getProductCount();
        $totalProductCategories = $this->getProductCategories();
        $products=Product::where('user_id', Auth::user()->id)->get();
        return view("dashboard", ["products" => $products, "productCount" => $totalProducts, "categoryCount" => $totalProductCategories]);
    }

    public function showAdminDashboard() {
        return view("admin.index");
    }
}