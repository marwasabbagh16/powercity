@extends('admin.layout')
@section('title', 'Éditer produit')
@section('page-title', 'Éditer un produit')
@section('breadcrumb', 'Produits / Éditer')

@section('content')

<div style="max-width:700px">
    <div class="panel">
        <div class="panel-head">
            <span class="panel-title">{{ $product->reference }}</span>
        </div>
        <div style="padding:20px">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Référence --}}
                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Référence</label>
                    <input type="text" name="reference" value="{{ $product->reference }}"
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                </div>

                {{-- Nom --}}
                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Nom du produit</label>
                    <input type="text" name="libelle" value="{{ $product->libelle }}"
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                    @error('libelle')<div style="color:#ef4444;font-size:11px;margin-top:4px">{{ $message }}</div>@enderror
                </div>

                {{-- Marque --}}
                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Marque</label>
                    <input type="text" name="marque" value="{{ $product->marque }}"
                           placeholder="Ex: Eaton, Yuasa, CSB..."
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                </div>

                {{-- Catégorie --}}
                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Catégorie</label>
                    <select name="category_id" style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Description --}}
                <div style="margin-bottom:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Description</label>
                    <textarea name="description" rows="5"
                              placeholder="Description détaillée du produit..."
                              style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif;resize:vertical">{{ $product->description }}</textarea>
                </div>

                {{-- SPECS TECHNIQUES --}}
                <div style="margin-bottom:8px;padding:16px;background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:8px">
                    <div style="font-size:12px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.1em;margin-bottom:14px">
                        ⚡ Specs techniques
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">

                        <div>
                            <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Topologie</label>
                            <input type="text" name="topologie" value="{{ $product->topologie }}"
                                   placeholder="Ex: Online, Line Interactive..."
                                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        </div>

                        <div>
                            <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Puissance</label>
                            <input type="text" name="puissance" value="{{ $product->puissance }}"
                                   placeholder="Ex: 15 – 200 kVA"
                                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        </div>

                        <div>
                            <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Rendement</label>
                            <input type="text" name="rendement" value="{{ $product->rendement }}"
                                   placeholder="Ex: Jusqu'à 94%"
                                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        </div>

                        <div>
                            <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Configuration</label>
                            <input type="text" name="configuration" value="{{ $product->configuration }}"
                                   placeholder="Ex: Tour, Rack..."
                                   style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                        </div>
                          
                    </div>
                </div>
                <label class="flex items-center gap-2 mt-4">
    <input type="checkbox" name="featured" value="1">
    Produit en vedette
</label>

                {{-- Image --}}
                <div style="margin-bottom:16px;margin-top:16px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Image du produit</label>
                    @if($product->image)
                    <div style="margin-bottom:10px;padding:10px;background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:8px;display:flex;align-items:center;gap:12px">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="Image actuelle"
                             style="height:60px;width:60px;object-fit:contain;background:white;border-radius:6px;padding:4px">
                        <div>
                            <div style="font-size:11px;color:var(--text-muted)">Image actuelle</div>
                            <div style="font-size:12px;color:var(--text)">{{ basename($product->image) }}</div>
                        </div>
                    </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                    <div style="font-size:11px;color:var(--text-muted);margin-top:4px">Formats acceptés : JPG, PNG, WEBP. Max 2MB.</div>
                </div>

                {{-- Datasheet --}}
                <div style="margin-bottom:24px">
                    <label style="font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px">Fiche technique (PDF)</label>
                    @if($product->datasheet)
                    <div style="margin-bottom:10px;padding:10px;background:rgba(255,255,255,0.03);border:1px solid var(--border);border-radius:8px;display:flex;align-items:center;gap:12px">
                        <span style="font-size:20px">📄</span>
                        <div>
                            <div style="font-size:11px;color:var(--text-muted)">Datasheet actuelle</div>
                            <a href="{{ asset('storage/' . $product->datasheet) }}" target="_blank"
                               style="font-size:12px;color:#4caf50">{{ basename($product->datasheet) }}</a>
                        </div>
                    </div>
                    @endif
                    <input type="file" name="datasheet" accept=".pdf"
                           style="width:100%;background:rgba(255,255,255,0.05);border:1px solid var(--border);border-radius:8px;color:var(--text);padding:9px 12px;font-size:13px;font-family:'Sora',sans-serif">
                    <div style="font-size:11px;color:var(--text-muted);margin-top:4px">Format PDF uniquement.</div>
                </div>

                {{-- Boutons --}}
                <div style="display:flex;gap:10px">
                    <button class="btn btn-green" type="submit">💾 Sauvegarder</button>
                    <a href="{{ route('admin.products') }}" class="btn btn-outline">Annuler</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection