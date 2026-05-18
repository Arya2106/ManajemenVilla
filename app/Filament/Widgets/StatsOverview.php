<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Expense;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth()->toDateString();
        $endOfMonth = $now->copy()->endOfMonth()->toDateString();

        $pendapatan = Booking::where('status', 'paid')
            ->whereBetween('tanggal_checkin', [$startOfMonth, $endOfMonth])
            ->sum('total_harga');

        $pengeluaran = Expense::whereBetween('tanggal_pengeluaran', [$startOfMonth, $endOfMonth])
            ->sum('nominal');

        $bookingMasuk = Booking::whereBetween('tanggal_checkin', [$startOfMonth, $endOfMonth])->count();

        return [
            Stat::make('Pendapatan (Bulan Ini)', 'Rp ' . number_format($pendapatan, 0, ',', '.'))
                ->description('Berdasarkan tanggal check-in')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
                
            Stat::make('Pengeluaran (Bulan Ini)', 'Rp ' . number_format($pengeluaran, 0, ',', '.'))
                ->description('Total pengeluaran bulan ini')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
                
            Stat::make('Total Booking (Bulan Ini)', $bookingMasuk)
                ->description('Booking yang check-in bulan ini')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),
        ];
    }
}
