@extends('layouts.app')

@section('title', 'Kontak - '.\App\Models\Setting::get('site_name', 'Briket Desa'))

@section('content')
@php
    $address = \App\Models\Setting::get('address');
    $hours = \App\Models\Setting::get('hours');
    $waNumber = \App\Models\Setting::get('wa_number');
    $mapEmbed = \App\Models\Setting::get('map_embed');
@endphp

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-2xl sm:text-3xl font-bold text-stone-900">Hubungi Kami</h1>

    @if (session('status'))
        <div class="mt-6 rounded-lg bg-green-100 text-green-800 px-4 py-3 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <div class="mt-8 grid gap-10 lg:grid-cols-2">
        <div>
            <form method="POST" action="{{ route('contact.store') }}" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-stone-700">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="mt-1 w-full rounded-lg border-stone-300 focus:border-amber-500 focus:ring-amber-500">
                    @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-stone-700">No. HP / Email</label>
                    <input type="text" name="contact" value="{{ old('contact') }}" required class="mt-1 w-full rounded-lg border-stone-300 focus:border-amber-500 focus:ring-amber-500">
                    @error('contact') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-stone-700">Pesan</label>
                    <textarea name="message" rows="5" required class="mt-1 w-full rounded-lg border-stone-300 focus:border-amber-500 focus:ring-amber-500">{{ old('message') }}</textarea>
                    @error('message') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="rounded-lg bg-amber-600 px-6 py-3 font-medium text-white hover:bg-amber-700 transition">
                    Kirim Pesan
                </button>
            </form>

            @if ($waNumber)
                <a
                    href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang produk briket.') }}"
                    target="_blank"
                    rel="noopener"
                    class="mt-6 inline-flex items-center gap-2 rounded-lg bg-green-600 px-6 py-3 font-medium text-white hover:bg-green-700 transition"
                >
                    Chat Langsung via WhatsApp
                </a>
            @endif
        </div>

        <div>
            <dl class="space-y-4 text-sm text-stone-600">
                @if ($address)
                    <div>
                        <dt class="font-semibold text-stone-900">Alamat</dt>
                        <dd class="mt-1">{{ $address }}</dd>
                    </div>
                @endif
                @if ($hours)
                    <div>
                        <dt class="font-semibold text-stone-900">Jam Operasional</dt>
                        <dd class="mt-1">{{ $hours }}</dd>
                    </div>
                @endif
            </dl>

            @if ($mapEmbed)
                <div class="mt-6 rounded-xl overflow-hidden aspect-video [&>iframe]:w-full [&>iframe]:h-full">
                    {!! $mapEmbed !!}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
