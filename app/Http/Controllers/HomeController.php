<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        
        $featuredProducts = Product::with('category')
        ->where(function($q) {
        $q->where('libelle', 'like', '%93E%')
          ->orWhere('libelle', 'like', '%93T%')
          ->orWhere('libelle', 'like', '%93PM%')
          ->orWhere('libelle', 'like', '%93PS%');
    })
    ->limit(8)
    ->get();

        return view('home', compact('categories', 'featuredProducts'));
    }
}