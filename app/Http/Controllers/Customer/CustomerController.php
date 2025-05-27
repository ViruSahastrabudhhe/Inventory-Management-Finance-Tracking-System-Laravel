<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index() {
        return view("customer.index");
    }
    
    public function create() {
        return view("customer.create");
    }

    public function edit(Customer $customer) {
        return view("customer.edit", ['customer'=>$customer]);
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>['nullable'],
            'company_name'=>['required'],
            'description'=>['nullable'],
            'email'=>['required', 'email'],
            'phone'=>['required'],
            'billing_address'=>['nullable'],
            'shipping_address'=>['nullable'],
            'is_active'=>['required', 'boolean'],
        ]);

        $customer = new Customer;

        $customer->name= $request->name;
        $customer->company_name= $request->company_name;
        $customer->description = $request->description;
        $customer->email= $request->email;
        $customer->phone= $request->phone;
        $customer->billing_address = $request->billing_address;
        $customer->shipping_address = $request->shipping_address;
        $customer->is_active= $request->is_active;
        $customer->user_id= Auth::id();
        
        $customer->save();

        return redirect()->route('view-customers')->with('success', 'Successfully added new customer!');
    }

    public function update(Request $request, Customer $customer) {
        $request->validate([
            'name'=>['required'],
            'company_name'=>['required'],
            'description'=>['required'],
            'email'=>['required', 'email'],
            'phone'=>['required'],
            'billing_address'=>['nullable'],
            'shipping_address'=>['nullable'],
            'is_active'=>['boolean'],
        ]);

        $customer->name= $request->name;
        $customer->company_name= $request->company_name;
        $customer->description= $request->description;
        $customer->email= $request->email;
        $customer->phone= $request->phone;
        if ($request->billing_address == null) {
            $customer->billing_address = '';
        } else {
            $customer->billing_address = $request->billing_address;
        }
        if ($request->shipping_address == null) {
            $customer->shipping_address = '';
        } else {
            $customer->shipping_address = $request->shipping_address;
        }
        $customer->is_active= $request->is_active;
        $customer->user_id= Auth::id();
        
        $customer->save();

        return redirect()->route('view-customers')->with('success', 'Successfully updated customer information!');
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return redirect()->route('view-customers')->with('success','Successfully deleted customer information!');
    }
}

