<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Feature;
use App\Models\GalleryPhoto;
use App\Models\Product;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::where('status', true)->orderBy('order')->get();
        $features = Feature::orderBy('order')->get();
        $featuredProducts = Product::where('status', true)
            ->with(['category', 'images'])
            ->latest()
            ->take(8)
            ->get();
        $testimonials = Testimonial::where('status', true)->latest()->take(6)->get();
        $gallery = GalleryPhoto::orderBy('order')->take(8)->get();

        return view('home', compact('banners', 'features', 'featuredProducts', 'testimonials', 'gallery'));
    }
}
