<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SalesController extends Controller
{
    public function index() {
        return view("sales.index");
    }
}
