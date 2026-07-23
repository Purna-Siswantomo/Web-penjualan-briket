@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-2xl sm:text-3xl font-bold text-stone-900">Katalog Produk</h1>

    <form method="GET" action="{{ route('products.index') }}" class="mt-6 grid gap-4 sm:grid-cols-4">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari produk..."
            class="sm:col-span-2 rounded-lg border-stone-300 focus:border-amber-500 focus:ring-amber-500"
        >

        <select name="category" class="rounded-lg border-stone-300 focus:border-amber-500 focus:ring-amber-500">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>
                    {{ $category->name }} ({{ $category->products_count }})
                </option>
            @endforeach
        </select>

        <select name="sort" class="rounded-lg border-stone-300 focus:border-amber-500 focus:ring-amber-500">
            <option value="">Terbaru</option>
            <option value="name_asc" @selected(request('sort') === 'name_asc')>Nama A-Z</option>
            <option value="price_asc" @selected(request('sort') === 'price_asc')>Harga Terendah</option>
            <option value="price_desc" @selected(request('sort') === 'price_desc')>Harga Tertinggi</option>
        </select>

        <button type="submit" class="sm:col-span-4 sm:w-fit rounded-lg bg-amber-600 px-6 py-2 font-medium text-white hover:bg-amber-700 transition">
            Terapkan Filter
        </button>
    </form>

    @if ($products->isEmpty())
        <p class="mt-12 text-center text-stone-500">Belum ada produk yang tersedia.</p>
    @else
        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="mt-10">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
