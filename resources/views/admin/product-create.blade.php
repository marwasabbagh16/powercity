@extends('admin.layout')
@section('title', 'Ajouter produit')
@section('page-title', 'Ajouter un produit')
@section('breadcrumb', 'Produits / Ajouter')

@section('content')

<div style="max-width:700px">
    <div class="panel">
        <div class="panel-head">
            <span class="panel-title">Nouveau produit</span>
        </div>
        <div style="padding:20px">
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf

                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Référence *</label>
                    <input type="text" name="reference" value="{{ old('reference') }}" required
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                    @error('reference')<div style="color:#ef4444;font-size:11px;margin-top:4px">{{ $message }}</div>@enderror
                </div>

                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Nom du produit *</label>
                    <input type="text" name="libelle" value="{{ old('libelle') }}" required
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                    @error('libelle')<div style="color:#ef4444;font-size:11px;margin-top:4px">{{ $message }}</div>@enderror
                </div>

                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Marque</label>
                    <input type="text" name="marque" value="{{ old('marque') }}"
                           placeholder="Ex: Eaton, Yuasa, CSB..."
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                </div>

                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Catégorie *</label>
                    <select name="category_id" required style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                           <option value="" style="color:#333">-- Choisir une catégorie --</option>
    @foreach($categories as $cat)
    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }} style="color:#333; background:white">
        {{ $cat->name }}
    </option>
    @endforeach
</select>
                    @error('category_id')<div style="color:#ef4444;font-size:11px;margin-top:4px">{{ $message }}</div>@enderror
                </div>

                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Description</label>
                    <textarea name="description" rows="5"
                              placeholder="Description détaillée du produit..."
                              style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif;resize:vertical">{{ old('description') }}</textarea>
                </div>

                <div style="margin-bottom:8px;padding:16px;background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:8px">
                    <div style="font-size:12px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:14px">
                        ⚡ Specs techniques
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                        <div>
                            <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Topologie</label>
                            <input type="text" name="topologie" value="{{ old('topologie') }}"
                                   placeholder="Ex: Online..."
                                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        </div>
                        <div>
                            <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Puissance</label>
                            <input type="text" name="puissance" value="{{ old('puissance') }}"
                                   placeholder="Ex: 15-200 kVA"
                                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        </div>
                        <div>
                            <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Rendement</label>
                            <input type="text" name="rendement" value="{{ old('rendement') }}"
                                   placeholder="Ex: Jusqu'à 94%"
                                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        </div>
                        <div>
                            <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Configuration</label>
                            <input type="text" name="configuration" value="{{ old('configuration') }}"
                                   placeholder="Ex: Tour, Rack..."
                                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        </div>
                    </div>
                </div>

                <div style="margin-bottom:16px;margin-top:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Image du produit</label>
                    <input type="file" name="image" accept="image/*"
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                </div>

                <div style="margin-bottom:24px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Fiche technique (PDF)</label>
                    <input type="file" name="datasheet" accept=".pdf"
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                </div>
                <label class="flex items-center gap-2 mt-4">
                    <input type="checkbox" name="featured" value="1">
                         Produit en vedette
                    </label>
                <div style="display:flex;gap:10px">
                    <button class="btn btn-green" type="submit">💾 Créer le produit</button>
                    <a href="{{ route('admin.products') }}" class="btn btn-outline">Annuler</a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection