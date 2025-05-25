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
        $category = $this->getProductCategoryCount();
        if (empty($category)) {
            session()->flash('error', 'Create categories first before adding items!');
            return view("category.create");
        }
        return view("category.create");
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
}
