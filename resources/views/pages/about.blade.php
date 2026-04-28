@extends('layouts.app')

@section('title', 'À propos – PowerCity')

@section('content')

{{-- HERO --}}
<div style="background:#0d2b45" class="py-16 text-center text-white">
    <span class="text-xs font-bold uppercase tracking-widest" style="color:#4caf50">Notre histoire</span>
    <h1 class="text-4xl font-black mt-2">À propos de PowerCity</h1>
    <p class="text-gray-300 mt-3 text-sm max-w-xl mx-auto">
        Votre partenaire de confiance en solutions électriques professionnelles au Maroc
    </p>
</div>

<div class="max-w-5xl mx-auto px-4 py-14">

    {{-- Intro --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-10 mb-10 text-gray-600 leading-relaxed space-y-5 shadow-sm">
        <p class="text-lg font-semibold" style="color:#0d2b45">
            PowerCity est une entreprise marocaine de référence dans la distribution de matériel électrique professionnel, établie au cœur de Casablanca.
        </p>
        <p>
            Depuis notre création, nous mettons notre expertise au service des industriels, des installateurs et des entreprises pour répondre à leurs besoins en équipements électriques de haute qualité. Notre catalogue couvre l'ensemble des segments du marché : onduleurs UPS, batteries, câbles, protection électrique, appareillage, automatisme et distribution d'énergie.
        </p>
        <p>
            En tant que distributeur officiel agréé de marques leaders — <strong>Eaton, Yuasa, CSB et EnerSys</strong> — nous garantissons des produits authentiques, conformes aux normes IEC et CE, avec une traçabilité complète et un service après-vente structuré.
        </p>
        <p>
            Notre équipe de techniciens et de conseillers spécialisés est à votre disposition pour vous accompagner à chaque étape de vos projets : de la sélection des équipements jusqu'à la mise en service, avec un suivi personnalisé avant et après chaque commande.
        </p>
    </div>

    {{-- Chiffres clés --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center shadow-sm">
            <div class="text-3xl font-black" style="color:#0a5c8a">+18 000</div>
            <div class="text-xs text-gray-500 mt-1 font-semibold uppercase tracking-wide">Références</div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center shadow-sm">
            <div class="text-3xl font-black" style="color:#0a5c8a">4</div>
            <div class="text-xs text-gray-500 mt-1 font-semibold uppercase tracking-wide">Marques officielles</div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center shadow-sm">
            <div class="text-3xl font-black" style="color:#0a5c8a">100%</div>
            <div class="text-xs text-gray-500 mt-1 font-semibold uppercase tracking-wide">Produits certifiés</div>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 text-center shadow-sm">
            <div class="text-3xl font-black" style="color:#0a5c8a">Maroc</div>
            <div class="text-xs text-gray-500 mt-1 font-semibold uppercase tracking-wide">Livraison nationale</div>
        </div>
    </div>

    {{-- Valeurs --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="text-2xl mb-3">⚡</div>
            <h3 class="font-bold text-sm uppercase tracking-wide mb-2" style="color:#0d2b45">Expertise technique</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Une équipe de spécialistes en électrotechnique et en systèmes d'énergie, prête à vous conseiller sur les solutions les mieux adaptées à vos besoins.</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="text-2xl mb-3">🔒</div>
            <h3 class="font-bold text-sm uppercase tracking-wide mb-2" style="color:#0d2b45">Qualité garantie</h3>
            <p class="text-gray-500 text-sm leading-relaxed">Tous nos produits sont originaux, certifiés et conformes aux normes internationales. Aucun compromis sur la qualité ou la sécurité.</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
            <div class="text-2xl mb-3">🤝</div>
            <h3 class="font-bold text-sm uppercase tracking-wide mb-2" style="color:#0d2b45">Service irréprochable</h3>
            <p class="text-gray-500 text-sm leading-relaxed">De la commande à la livraison, nous assurons un suivi rigoureux avec un service après-vente disponible et réactif pour tous nos clients.</p>
        </div>
    </div>

    {{-- CTA --}}
    <div class="rounded-2xl p-10 text-center text-white" style="background:#0d2b45">
        <h2 class="text-2xl font-black mb-3">Vous avez un projet ?</h2>
        <p class="text-gray-300 text-sm mb-6">Contactez notre équipe pour un devis personnalisé ou une assistance technique.</p>
        <a href="{{ route('contact') }}"
           class="inline-block font-bold px-8 py-3 rounded-xl text-white transition hover:opacity-90"
           style="background:#4caf50">
            Nous contacter →
        </a>
    </div>

</div>
@endsection