@extends('layouts.app')

@section('title', $product->libelle . ' – PowerCity')

@section('content')

{{-- Breadcrumb --}}
<div style="background:#f4f6f8; border-bottom:1px solid #e2e8f0;">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="text-xs text-gray-400 flex items-center gap-2 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-primary transition">Accueil</a>
            <span class="text-gray-300">›</span>
            <a href="{{ route('products.index') }}" class="hover:text-primary transition">Produits</a>
            @if($product->category)
            <span class="text-gray-300">›</span>
            <a href="{{ route('products.index', ['category' => $product->category->id]) }}" class="hover:text-primary transition">
                {{ $product->category->name }}
            </a>
            @endif
            <span class="text-gray-300">›</span>
            <span class="text-gray-600 font-medium truncate max-w-xs">{{ $product->libelle }}</span>
        </nav>
    </div>
</div>

{{-- Section principale --}}
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-16 items-center">

            {{-- Gauche : Texte --}}
            <div>
                <div class="flex items-center gap-2 mb-6">
                    @if($product->marque)
                    <span class="text-xs font-bold px-3 py-1 rounded-full text-white" style="background:#0d2b45">
                        {{ $product->marque }}
                    </span>
                    @endif
                    @if($product->category)
                    <span class="text-xs font-bold px-3 py-1 rounded-full" style="background:#e8f4fd; color:#0a5c8a">
                        {{ $product->category->name }}
                    </span>
                    @endif
                </div>

                <h1 class="text-4xl md:text-5xl font-black leading-tight mb-6" style="color:#0d2b45">
                    {{ $product->libelle }}
                </h1>

                @if($product->description)
                <p class="text-gray-600 text-sm leading-relaxed mb-8 text-justify">
                    {!! nl2br(e($product->description)) !!}
                </p>
                @else
                <p class="text-gray-500 text-sm leading-relaxed mb-8">
                    Ce produit fait partie de notre gamme
                    @if($product->category)<strong>{{ $product->category->name }}</strong>@endif.
                    Contactez notre équipe pour une fiche technique ou une offre de prix.
                </p>
                @endif

                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('contact') }}?product={{ $product->reference }}"
                       class="inline-flex items-center gap-2 font-bold px-8 py-3.5 text-sm text-white transition hover:opacity-90"
                       style="background:#0a5c8a; border-radius:4px">
                        EN SAVOIR PLUS
                    </a>
                    @if($product->datasheet)
                    <a href="{{ asset('storage/' . $product->datasheet) }}" target="_blank"
                       class="inline-flex items-center gap-2 font-bold px-8 py-3.5 text-sm text-white transition hover:opacity-90"
                       style="background:#f59e0b; border-radius:4px">
                        📄 DATASHEETS
                    </a>
                    @endif
                </div>
            </div>

            {{-- Droite : Image produit --}}
            <div class="flex items-center justify-center">
                <div class="w-full flex items-center justify-center" style="min-height:400px; background:#f8f9fa;">
                    @if($product->image)
                        <img src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}"
                             alt="{{ $product->libelle }}"
                             class="max-h-96 max-w-full object-contain p-8">
                    @else
                        <div class="flex flex-col items-center justify-center gap-4 p-12 text-center">
                            <span style="font-size:80px; opacity:0.1">📦</span>
                            <span class="text-xs text-gray-400">Image non disponible</span>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Specs techniques --}}
@if($product->topologie || $product->puissance || $product->rendement || $product->configuration)
<div style="background:#f8f9fa; border-top:2px solid #e2e8f0;">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-wrap justify-center gap-20 text-center">
            @if($product->topologie)
            <div>
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-2">Topologie</div>
                <div class="text-2xl font-black" style="color:#0d2b45">{{ $product->topologie }}</div>
            </div>
            @endif
            @if($product->puissance)
            <div>
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-2">Puissance</div>
                <div class="text-2xl font-black" style="color:#0d2b45">{{ $product->puissance }}</div>
            </div>
            @endif
            @if($product->rendement)
            <div>
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-2">Rendement</div>
                <div class="text-2xl font-black" style="color:#0d2b45">{{ $product->rendement }}</div>
            </div>
            @endif
            @if($product->configuration)
            <div>
                <div class="text-sm font-semibold text-gray-500 uppercase tracking-widest mb-2">Configuration</div>
                <div class="text-2xl font-black" style="color:#0d2b45">{{ $product->configuration }}</div>
            </div>
            @endif
        </div>
    </div>
</div>
@endif

{{-- Bande infos --}}
<div style="background:#0d2b45;">
    <div class="max-w-7xl mx-auto px-4 py-5 flex flex-wrap gap-8 items-center justify-center">
        <span class="text-xs font-bold uppercase tracking-widest text-white">Prix sur demande</span>
        <span class="text-gray-400">|</span>
        <span class="text-xs text-gray-300">📍 Livraison Maroc</span>
        <span class="text-gray-400">|</span>
        <span class="text-xs text-gray-300">🛡️ Certifié IEC</span>
        <span class="text-gray-400">|</span>
        <span class="text-xs text-gray-300">🎧 Support 24/7</span>
        <span class="text-gray-400">|</span>
        <a href="tel:+212654755908" class="text-xs font-bold" style="color:#4caf50">
            📞 +212 654-755908
        </a>
    </div>
</div>

{{-- Caractéristiques techniques --}}
<div class="bg-white">
    <div class="max-w-7xl mx-auto px-4 py-16">
        <div class="grid md:grid-cols-2 gap-16 items-center">

            {{-- Gauche : image datacenter --}}
            <div style="min-height:400px; border-radius:8px; overflow:hidden;">
                <img src="{{ asset('images/datacenter.jpg') }}"
                     alt="Datacenter PowerCity"
                     class="w-full h-full object-cover"
                     style="min-height:400px"
                     onerror="this.src='https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=800&q=80'">
            </div>

            {{-- Droite : liste caractéristiques --}}
            <div>
                <h2 class="text-2xl font-black mb-10" style="color:#0d2b45">
                    Caractéristiques techniques
                </h2>
                @if($product->description)
                <ul class="space-y-5">
                    @foreach(explode("\n", $product->description) as $ligne)
                    @if(trim($ligne))
                    <li class="flex items-start gap-4 text-sm text-gray-600">
                        <span class="font-black text-lg shrink-0" style="color:#0d2b45">✓</span>
                        <span>{{ trim($ligne) }}</span>
                    </li>
                    @endif
                    @endforeach
                </ul>
                @else
                <p class="text-gray-400 text-sm">Contactez-nous pour obtenir les caractéristiques techniques.</p>
                @endif
            </div>

        </div>
    </div>
</div>


@endsection