<?php

namespace App\Http\Controllers\CRUD;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function dashboard() {
        $products=Product::all();
        $total = DB::table('products')->count();
        return view("home.dashboard", ["products" => $products, "total" => $total]);
    }

    public function viewAddProduct() {
        $products = Product::all();
        return view("home.crud.add-product", ["products" => $products]);
    }
    
    public function store(Request $request) {
        // if (Auth::user() && ! Auth::user()->email_verified_at) {
        //     return redirect(route('home.dashboard'));;
        // }

        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'description' => 'nullable',
        ]);

        $product=new Product;
        
        $product->name = $request->name;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->user_id = Auth::id();

        $product->save();

        return redirect(route('view-dashboard'));
    }

    public function edit(Product $product) {
        $products=Product::all();
        return view('home.crud.edit-product', ['product' => $product]);
    }

    public function update(Request $request, Product $product) {
        $products=Product::all();
        
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);
        
        $product->update($data);

        return redirect(route('view-dashboard', ["products" => $products]))->with('success', "Successfully updated product!");
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect(route('view-dashboard'))->with('success', "Successfully deleted product!");
    }
}
