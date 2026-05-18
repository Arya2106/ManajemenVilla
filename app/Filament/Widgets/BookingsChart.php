<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingsChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Pemesanan (Bulan Ini)';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $now = Carbon::now();
        $daysInMonth = $now->daysInMonth;
        
        $data = [];
        $labels = [];
        
        // Initialize array
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $data[$i] = 0;
            $labels[] = $i . ' ' . $now->translatedFormat('M');
        }

        // Get bookings for this month
        // Gunakan DB::raw untuk mengekstrak hari karena support SQLite/MySQL bisa beda, 
        // tapi asumsikan ini MySQL. Jika SQLite (bawaan dev), pake strftime.
        // Cara paling aman tanpa peduli driver DB adalah mengambil semua data bulan ini
        // lalu di-group di collection Laravel.
        
        $bookings = Booking::whereMonth('tanggal_checkin', $now->month)
            ->whereYear('tanggal_checkin', $now->year)
            ->get()
            ->groupBy(function($date) {
                return Carbon::parse($date->tanggal_checkin)->format('j'); // get day without leading zero
            });

        foreach ($bookings as $day => $dayBookings) {
            $data[$day] = $dayBookings->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pemesanan',
                    'data' => array_values($data),
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
