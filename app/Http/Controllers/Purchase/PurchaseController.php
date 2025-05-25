<?php

namespace App\Http\Controllers\Purchase;

use App\Models\Purchase;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index() {
        return view('purchase.index');
    }
    public function create() {
        return view('purchase.create');
    }

    public function show(Purchase $purchase) {
        return view("purchase.show", ["purchase"=>$purchase]);
    }

}
