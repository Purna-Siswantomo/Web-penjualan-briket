<?php

namespace Database\Seeders;

use App\Models\GalleryPhoto;
use App\Support\SeedAsset;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $photos = [
            ['caption' => 'Pengumpulan Sekam Padi', 'source' => 'rice-husk-sacks.jpg'],
            ['caption' => 'Proses Penjemuran', 'source' => 'women-sifting-grain.jpg'],
            ['caption' => 'Proses Pencetakan Briket', 'source' => 'charcoal-briquettes.jpg'],
            ['caption' => 'Proses Pengeringan Briket', 'source' => 'rice-field.jpg'],
            ['caption' => 'Briket Siap Kemas', 'source' => 'charcoal-briquettes.jpg'],
            ['caption' => 'Pengemasan Produk', 'source' => 'farmhouse-rice-field.jpg'],
        ];

        foreach ($photos as $index => $photo) {
            $imagePath = SeedAsset::copy($photo['source'], 'gallery/photo-'.($index + 1).'.jpg');

            GalleryPhoto::create([
                'image_path' => $imagePath,
                'caption' => $photo['caption'],
                'order' => $index,
            ]);
        }
    }
}
