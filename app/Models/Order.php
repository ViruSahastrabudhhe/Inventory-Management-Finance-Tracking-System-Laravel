<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
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
        'description',
        'order_date',
        'shipping_date',
        'delivery_date',
        'completion_date',
        'payment_type',
        'total_products',
        'sub_total',
        'is_returned',
        'customer_id',
        'user_id',
    ];
}
