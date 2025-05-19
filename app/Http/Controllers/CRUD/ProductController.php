<?php

namespace App\Http\Controllers\CRUD;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view("home.dashboard", ["products" => $products]);
    }
    
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'description' => 'nullable',
        ]);

        $product = new Product;

        $product->name=$request->name;
        $product->qty=$request->qty;
        $product->price=$request->price;
        $product->description=$request->description;

        $product->save();

        return redirect(route('view-dashboard'));
    }

    public function edit(Product $product) {
        $products=Product::all();
        return view('funs.edit', ['products' => $products, 'product' => $product]);
    }

    public function update(Request $request, Product $product) {
        $products=Product::all();
        
        $data = $request->validate([
            'ProductName' => 'required',
            'ProductEmail' => 'required',
        ]);
        
        $product->update($data);

        return redirect(route('home', ["products" => $products]))->with('success', "Successfully updated user!");
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect('/');
    }
}
