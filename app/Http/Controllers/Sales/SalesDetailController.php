<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;    

class SalesDetailController extends Controller
{
    public function create(Product $product) {
        $product = Product::where('id', $product->id)
            ->where('user_id', '=', Auth::id())
            ->first();

        if ($product->qty==0) {
            return back()->with('error','Item is out of stock!');
        }
        return view("sales_detail.create", ['product' => $product]);
    }

    public function store(Request $request, OrderDetail $orderDetail) {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'total' => 'required',
        ]);

        $orderDetail = OrderDetail::where('order_id', $request->order_id)
            ->where('product_id', $request->product_id)
            ->where('user_id', Auth::id())
            ->first();
        $product = Product::where('id', $request->product_id)
            ->where('user_id', '=', Auth::id())
            ->first();

        if ($orderDetail) {
            $orderDetail->quantity += $request->quantity;
            $orderDetail->total += $request->total;
            $orderDetail->save();
            return back()->with('success', 'Added quantity to sales order!');
        }

        $orderDetail=new OrderDetail;

        $product->qty -= $request->quantity;

        $orderDetail->quantity=$request->quantity;
        $orderDetail->total=$request->total;
        $orderDetail->order_id=$request->order_id;
        $orderDetail->product_id=$request->product_id;
        $orderDetail->user_id=Auth::id();

        $orderDetail->save();
        $product->save();

        return back()->with('success', 'Successfully added item to sales order!');
    }

    public function deliver(Request $request, int $productID, int $orderDetailID) {
        $request->validate([
            'is_delivered'=> ['boolean'],
            'quantity'=> ['required'],
        ]);
        $product=Product::where("id","=", $productID)
            ->where("user_id","=", Auth::user()->id)
            ->first();
        $orderDetail=OrderDetail::where("id","=", $orderDetailID)
            ->where("user_id","=", Auth::user()->id)
            ->first();

        $product->qty -= $request->quantity;
        $orderDetail->is_delivered = $request->is_delivered;

        $product->save();
        $orderDetail->save();

        return back()->with("success","Successfully restocked item!");
    }

    public function update(Request $request, OrderDetail $salesDetail) {
        $request->validate([
            'order_no' => 'required',
            'description' => 'required',
            'supplier_id' => 'required',
        ]);

        $salesDetail->purchase_no=OrderDetail::count();
        $salesDetail->description=$request->description;
        $salesDetail->supplier_id=$request->supplier_id;
        $salesDetail->user_id=Auth::id();

        $salesDetail->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully created new purchase order item!');
    }

    public function destroy(OrderDetail $orderDetail) {
        $orderDetail->delete();
        return back()->with('success', 'Successfully deleted sales order item!');
    }
}
