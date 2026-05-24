<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('images/logoo.png') }}" class="h-30 w-auto">
    <title>@yield('title', 'PowerCity - Global Energy Store')</title>
    <meta name="description" content="@yield('description', 'PowerCity - Votre partenaire expert en énergie électrique.')">
    <style>
    html, body {
        overflow-x: hidden;
        max-width: 100%;
    }
    </style>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary:   { DEFAULT: '#0a5c8a', light: '#1a7ab5', dark: '#0d2b45' },
                        secondary: { DEFAULT: '#4caf50', light: '#6fc771', dark: '#388e3c' },
                    },
                    fontFamily: { sans: ['Sora', 'sans-serif'] }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        body { font-family: 'Sora', sans-serif; }
        .card-lift { transition: transform 0.2s, box-shadow 0.2s; }
        .card-lift:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(10,92,138,0.15); }
        .nav-link.active { color: #4caf50; border-bottom: 2px solid #4caf50; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #0a5c8a; border-radius: 3px; }
        .badge-cat { background: linear-gradient(90deg,#0a5c8a,#1a7ab5); color:white; font-size:0.7rem; font-weight:600; padding:2px 8px; border-radius:999px; }
        .dropdown-menu { opacity: 0; visibility: hidden; transition: opacity 0.2s, visibility 0.2s; }
        .dropdown:hover .dropdown-menu { opacity: 1; visibility: visible; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-800">



{{-- NAVBAR --}}
<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
    <div class="max-w-9xl mx-auto px-4">
        <div class="flex items-center justify-between h-30">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="PowerCity" class="h-30 w-auto"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                <span style="display:none" class="items-center gap-1 text-xl font-black">
                    <span style="color:#0d2b45">POWER</span><span style="color:#4caf50">CITY</span>
                </span>
            </a>

            {{-- Search Bar --}}
<form action="{{ route('products.search') }}" method="GET" class="hidden md:flex flex-1 max-w-md mx-8">
    <div class="relative w-full">
        <input type="text" name="q" value="{{ request('q') }}"
               placeholder="Rechercher un produit, un document ou plus encore"
               class="w-full pl-4 pr-12 py-2.5 text-sm focus:outline-none focus:ring-2"
               style="border: 1.5px solid #d1d5db; border-radius: 6px;">
        <button type="submit" class="absolute right-1 top-1 text-white p-1.5 transition" style="background:#0a5c8a; border-radius:5px;">
            <i data-lucide="search" class="w-4 h-4"></i>
        </button>
    </div>
</form>

            {{-- Nav Links --}}
            <div class="hidden md:flex items-center gap-6 text-base font-medium">
                <a href="{{ route('home') }}" class="nav-link text-gray-600 hover:text-primary transition pb-1 {{ request()->routeIs('home') ? 'active' : '' }}">
                    Accueil
                </a>

                {{-- Menu Produits déroulant --}}
                <div class="relative dropdown">
                    <button class="nav-link text-gray-600 hover:text-primary transition pb-1 flex items-center gap-1 {{ request()->routeIs('products.*') || request()->routeIs('categories.*') ? 'active' : '' }}">
                        Produits
                        <i data-lucide="chevron-down" class="w-4 h-4"></i>
                    </button>
 
                    {{-- Dropdown --}}
<div class="dropdown-menu absolute top-full left-1/2 -translate-x-1/2 mt-2 w-[1000px] bg-white rounded-2xl shadow-2xl border border-gray-100 z-50">
    <div class="p-6">
        <div class="grid grid-cols-3 gap-6">
{{-- Colonne 1 : EATON --}}
<div>
    <div class="mb-4 pb-3 border-b border-gray-100">
        <a href="{{ route('products.index', ['marque' => 'Eaton']) }}">
            <img src="{{ asset('images/marques/eaton.png') }}"
                 alt="Eaton" class="h-8 w-auto object-contain mb-2 hover:opacity-70 transition">
        </a>
    </div>
    <ul class="space-y-2">
        <li><a href="{{ route('categories.show', 9) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
            <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> UPS
        </a></li>
        <li><a href="{{ route('categories.show', 12) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
            <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> BAES
        </a></li>

       {{-- Protection électrique avec sous-menu vers le bas --}}
<li class="relative group/sub">
    <div class="text-sm text-gray-600 hover:text-primary flex items-center justify-between gap-2 transition cursor-pointer py-1">
        <span class="flex items-center gap-2">
            <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i>
            Protection électrique
        </span>
        <i data-lucide="chevron-down" class="w-3 h-3 text-gray-400"></i>
    </div>

    {{-- Sous-menu vers le bas avec scroll --}}
    <div class="overflow-hidden max-h-0 group-hover/sub:max-h-96 transition-all duration-300 overflow-y-auto">
        <ul class="pl-4 pt-1 space-y-1 border-l-2 ml-2" style="border-color:#4caf50">
            <li><a href="{{ route('categories.show', 17) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Disjoncteur modulaire
            </a></li>
            <li><a href="{{ route('categories.show', 18) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Interrupteur modulaire
            </a></li>
            <li><a href="{{ route('categories.show', 19) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Interrupteur diff.
            </a></li>
            <li><a href="{{ route('categories.show', 20) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Contacteurs modulaires
            </a></li>
            <li><a href="{{ route('categories.show', 21) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Minutrie sur rail
            </a></li>
            <li><a href="{{ route('categories.show', 22) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Télérupteur
            </a></li>
            <li><a href="{{ route('categories.show', 23) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Disjoncteur compact
            </a></li>
            <li><a href="{{ route('categories.show', 24) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Interrupteur compact
            </a></li>
            <li><a href="{{ route('categories.show', 25) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Contacteurs puissance
            </a></li>
            <li><a href="{{ route('categories.show', 26) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Protection moteur
            </a></li>
            <li><a href="{{ route('categories.show', 27) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Parafoudre
            </a></li>
            <li><a href="{{ route('categories.show', 28) }}" class="text-sm text-gray-500 hover:text-primary flex items-center gap-2 transition py-1">
                <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Coffret modulaire
            </a></li>
        </ul>
    </div>
</li>
{{-- Colonne 2 : Protection & Câbles --}}
            <div>
                <div class="mb-4 pb-3 border-b border-gray-100">
                    <span class="text-xs font-black uppercase tracking-widest" style="color:#0a5c8a"> Protection & Câbles</span>
                </div>
                <ul class="space-y-2">
                    <li><a href="{{ route('categories.show', 64) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
                        <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Câbles
                    </a></li>
                    <li><a href="{{ route('categories.show', 65) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
                        <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Câbles électriques
                    </a></li>
                    <li><a href="{{ route('categories.show', 66) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
                        <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Protection électrique
                    </a></li>
                    <li><a href="{{ route('categories.show', 67) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
                        <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Bornes de Recharge
                    </a></li>
                </ul>
            </div>
            {{-- Colonne 3 : Autres --}}
            <div>
                <div class="mb-4 pb-3 border-b border-gray-100">
                    <span class="text-xs font-black uppercase tracking-widest" style="color:#0a5c8a"> Autres</span>
                </div>
                <ul class="space-y-2">
                    <li><a href="{{ route('categories.show', 68) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
                        <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Appareillage
                    </a></li>
                    <li><a href="{{ route('categories.show', 69) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
                        <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Interrupteurs
                    </a></li>
                    <li><a href="{{ route('categories.show', 70) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
                        <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Prises
                    </a></li>
                    <li><a href="{{ route('categories.show', 71) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
                        <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Automatisme
                    </a></li>
                    <li><a href="{{ route('categories.show', 72) }}" class="text-sm text-gray-600 hover:text-primary flex items-center gap-2 transition">
                        <i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Distribution
                    </a></li>
                    <li>
                        <a href="{{ route('products.index') }}"
                           class="text-xs font-bold text-white px-3 py-1.5 rounded-lg flex items-center gap-1 mt-2 transition"
                           style="background:#4caf50">
                             Tout le catalogue →
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
                </div>
 
                <a href="{{ route('about') }}" class="nav-link text-gray-600 hover:text-primary transition pb-1 {{ request()->routeIs('about') ? 'active' : '' }}">
                    À propos
                </a>
                <a href="{{ route('contact') }}" class="text-white font-semibold px-5 py-2 rounded-lg text-xs transition" style="background:#4caf50">
                    Contact
                </a>
                @auth
<a href="{{ route('admin.dashboard') }}"
   class="flex items-center gap-2 text-white font-semibold px-4 py-2 rounded-lg text-xs"
   style="background:#1a2540; border:1.5px solid #2a3f6f;">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4z"/>
    </svg>
    Login
</a>
@else
<a href="{{ route('login') }}"
   class="flex items-center gap-2 text-white font-semibold px-4 py-2 rounded-lg text-xs"
   style="background:#1a2540; border:1.5px solid #2a3f6f;">
    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4z"/>
    </svg>
    Login 
</a>
@endauth
            </div>
 
            <button id="mobile-menu-btn" class="md:hidden p-2">
                <i data-lucide="menu" class="w-5 h-5 text-gray-600"></i>
            </button>
        </div>
 
        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="md:hidden hidden pb-4 border-t border-gray-100 mt-2 pt-3">
            <form action="{{ route('products.search') }}" method="GET" class="mb-3">
                <div class="relative">
                    <input type="text" name="q" placeholder="Rechercher..." class="w-full pl-4 pr-10 py-2 border border-gray-200 rounded-full text-sm focus:outline-none">
                    <button type="submit" class="absolute right-1 top-1 text-white rounded-full p-1.5" style="background:#0a5c8a">
                        <i data-lucide="search" class="w-3 h-3"></i>
                    </button>
                </div>
            </form>
            <a href="{{ route('home') }}" class="block py-2 text-sm font-medium text-gray-700">Accueil</a>
            <a href="{{ route('products.index') }}" class="block py-2 text-sm font-medium text-gray-700">Produits</a>
            <a href="{{ route('categories.show', 1) }}" class="block py-2 pl-4 text-sm text-gray-500">→ Onduleurs</a>
            <a href="{{ route('categories.show', 2) }}" class="block py-2 pl-4 text-sm text-gray-500">→ Câbles</a>
            <a href="{{ route('categories.show', 3) }}" class="block py-2 pl-4 text-sm text-gray-500">→ Protection</a>
            <a href="{{ route('categories.show', 4) }}" class="block py-2 pl-4 text-sm text-gray-500">→ Appareillage</a>
            <a href="{{ route('categories.show', 5) }}" class="block py-2 pl-4 text-sm text-gray-500">→ Automatisme</a>
            <a href="{{ route('categories.show', 6) }}" class="block py-2 pl-4 text-sm text-gray-500">→ Distribution</a>
            <a href="{{ route('about') }}" class="block py-2 text-sm font-medium text-gray-700">À propos</a>
            <a href="{{ route('contact') }}" class="block py-2 text-sm font-medium" style="color:#4caf50">Contact</a>

        </div>
    </div>
</nav>
 
<main>@yield('content')</main>

{{-- FOOTER --}}
<footer style="background:#0d2b45" class="text-white mt-16">
    <div style="background:#4caf50; height:4px"></div>

    <div class="max-w-7xl mx-auto px-4 py-14">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            <div>
                <img src="{{ asset('images/logo.png') }}" alt="PowerCity"
                     class="h-14 w-auto mb-6"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
                <div style="display:none" class="text-2xl font-black mb-6">
                    <span class="text-white">POWER</span><span style="color:#4caf50">CITY</span>
                </div>

                <div class="space-y-3 text-sm text-gray-300">
                    <div><span class="font-semibold text-white">Adresse :</span> 18, rue Ibn Katir 20380 Casablanca - Maroc</div>
                    <div><span class="font-semibold text-white">Tél :</span> +212 654-755908</div>
                    <div><span class="font-semibold text-white">Fax :</span> +212 522-234448</div>
                    <div><span class="font-semibold text-white">Email :</span> contact@powercity.ma</div>
                    <div><span class="font-semibold text-white">Horaires :</span> Lun–Ven 8h–18h</div>
                </div>

                <div class="flex gap-3 mt-6">
                    {{-- LinkedIn --}}
                <a href="#" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center hover:opacity-80 transition" style="background:#4caf50">
                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
                     <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2z M4 6a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                   </svg>
                </a>

                {{-- Facebook --}}
                <a href="#" target="_blank" class="w-9 h-9 rounded-full flex items-center justify-center hover:opacity-80 transition" style="background:#4caf50">
                   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" viewBox="0 0 24 24">
                      <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                   </svg>
                </a>
                    <a href="{{ route('contact') }}" class="w-9 h-9 rounded-full flex items-center justify-center hover:opacity-80 transition" style="background:#4caf50">
                         <i data-lucide="mail" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

            <div>
                <h3 class="font-bold text-white uppercase text-xs tracking-widest mb-5 pb-2 border-b border-white/10">Catégories</h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li><a href="{{ route('categories.show', 1) }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Onduleurs</a></li>
                    <li><a href="{{ route('categories.show', 2) }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Câbles</a></li>
                    <li><a href="{{ route('categories.show', 3) }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Protection électrique</a></li>
                    <li><a href="{{ route('categories.show', 4) }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Appareillage</a></li>
                    <li><a href="{{ route('categories.show', 5) }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Automatisme</a></li>
                    <li><a href="{{ route('categories.show', 6) }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Distribution</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-white uppercase text-xs tracking-widest mb-5 pb-2 border-b border-white/10">Liens rapides</h3>
                <ul class="space-y-3 text-sm text-gray-300">
                    <li><a href="{{ route('home') }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Accueil</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Catalogue produits</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> À propos</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Contact</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white flex items-center gap-2 transition"><i data-lucide="chevron-right" class="w-3 h-3" style="color:#4caf50"></i> Demander un devis</a></li>
                </ul>

                {{-- Logos marques footer --}}
                <h3 class="font-bold text-white uppercase text-xs tracking-widest mt-8 mb-4 pb-2 border-b border-white/10">Nos marques</h3>
                <div class="flex flex-wrap gap-3 items-center">
                    <img src="{{ asset('images/marques/eaton.png') }}"
                          alt="Eaton" class="h-6 w-auto opacity-80 hover:opacity-100 transition">
                    <img src="{{ asset('images/marques/yuasa.png') }}"
                          alt="Yuasa" class="h-5 w-auto opacity-80 hover:opacity-100 transition">
                    <img src="{{ asset('images/marques/csb.png') }}"
                          alt="CSB" class="h-5 w-auto opacity-80 hover:opacity-100 transition">
                     <img src="{{ asset('images/marques/enersys.png') }}"
                         alt="EnerSys" class="h-5 w-auto opacity-80 hover:opacity-100 transition">
                </div>
            </div>

        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center text-xs text-gray-400">
            <p>&copy; {{ date('Y') }} PowerCity – Global Energy Store. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<script>
    lucide.createIcons();
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
@stack('scripts')
</body>
</html>