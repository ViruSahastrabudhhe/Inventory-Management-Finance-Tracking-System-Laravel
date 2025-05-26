<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseDetail extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'purchase_details';

    protected $fillable = [
        'quantity',
        'total',
        'purchase_id',
        'product_id',
        'user_id',
    ];

    public function getItemPurchaseDetails(int $productID) {
        $itemDetails = DB::table('purchase_details')
            ->join('purchases', 'purchases.id', '=', 'purchase_details.purchase_id')
            ->join('products', 'products.id', '=', 'purchase_details.product_id')
            ->where('purchase_details.user_id', '=', Auth::user()->id)
            ->where('products.id', '=', $productID)
            ->get();

        return $itemDetails;
    }

    public function getItemPurchaseInfo(int $productID) {
        $ppinfo = DB::table('purchases')
            ->join('purchase_details', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('products', 'purchase_details.product_id', '=', 'products.id')
            ->join('suppliers', 'purchases.supplier_id', '=', 'suppliers.id')
            ->where('products.id', '=', $productID)
            ->where('purchases.user_id', '=', Auth::user()->id)
            ->get();

        return $ppinfo;
    }
}
