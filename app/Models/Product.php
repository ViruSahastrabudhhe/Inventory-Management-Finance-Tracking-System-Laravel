<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'products';

    protected $fillable = [
        'name',
        'category_id',
        'qty',
        'buying_price',
        'selling_price',
        'description',
        'user_id',
    ];

    public function getCategoryName(int $categoryID) {
        $categoryName = Category::where('user_id', '=', Auth::id())
            ->where('id','=', $categoryID)
            ->pluck('name')[0];
        return $categoryName;
    }
}
