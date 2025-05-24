<?php

namespace App\Http\Controllers\Category;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->user_id = Auth::id();
        $category->save();

        return redirect()->route('view-add-product')->with('success','Successfully added category!');
    }
}
