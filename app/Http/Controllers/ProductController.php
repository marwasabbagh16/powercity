<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $marques = Product::whereNotNull('marque')->distinct()->pluck('marque')->sort()->values();
        $query = Product::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('marque')) {
            $query->where('marque', $request->marque);
        }

        if ($request->filled('q')) {
            $query->search($request->q);
        }

        $products = $query->paginate(16)->withQueryString();

        return view('products.index', compact('products', 'categories', 'marques'));
    }

    public function show(Product $product)
    {
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }

    public function search(Request $request)
    {
        $categories = Category::all();
        $marques = Product::whereNotNull('marque')->distinct()->pluck('marque')->sort()->values();
        $products = Product::search($request->q)
            ->with('category')
            ->paginate(16)
            ->withQueryString();

        return view('products.index', compact('products', 'categories', 'marques'));
    }
}