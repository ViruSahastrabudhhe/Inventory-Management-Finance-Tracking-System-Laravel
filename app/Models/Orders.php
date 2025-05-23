<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'orders';

    protected $fillable = [
        'order_status',
        'order_date',
        'payment_type',
        'total_products',
        'sub_total',
        'customer_id',
        'user_id',
    ];
}
