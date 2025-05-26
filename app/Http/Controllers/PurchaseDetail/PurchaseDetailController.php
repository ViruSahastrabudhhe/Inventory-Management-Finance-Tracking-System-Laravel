<?php

namespace App\Http\Controllers\PurchaseDetail;

use App\Models\PurchaseDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class PurchaseDetailController extends Controller
{
    public function create() {
        return view('purchase_detail.create');
    }

    public function edit(PurchaseDetail $purchase) {
        return view("purchase.edit", ["purchase"=> $purchase]);
    }

    public function show(PurchaseDetail $purchase) {
        return view("purchase.show", ["purchase"=>$purchase]);
    }

    public function goto(int $purchaseID) {
        $purchase=PurchaseDetail::where('id', '=', $purchaseID)
            ->where('user_id', '=', Auth::user()->id)
            ->first();
        return $this->show($purchase);
    }

    public function store(Request $request) {
        $request->validate([
            'purchase_no' => 'required',
            'description' => 'required',
            'supplier_id' => 'required',
        ]);

        $purchase=new PurchaseDetail;

        $purchase->purchase_no=PurchaseDetail::count();
        $purchase->description=$request->description;
        $purchase->supplier_id=$request->supplier_id;
        $purchase->user_id=Auth::id();

        $purchase->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully created new purchase order!');
    }


    public function update(Request $request, PurchaseDetail $purchase) {
        $request->validate([
            'purchase_no' => 'required',
            'description' => 'required',
            'supplier_id' => 'required',
        ]);

        $purchase->purchase_no=PurchaseDetail::count();
        $purchase->description=$request->description;
        $purchase->supplier_id=$request->supplier_id;
        $purchase->user_id=Auth::id();

        $purchase->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully created new purchase order!');
    }

    public function destroy(PurchaseDetail $purchase) {
        $purchase->delete();
        return redirect()->route('view-purchases')->with('success', 'Successfully deleted purchase order!');
    }
}
