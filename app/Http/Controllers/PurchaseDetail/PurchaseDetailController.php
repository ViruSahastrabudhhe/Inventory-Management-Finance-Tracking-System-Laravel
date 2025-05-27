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

    public function edit(Product $product) {
        return view("purchase_detail.edit", ["product"=> $product]);
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

    public function receive(Request $request, int $productID, int $purchaseDetailID) {
        $request->validate([
            'is_received'=> ['boolean'],
            'quantity'=> ['required'],
        ]);
        $product=Product::where("id","=", $productID)
            ->where("user_id","=", Auth::user()->id)
            ->first();
        $purchaseDetail=PurchaseDetail::where("id","=", $purchaseDetailID)
            ->where("user_id","=", Auth::user()->id)
            ->first();

        $product->qty += $request->quantity;
        $purchaseDetail->is_received = $request->is_received;

        $product->save();
        $purchaseDetail->save();

        return back()->with("success","Successfully restocked item!");
    }

    public function store(Request $request, PurchaseDetail $purchaseDetail) {
        $request->validate([
            'purchase_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'total' => 'required',
        ]);

        $receivedDetail = PurchaseDetail::where('purchase_id', $request->purchase_id)
            ->where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->where('is_received', true)
            ->first();

        if ($receivedDetail) {
            return back()->with('error', 'Item already received in the purchase order! Create a new purchase order instead!');
        }

        $purchaseDetail = PurchaseDetail::where('purchase_id', $request->purchase_id)
            ->where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($purchaseDetail) {
            $purchaseDetail->quantity += $request->quantity;
            $purchaseDetail->total += $request->total;
            $purchaseDetail->save();
            return back()->with('success', 'Added quantity to purchase order!');
        }

        $purchase=new PurchaseDetail;

        $purchase->quantity=$request->quantity;
        $purchase->total=$request->total;
        $purchase->purchase_id=$request->purchase_id;
        $purchase->product_id=$request->product_id;
        $purchase->user_id=Auth::id();

        $purchase->save();

        return back()->with('success', 'Successfully created new purchase order item!');
    }

    public function add(Request $request) {
        $purchase=PurchaseDetail::where('product_id','=', $request->product_id)
            ->where('user_id','=', Auth::user()->id)
            ->first();
        $purchase->quantity+=$request->quantity;
        $purchase->total+=$request->total;
        $purchase->purchase_id=$request->purchase_id;
        $purchase->product_id=$request->product_id;
        $purchase->user_id=Auth::id();

        $purchase->save();
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

        return redirect()->route('view-purchases')->with('success', 'Successfully updated item in purchase order!');
    }

    public function destroy(PurchaseDetail $purchaseDetail) {
        $purchaseDetail->delete();
        return back()->with('success', 'Successfully deleted purchase order item!');
    }
}
