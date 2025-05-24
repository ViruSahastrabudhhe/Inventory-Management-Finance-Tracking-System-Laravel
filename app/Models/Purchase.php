<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'purchases';

    protected $fillable = [
        'name',
        'purchase_status',
        'purchase_no',
        'purchase_date',
        'supplier_id',
        'user_id',
    ];
}
