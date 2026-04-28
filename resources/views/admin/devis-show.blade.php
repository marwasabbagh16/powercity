@extends('admin.layout')
@section('title', 'Devis ' . $devis->reference)
@section('page-title', 'Détail du devis')
@section('breadcrumb', 'Devis / ' . $devis->reference)

@section('content')

<div style="max-width:700px">

    <a href="{{ route('admin.devis') }}" class="btn btn-outline" style="margin-bottom:20px">
        ← Retour
    </a>

    <div class="panel">
        <div class="panel-head">
            <span class="panel-title" style="color:var(--green)">{{ $devis->reference }}</span>
            @if($devis->statut === 'en_attente') <span class="pill pill-yellow">En attente</span>
            @elseif($devis->statut === 'en_traitement') <span class="pill pill-blue">En traitement</span>
            @elseif($devis->statut === 'valide') <span class="pill pill-green">Validé</span>
            @else <span class="pill pill-red">Refusé</span>
            @endif
        </div>

        <div style="padding:20px;display:grid;gap:16px">

            {{-- Infos client --}}
            <div style="background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:8px;padding:16px">
                <div style="font-size:11px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px">
                    👤 Informations client
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px">
                    <div>
                        <div style="font-size:11px;color:var(--text-muted)">Nom</div>
                        <div style="font-size:14px;font-weight:600;color:var(--text)">{{ $devis->client_name }}</div>
                    </div>
                    <div>
                        <div style="font-size:11px;color:var(--text-muted)">Email</div>
                        <a href="mailto:{{ $devis->client_email }}" style="font-size:14px;font-weight:600;color:var(--green)">{{ $devis->client_email }}</a>
                    </div>
                    @if($devis->client_company)
                    <div>
                        <div style="font-size:11px;color:var(--text-muted)">Entreprise</div>
                        <div style="font-size:14px;font-weight:600;color:var(--text)">{{ $devis->client_company }}</div>
                    </div>
                    @endif
                    <div>
                        <div style="font-size:11px;color:var(--text-muted)">Date</div>
                        <div style="font-size:14px;font-weight:600;color:var(--text)">
                            {{ \Carbon\Carbon::parse($devis->created_at)->format('d/m/Y à H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Message complet --}}
            <div style="background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:8px;padding:16px">
                <div style="font-size:11px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px">
                    💬 Message complet
                </div>
                <div style="font-size:14px;color:var(--text);line-height:1.7;white-space:pre-wrap">{{ $devis->message }}</div>
            </div>

            {{-- Changer statut --}}
            <div style="background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:8px;padding:16px">
                <div style="font-size:11px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:12px">
                    ⚙️ Changer le statut
                </div>
                <form method="POST" action="{{ route('admin.devis.statut', $devis->id) }}" style="display:flex;gap:10px;align-items:center">
                    @csrf
                    @method('PATCH')
                    <select name="statut" style="background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:8px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        <option value="en_attente" {{ $devis->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="en_traitement" {{ $devis->statut === 'en_traitement' ? 'selected' : '' }}>En traitement</option>
                        <option value="valide" {{ $devis->statut === 'valide' ? 'selected' : '' }}>Validé</option>
                        <option value="refuse" {{ $devis->statut === 'refuse' ? 'selected' : '' }}>Refusé</option>
                    </select>
                    <button class="btn btn-green" type="submit">💾 Sauvegarder</button>
                    <a href="https://mail.google.com/mail/?view=cm&to={{ $devis->client_email }}&subject=Re: {{ urlencode($devis->reference) }}&body={{ urlencode('Bonjour ' . $devis->client_name . ',') }}" 
                           target="_blank" 
                           class="btn btn-outline">
                    📧 Répondre via Gmail
                   </a>
                </form>
            </div>

        </div>
    </div>
</div>

@endsection