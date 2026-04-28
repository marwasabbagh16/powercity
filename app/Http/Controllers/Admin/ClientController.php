<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        $clients = DB::table('devis')
            ->select('client_name', 'client_email', 'client_company', 'client_city',
                     DB::raw('COUNT(*) as total_devis'),
                     DB::raw('MAX(created_at) as dernier_contact'))
            ->groupBy('client_email', 'client_name', 'client_company', 'client_city')
            ->orderBy('total_devis', 'desc')
            ->paginate(20);

        return view('admin.clients', compact('clients'));
    }
}