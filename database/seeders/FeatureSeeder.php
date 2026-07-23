<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        $features = [
            ['icon' => 'heroicon-o-fire', 'title' => 'Panas Stabil & Minim Asap', 'description' => 'Briket sekam padi kami menghasilkan panas yang konsisten dengan asap yang jauh lebih sedikit.'],
            ['icon' => 'heroicon-o-globe-asia-australia', 'title' => 'Ramah Lingkungan', 'description' => 'Diolah dari limbah sekam padi, mengurangi limbah pertanian sekaligus menjadi energi terbarukan.'],
            ['icon' => 'heroicon-o-truck', 'title' => 'Pengiriman ke Berbagai Daerah', 'description' => 'Siap dikirim ke pasar lokal maupun luar daerah.'],
            ['icon' => 'heroicon-o-heart', 'title' => 'Produk Asli Desa', 'description' => 'Mendukung perekonomian warga desa melalui produk unggulan lokal.'],
        ];

        foreach ($features as $index => $feature) {
            Feature::create([
                ...$feature,
                'order' => $index,
            ]);
        }
    }
}
