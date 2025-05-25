<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\User;
use App\Models\RoleUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index() {
        $products=Product::where('user_id', Auth::user()->id)->get();
        return view("product.index", ["products"=>$products]);
    }
    
    public function create() {
        return view("product.create");
    }

    public function show(Product $product) {
        return view("product.show", ["product"=>$product]);
    }
    
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'qty' => 'required',
            'status' => 'nullable',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'supplier_id' => 'nullable',
            'description' => 'nullable',
        ]);

        $product=new Product;
        
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->qty = $request->qty;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->description = $request->description;
        $product->user_id = Auth::id();

        $product->save();
        if ($request->supplier_id==null) {
            return redirect(route('view-products'))->with('success', 'Successfully added new item!');
        }

        $this->order($request, $product);
        return redirect(route('view-products'))->with('success', 'Successfully added new item and purchase order!');
    }

    public function order(Request $request, Product $product) {
        $purchase=new Purchase;

        $purchase->purchase_no="PO"."-".Purchase::count();
        $purchase->user_id=Auth::id();
        $purchase->supplier_id=$request->supplier_id;

        $purchase->save();
        $this->write($request, $product, $purchase);
    }

    public function write(Request $request, Product $product, Purchase $purchase) {
        $purchaseDetail=new PurchaseDetail;

        $purchaseDetail->quantity=$request->qty;
        $purchaseDetail->total=$request->buying_price*$request->qty;
        $purchaseDetail->purchase_id=$purchase->id;
        $purchaseDetail->product_id=$product->id;
        $purchaseDetail->user_id=Auth::id();

        $purchaseDetail->save();
    }

    public function edit(Product $product) {
        return view('product.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'qty' => 'required',
            'supplier_id' => 'nullable',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'description' => 'required',
        ]);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->qty = $request->qty;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->description = $request->description;

        $product->save();
        
        return redirect(route('view-products'))->with('success', "Successfully updated product!");
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect(route('view-products'))->with('success', "Successfully deleted product!");
    }
}
