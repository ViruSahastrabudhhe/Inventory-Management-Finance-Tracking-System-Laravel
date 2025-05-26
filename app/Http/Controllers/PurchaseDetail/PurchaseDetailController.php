<?php

namespace App\Http\Controllers\PurchaseDetail;

use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;    

class PurchaseDetailController extends Controller
{
    public function create(Product $product) {
        return view('purchase_detail.create', ['product'=> $product]);
    }

    public function edit(PurchaseDetail $purchase) {
        return view("purchase.edit", ["purchase"=> $purchase]);
    }

    public function show(PurchaseDetail $purchase) {
        return view("purchase.show", ["purchase"=>$purchase]);
    }

    public function goto(int $purchaseID) {
        $purchase=PurchaseDetail::where('id', '=', $purchaseID)
            ->where('user_id', '=', Auth::user()->id)
            ->first();
        return $this->show($purchase);
    }

    public function store(Request $request) {
        $request->validate([
            'purchase_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'total' => 'required',
        ]);

        $purchase=new PurchaseDetail;

        $purchase->quantity=$request->quantity;
        $purchase->total=$request->total;
        $purchase->purchase_id=$request->purchase_id;
        $purchase->product_id=$request->product_id;
        $purchase->user_id=Auth::id();

        $purchase->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully created new purchase order item!');
    }


    public function update(Request $request, PurchaseDetail $purchase) {
        $request->validate([
            'purchase_no' => 'required',
            'description' => 'required',
            'supplier_id' => 'required',
        ]);

        $purchase->purchase_no=PurchaseDetail::count();
        $purchase->description=$request->description;
        $purchase->supplier_id=$request->supplier_id;
        $purchase->user_id=Auth::id();

        $purchase->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully created new purchase order item!');
    }

    public function destroy(int $productID) {
        $purchase = PurchaseDetail::where('user_id','=', Auth::user()->id)
            ->where('product_id','=',$productID)
            ->first();
        $purchase->delete();
        return redirect()->route('view-purchases')->with('success', 'Successfully deleted purchase order item!');
    }
}
