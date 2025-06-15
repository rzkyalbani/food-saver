<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // Menghitung total pendapatan dari order yang sudah lunas
        $grossRevenue = Order::where('status', 'paid')->orWhere('status', 'completed')->sum('total_price');

        return [
            Stat::make('Total Pengguna', User::count())
                ->description('Semua pengguna terdaftar')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Total Mitra Toko', Store::where('status', 'approved')->count())
                ->description('Mitra yang sudah disetujui')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
            Stat::make('Pendapatan Kotor', 'Rp ' . Number::format($grossRevenue)) // Format angka
                ->description('Dari semua transaksi lunas')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}