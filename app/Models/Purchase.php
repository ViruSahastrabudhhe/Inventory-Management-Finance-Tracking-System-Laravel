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
        $purchases = Purchase::where('user_id', '=', Auth::user()->id)->get();
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

}
