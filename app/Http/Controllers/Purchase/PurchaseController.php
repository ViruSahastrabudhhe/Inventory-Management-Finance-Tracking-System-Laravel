<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PurchaseController extends Controller
{
    public function index() {
        return view('purchase.index');
    }

}
