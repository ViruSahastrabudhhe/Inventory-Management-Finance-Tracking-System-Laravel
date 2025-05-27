<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait PurchaseTrait
{
        public function getPurchaseItemDetails(int $purchaseID) {
        $pdinfo = DB::table('purchases')
            ->join('purchase_details', 'purchases.id', '=', 'purchase_details.purchase_id')
            ->join('products', 'products.id', '=', 'purchase_details.product_id')
            ->where('purchases.user_id', '=', Auth::user()->id)
            ->where('purchases.id', '=', $purchaseID)
            ->get();

        return $pdinfo;
    }
}
