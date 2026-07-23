<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Support\SeedAsset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $name = 'Briket Sekam Padi';
        $iconPath = SeedAsset::copy('rice-husk-sacks.jpg', 'categories/briket-sekam-padi.jpg');

        Category::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => 'Briket ramah lingkungan berbahan dasar sekam padi, diolah warga desa menjadi bahan bakar alternatif berkualitas.',
            'icon' => $iconPath,
        ]);
    }
}
