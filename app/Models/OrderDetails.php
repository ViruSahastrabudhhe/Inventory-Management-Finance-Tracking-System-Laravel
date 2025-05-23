<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetails extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'order_details';

    protected $fillable = [
        'quantity',
        'total',
        'product_id',
        'order_id',
        'user_id',
    ];
}
