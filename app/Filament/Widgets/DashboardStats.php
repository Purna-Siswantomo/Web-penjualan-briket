<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Jumlah Produk', Product::count())
                ->icon('heroicon-o-cube'),
            Stat::make('Jumlah Kategori', Category::count())
                ->icon('heroicon-o-rectangle-stack'),
            Stat::make('Pesan Belum Dibaca', ContactMessage::where('is_read', false)->count())
                ->icon('heroicon-o-envelope')
                ->color('warning'),
            Stat::make('Stok Menipis / Habis', Product::where('stock', '<=', 5)->count())
                ->description('Stok 5 atau kurang')
                ->icon('heroicon-o-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
