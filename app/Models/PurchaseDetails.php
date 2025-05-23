<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseDetails extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'purchase_details';

    protected $fillable = [
        'quantity',
        'total',
        'purchase_id',
        'product_id',
        'user_id',
    ];
}
