@extends('layouts.app')

@section('title', 'Catalogue Produits – PowerCity')

@section('content')

{{-- BARRE FILTRES STYLE ATLANTIC ENERGY --}}
<div style="background:#0d2b45;" class="py-5">
    <div class="max-w-7xl mx-auto px-4">
        <form action="{{ route('products.index') }}" method="GET">
            <div class="flex flex-wrap gap-4 items-end">

                {{-- Filtre Marque --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-gray-300 font-semibold uppercase tracking-widest">Marque</label>
                    <select name="marque"
                            class="px-4 py-2.5 rounded-lg text-sm font-medium bg-white border-0 focus:outline-none focus:ring-2 min-w-[180px]"
                            style="color:#0d2b45">
                        <option value="">Toutes les marques</option>
                        @foreach($marques as $marque)
                            <option value="{{ $marque }}" {{ request('marque') == $marque ? 'selected' : '' }}>
                                {{ $marque }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Filtre Catégorie --}}
                <div class="flex flex-col gap-1">
                    <label class="text-xs text-gray-300 font-semibold uppercase tracking-widest">Catégorie</label>
                    <select name="category"
                            class="px-4 py-2.5 rounded-lg text-sm font-medium bg-white border-0 focus:outline-none focus:ring-2 min-w-[200px]"
                            style="color:#0d2b45">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                {{-- Bouton --}}
                <div class="flex gap-2">
                    <button type="submit"
                            class="px-6 py-2.5 text-white font-bold text-sm rounded-lg transition hover:opacity-90"
                            style="background:#4caf50">
                        Filtrer
                    </button>
                    @if(request('marque') || request('category') || request('q'))
                    <a href="{{ route('products.index') }}"
                       class="px-4 py-2.5 text-white font-bold text-sm rounded-lg transition hover:opacity-80"
                       style="background:#dc2626">
                        ✕
                    </a>
                    @endif
                </div>

            </div>

            {{-- Filtres actifs --}}
            @if(request('marque') || request('category') || request('q'))
            <div class="mt-3 flex flex-wrap gap-2">
                @if(request('marque'))
                <span class="text-xs px-3 py-1 rounded-full font-semibold" style="background:#4caf50; color:white">
                    Marque : {{ request('marque') }}
                </span>
                @endif
                @if(request('category'))
                <span class="text-xs px-3 py-1 rounded-full font-semibold" style="background:#4caf50; color:white">
                    Catégorie : {{ $categories->firstWhere('id', request('category'))?->name }}
                </span>
                @endif
                @if(request('q'))
                <span class="text-xs px-3 py-1 rounded-full font-semibold" style="background:#4caf50; color:white">
                    Recherche : {{ request('q') }}
                </span>
                @endif
            </div>
            @endif

        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- Header --}}
    <div class="mb-8 flex items-center justify-between">
        <div>
            <span class="font-semibold text-sm uppercase tracking-widest" style="color:#4caf50">Catalogue</span>
            <h1 class="text-3xl font-black mt-1" style="color:#0d2b45">Tous nos produits</h1>
        </div>
        <span class="text-gray-500 text-sm">{{ $products->total() }} produits</span>
    </div>

    {{-- GRILLE PRODUITS --}}
    @if($products->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
        <i data-lucide="package-x" class="w-16 h-16 text-gray-200 mx-auto mb-4"></i>
        <h3 class="font-semibold text-gray-500">Aucun produit trouvé</h3>
        <a href="{{ route('products.index') }}" class="text-sm mt-2 inline-block hover:underline" style="color:#0a5c8a">
            Voir tous les produits
        </a>
    </div>
    @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @foreach($products as $product)
        <a href="{{ route('products.show', $product) }}"
           class="card-lift bg-white rounded-2xl border border-gray-100 overflow-hidden flex flex-col group">

            {{-- Image --}}
            <div class="h-44 flex items-center justify-center relative overflow-hidden"
                 style="background:linear-gradient(135deg,#e8f4fd,#e8f7e8)">
                @if($product->image)
                    <img src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}"
                         alt="{{ $product->libelle }}"
                         class="max-h-36 max-w-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
                @else
                    <i data-lucide="package" class="w-16 h-16" style="color:#0a5c8a; opacity:0.15"></i>
                @endif
                <span class="absolute top-2 right-2 text-xs font-semibold px-2 py-0.5 rounded-full"
                      style="background:#fee2e2; color:#dc2626">
                    Sur commande
                </span>
                @if($product->marque)
                <span class="absolute top-2 left-2 text-xs font-bold px-2 py-0.5 rounded-full"
                      style="background:#0d2b45; color:white">
                    {{ $product->marque }}
                </span>
                @endif
            </div>

            {{-- Infos --}}
            <div class="p-4 flex flex-col flex-1">
                @if($product->category)
                <span class="text-xs font-bold px-2 py-0.5 rounded-full self-start mb-2"
                      style="background:#e8f4fd; color:#0a5c8a">
                    {{ $product->category->name }}
                </span>
                @endif
                <h3 class="font-semibold text-sm text-gray-800 line-clamp-2 flex-1 mb-3 group-hover:text-primary transition">
                    {{ $product->libelle }}
                </h3>
                <div class="flex items-center justify-between border-t border-gray-50 pt-2">
                    <span class="text-xs text-gray-400 italic">Prix sur demande</span>
                    <span class="text-xs font-semibold text-white px-3 py-1 rounded-lg opacity-0 group-hover:opacity-100 transition"
                          style="background:#0a5c8a">
                        Détails →
                    </span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection