@extends('admin.layout')
@section('title', 'Catégories')
@section('page-title', 'Catégories de produits')
@section('breadcrumb', 'Catégories')

@section('content')

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px">
    @foreach($categories as $cat)
    <div class="panel" style="margin-bottom:0">
        <div style="padding:20px;text-align:center">
            <div style="font-size:32px;margin-bottom:10px">
                @if($cat->id == 1) ⚡
                @elseif($cat->id == 2) 🔌
                @elseif($cat->id == 3) 🛡️
                @elseif($cat->id == 4) 🔧
                @elseif($cat->id == 5) 🤖
                @else 📦
                @endif
            </div>
            <div style="font-weight:700;font-size:14px;margin-bottom:4px">{{ $cat->name }}</div>
            <div style="font-size:22px;font-weight:800;color:var(--green);margin:8px 0">{{ number_format($cat->products_count) }}</div>
            <div style="font-size:11px;color:var(--text-muted)">produits</div>
        </div>
    </div>
    @endforeach
</div>

@endsection