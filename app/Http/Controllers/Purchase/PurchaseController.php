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

    public function edit(Purchase $purchase) {
        return view("purchase.edit", ["purchase"=> $purchase]);
    }

    public function show(Purchase $purchase) {
        return view("purchase.show", ["purchase"=>$purchase]);
    }

    public function store(Request $request) {
        $request->validate([
            'purchase_no' => 'required',
            'description' => 'required',
            'supplier_id' => 'required',
        ]);

        $purchase=new Purchase;

        $purchase->purchase_no=Purchase::count();
        $purchase->description=$request->description;
        $purchase->supplier_id=$request->supplier_id;
        $purchase->user_id=Auth::id();

        $purchase->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully created new purchase order!');
    }

    public function update(Request $request, Purchase $purchase) {
        $request->validate([
            'purchase_no' => 'required',
            'description' => 'required',
            'supplier_id' => 'required',
        ]);

        $purchase->purchase_no=Purchase::count();
        $purchase->description=$request->description;
        $purchase->supplier_id=$request->supplier_id;
        $purchase->user_id=Auth::id();

        $purchase->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully created new purchase order!');
    }

    public function destroy(Purchase $purchase) {
        $purchase->delete();
        return redirect()->route('view-purchases')->with('success', 'Successfully deleted purchase order!');
    }
}
