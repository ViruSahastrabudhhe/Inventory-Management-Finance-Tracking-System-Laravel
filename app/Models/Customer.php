<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'company_name',
        'description',
        'email',
        'phone',
        'billing_address',
        'shipping_address',
        'is_active',
        'user_id',
    ];

    public function getCustomers() {
        $customers=Customer::where('user_id', '=', Auth::user()->id)->get();
        return $customers;
    }
}
