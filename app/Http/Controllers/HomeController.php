<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->withCount('products')->get();
        
        $featuredProducts = Product::with('category')
    ->where('featured', true)
    ->limit(8)
    ->get();

        return view('home', compact('categories', 'featuredProducts'));
    }
}