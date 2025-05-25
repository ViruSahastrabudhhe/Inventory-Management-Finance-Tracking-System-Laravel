<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        'completion_date',
        'supplier_id',
        'user_id',
    ];

    public function getPurchases() {
        $purchases = Purchase::where('user_id', '=', Auth::user()->id)->get();
        return $purchases;
    }
}
