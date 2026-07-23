@extends('layouts.app')

@section('content')

    {{-- Hero / Banner Slider --}}
    @if ($banners->isNotEmpty())
        <section x-data="{ active: 0, count: {{ $banners->count() }} }" x-init="setInterval(() => active = (active + 1) % count, 5000)" class="relative overflow-hidden bg-stone-900">
            @foreach ($banners as $index => $banner)
                <div
                    x-show="active === {{ $index }}"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="relative h-[420px] sm:h-[480px]"
                >
                    <img src="{{ \Illuminate\Support\Facades\Storage::url($banner->image_path) }}" alt="{{ $banner->title }}" class="absolute inset-0 h-full w-full object-cover opacity-60">
                    <div class="relative h-full mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex flex-col justify-center">
                        @if ($banner->title)
                            <h1 class="text-3xl sm:text-5xl font-bold text-white max-w-xl">{{ $banner->title }}</h1>
                        @endif
                        @if ($banner->subtitle)
                            <p class="mt-4 text-stone-200 max-w-lg">{{ $banner->subtitle }}</p>
                        @endif
                        @if ($banner->button_text)
                            <a href="{{ $banner->button_url ?: route('products.index') }}" class="mt-6 inline-block w-fit rounded-lg bg-amber-600 px-6 py-3 font-medium text-white hover:bg-amber-700 transition">
                                {{ $banner->button_text }}
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach

            @if ($banners->count() > 1)
                <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2">
                    @foreach ($banners as $index => $banner)
                        <button @click="active = {{ $index }}" :class="active === {{ $index }} ? 'bg-amber-500' : 'bg-white/50'" class="h-2 w-2 rounded-full"></button>
                    @endforeach
                </div>
            @endif
        </section>
    @endif

    {{-- Tentang --}}
    @php
        $aboutTitle = \App\Models\Setting::get('about_title', 'Tentang Kami');
        $aboutText = \App\Models\Setting::get('about_text');
        $aboutImage = \App\Models\Setting::get('about_image');
    @endphp
    @if ($aboutText)
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 grid gap-10 lg:grid-cols-2 items-center">
            @if ($aboutImage)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($aboutImage) }}" alt="{{ $aboutTitle }}" class="rounded-xl w-full object-cover aspect-video">
            @endif
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-stone-900">{{ $aboutTitle }}</h2>
                <p class="mt-4 text-stone-600 leading-relaxed whitespace-pre-line">{{ $aboutText }}</p>
            </div>
        </section>
    @endif

    {{-- Kenapa Pilih Kami --}}
    @if ($features->isNotEmpty())
        <section class="bg-white py-16 border-y border-stone-200">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 text-center">Kenapa Pilih Kami</h2>
                <div class="mt-10 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($features as $feature)
                        <div class="text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-amber-100 text-amber-600">
                                <x-dynamic-component :component="$feature->icon ?: 'heroicon-o-sparkles'" class="w-7 h-7" />
                            </div>
                            <h3 class="mt-4 font-semibold text-stone-900">{{ $feature->title }}</h3>
                            @if ($feature->description)
                                <p class="mt-2 text-sm text-stone-500">{{ $feature->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Produk Unggulan --}}
    @if ($featuredProducts->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl sm:text-3xl font-bold text-stone-900">Produk Unggulan</h2>
                <a href="{{ route('products.index') }}" class="text-sm font-medium text-amber-600 hover:underline">Lihat Semua &rarr;</a>
            </div>
            <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif

    {{-- Testimoni --}}
    @if ($testimonials->isNotEmpty())
        <section class="bg-stone-100 py-16">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 text-center">Kata Pelanggan Kami</h2>
                <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($testimonials as $testimonial)
                        <div class="rounded-xl bg-white p-6 shadow-sm">
                            <div class="flex items-center gap-3">
                                @if ($testimonial->photo)
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($testimonial->photo) }}" alt="{{ $testimonial->name }}" class="h-10 w-10 rounded-full object-cover">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 font-semibold">
                                        {{ mb_substr($testimonial->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-semibold text-stone-900">{{ $testimonial->name }}</div>
                                    @if ($testimonial->rating)
                                        <div class="text-amber-500 text-sm">{{ str_repeat('★', $testimonial->rating) }}{{ str_repeat('☆', 5 - $testimonial->rating) }}</div>
                                    @endif
                                </div>
                            </div>
                            <p class="mt-4 text-sm text-stone-600 leading-relaxed">"{{ $testimonial->message }}"</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Galeri --}}
    @if ($gallery->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-stone-900 text-center">Galeri</h2>
            <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-4">
                @foreach ($gallery as $photo)
                    <div class="aspect-square rounded-lg overflow-hidden bg-stone-100">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($photo->image_path) }}" alt="{{ $photo->caption }}" class="h-full w-full object-cover hover:scale-105 transition duration-300" loading="lazy">
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    @include('partials.contact-section')

@endsection
