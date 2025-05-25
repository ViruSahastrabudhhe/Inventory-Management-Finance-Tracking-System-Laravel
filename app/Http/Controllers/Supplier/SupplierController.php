<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index() {
        return view("supplier.index");
    }

    public function create() {
        return view("supplier.create");
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>['required'],
            'email'=>['required', 'email'],
            'phone'=>['required'],
            'address'=>['required'],
        ]);

        $supplier = new Supplier;

        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->user_id = Auth::id();

        $supplier->save();

        return redirect()->route('view-suppliers')->with('success', 'Successfully added supplier!');
    }

}
