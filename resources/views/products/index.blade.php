@extends('layouts.app')

@section('title', 'Catalogue Produits – PowerCity')

@section('content')

{{-- BARRE FILTRES --}}
<div style="background:#0d2b45;" class="py-5">
    <div class="max-w-7xl mx-auto px-4">
        <form action="{{ route('products.index') }}" method="GET" id="filterForm">
            <div class="flex flex-wrap gap-4 items-end">

                <div class="flex flex-col gap-1">
                    <label class="text-xs text-gray-300 font-semibold uppercase tracking-widest">Marque</label>
                    <select name="marque" id="marqueSelect"
                            class="px-4 py-2.5 rounded-lg text-sm font-medium bg-white border-0 focus:outline-none min-w-[180px]"
                            style="color:#0d2b45">
                        <option value="">Toutes les marques</option>
                        @foreach($marques as $marque)
                            <option value="{{ $marque }}" {{ request('marque') == $marque ? 'selected' : '' }}>
                                {{ $marque }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-col gap-1">
                    <label class="text-xs text-gray-300 font-semibold uppercase tracking-widest">Catégorie</label>
                    <select name="category" id="categorySelect"
                            class="px-4 py-2.5 rounded-lg text-sm font-medium bg-white border-0 focus:outline-none min-w-[200px]"
                            style="color:#0d2b45">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">

    <p class="text-green-600 font-semibold">CATALOGUE</p>
<h2 class="text-3xl font-bold">
    @if(request('marque') || request('category'))
        Produits
        @if(request('marque')) {{ request('marque') }} @endif
        @if($categoryName) — {{ $categoryName }} @endif
    @else
        Tous nos produits
    @endif
</h2>

    @if($products->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-100 p-16 text-center">
        <span style="font-size:60px; opacity:0.1">📦</span>
        <h3 class="font-semibold text-gray-500 mt-4">Aucun produit trouvé</h3>
        <a href="{{ route('products.index') }}" class="text-sm mt-2 inline-block hover:underline" style="color:#0a5c8a">
            Voir tous les produits
        </a>
    </div>
    @else
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
        <a href="{{ route('products.show', $product) }}"
           class="group text-center">

            <div class="bg-white rounded-xl overflow-hidden flex items-center justify-center mb-3"
                 style="height:220px; border:1px solid #f0f0f0;">
                @if($product->image)
                    <img src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}"
                         alt="{{ $product->libelle }}"
                         class="max-h-48 max-w-full object-contain p-4 group-hover:scale-105 transition-transform duration-300">
                @else
                    <span style="font-size:60px; opacity:0.1">📦</span>
                @endif
            </div>

            <h3 class="font-semibold text-sm text-center group-hover:underline transition"
                style="color:#0a5c8a">
                {{ $product->libelle }}
            </h3>

        </a>
        @endforeach
    </div>

    <div class="mt-8">
        {{ $products->links() }}
    </div>
    @endif
</div>

<script>
const categoriesAvecMarques = @json($categoriesAvecMarques);

const marqueSelect   = document.getElementById('marqueSelect');
const categorySelect = document.getElementById('categorySelect');
const filterForm     = document.getElementById('filterForm');

// Sauvegarder TOUTES les options au chargement
const allOptions = Array.from(categorySelect.querySelectorAll('option')).map(opt => ({
    value: opt.value,
    text: opt.textContent
}));

function filtrerCategories(marque) {
    const currentVal = categorySelect.value;
    categorySelect.innerHTML = '';

    allOptions.forEach(opt => {
        if (opt.value === '') {
            categorySelect.innerHTML += `<option value="">Toutes les catégories</option>`;
            return;
        }
        const marquesDeCetteCat = categoriesAvecMarques[opt.value] || [];
        if (marque === '' || marquesDeCetteCat.includes(marque)) {
            const selected = String(opt.value) === String(currentVal) ? 'selected' : '';
            categorySelect.innerHTML += `<option value="${opt.value}" ${selected}>${opt.text}</option>`;
        }
    });
}

// Appliquer le filtre au chargement si une marque est déjà sélectionnée
const marqueInitiale = marqueSelect.value;
if (marqueInitiale) {
    filtrerCategories(marqueInitiale);
}

marqueSelect.addEventListener('change', function () {
    filtrerCategories(this.value);
    filterForm.submit();
});

categorySelect.addEventListener('change', function () {
    filterForm.submit();
});
</script>

@endsection