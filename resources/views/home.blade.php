@extends('layouts.app')
 
@section('title', 'PowerCity – Global Energy Store | Onduleurs, Câbles, Protection Électrique')
 
@section('content')
 
{{-- ===== HERO ===== --}}
<section class="relative overflow-hidden" style="min-height: 350px;">
 
    {{{-- BACKGROUND --}}
     <div class="absolute inset-0">
    <img src="{{ asset('images/background.png') }}"
         alt="background"
         class="w-full h-full object-cover"
         onerror="this.style.display='none'">
    <div class="absolute inset-0"
         style="background: linear-gradient(135deg, rgba(10,40,60,0.85));">
    </div>
   </div>
 
    {{-- CONTENT --}}
    <div class="relative max-w-7xl mx-auto px-4 py-32 md:py-10">
        <div class="max-w-2xl">
 
            <div class="inline-flex items-center gap-2 border border-green-400/40 bg-green-400/10 text-green-400 text-xs font-semibold px-4 py-2 rounded-full mb-6">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                Casablanca, Maroc — Global Energy Store
            </div>
 
            {{-- TITRE --}}
            <h1 class="text-5xl md:text-6xl text-white leading-tight mb-6" style="font-family:'Source Sans 3', sans-serif; font-weight:300; letter-spacing:-0.02em;">
                <span style="font-weight:900;">Solutions électriques</span> industrielles<br>
                pour vos installations <span style="font-weight:900; color:#4caf50">au Maroc.</span>
            </h1>
 
            {{-- DESCRIPTION --}}
            <p class="text-blue-100 text-base leading-relaxed mb-8 max-w-lg" style="font-family:'Source Sans 3', sans-serif; font-weight:300;">
                Distribution, protection et automatisation : des équipements certifiés pour garantir la performance,
                la sécurité et la continuité de vos installations industrielles.
            </p>
 
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('products.index') }}"
                   class="text-white font-semibold px-7 py-3 rounded-lg flex items-center gap-2 text-sm"
                   style="background:#4caf50">
                    Voir le catalogue
                </a>
                <a href="{{ route('contact') }}"
                   class="bg-white/10 hover:bg-white/20 text-white font-semibold px-7 py-3 rounded-lg border border-white/30">
                    Demander un devis
                </a>
            </div>
 
            {{-- PREUVE SOCIALE --}}
            <div class="flex flex-wrap gap-6 mt-6 text-xs text-blue-200">
                <div>+120 entreprises accompagnées</div>
                <div>+20 000 références</div>
                <div>Livraison partout au Maroc</div>
            </div>
 
            {{-- BADGES --}}
            <div class="flex items-center gap-6 mt-10 pt-8 border-t border-white/10">
                @foreach(['Certifié IEC', 'Livraison Maroc', 'Support 24/7'] as $cert)
                <div class="flex items-center gap-2 text-xs text-blue-200">
                    <i data-lucide="check-circle" class="w-4 h-4 text-green-400"></i>
                    {{ $cert }}
                </div>
                @endforeach
            </div>
 
        </div>
    </div>
</section>
 
{{-- ===== CATÉGORIES ===== --}}
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex items-end justify-between mb-10">
        <div>
            <span class="text-sm font-semibold uppercase tracking-widest" style="color:#4caf50">Nos spécialités</span>
            <h2 class="text-3xl font-black mt-1" style="color:#0d2b45">Catégories de produits</h2>
        </div>
        <a href="{{ route('products.index') }}" class="text-sm font-semibold flex items-center gap-1 hover:gap-2 transition-all" style="color:#0a5c8a">
            Tout voir <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>
 
    @php
    $catIcons  = ['battery-charging', 'cable', 'shield', 'toggle-right', 'cpu', 'grid-3x3'];
    $catColors = ['#dbeafe', '#dcfce7', '#fee2e2', '#f3e8ff', '#ffedd5', '#e0f2fe'];
    $catText   = ['#1d4ed8', '#15803d', '#dc2626', '#7c3aed', '#ea580c', '#0369a1'];
    @endphp
 
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
        @foreach($categories as $i => $cat)
        <a href="{{ route('categories.show', $cat->id) }}"
           class="card-lift bg-white border border-gray-100 rounded-xl p-5 text-center group shadow-sm">
            <div class="w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform"
                 style="background:{{ $catColors[$i] ?? '#f3f4f6' }}">
                <i data-lucide="{{ $catIcons[$i] ?? 'box' }}" class="w-7 h-7" style="color:{{ $catText[$i] ?? '#374151' }}"></i>
            </div>
            <div class="font-bold text-sm leading-tight" style="color:#0d2b45">{{ $cat->name }}</div>
        </a>
        @endforeach
    </div>
