@extends('admin.layout')
@section('title', 'Produits')
@section('page-title', 'Gestion des produits')
@section('breadcrumb', 'Produits')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px">
    <p style="font-size:13px;color:var(--text-muted)">{{ $products->total() }} produits au total</p>
    <div style="display:flex;gap:10px">
        <a href="{{ route('admin.products.create') }}" class="btn btn-green">
            ➕ Ajouter un produit
        </a>
        <form action="{{ route('admin.products') }}" method="GET" style="display:flex;gap:8px">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Rechercher..."
                   style="background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:7px 12px;font-size:12px;font-family:'Sora',sans-serif">
            <select name="category" style="background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:7px 12px;font-size:12px;font-family:'Sora',sans-serif">
                <option value="">Toutes catégories</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <button class="btn btn-green" type="submit">Filtrer</button>
        </form>
    </div>
</div>

<div class="panel">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Référence</th>
                    <th>Catégorie</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>
                        <div style="font-weight:600;font-size:13px">{{ Str::limit($product->libelle, 50) }}</div>
                    </td>
                    <td style="font-family:monospace;font-size:12px;color:var(--text-muted)">{{ $product->reference }}</td>
                    <td>
                        @if($product->category)
                        <span class="pill pill-blue">{{ $product->category->name }}</span>
                        @endif
                    </td>
                    <td style="display:flex;gap:6px">
                       <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline" style="padding:4px 10px;font-size:11px;">
                           <i data-lucide="edit" style="width:12px;height:12px"></i> Éditer
                       </a>
                      <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                           onsubmit="return confirm('Supprimer ce produit ?')">
                     @csrf
                     @method('DELETE')
                       <button type="submit" class="btn" style="padding:4px 10px;font-size:11px;background:#ef4444;color:white;border:none;border-radius:8px;cursor:pointer">
                          <i data-lucide="trash-2" style="width:12px;height:12px"></i> Supprimer
                        </button>
                    </form>
                 </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="padding:16px">
        {{ $products->links() }}
    </div>
</div>

@endsection