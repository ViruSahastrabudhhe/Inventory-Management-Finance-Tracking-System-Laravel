<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Category;
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
        $category=Category::where('user_id', '=', Auth::user()->id)->count();
        if ($category==0) {
            return redirect()->route('view-add-category')->with('error','Create a category first before adding items!');
        }
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
            'status' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'payment_type' => 'required',
            'supplier_id' => 'nullable',
            'description' => 'nullable',
            'purchase_description' => 'nullable',
        ]);

        $product=new Product;
        
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->qty = $request->qty;
        $product->status= $request->status;
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

        date_default_timezone_set("Asia/Manila");
        $purchase_date = date('Y-m-d H:i:s');

        $purchase->purchase_no="PO".rand(0,1000)."-".Purchase::count();
        $purchase->user_id=Auth::id();
        $purchase->payment_type=$request->payment_type;
        $purchase->purchase_date=$purchase_date;
        $purchase->purchase_description= $request->purchase_description;
        $purchase->supplier_id=$request->supplier_id;

        $purchase->save();
        $this->write($request, $product, $purchase);
    }

    public function write(Request $request, Product $product, Purchase $purchase) {
        $purchaseDetail=new PurchaseDetail;

        $purchaseDetail->quantity=$request->qty;
        $purchaseDetail->total=$request->buying_price*$request->qty;
        $purchaseDetail->is_received=false;
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
            'status' => 'required',
            'supplier_id' => 'nullable',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'description' => 'required',
        ]);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->status = $request->status;
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
