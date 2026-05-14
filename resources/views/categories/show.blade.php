@extends('layouts.app')
@section('title', $category->name . ' – PowerCity')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-10">
    <h1 class="text-3xl font-black mb-8" style="color:#0d2b45">{{ $category->name }}</h1>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <a href="{{ route('products.show', $product) }}" class="group text-center block">

            {{-- Image --}}
            <div class="bg-white rounded-xl overflow-hidden flex items-center justify-center mb-3"
                 style="height:220px; border:1px solid #f0f0f0;">
                @if($product->image)
                    <img src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}"
                         alt="{{ $product->libelle }}"
                         class="max-h-48 max-w-full object-contain p-4 transition-transform duration-300 group-hover:scale-110">
                @else
                    <span style="font-size:60px; opacity:0.1">📦</span>
                @endif
            </div>

            {{-- Nom --}}
            <h3 class="font-semibold text-sm text-center group-hover:underline transition"
                style="color:#0a5c8a">
                {{ $product->libelle }}
            </h3>

        </a>
        @endforeach
    </div>

    {{-- Section SEO --}}
    @if($category->description)
    <div class="mt-16 pt-10 border-t border-gray-100">
        <div class="max-w-4xl text-sm leading-relaxed text-gray-600">
            {!! nl2br(e($category->description)) !!}
        </div>
    </div>
    @endif

</div>

@endsection