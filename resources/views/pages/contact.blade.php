@extends('layouts.app')
 
@section('title', 'Contact – PowerCity')
 
@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">
 
    <div class="text-center mb-10">
        <span class="text-secondary font-semibold text-sm uppercase tracking-widest">Contactez-nous</span>
        <h1 class="text-3xl font-black text-primary-dark mt-1">Nous sommes à votre écoute</h1>
    </div>
 
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-5 py-3 mb-6 flex items-center gap-2">
        <i data-lucide="check-circle" class="w-5 h-5"></i>
        {{ session('success') }}
    </div>
    @endif
 
    <div class="grid md:grid-cols-3 gap-8">
 
        {{-- Infos --}}
        <div class="space-y-5">
            @foreach([
                ['map-pin', 'Adresse', 'Casablanca, Maroc', '#0a5c8a'],
                ['phone', 'Téléphone', '+212 522234448', '#4caf50'],
                ['mail', 'Email', 'contact@powercity.ma', '#0a5c8a'],
                ['clock', 'Horaires', 'Lun–Ven  8h–18h', '#4caf50'],
            ] as [$icon, $label, $value, $color])
            <div class="bg-white rounded-2xl border border-gray-100 p-5 flex gap-4 items-start">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background-color: {{ $color }}20">
                    <i data-lucide="{{ $icon }}" class="w-5 h-5" style="color: {{ $color }}"></i>
                </div>
                <div>
                    <div class="text-xs text-gray-400 uppercase tracking-wide">{{ $label }}</div>
                    <div class="font-semibold text-gray-800 text-sm mt-0.5">{{ $value }}</div>
                </div>
            </div>
            @endforeach
        </div>
 
        {{-- Formulaire --}}
        <div class="md:col-span-2 bg-white rounded-2xl border border-gray-100 p-7">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Envoyer un message</h2>
            <form action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-1">Nom complet *</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 @error('name') border-red-400 @enderror"
                               placeholder="Votre nom">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700 block mb-1">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 @error('email') border-red-400 @enderror"
                               placeholder="votre@email.com">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 block mb-1">Sujet *</label>
                    <input type="text" name="subject" value="{{ old('subject') }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 @error('subject') border-red-400 @enderror"
                           placeholder="Demande de devis, renseignement...">
                    @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-gray-700 block mb-1">Message *</label>
                    <textarea name="message" rows="5"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 resize-none @error('message') border-red-400 @enderror"
                              placeholder="Décrivez votre besoin...">{{ old('message') }}</textarea>
                    @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <button type="submit"
                        class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 rounded-xl transition flex items-center justify-center gap-2">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Envoyer le message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection