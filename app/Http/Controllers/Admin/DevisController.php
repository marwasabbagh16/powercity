<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevisController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('devis')->orderBy('created_at', 'desc');

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        $devis = $query->paginate(20)->withQueryString();
        $stats = [
            'total' => DB::table('devis')->count(),
            'en_attente' => DB::table('devis')->where('statut', 'en_attente')->count(),
            'en_traitement' => DB::table('devis')->where('statut', 'en_traitement')->count(),
            'valide' => DB::table('devis')->where('statut', 'valide')->count(),
            'refuse' => DB::table('devis')->where('statut', 'refuse')->count(),
        ];

        return view('admin.devis', compact('devis', 'stats'));
    }

    public function updateStatut(Request $request, $id)
    {
        DB::table('devis')->where('id', $id)->update([
            'statut' => $request->statut,
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Statut mis à jour !');
    }
    public function show($id)
     {
    $devis = DB::table('devis')->where('id', $id)->first();
    return view('admin.devis-show', compact('devis'));
     }
}