@extends('admin.layout')
@section('title', 'Devis')
@section('page-title', 'Demandes de devis')
@section('breadcrumb', 'Devis')

@section('content')

<div class="kpi-grid">
    <div class="kpi-card" style="--kpi-color:#4caf50">
        <div class="kpi-val">{{ $stats['total'] }}</div>
        <div class="kpi-label">Total</div>
    </div>
    <div class="kpi-card" style="--kpi-color:#eab308">
        <div class="kpi-val">{{ $stats['en_attente'] }}</div>
        <div class="kpi-label">En attente</div>
    </div>
    <div class="kpi-card" style="--kpi-color:#2563eb">
        <div class="kpi-val">{{ $stats['en_traitement'] }}</div>
        <div class="kpi-label">En traitement</div>
    </div>
    <div class="kpi-card" style="--kpi-color:#4caf50">
        <div class="kpi-val">{{ $stats['valide'] }}</div>
        <div class="kpi-label">Validés</div>
    </div>
</div>

{{-- Filtres --}}
<div style="display:flex;gap:8px;margin-bottom:16px">
    <a href="{{ route('admin.devis') }}" class="btn {{ !request('statut') ? 'btn-green' : 'btn-outline' }}">Tous ({{ $stats['total'] }})</a>
    <a href="{{ route('admin.devis', ['statut' => 'en_attente']) }}" class="btn {{ request('statut') === 'en_attente' ? 'btn-green' : 'btn-outline' }}">En attente ({{ $stats['en_attente'] }})</a>
    <a href="{{ route('admin.devis', ['statut' => 'en_traitement']) }}" class="btn {{ request('statut') === 'en_traitement' ? 'btn-green' : 'btn-outline' }}">En traitement ({{ $stats['en_traitement'] }})</a>
    <a href="{{ route('admin.devis', ['statut' => 'valide']) }}" class="btn {{ request('statut') === 'valide' ? 'btn-green' : 'btn-outline' }}">Validés ({{ $stats['valide'] }})</a>
    <a href="{{ route('admin.devis', ['statut' => 'refuse']) }}" class="btn {{ request('statut') === 'refuse' ? 'btn-green' : 'btn-outline' }}">Refusés ({{ $stats['refuse'] }})</a>
</div>

<div class="panel">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Référence</th>
                    <th>Client</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($devis as $d)
                <tr>
                    <td style="font-family:monospace;font-size:12px;color:var(--green);font-weight:600">{{ $d->reference }}</td>
                    <td>
                        <div style="font-weight:600">{{ $d->client_name }}</div>
                        <div style="font-size:11px;color:var(--text-muted)">{{ $d->client_email }}</div>
                        @if($d->client_company)
                        <div style="font-size:11px;color:var(--text-muted)">{{ $d->client_company }}</div>
                        @endif
                    </td>
                    <td style="font-size:12px;color:var(--text-muted);max-width:200px">
                         {{ Str::limit($d->message, 60) }}
                      <br>
                       <a href="{{ route('admin.devis.show', $d->id) }}" 
                    style="color:#4caf50;font-size:11px;font-weight:600">
                      👁 Voir complet
                         </a>
                     </td>
                    <td style="font-size:11px;color:var(--text-muted)">
                        {{ \Carbon\Carbon::parse($d->created_at)->format('d/m/Y H:i') }}
                    </td>
                    <td>
                        @if($d->statut === 'en_attente') <span class="pill pill-yellow">En attente</span>
                        @elseif($d->statut === 'en_traitement') <span class="pill pill-blue">En traitement</span>
                        @elseif($d->statut === 'valide') <span class="pill pill-green">Validé</span>
                        @else <span class="pill pill-red">Refusé</span>
                        @endif
                    </td>
                   <td>
    <form method="POST" action="{{ route('admin.devis.statut', $d->id) }}" style="display:flex;flex-direction:column;gap:6px">
        @csrf
        @method('PATCH')
        <select name="statut" style="background:#0f3356;border:1px solid rgba(76,175,80,0.3);border-radius:8px;color:#e8edf5;padding:6px 10px;font-size:12px;font-family:'Sora',sans-serif;cursor:pointer;outline:none">
            <option value="en_attente" {{ $d->statut === 'en_attente' ? 'selected' : '' }} style="background:#0d2b45">⏳ En attente</option>
            <option value="en_traitement" {{ $d->statut === 'en_traitement' ? 'selected' : '' }} style="background:#0d2b45">🔄 En traitement</option>
            <option value="valide" {{ $d->statut === 'valide' ? 'selected' : '' }} style="background:#0d2b45">✅ Validé</option>
            <option value="refuse" {{ $d->statut === 'refuse' ? 'selected' : '' }} style="background:#0d2b45">❌ Refusé</option>
        </select>
        <button type="submit" style="background:#4caf50;color:white;border:none;border-radius:8px;padding:6px 12px;font-size:12px;font-family:'Sora',sans-serif;font-weight:600;cursor:pointer;transition:all 0.2s">
            Sauvegarder
        </button>
    </form>
</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:30px;color:var(--text-muted)">Aucune demande de devis</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div style="padding:16px">{{ $devis->links() }}</div>
</div>

@endsection