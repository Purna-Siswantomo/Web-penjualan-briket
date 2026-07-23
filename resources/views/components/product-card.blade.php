@props(['product'])

<div class="group rounded-xl border border-stone-200 bg-white overflow-hidden hover:shadow-lg transition flex flex-col">
    <a href="{{ route('products.show', $product->slug) }}" class="block aspect-square bg-stone-100 overflow-hidden">
        @if ($product->images->isNotEmpty())
            <img
                src="{{ \Illuminate\Support\Facades\Storage::url($product->images->first()->image_path) }}"
                alt="{{ $product->name }}"
                class="h-full w-full object-cover group-hover:scale-105 transition duration-300"
                loading="lazy"
            >
        @else
            <div class="h-full w-full flex items-center justify-center text-4xl">🔥</div>
        @endif
    </a>

    <div class="p-4 flex flex-col flex-1">
        @if ($product->category)
            <span class="text-xs font-medium text-amber-600 uppercase tracking-wide">{{ $product->category->name }}</span>
        @endif

        <a href="{{ route('products.show', $product->slug) }}" class="mt-1 font-semibold text-stone-900 hover:text-amber-600 line-clamp-2">
            {{ $product->name }}
        </a>

        <div class="mt-2 font-bold text-stone-900">
            Rp {{ number_format($product->price, 0, ',', '.') }} <span class="text-xs font-normal text-stone-500">/ {{ $product->unit }}</span>
        </div>

        <div class="mt-3 flex-1">
            @if ($product->stock <= 0)
                <span class="inline-block text-xs font-medium bg-red-100 text-red-700 px-2 py-1 rounded">Stok Habis</span>
            @elseif ($product->stock <= 5)
                <span class="inline-block text-xs font-medium bg-amber-100 text-amber-700 px-2 py-1 rounded">Stok Menipis</span>
            @endif
        </div>

        @if ($product->stock > 0)
            <a
                href="{{ \App\Support\WhatsApp::orderLink($product->name) }}"
                target="_blank"
                rel="noopener"
                class="mt-3 inline-flex items-center justify-center gap-2 rounded-lg bg-green-600 text-white text-sm font-medium py-2 hover:bg-green-700 transition"
            >
                Pesan via WhatsApp
            </a>
        @else
            <button disabled class="mt-3 inline-flex items-center justify-center gap-2 rounded-lg bg-stone-200 text-stone-500 text-sm font-medium py-2 cursor-not-allowed">
                Stok Habis
            </button>
        @endif
    </div>
</div>
