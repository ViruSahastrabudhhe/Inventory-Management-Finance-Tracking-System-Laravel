<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Purchase extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'purchases';

    protected $fillable = [
        'name',
        'purchase_no',
        'purchase_status',
        'purchase_description',
        'payment_type',
        'purchase_date',
        'target_date',
        'completion_date',
        'supplier_id',
        'user_id',
    ];

    public function getPurchases() {
        $purchases = Purchase::where('user_id', '=', Auth::user()->id)
            ->get();
        return $purchases;  
    }

    public function getProcessingPurchases() {
        $purchases = Purchase::where('user_id', '=', Auth::user()->id)
            ->where('completion_date', null)
            ->get();
        return $purchases;  
    }

    public function getPurchaseSupplierName(int $purchaseID) {
        $supplierName = DB::table('purchases')
            ->join('suppliers', 'suppliers.id', '=', 'purchases.supplier_id')
            ->where('purchases.user_id','=', Auth::user()->id)
            ->where('purchases.id','=', $purchaseID)
            ->pluck('company_name')[0];
        
        return $supplierName;

    }

    public function getPurchaseItemDetails(int $purchaseID) {
        $purchaseDetailsInfo = DB::table('purchases')
            ->join('purchase_details', 'purchases.id', '=', 'purchase_details.purchase_id')
            ->join('products', 'products.id', '=', 'purchase_details.product_id')
            ->where('purchases.user_id', '=', Auth::user()->id)
            ->where('purchases.id', '=', $purchaseID)
            ->select('products.name as itemName', 'purchase_details.quantity as itemQuantity', 
            'purchase_details.total as itemTotalPrice', 'purchase_details.is_received as itemReceived', 'products.id as productID',
            'purchase_details.id as pdID', 'purchases.completion_date as completionDate')
            ->get();

        return $purchaseDetailsInfo;
    }

}
