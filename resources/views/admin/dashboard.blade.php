@extends('admin.layout')
@section('title', 'Dashboard')
@section('page-title', 'Tableau de bord')
@section('breadcrumb', 'Dashboard')

@section('content')

@if($devisEnAttente > 0)
<div class="alert-green">
    ⚡ {{ $devisEnAttente }} nouvelle(s) demande(s) de devis en attente de traitement.
</div>
@endif

{{-- KPI --}}
<div class="kpi-grid">
    <div class="kpi-card" style="--kpi-color:#4caf50;--kpi-bg:rgba(76,175,80,0.12)">
        <div class="kpi-icon" style="font-size:20px">📦</div>
        <div class="kpi-val">{{ number_format($totalProduits) }}</div>
        <div class="kpi-label">Produits en catalogue</div>
    </div>
    <div class="kpi-card" style="--kpi-color:#2563eb;--kpi-bg:rgba(37,99,235,0.12)">
        <div class="kpi-icon" style="font-size:20px">📋</div>
        <div class="kpi-val">{{ $totalDevis }}</div>
        <div class="kpi-label">Total demandes de devis</div>
    </div>
    <div class="kpi-card" style="--kpi-color:#f59e0b;--kpi-bg:rgba(245,158,11,0.12)">
        <div class="kpi-icon" style="font-size:20px">⏳</div>
        <div class="kpi-val">{{ $devisEnAttente }}</div>
        <div class="kpi-label">Devis en attente</div>
        @if($devisEnAttente > 0)
        <div class="kpi-delta down">⚠ À traiter rapidement</div>
        @endif
    </div>
    <div class="kpi-card" style="--kpi-color:#8b5cf6;--kpi-bg:rgba(139,92,246,0.12)">
        <div class="kpi-icon" style="font-size:20px">🗂️</div>
        <div class="kpi-val">{{ $totalCategories }}</div>
        <div class="kpi-label">Catégories</div>
    </div>
</div>
    {{-- Produits par catégorie --}}
    <div class="panel">
        <div class="panel-head">
            <span class="panel-title">Produits par catégorie</span>
            <a href="{{ route('admin.products') }}" class="btn btn-outline" style="padding:5px 10px;font-size:11px;">Voir tout</a>
        </div>
        <div style="padding:16px">
            @foreach($produitsParCategorie as $cat)
            <div style="margin-bottom:14px">
                <div style="display:flex;justify-content:space-between;font-size:13px;margin-bottom:5px">
                    <span>{{ $cat->name }}</span>
                    <span style="font-weight:600;color:var(--green)">{{ number_format($cat->products_count) }}</span>
                </div>
                <div style="height:6px;border-radius:4px;background:rgba(255,255,255,0.08);overflow:hidden">
                    <div style="height:100%;border-radius:4px;background:var(--green);width:{{ $totalProduits > 0 ? ($cat->products_count / $totalProduits * 100) : 0 }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Dernières demandes --}}
    <div class="panel">
        <div class="panel-head">
            <span class="panel-title">Dernières demandes de devis</span>
            <a href="{{ route('admin.devis') }}" class="btn btn-outline" style="padding:5px 10px;font-size:11px;">Voir tout</a>
        </div>
        @forelse($devisRecents as $d)
        <div class="devis-item">
            <div class="dav">{{ strtoupper(substr($d->client_name, 0, 2)) }}</div>
            <div style="flex:1">
                <div style="font-size:13px;font-weight:600">{{ $d->client_name }}</div>
                <div style="font-size:11px;color:var(--text-muted)">{{ $d->reference }}</div>
                <div style="margin-top:4px">
                    @if($d->statut === 'en_attente') <span class="pill pill-yellow">En attente</span>
                    @elseif($d->statut === 'en_traitement') <span class="pill pill-blue">En traitement</span>
                    @elseif($d->statut === 'valide') <span class="pill pill-green">Validé</span>
                    @else <span class="pill pill-red">Refusé</span>
                    @endif
                </div>
            </div>
            <div style="font-size:10px;color:var(--text-muted);text-align:right">
                {{ \Carbon\Carbon::parse($d->created_at)->diffForHumans() }}
            </div>
        </div>
        @empty
        <div style="padding:24px;text-align:center;color:var(--text-muted);font-size:13px">
            Aucune demande de devis pour le moment
        </div>
        @endforelse
    </div>
</div>

@endsection