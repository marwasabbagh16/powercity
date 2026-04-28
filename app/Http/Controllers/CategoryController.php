<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        
        $products = $category->products()->paginate(16);

        $allCategories = Category::all();

        return view('categories.show', compact('category', 'products', 'allCategories'));
    }
}