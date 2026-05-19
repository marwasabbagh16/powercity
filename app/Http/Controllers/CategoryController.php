<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // Récupère les IDs de cette catégorie + ses enfants
        $categoryIds = Category::where('parent_id', $category->id)
                               ->pluck('id')
                               ->push($category->id);

        $products = Product::whereIn('category_id', $categoryIds)
                           ->orderBy('created_at', 'desc')
                           ->get();

        $allCategories = Category::all();
        
        return view('categories.show', compact('category', 'products', 'allCategories'));
    }
}