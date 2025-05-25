<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'email',
        'phone',
        'billing_address',
        'shipping_address',
        'is_active',
        'user_id',
    ];
}
