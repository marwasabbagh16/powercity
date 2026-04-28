@extends('layouts.app')
@section('title', $category->name . ' – PowerCity')
@section('content')

<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-black mb-8" style="color:#0d2b45">{{ $category->name }}</h1>

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
                    <span style="font-size:50px; opacity:0.1">📦</span>
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
                <h3 class="font-semibold text-sm text-gray-800 line-clamp-2 flex-1 mb-3">
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

    <div class="mt-8">{{ $products->links() }}</div>
</div>

@endsection