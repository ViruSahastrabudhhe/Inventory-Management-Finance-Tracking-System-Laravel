<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use App\Models\User;
use App\Models\RoleUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function dashboard() {
        $products=Product::where('user_id', Auth::user()->id)->get();
        $total = Product::where('user_id', Auth::user()->id)->count();
        return view("home.dashboard", ["products" => $products, "total" => $total]);
    }

    public function viewAddProduct() {
        $products=Product::where('user_id', Auth::user()->id)->get();
        return view("home.crud.add-product", ["products" => $products]);
    }
    
    public function store(Request $request) {
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
        $products=Product::where('user_id', Auth::user()->id)->get();
        return view('home.crud.edit-product', ['product' => $product]);
    }

    public function update(Request $request, Product $product) {
        $products=Product::where('user_id', Auth::user()->id)->get();
        
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
