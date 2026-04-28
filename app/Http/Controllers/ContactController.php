<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contact');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|min:2',
            'email'   => 'required|email',
            'subject' => 'required|min:5',
            'message' => 'required|min:10',
        ]);

        Devis::create([
            'reference'    => 'DEV-' . strtoupper(uniqid()),
            'client_name'  => $request->name,
            'client_email' => $request->email,
            'message'      => $request->subject . ' — ' . $request->message,
            'statut'       => 'en_attente',
        ]);

        return back()->with('success', 'Votre message a été envoyé ! Nous vous contacterons sous 24h.');
    }
}