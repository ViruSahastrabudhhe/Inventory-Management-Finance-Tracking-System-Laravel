<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Category extends Model
{
    use HasFactory;
    /**

     * The table associated with the model.

     *

     * @var string

     */

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'user_id',
    ];

    public function categoriesExists() {
        $categories = Category::where('user_id', '=',  Auth::user()->id)->count();
        if ($categories > 0) {
            return true;
        }

        return false;
    }

    public function getCategories() {
        $categoryName = Category::where('user_id', '=', Auth::user()->id)->get();
        return $categoryName;
    }
}
