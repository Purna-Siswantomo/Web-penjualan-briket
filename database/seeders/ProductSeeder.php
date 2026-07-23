<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Support\SeedAsset;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::where('slug', 'briket-sekam-padi')->firstOrFail();

        $products = [
            ['name' => 'Briket Sekam Padi Premium 10kg', 'price' => 65000, 'unit' => 'karung', 'stock' => 40],
            ['name' => 'Briket Sekam Padi Reguler 1kg', 'price' => 8000, 'unit' => 'kg', 'stock' => 250],
            ['name' => 'Briket Sekam Padi Ekonomis 25kg', 'price' => 150000, 'unit' => 'dus', 'stock' => 20],
            ['name' => 'Briket Sekam Padi untuk BBQ 5kg', 'price' => 35000, 'unit' => 'karung', 'stock' => 0],
            ['name' => 'Briket Sekam Padi Industri 50kg', 'price' => 280000, 'unit' => 'dus', 'stock' => 10],
        ];

        foreach ($products as $product) {
            $slug = Str::slug($product['name']);

            $created = Product::create([
                'category_id' => $category->id,
                'name' => $product['name'],
                'slug' => $slug,
                'description' => "Briket sekam padi hasil olahan warga desa, diproses secara higienis dari limbah pertanian menjadi bahan bakar alternatif ramah lingkungan.\n\nPanas stabil, minim asap, dan tahan lama. Cocok untuk kebutuhan memasak, panggangan (BBQ), maupun industri rumahan.",
                'price' => $product['price'],
                'unit' => $product['unit'],
                'stock' => $product['stock'],
                'status' => true,
            ]);

            $imagePath = SeedAsset::copy('charcoal-briquettes.jpg', "products/{$slug}.jpg");

            $created->images()->create([
                'image_path' => $imagePath,
                'order' => 0,
            ]);
        }
    }
}
