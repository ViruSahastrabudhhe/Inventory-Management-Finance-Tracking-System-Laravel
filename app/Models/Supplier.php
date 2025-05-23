<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'email',
        'phone',
        'address',
        'shop_name',
        'user_id',
    ];
}
