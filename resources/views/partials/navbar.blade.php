@php
    $siteName = \App\Models\Setting::get('site_name', 'Briket Desa');
    $siteLogo = \App\Models\Setting::get('site_logo');
@endphp

<header x-data="{ open: false }" class="sticky top-0 z-30 bg-white/95 backdrop-blur border-b border-stone-200">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-bold text-lg text-stone-900">
                @if ($siteLogo)
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($siteLogo) }}" alt="{{ $siteName }}" class="h-9 w-9 rounded object-cover">
                @else
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded bg-amber-600 text-white">🔥</span>
                @endif
                <span>{{ $siteName }}</span>
            </a>

            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-stone-700">
                <a href="{{ route('home') }}" class="hover:text-amber-600 {{ request()->routeIs('home') ? 'text-amber-600' : '' }}">Beranda</a>
                <a href="{{ route('products.index') }}" class="hover:text-amber-600 {{ request()->routeIs('products.*') ? 'text-amber-600' : '' }}">Produk</a>
                <a href="{{ route('contact.index') }}" class="hover:text-amber-600 {{ request()->routeIs('contact.*') ? 'text-amber-600' : '' }}">Kontak</a>
            </nav>

            <button @click="open = !open" class="md:hidden p-2 text-stone-700" aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <nav x-show="open" x-cloak class="md:hidden pb-4 flex flex-col gap-3 text-sm font-medium text-stone-700">
            <a href="{{ route('home') }}" class="hover:text-amber-600">Beranda</a>
            <a href="{{ route('products.index') }}" class="hover:text-amber-600">Produk</a>
            <a href="{{ route('contact.index') }}" class="hover:text-amber-600">Kontak</a>
        </nav>
    </div>
</header>
