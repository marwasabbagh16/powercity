<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
 
class DevisController extends Controller
{
    // Statuts autorisés — correspond à ce que demande l'encadrant
    const STATUTS = ['Pending', 'Approved', 'Rejected'];
 
    public function index(Request $request)
    {
        $query = DB::table('devis')->orderBy('created_at', 'desc');
 
        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }
 
        $devis = $query->paginate(20)->withQueryString();
 
        $stats = [
            'total'    => DB::table('devis')->count(),
            'pending'  => DB::table('devis')->where('statut', 'Pending')->count(),
            'approved' => DB::table('devis')->where('statut', 'Approved')->count(),
            'rejected' => DB::table('devis')->where('statut', 'Rejected')->count(),
        ];
 
        return view('admin.devis', compact('devis', 'stats'));
    }
 
    public function show($id)
    {
        $devis = DB::table('devis')->where('id', $id)->first();
 
        abort_if(!$devis, 404);
 
        return view('admin.devis-show', compact('devis'));
    }
 
    public function updateStatut(Request $request, $id)
    {
        // Validation : seuls Pending, Approved, Rejected sont acceptés
        $request->validate([
            'statut' => ['required', 'in:Pending,Approved,Rejected'],
        ]);
 
        $updated = DB::table('devis')->where('id', $id)->update([
            'statut'     => $request->statut,
            'updated_at' => now(),
        ]);
 
        if (!$updated) {
            return back()->with('error', 'Devis introuvable.');
        }
 
        $messages = [
            'Pending'  => 'Devis remis en attente.',
            'Approved' => 'Devis accepté avec succès.',
            'Rejected' => 'Devis refusé.',
        ];
 
        return back()->with('success', $messages[$request->statut]);
    }
}