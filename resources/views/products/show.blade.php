@extends('layouts.app')

@section('title', $product->name.' - '.\App\Models\Setting::get('site_name', 'Briket Desa'))
@section('description', \Illuminate\Support\Str::limit(strip_tags($product->description ?? ''), 150))

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <nav class="text-sm text-stone-500">
        <a href="{{ route('home') }}" class="hover:text-amber-600">Beranda</a> /
        <a href="{{ route('products.index') }}" class="hover:text-amber-600">Produk</a> /
        <span class="text-stone-700">{{ $product->name }}</span>
    </nav>

    <div class="mt-6 grid gap-10 lg:grid-cols-2">
        {{-- Galeri --}}
        <div x-data="{ active: 0 }">
            <div class="aspect-square rounded-xl overflow-hidden bg-stone-100">
                @forelse ($product->images as $index => $image)
                    <img
                        x-show="active === {{ $index }}"
                        src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}"
                        alt="{{ $product->name }}"
                        class="h-full w-full object-cover"
                    >
                @empty
                    <div class="h-full w-full flex items-center justify-center text-6xl">🔥</div>
                @endforelse
            </div>

            @if ($product->images->count() > 1)
                <div class="mt-4 grid grid-cols-5 gap-2">
                    @foreach ($product->images as $index => $image)
                        <button
                            @click="active = {{ $index }}"
                            :class="active === {{ $index }} ? 'ring-2 ring-amber-600' : ''"
                            class="aspect-square rounded-lg overflow-hidden bg-stone-100"
                        >
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($image->image_path) }}" alt="" class="h-full w-full object-cover">
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div x-data="{ qty: 1 }">
            @if ($product->category)
                <span class="text-xs font-medium text-amber-600 uppercase tracking-wide">{{ $product->category->name }}</span>
            @endif
            <h1 class="mt-1 text-2xl sm:text-3xl font-bold text-stone-900">{{ $product->name }}</h1>

            <div class="mt-4 text-2xl font-bold text-stone-900">
                Rp {{ number_format($product->price, 0, ',', '.') }}
                <span class="text-sm font-normal text-stone-500">/ {{ $product->unit }}</span>
            </div>

            <div class="mt-3">
                @if ($product->stock <= 0)
                    <span class="inline-block text-sm font-medium bg-red-100 text-red-700 px-3 py-1 rounded-full">Stok Habis</span>
                @elseif ($product->stock <= 5)
                    <span class="inline-block text-sm font-medium bg-amber-100 text-amber-700 px-3 py-1 rounded-full">Stok Menipis ({{ $product->stock }} {{ $product->unit }})</span>
                @else
                    <span class="inline-block text-sm font-medium bg-green-100 text-green-700 px-3 py-1 rounded-full">Stok Tersedia ({{ $product->stock }} {{ $product->unit }})</span>
                @endif
            </div>

            @if ($product->description)
                <p class="mt-6 text-stone-600 leading-relaxed whitespace-pre-line">{{ $product->description }}</p>
            @endif

            @if ($product->stock > 0)
                <div class="mt-8 flex items-end gap-4">
                    <div>
                        <label class="block text-sm font-medium text-stone-700">Jumlah ({{ $product->unit }})</label>
                        <div class="mt-1 flex items-center gap-2">
                            <button type="button" @click="qty = Math.max(1, qty - 1)" class="h-10 w-10 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-100">-</button>
                            <input type="number" min="1" x-model.number="qty" class="h-10 w-16 rounded-lg border-stone-300 text-center focus:border-amber-500 focus:ring-amber-500">
                            <button type="button" @click="qty = qty + 1" class="h-10 w-10 rounded-lg border border-stone-300 text-stone-600 hover:bg-stone-100">+</button>
                        </div>
                    </div>

                    <a
                        :href="`https://wa.me/{{ preg_replace('/\D/', '', (string) \App\Models\Setting::get('wa_number')) }}?text=` + encodeURIComponent({{ \Illuminate\Support\Js::from(\App\Models\Setting::get('wa_template') ?: 'Halo, saya ingin memesan {produk} sebanyak {jumlah}.') }}.replace('{produk}', {{ \Illuminate\Support\Js::from($product->name) }}).replace('{jumlah}', qty + ' {{ $product->unit }}'))"
                        target="_blank"
                        rel="noopener"
                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-green-600 text-white font-medium px-6 py-3 hover:bg-green-700 transition"
                    >
                        Pesan via WhatsApp
                    </a>
                </div>
            @else
                <button disabled class="mt-8 inline-flex items-center justify-center gap-2 rounded-lg bg-stone-200 text-stone-500 font-medium px-6 py-3 cursor-not-allowed">
                    Stok Habis
                </button>
            @endif
        </div>
    </div>

    {{-- Produk Terkait --}}
    @if ($relatedProducts->isNotEmpty())
        <div class="mt-16">
            <h2 class="text-xl font-bold text-stone-900">Produk Terkait</h2>
            <div class="mt-6 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($relatedProducts as $related)
                    <x-product-card :product="$related" />
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
