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
        'qty',
        'buying_price',
        'selling_price',
        'status',
        'description',
        'category_id',
        'user_id',
    ];

    public function getCategoryName(int $categoryID) {
        $categoryName = Category::where('user_id', '=', Auth::id())
            ->where('id','=', $categoryID)
            ->pluck('name')[0];
        
        return $categoryName;
    }

}
