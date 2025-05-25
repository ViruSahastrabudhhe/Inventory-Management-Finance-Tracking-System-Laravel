<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

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
    
}
