<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index() {
        return view("sales.index");
    }

    public function create() {
        return view("sales.create");
    }
    public function edit() {
        return view("sales.edit");
    }

    public function store(Request $request) {
        $request->validate([
            'status' => 'required',
            'description' => 'required',
            'supplier_id' => 'required',
        ]);

        $purchase=new Order;

        $purchase->purchase_no=Order::count();
        $purchase->description=$request->description;
        $purchase->supplier_id=$request->supplier_id;
        $purchase->user_id=Auth::id();

        $purchase->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully created new purchase order!');
   
    }
}
