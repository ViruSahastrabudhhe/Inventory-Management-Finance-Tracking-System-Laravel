<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleUser extends Model
{
    use HasFactory;

    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'role_user';

    protected $fillable = [
        "user_id",
        "role_id",
    ];
}
