<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use Filament\Widgets\Widget;
use Carbon\Carbon;

class BookingCalendarWidget extends Widget
{
    protected string $view = 'filament.widgets.booking-calendar-widget';
    protected int | string | array $columnSpan = 1;
    protected static ?int $sort = 3;

    public int $month;
    public int $year;

    public function mount()
    {
        $now = Carbon::now();
        $this->month = $now->month;
        $this->year = $now->year;
    }

    public function previousMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->subMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function nextMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->addMonth();
        $this->month = $date->month;
        $this->year = $date->year;
    }

    public function today()
    {
        $now = Carbon::now();
        $this->month = $now->month;
        $this->year = $now->year;
    }

    protected function getViewData(): array
    {
        $firstDay = Carbon::createFromDate($this->year, $this->month, 1);
        $lastDay = $firstDay->copy()->endOfMonth();

        // Get all bookings that overlap with the current month view
        $monthBookings = Booking::where(function ($query) use ($firstDay, $lastDay) {
            $query->whereBetween('tanggal_checkin', [$firstDay, $lastDay])
                  ->orWhereBetween('tanggal_checkout', [$firstDay, $lastDay])
                  ->orWhere(function ($q) use ($firstDay, $lastDay) {
                      $q->where('tanggal_checkin', '<=', $firstDay)
                        ->where('tanggal_checkout', '>=', $lastDay);
                  });
        })->get();

        $bookedMap = [];
        foreach ($monthBookings as $b) {
            $checkin  = Carbon::parse($b->tanggal_checkin)->startOfDay();
            $checkout = Carbon::parse($b->tanggal_checkout)->startOfDay();
            $current  = $checkin->copy();
            
            while ($current->lte($checkout)) {
                $key = $current->format('Y-m-d');
                if (!isset($bookedMap[$key])) {
                    $bookedMap[$key] = [];
                }
                $bookedMap[$key][] = $b;
                $current->addDay();
            }
        }

        return [
            'firstDay' => $firstDay,
            'lastDay' => $lastDay,
            'bookedMap' => $bookedMap,
            'monthNames' => ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
        ];
    }
}
