<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Support\PlaceholderImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            ['name' => 'Budi Santoso', 'message' => 'Briket sekam padinya awet dan minim asap, cocok untuk usaha sate saya.', 'rating' => 5],
            ['name' => 'Siti Aminah', 'message' => 'Pemesanan lewat WhatsApp gampang banget, responnya cepat.', 'rating' => 5],
            ['name' => 'Andi Wijaya', 'message' => 'Kualitas briketnya bagus, harga bersaing, dan ramah lingkungan. Recommended!', 'rating' => 4],
        ];

        foreach ($testimonials as $testimonial) {
            $photoPath = 'testimonials/'.Str::slug($testimonial['name']).'.jpg';
            PlaceholderImage::avatar($photoPath, $testimonial['name']);

            Testimonial::create([
                ...$testimonial,
                'photo' => $photoPath,
                'status' => true,
            ]);
        }
    }
}
