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
    public function viewAddProduct() {
        return view("product.create");
    }
    
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'qty' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
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

        return redirect(route('view-dashboard'));
    }

    public function edit(Product $product) {
        return view('product.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product) {
        $products=Product::where('user_id', Auth::user()->id)->get();
        
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required',
            'buying_price' => 'required',
            'sellig_price' => 'required',
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
