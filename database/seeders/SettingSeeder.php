<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Support\PlaceholderImage;
use App\Support\SeedAsset;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $logoPath = 'settings/site-logo.jpg';
        PlaceholderImage::logo($logoPath);

        $aboutImagePath = SeedAsset::copy('farmhouse-rice-field.jpg', 'settings/about.jpg');

        $settings = [
            'site_name' => 'Briket Desa Makmur',
            'site_logo' => $logoPath,
            'wa_number' => '6281234567890',
            'wa_template' => 'Halo, saya ingin memesan {produk} sebanyak {jumlah}.',
            'address' => 'Jl. Raya Desa Makmur No. 1, Kecamatan Sukamaju, Kabupaten Sejahtera',
            'hours' => 'Senin - Sabtu, 08.00 - 17.00 WIB',
            'facebook_url' => 'https://facebook.com/briketdesamakmur',
            'instagram_url' => 'https://instagram.com/briketdesamakmur',
            'tiktok_url' => null,
            'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1000!2d0!3d0" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'about_title' => 'Tentang Briket Sekam Padi Desa Makmur',
            'about_text' => "Briket Desa Makmur adalah produk unggulan hasil olahan warga desa yang memanfaatkan limbah sekam padi menjadi arang briket berkualitas tinggi dan ramah lingkungan.\n\nDiproduksi secara mandiri oleh BUMDes, briket ini telah dipasarkan ke berbagai wilayah dengan kualitas panas yang stabil, minim asap, dan tahan lama.",
            'about_image' => $aboutImagePath,
        ];

        foreach ($settings as $key => $value) {
            Setting::set($key, $value);
        }
    }
}
