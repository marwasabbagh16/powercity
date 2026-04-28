<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduits = Product::count();
        $totalCategories = Category::count();
        $totalDevis = DB::table('devis')->count();
        $devisEnAttente = DB::table('devis')->where('statut', 'en_attente')->count();
        $devisRecents = DB::table('devis')->orderBy('created_at', 'desc')->limit(5)->get();
        $produitsParCategorie = Category::withCount('products')->get();

        return view('admin.dashboard', compact(
            'totalProduits', 'totalCategories',
            'totalDevis', 'devisEnAttente',
            'devisRecents', 'produitsParCategorie'
        ));
    }
}