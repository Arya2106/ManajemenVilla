<x-filament-widgets::widget>
    <x-filament::section>
        <style>
            .fc-grid { display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); border-left: 1px solid #e5e7eb; border-top: 1px solid #e5e7eb; border-radius: 0.5rem; overflow: hidden; }
            .dark .fc-grid { border-color: #1f2937; }
            .fc-header { text-align: center; font-size: 0.7rem; font-weight: 500; text-transform: uppercase; color: #6b7280; padding: 0.35rem; border-right: 1px solid #e5e7eb; border-bottom: 1px solid #e5e7eb; background-color: #f9fafb; }
            .dark .fc-header { background-color: #111827; border-color: #1f2937; color: #9ca3af; }
            .fc-cell { min-height: 50px; padding: 0.25rem; border-right: 1px solid #e5e7eb; border-bottom: 1px solid #e5e7eb; background-color: #ffffff; }
            .dark .fc-cell { background-color: #18181b; border-color: #1f2937; }
            .fc-cell.is-other-month { background-color: #f9fafb; opacity: 0.6; }
            .dark .fc-cell.is-other-month { background-color: #111827; }
            .fc-cell.is-today { background-color: #eff6ff; }
            .dark .fc-cell.is-today { background-color: rgba(59, 130, 246, 0.1); }
            
            .fc-date { font-size: 0.75rem; font-weight: 500; color: #374151; margin-bottom: 0.15rem; display: inline-block; }
            .dark .fc-date { color: #d1d5db; }
            .fc-cell.is-today .fc-date { background-color: rgba(var(--primary-600), 1); color: white; border-radius: 9999px; width: 1.25rem; height: 1.25rem; display: flex; align-items: center; justify-content: center; }
            
            .fc-label { font-size: 0.55rem; padding: 0.1rem 0.2rem; border-radius: 0.2rem; margin-bottom: 0.15rem; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; border-left-width: 2px; border-left-style: solid; font-weight: 500; }
            .fc-label.checkin { background-color: #dcfce7; color: #15803d; border-left-color: #22c55e; }
            .dark .fc-label.checkin { background-color: rgba(34, 197, 94, 0.15); color: #4ade80; }
            .fc-label.checkout { background-color: #fef9c3; color: #a16207; border-left-color: #eab308; }
            .dark .fc-label.checkout { background-color: rgba(234, 179, 8, 0.15); color: #facc15; }
            .fc-label.occupied { background-color: #fee2e2; color: #b91c1c; border-left-color: #ef4444; }
            .dark .fc-label.occupied { background-color: rgba(239, 68, 68, 0.15); color: #f87171; }
            
            .fc-legend { display: flex; align-items: center; gap: 1rem; margin-top: 1rem; font-size: 0.75rem; color: #6b7280; }
            .dark .fc-legend { color: #9ca3af; }
            .fc-legend-item { display: flex; align-items: center; gap: 0.25rem; }
            .fc-dot { width: 0.75rem; height: 0.75rem; border-radius: 9999px; }
            .fc-dot.checkin { background-color: #22c55e; }
            .fc-dot.checkout { background-color: #eab308; }
            .fc-dot.occupied { background-color: #ef4444; }
        </style>

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <x-filament::button wire:click="previousMonth" color="gray" size="sm">
                    ‹ Sebelumnya
                </x-filament::button>
                <div style="font-weight: 500; padding: 0 0.5rem; color: rgba(var(--primary-600), 1); width: 8rem; text-align: center;">
                    {{ $monthNames[$month] }} {{ $year }}
                </div>
                <x-filament::button wire:click="nextMonth" color="gray" size="sm">
                    Selanjutnya ›
                </x-filament::button>
                <x-filament::button wire:click="today" color="primary" size="sm">
                    Hari Ini
                </x-filament::button>
            </div>
        </div>

        <div style="width: 100%;">
            <div class="fc-grid">
                <!-- Header Hari -->
                @foreach(['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $day)
                    <div class="fc-header">
                        {{ $day }}
                    </div>
                @endforeach

                <!-- Grid Tanggal -->
                @php
                    $startOfGrid = clone $firstDay;
                    $startOfGrid->startOfWeek(\Carbon\Carbon::SUNDAY);
                    
                    $endOfGrid = clone $lastDay;
                    $endOfGrid->endOfWeek(\Carbon\Carbon::SATURDAY);
                    
                    $current = clone $startOfGrid;
                @endphp

                @while($current->lte($endOfGrid))
                    @php
                        $dateKey = $current->format('Y-m-d');
                        $isToday = $current->isToday();
                        $isThisMonth = $current->month === $month;
                        $isBooked = isset($bookedMap[$dateKey]);
                        $dayBookings = $bookedMap[$dateKey] ?? [];
                        
                        $cellClass = 'fc-cell';
                        if (!$isThisMonth) $cellClass .= ' is-other-month';
                        if ($isToday) $cellClass .= ' is-today';
                    @endphp

                    <div class="{{ $cellClass }}">
                        <div style="margin-bottom: 4px;">
                            <span class="fc-date">
                                {{ $current->day }}
                            </span>
                        </div>

                        <div style="display: flex; flex-direction: column;">
                            @if($isBooked && $isThisMonth)
                                @foreach($dayBookings as $b)
                                    @php
                                        $checkinDate  = \Carbon\Carbon::parse($b->tanggal_checkin)->format('Y-m-d');
                                        $checkoutDate = \Carbon\Carbon::parse($b->tanggal_checkout)->format('Y-m-d');
                                        
                                        $type = 'occupied';
                                        $label = 'Terisi';
                                        
                                        if($dateKey === $checkinDate) {
                                            $type = 'checkin';
                                            $label = 'Check-in';
                                        } elseif($dateKey === $checkoutDate) {
                                            $type = 'checkout';
                                            $label = 'Check-out';
                                        }
                                    @endphp
                                    <div class="fc-label {{ $type }}" title="{{ $b->guest->nama ?? 'Guest' }}">
                                        {{ $label }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    @php $current->addDay(); @endphp
                @endwhile
            </div>
        </div>
        
        <!-- Legenda -->
        <div class="fc-legend">
            <div class="fc-legend-item">
                <div class="fc-dot checkin"></div> Check-in
            </div>
            <div class="fc-legend-item">
                <div class="fc-dot checkout"></div> Check-out
            </div>
            <div class="fc-legend-item">
                <div class="fc-dot occupied"></div> Terisi
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
