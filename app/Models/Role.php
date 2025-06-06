<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'roles';

    protected $fillable = [
        'name',
    ];
}
