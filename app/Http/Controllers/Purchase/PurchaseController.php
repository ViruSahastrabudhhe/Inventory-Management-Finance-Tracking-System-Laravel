<?php

namespace App\Http\Controllers\Purchase;

use App\Models\Purchase;
use App\Traits\PurchaseTrait;
use App\Models\Supplier;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PurchaseController extends Controller
{
    use PurchaseTrait;
    public function index() {
        return view('purchase.index');
    }
    public function create() {
        $supplier=Supplier::where('user_id', '=', Auth::user()->id)->count();
        if ($supplier==0) {
            return redirect()->route('view-add-supplier')->with('error','Add a supplier first before creating purchase order!');
        }
        return view('purchase.create');
    }

    public function edit(Purchase $purchase) {
        return view("purchase.edit", ["purchase"=> $purchase]);
    }

    public function show(Purchase $purchase) {
        return view("purchase.show", ["purchase"=>$purchase]);
    }

    public function goto(int $purchaseID) {
        $purchase=Purchase::where('id', '=', $purchaseID)
            ->where('user_id', '=', Auth::user()->id)
            ->first();
        return $this->show($purchase);
    }

    public function issue(Purchase $purchase) {
        $purchase=Purchase::where('id','=', $purchase->id)
            ->where('user_id','=', Auth::user()->id)
            ->first();
        
        $purchase->purchase_status="Placed";

        $purchase->save();

        return back()->with("success","Successfully placed order!");
    }

    public function complete(Purchase $purchase) {
        $purchase=Purchase::where('id','=', $purchase->id)
            ->where('user_id','=', Auth::user()->id)
            ->first();

        
        date_default_timezone_set("Asia/Manila");
        $date = date('Y-m-d H:i:s');
        $purchase->purchase_status="Completed";
        $purchase->completion_date=$date;

        $purchase->save();

        return back()->with("success","Successfully completed order!");
    }

    public function store(Request $request) {
        $request->validate([
            'purchase_no' => ['required'],
            'purchase_description' => ['nullable'],
            'payment_type' => ['required'],
            'supplier_id' => ['required'],
            'target_date' => ['nullable', Rule::date()->format('Y-m-d')],
        ]);

        $purchase=new Purchase;

        date_default_timezone_set("Asia/Manila");
        $purchase_date = date('Y-m-d');

        $purchase->purchase_no=Purchase::count();
        $purchase->purchase_description=$request->purchase_description;
        $purchase->purchase_date=$purchase_date;
        $purchase->target_date=$request->target_date;
        $purchase->payment_type=$request->payment_type;
        if($request->supplier_id==null) {
            $purchase->supplier_id=null;
        } else {
            $purchase->supplier_id=$request->supplier_id;
        }
        $purchase->user_id=Auth::id();

        $purchase->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully created new purchase order!');
    }


    public function update(Request $request, Purchase $purchase) {
        $request->validate([
            'purchase_description' => ['required'],
            'payment_type' => ['required'],
            'supplier_id' => ['required'],
            'target_date' => ['required', Rule::date()->format('Y-m-d')],
        ]);

        $purchase->purchase_description=$request->purchase_description;
        $purchase->payment_type=$request->payment_type;
        $purchase->supplier_id=$request->supplier_id;
        $purchase->target_date=$request->target_date;

        $purchase->save();

        return redirect()->route('view-purchases')->with('success', 'Successfully updated new purchase order!');
    }

    public function destroy(Purchase $purchase) {
        $purchase->delete();
        return redirect()->route('view-purchases')->with('success', 'Successfully deleted purchase order!');
    }
}
