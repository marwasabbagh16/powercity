<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('products')->get();
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

        $products = $query->latest()->paginate(100)->withQueryString();

        $categoriesAvecMarques = Product::whereNotNull('marque')
            ->whereNotNull('category_id')
            ->select('category_id', 'marque')
            ->distinct()
            ->get()
            ->groupBy('category_id')
            ->map(fn($items) => $items->pluck('marque')->unique()->values());

        // 👇 Ajout du nom de la catégorie
        $categoryName = null;
        if ($request->filled('category')) {
            $categoryName = Category::find($request->category)?->name;
        }

        return view('products.index', compact('products', 'categories', 'marques', 'categoriesAvecMarques', 'categoryName'));
    }

    public function show(Product $product)
    {
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'related'));
    }

    public function search(Request $request)
{
    $q = $request->q;
    $categories = Category::all();
    $marques = Product::whereNotNull('marque')->distinct()->pluck('marque')->sort()->values();
    
    $products = Product::where('libelle', 'LIKE', '%' . $q . '%')
        ->orWhere('description', 'LIKE', '%' . $q . '%')
        ->orWhere('reference', 'LIKE', '%' . $q . '%')
        ->orWhere('marque', 'LIKE', '%' . $q . '%')
        ->with('category')
        ->paginate(16)
        ->withQueryString();

    $categoriesAvecMarques = Product::whereNotNull('marque')
        ->whereNotNull('category_id')
        ->select('category_id', 'marque')
        ->distinct()
        ->get()
        ->groupBy('category_id')
        ->map(fn($items) => $items->pluck('marque')->unique()->values());

    $categoryName = null;

    return view('products.index', compact('products', 'categories', 'marques', 'categoriesAvecMarques', 'categoryName'));
}

    public function categoriesByMarque(Request $request)
    {
        $categories = Category::whereHas('products', function ($q) use ($request) {
            $q->where('marque', $request->marque);
        })->get();

        return response()->json($categories);
    }
}