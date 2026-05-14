<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        $products = $category->products()->orderBy('created_at', 'desc')->get();
        $allCategories = Category::all();
        return view('categories.show', compact('category', 'products', 'allCategories'));
    }
}