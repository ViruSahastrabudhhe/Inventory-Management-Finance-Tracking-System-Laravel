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

    public function edit(Supplier $supplier) {
        return view("supplier.edit", ['supplier'=>$supplier]);
    }

    public function store(Request $request) {
        $request->validate([
            'name'=>['nullable'],
            'company_name'=>['required'],
            'description'=>['nullable'],
            'email'=>['required', 'email'],
            'phone'=>['required'],
            'address'=>['required'],
            'is_active'=>['boolean'],
        ]);

        $supplier = new Supplier;

        if ($request->name===null) {
            $supplier->name=null;
        } else {
            $supplier->name = $request->name;
        }
        $supplier->company_name = $request->company_name;
        $supplier->description = $request->description;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->is_active = $request->is_active;
        $supplier->user_id = Auth::id();

        $supplier->save();

        return redirect()->route('view-suppliers')->with('success', 'Successfully added supplier!');
    }

    public function update(Request $request, Supplier $supplier) {
        $request->validate([
            'name'=>['nullable'],
            'company_name'=>['required'],
            'description'=>['nullable'],
            'email'=>['required', 'email'],
            'phone'=>['required'],
            'address'=>['required'],
            'is_active'=>['boolean'],
        ]);

        if ($request->name===null) {
            $supplier->name=null;
        } else {
            $supplier->name = $request->name;
        }
        $supplier->company_name = $request->company_name;
        $supplier->description = $request->description;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->address = $request->address;
        $supplier->is_active = $request->is_active;
        $supplier->user_id = Auth::id();

        $supplier->save();
        
        return redirect(route('view-suppliers'))->with('success', "Successfully updated supplier!");
    }

    public function destroy(Supplier $supplier) {
        $supplier->delete();
        return redirect(route('view-suppliers'))->with('success', "Successfully deleted supplier!");
    }

}
