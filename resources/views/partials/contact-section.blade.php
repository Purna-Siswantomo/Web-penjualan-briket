@php
    $address = \App\Models\Setting::get('address');
    $hours = \App\Models\Setting::get('hours');
    $waNumber = \App\Models\Setting::get('wa_number');
    $mapEmbed = \App\Models\Setting::get('map_embed');
@endphp

<section class="bg-stone-900 py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 grid gap-10 lg:grid-cols-2 items-start">
        <div>
            <h2 class="text-2xl sm:text-3xl font-bold text-white">Hubungi Kami</h2>
            <dl class="mt-6 space-y-4 text-stone-300 text-sm">
                @if ($address)
                    <div>
                        <dt class="font-semibold text-white">Alamat</dt>
                        <dd class="mt-1">{{ $address }}</dd>
                    </div>
                @endif
                @if ($hours)
                    <div>
                        <dt class="font-semibold text-white">Jam Operasional</dt>
                        <dd class="mt-1">{{ $hours }}</dd>
                    </div>
                @endif
                @if ($waNumber)
                    <div>
                        <dt class="font-semibold text-white">WhatsApp</dt>
                        <dd class="mt-1">
                            <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang produk briket.') }}" target="_blank" rel="noopener" class="text-amber-400 hover:underline">
                                {{ $waNumber }}
                            </a>
                        </dd>
                    </div>
                @endif
            </dl>
            <a href="{{ route('contact.index') }}" class="mt-6 inline-block rounded-lg bg-amber-600 px-6 py-3 font-medium text-white hover:bg-amber-700 transition">
                Kirim Pesan
            </a>
        </div>

        @if ($mapEmbed)
            <div class="rounded-xl overflow-hidden aspect-video [&>iframe]:w-full [&>iframe]:h-full">
                {!! $mapEmbed !!}
            </div>
        @endif
    </div>
</section>
