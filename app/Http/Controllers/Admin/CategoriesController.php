<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::where([]);
        $categories = $categories->paginate(8);
        return view('admin.categories.index', compact('categories'));
    }

    public function view_products($id)
    {
        $category= Category::find($id);
        $products= $category->products;//pagination not working
        return view('admin.categories.products', compact('category', 'products'));
    }
}

