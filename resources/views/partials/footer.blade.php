@php
    $siteName = \App\Models\Setting::get('site_name', 'Briket Desa');
    $address = \App\Models\Setting::get('address');
    $hours = \App\Models\Setting::get('hours');
    $waNumber = \App\Models\Setting::get('wa_number');
    $facebook = \App\Models\Setting::get('facebook_url');
    $instagram = \App\Models\Setting::get('instagram_url');
    $tiktok = \App\Models\Setting::get('tiktok_url');
@endphp

<footer class="bg-stone-900 text-stone-300 mt-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
        <div>
            <h3 class="text-white font-bold text-lg mb-3">{{ $siteName }}</h3>
            <p class="text-sm text-stone-400">Briket arang berkualitas produksi desa, dipasarkan langsung tanpa perantara.</p>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3">Tautan Cepat</h4>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-amber-500">Beranda</a></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-amber-500">Produk</a></li>
                <li><a href="{{ route('contact.index') }}" class="hover:text-amber-500">Kontak</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3">Kontak</h4>
            <ul class="space-y-2 text-sm text-stone-400">
                @if ($address)
                    <li>{{ $address }}</li>
                @endif
                @if ($hours)
                    <li>{{ $hours }}</li>
                @endif
                @if ($waNumber)
                    <li>
                        <a href="{{ \App\Support\WhatsApp::link('Halo, saya ingin bertanya tentang produk briket.') }}" target="_blank" rel="noopener" class="hover:text-amber-500">
                            WhatsApp: {{ $waNumber }}
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div>
            <h4 class="text-white font-semibold mb-3">Sosial Media</h4>
            <ul class="space-y-2 text-sm">
                @if ($facebook)
                    <li><a href="{{ $facebook }}" target="_blank" rel="noopener" class="hover:text-amber-500">Facebook</a></li>
                @endif
                @if ($instagram)
                    <li><a href="{{ $instagram }}" target="_blank" rel="noopener" class="hover:text-amber-500">Instagram</a></li>
                @endif
                @if ($tiktok)
                    <li><a href="{{ $tiktok }}" target="_blank" rel="noopener" class="hover:text-amber-500">TikTok</a></li>
                @endif
            </ul>
        </div>
    </div>

    <div class="border-t border-stone-800 py-4 text-center text-xs text-stone-500">
        &copy; {{ date('Y') }} {{ $siteName }}. Seluruh hak cipta dilindungi.
    </div>
</footer>
