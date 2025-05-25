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
        $totalProductCategories = $this->getProductCategoryCount();
        return view("dashboard", ["productCount" => $totalProducts, "categoryCount" => $totalProductCategories]);
    }

    public function showAdminDashboard() {
        return view("admin.index");
    }
}