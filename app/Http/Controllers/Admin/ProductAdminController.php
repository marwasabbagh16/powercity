<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('q')) {
            $query->where(function($q) use ($request) {
                $q->where('libelle', 'like', "%{$request->q}%")
                  ->orWhere('reference', 'like', "%{$request->q}%")
                  ->orWhere('marque', 'like', "%{$request->q}%");
            });
        }

        $products = $query->paginate(20)->withQueryString();
        $categories = Category::all();

        return view('admin.products', compact('products', 'categories'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.product-edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'libelle'     => 'required|min:2',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'datasheet'   => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $data = [
        'libelle'       => $request->libelle,
        'category_id'   => $request->category_id,
        'reference'     => $request->reference,
        'marque'        => $request->marque,
        'description'   => $request->description,
        'topologie'     => $request->topologie,
        'puissance'     => $request->puissance,
        'rendement'     => $request->rendement,
        'configuration' => $request->configuration,
         ];

        // Upload image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        // Upload datasheet PDF
        if ($request->hasFile('datasheet')) {
            // Supprimer l'ancienne datasheet
            if ($product->datasheet) {
                Storage::disk('public')->delete($product->datasheet);
            }
            $data['datasheet'] = $request->file('datasheet')->store('datasheets', 'public');
        }

        $product->update($data);

        return back()->with('success', '✅ Produit mis à jour avec succès !');
    }
    public function create()
{
    $categories = Category::all();
    return view('admin.product-create', compact('categories'));
}

public function store(Request $request)
{
    $request->validate([
        'libelle'     => 'required|min:2',
        'reference'   => 'required',
        'category_id' => 'required|exists:categories,id',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'datasheet'   => 'nullable|file|mimes:pdf|max:10240',
    ]);

    $data = [
        'libelle'       => $request->libelle,
        'category_id'   => $request->category_id,
        'reference'     => $request->reference,
        'marque'        => $request->marque,
        'description'   => $request->description,
        'topologie'     => $request->topologie,
        'puissance'     => $request->puissance,
        'rendement'     => $request->rendement,
        'configuration' => $request->configuration,
    ];

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    if ($request->hasFile('datasheet')) {
        $data['datasheet'] = $request->file('datasheet')->store('datasheets', 'public');
    }

    Product::create($data);

    return redirect()->route('admin.products')->with('success', '✅ Produit créé avec succès !');
}
public function destroy(Product $product)
{
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }
    if ($product->datasheet) {
        Storage::disk('public')->delete($product->datasheet);
    }
    $product->delete();
    return back()->with('success', '✅ Produit supprimé avec succès !');
}
}