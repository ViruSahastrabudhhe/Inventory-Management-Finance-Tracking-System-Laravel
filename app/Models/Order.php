<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        'status',
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

    public function getOrders() {
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();
        return $orders;
    }
}
