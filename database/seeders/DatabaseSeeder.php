<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Desa',
            'email' => 'admin@briketdesa.test',
            'password' => 'password',
            'role' => 'super_admin',
        ]);

        $this->call([
            SettingSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            FeatureSeeder::class,
            BannerSeeder::class,
            TestimonialSeeder::class,
            GallerySeeder::class,
        ]);
    }
}
