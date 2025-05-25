<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Supplier extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'suppliers';

    protected $fillable = [
        'name',
        'description',
        'company_name',
        'email',
        'phone',
        'address',
        'is_active',
        'user_id',
    ];

    public function suppliersExist() {
        $suppliers = Supplier::where('user_id', '=',  Auth::user()->id)->count();
        if ($suppliers > 0) {
            return true;
        }

        return false;
    }

    public function getSuppliers() {
        $suppliers = Supplier::where('user_id', '=', Auth::user()->id)->get();
        return $suppliers;
    }
    
    public function getSupplierCompanyName($productID) {
        $companyName = DB::table('suppliers')
            ->join('purchases', 'purchases.supplier_id', '=', 'suppliers.id')
            ->join('purchase_details', 'purchase_details.purchase_id', '=', 'purchases.id')
            ->join('products', 'products.id', '=', 'purchase_details.product_id')
            ->where('suppliers.user_id', '=', Auth::user()->id)
            ->where('products.id', '=', $productID)
            ->select('suppliers.*', 'suppliers.company_name')
            ->pluck('company_name');
        
        foreach ($companyName as $c) {
            echo $c;
        }
    }
}