</section>

 {{-- ===== PRODUITS ===== --}}
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-black mb-10">Produits phares</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($featuredProducts as $product)
            <a href="{{ route('products.show', $product) }}"
               class="bg-white rounded-xl overflow-hidden border hover:shadow-lg transition group">

                <div class="h-44 flex items-center justify-center bg-gray-50">
                    @if($product->image)
                        <img src="{{ asset($product->image) }}"
                             alt="{{ $product->libelle }}"
                             class="max-h-36 max-w-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
                    @else
                        <span style="font-size:60px; opacity:0.1">📦</span>
                    @endif
                </div>

                <div class="p-4">
                    <h3 class="font-semibold text-sm mb-2">{{ $product->libelle }}</h3>
                    <span class="text-xs text-gray-500 font-medium">Prix sur devis</span>
                </div>

            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== POURQUOI POWERCITY ===== --}}
<section class="max-w-7xl mx-auto px-4 py-16">
 
    <div class="text-center mb-12">
        <span class="text-sm font-semibold uppercase tracking-widest" style="color:#4caf50">Notre expertise</span>
        <h2 class="text-3xl font-black mt-1" style="color:#0d2b45">Pourquoi choisir PowerCity ?</h2>
    </div>
 
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach([
            ['shield-check', '#0a5c8a', '#e8f4fd', 'Produits certifiés', 'Tous nos produits sont conformes aux normes IEC et bénéficient des certifications internationales.'],
            ['truck', '#4caf50', '#e8f7e8', 'Livraison partout au Maroc', 'Nous livrons dans toutes les villes du Maroc avec un suivi en temps réel.'],
            ['headphones', '#f59e0b', '#fff8e1', 'Support 24/7', "Notre équipe d'experts est disponible à tout moment."],
            ['award', '#e91e63', '#fce4ec', 'Grandes marques', 'Partenaires : Eaton, Schneider, ABB, Siemens.'],
            ['clock', '#7c3aed', '#f3e8ff', 'Stock disponible', 'Plus de 20 000 références prêtes à livrer.'],
            ['trending-up', '#ea580c', '#ffedd5', 'Prix compétitifs', 'Des tarifs adaptés aux professionnels.'],
        ] as [$icon, $color, $bg, $title, $desc])
        <div class="group bg-white rounded-xl p-6 border border-gray-100 shadow-sm flex gap-4 items-start transition-all duration-300 hover:shadow-xl hover:-translate-y-2">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 transition-transform group-hover:scale-110"
                 style="background:{{ $bg }}">
                <i data-lucide="{{ $icon }}" class="w-6 h-6" style="color:{{ $color }}"></i>
            </div>
            <div>
                <div class="font-bold text-gray-800 mb-1 group-hover:text-[#0a5c8a] transition">{{ $title }}</div>
                <div class="text-sm text-gray-500 leading-relaxed">{{ $desc }}</div>
            </div>
        </div>
        @endforeach
    </div>
</section>
 
{{-- ===== CTA ===== --}} 
<section class="py-14" style="background:linear-gradient(#0d2b45)"> 
    <div class="max-w-4xl mx-auto px-4"> 
        <div class="bg-white/10 border border-white/20 rounded-2xl p-10 text-center text-white">
             <i data-lucide="zap" class="w-10 h-10 mx-auto mb-4" style="color:#4caf50">
             </i>
              <h2 class="text-3xl font-black mb-3">Besoin d'un devis ou d'un conseil ?</h2> 
              <p class="text-blue-100 mb-8 max-w-xl mx-auto">
                Notre équipe d'experts est disponible pour vous accompagner dans le choix des meilleures solutions énergétiques pour votre projet.</p> 
                <div class="flex flex-wrap justify-center gap-3"> 
                    <a href="{{ route('contact') }}" class="font-semibold px-8 py-3 rounded-lg transition text-white" style="background:#4caf50"> 
                        Demander un devis </a> 
                        <a href="{{ route('products.index') }}" class="bg-white/10 hover:bg-white/20 border border-white/30 font-semibold px-8 py-3 rounded-lg transition text-white">
                             Explorer le catalogue </a>
                             </div>
                             </div>
                             </div> 
                        </section>
 
{{-- ===== WHATSAPP FLOAT ===== --}}
<div class="fixed bottom-6 left-6 z-50">

    <div id="wa-box" class="bg-white shadow-xl rounded-xl p-3 mb-2 w-48 flex items-start gap-2">
        <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center font-bold text-sm shrink-0">
            PC
        </div>
        <div class="flex-1">
            <div class="text-sm font-semibold text-gray-800">PowerCity</div>
            <div class="text-xs text-gray-500 mb-1">Service client</div>
            <div class="text-sm text-gray-700">👋 Salut, je peux vous aider ?</div>
        </div>
        <button onclick="document.getElementById('wa-box').style.display='none'"
                class="text-gray-400 hover:text-gray-600 text-sm">✕</button>
    </div>
 
    <a href="https://wa.me/212654755908" target="_blank"
       class="w-14 h-14 flex items-center justify-center text-white rounded-full shadow-xl transition-transform hover:scale-110"
       style="background:#25d366">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
    </a>
</div>
 
@endsection