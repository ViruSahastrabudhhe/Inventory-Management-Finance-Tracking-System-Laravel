<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Business extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'businesses';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'country',
        'user_id',
    ];
}
