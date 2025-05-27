<?php

namespace App\Http\Controllers\Category;

use App\Traits\ProductTrait;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ProductTrait;

    public function index() {
        return view("category.index");
    }

    public function create() {
        return view("category.create");
    }

    public function edit(Category $category) {
        return view("category.edit", ['category'=>$category]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'is_parent' => 'boolean',
            'parent_name'=> 'nullable',
        ]);

        $findCategory= Category::where('name', '=', $request->name)->first();
        if (! empty($findCategory)) {
            return back()->with('error', 'Category already exists!');
        }

        $category = new Category;
        $category->name = $request->name;
        if ($request->parent_name==null) {
            $category->parent_name = null;
        } else {
            $category->parent_name = $request->name;
        }
        $category->is_parent = $request->is_parent;
        $category->user_id = Auth::id();
        $category->save();

        return redirect()->route('view-categories')->with('success','Successfully added category!');
    }

    public function update(Request $request, Category $category) {
        $request->validate([
            'name' => 'required',
            'is_parent' => 'boolean',
            'parent_name'=> 'nullable',
        ]);

        $category->name=$request->name;
        $category->is_parent=$request->is_parent;
        $category->save();

        return redirect()->route('view-categories')->with('success','Successfully updated category!');
    }

    public function destroy(Category $category) {
        $category->delete();
        return redirect()->route('view-categories')->with('success','Successfully deleted category!');
    }   
}
