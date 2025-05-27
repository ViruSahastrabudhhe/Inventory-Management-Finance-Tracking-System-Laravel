<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class SalesController extends Controller
{
    public function index() {
        return view("sales.index");
    }

    public function create() {
        $customer=Customer::where('user_id', '=', Auth::user()->id)->count();
        if ($customer==0) {
            return redirect()->route('view-add-customer')->with('error','Add a customer first before creating a sales order!');
        }
        return view("sales.create");
    }

    public function edit(Order $sales) {
        return view("sales.edit", ['sales'=>$sales]);
    }

    public function goto(int $salesID) {
        $sales=Order::where('id', '=', $salesID)
            ->where('user_id', '=', Auth::user()->id)
            ->first();
        return $this->show($sales);
    }

    public function issue(Order $sales) {
        $sales=Order::where('id','=', $sales->id)
            ->where('user_id','=', Auth::user()->id)
            ->first();
        
        $sales->order_status="Placed";

        $sales->save();

        return back()->with("success","Successfully placed order!");
    }
    public function ship(Order $sales) {
        $sales=Order::where('id','=', $sales->id)
            ->where('user_id','=', Auth::user()->id)
            ->first();
        
        $sales->order_status="Shipped";

        $sales->save();

        return back()->with("success","Successfully shipped order!");
    }
    public function deliver(Order $sales) {
        $sales=Order::where('id','=', $sales->id)
            ->where('user_id','=', Auth::user()->id)
            ->first();
        
        $sales->order_status="Delivered";

        $sales->save();

        return back()->with("success","Successfully delivered order!");
    }
    public function complete(Order $sales) {
        $sales=Order::where('id','=', $sales->id)
            ->where('user_id','=', Auth::user()->id)
            ->first();
        
        $sales->order_status="Completed";

        $sales->save();

        return back()->with("success","Successfully completed order!");
    }

    public function show(Order $sales) {
        return view("sales.show", ["sales"=>$sales]);
    }

    public function store(Request $request) {
        $request->validate([
            'order_no' => ['required'],
            'order_description' => ['nullable'],
            'customer_id' => ['required'],
            'payment_type' => ['required'],
            'total_products' => ['nullable'],
            'sub_total' => ['nullable'],
        ]);

        $sales = new Order;

        date_default_timezone_set("Asia/Manila");
        $order_date = date('Y-m-d H:i:s');

        $sales->order_no = $request->order_no;
        $sales->customer_id = $request->customer_id;
        $sales->order_description = $request->order_description;
        $sales->order_date = $order_date;
        $sales->payment_type = $request->payment_type;
        $sales->user_id = Auth::id();

        $sales->save();

        return redirect()->route('view-sales')->with('success', 'Successfully created new sales order!');
    }
    public function update(Request $request, Order $sales) {
        $request->validate([
            'order_description' => ['nullable'],
            'customer_id' => ['required'],
            'payment_type' => ['required'],
            'total_products' => ['nullable'],
            'sub_total' => ['nullable'],
        ]);

        date_default_timezone_set("Asia/Manila");
        $order_date = date('Y-m-d H:i:s');

        $sales->customer_id = $request->customer_id;
        $sales->order_description = $request->order_description;
        $sales->order_date = $order_date;
        $sales->payment_type = $request->payment_type;
        $sales->user_id = Auth::id();

        $sales->save();

        return redirect()->route('view-sales')->with('success', 'Successfully updated sales order!');
    }

    public function destroy(Order $sales): RedirectResponse {
        $sales->delete();
        return redirect()->route('view-sales')->with('success', 'Successfully deleted sales order!');
    }
}
