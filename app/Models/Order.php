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
        'order_no',
        'order_status',
        'order_description',
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

    public function getSales() {
        $orders = Order::where('user_id', '=', Auth::user()->id)->get();
        return $orders;
    }

    public function getProcessingSales() {
        $orders = Order::where('user_id', '=', Auth::user()->id)
            ->where('order_status', '!=', 'Completed')
            ->get();
        return $orders;
    }

    public function getCustomerName(int $customerID) {
        $customerName = Customer::where('user_id', '=', Auth::id())
            ->where('id','=', $customerID)
            ->pluck('name')[0];
        
        return $customerName;
    }

    public function getSalesItemDetails(int $orderID) {
        $salesDetailsInfo = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->where('orders.user_id', '=', Auth::user()->id)
            ->where('orders.id', '=', $orderID)
            ->select('products.name as itemName', 'order_details.quantity as itemQuantity', 
            'order_details.total as itemTotalPrice', 'products.id as productID',
            'order_details.id as odID', 'order_details.is_delivered as isDelivered', 'orders.completion_date as completionDate')
            ->get();

        return $salesDetailsInfo;
    }
}
