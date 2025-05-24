<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;

class DashboardController extends Controller
{
    public function showManagerDashboard() {
        $total = Product::where('user_id', Auth::user()->id)->count();
        $products=Product::where('user_id', Auth::user()->id)->get();
        return view("dashboard", ["products" => $products, "total" => $total]);
    }

    public function showAdminDashboard() {
        return view("admin.index");
    }
}