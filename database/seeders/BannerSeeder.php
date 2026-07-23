<?php

namespace Database\Seeders;

use App\Models\Banner;
use App\Support\SeedAsset;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'source' => 'rice-field.jpg',
                'image_path' => 'banners/banner-1.jpg',
                'title' => 'Briket Sekam Padi Desa Makmur',
                'subtitle' => 'Briket ramah lingkungan berbahan sekam padi, langsung dari produsen ke tangan Anda.',
                'button_text' => 'Lihat Produk',
                'button_url' => '/produk',
            ],
            [
                'source' => 'farmhouse-rice-field.jpg',
                'image_path' => 'banners/banner-2.jpg',
                'title' => 'Pesan Mudah via WhatsApp',
                'subtitle' => 'Tanpa ribet, langsung chat admin untuk pemesanan.',
                'button_text' => 'Hubungi Kami',
                'button_url' => '/kontak',
            ],
        ];

        foreach ($banners as $index => $banner) {
            $imagePath = SeedAsset::copy($banner['source'], $banner['image_path']);

            Banner::create([
                'image_path' => $imagePath,
                'title' => $banner['title'],
                'subtitle' => $banner['subtitle'],
                'button_text' => $banner['button_text'],
                'button_url' => $banner['button_url'],
                'order' => $index,
                'status' => true,
            ]);
        }
    }
}
