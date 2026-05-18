<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Booking – {{ $villa->nama }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            /* Landing Page Theme */
            --cream: #f5efe6;
            --sand: #e8d9c5;
            --brown: #8b6443;
            --dark: #1e1510;
            --gold: #c9a96e;
            --green: #3d5a3e;
            --white: #fdfaf6;

            /* Schedule Mappings */
            --bg:       var(--cream);
            --surface:  var(--white);
            --border:   var(--sand);
            --accent:   var(--brown);
            --text:     var(--dark);
            --muted:    rgba(30, 21, 16, 0.6);

            --booked-bg:     rgba(139, 100, 67, 0.12);
            --booked-text:   var(--brown);
            --booked-border: var(--brown);
            
            --checkin-bg:     rgba(61, 90, 62, 0.12);
            --checkin-text:   var(--green);
            --checkin-border: var(--green);
            
            --checkout-bg:     rgba(201, 169, 110, 0.12);
            --checkout-text:   #a3834b; /* darker gold for text */
            --checkout-border: var(--gold);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* NAV */
        nav {
            padding: 20px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }
        .nav-logo {
            font-weight: 600;
            font-size: 22px;
            color: var(--accent);
            text-decoration: none;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 24px;
        }
        .nav-villa {
            font-size: 14px;
            color: var(--muted);
        }
        .nav-villa span { color: var(--text); font-weight: 500; }

        /* HERO */
        .hero {
            padding: 40px 48px 32px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            max-width: 1100px;
            margin: 0 auto;
        }
        .hero-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--text);
            margin-bottom: 8px;
        }
        .hero-sub {
            font-size: 14px;
            color: var(--muted);
        }

        /* LEGEND */
        .legend {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--surface);
            padding: 10px 20px;
            border-radius: 50px;
            border: 1px solid var(--border);
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text);
        }
        .legend-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        .legend-dot.booked    { background: var(--booked-border); }
        .legend-dot.checkin   { background: var(--checkin-border); }
        .legend-dot.checkout  { background: var(--checkout-border); }
        .legend-dot.today     { background: var(--accent); }

        /* CALENDAR CONTAINER */
        .container {
            padding: 0 48px 48px;
            max-width: 1100px;
            margin: 0 auto;
        }

        /* CALENDAR NAV */
        .cal-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            background: var(--surface);
            padding: 16px 24px;
            border-radius: 12px;
            border: 1px solid var(--border);
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }
        .cal-month {
            font-size: 18px;
            font-weight: 600;
            color: var(--text);
        }
        .cal-month span {
            color: var(--accent);
        }
        .cal-controls {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .cal-btn {
            width: 36px;
            height: 36px;
            border: 1px solid var(--border);
            background: var(--surface);
            color: var(--text);
            cursor: pointer;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            font-size: 16px;
            text-decoration: none;
        }
        .cal-btn:hover { border-color: var(--accent); color: var(--accent); background: var(--surface); }
        .cal-today-btn {
            padding: 0 16px;
            width: auto;
            font-size: 13px;
            font-weight: 500;
        }

        /* CALENDAR GRID */
        .calendar {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
        }

        /* DAY HEADERS */
        .cal-header {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            background: rgba(232, 217, 197, 0.4); /* soft sand */
            border-bottom: 1px solid var(--border);
        }
        .cal-header-day {
            padding: 16px;
            text-align: center;
            font-size: 13px;
            font-weight: 600;
            color: var(--muted);
        }
        .cal-header-day:first-child, .cal-header-day:last-child { color: var(--booked-text); }

        /* DAY CELLS */
        .cal-body {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
        }
        .cal-cell {
            min-height: 120px;
            padding: 12px;
            border-right: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            position: relative;
            background: var(--surface);
        }
        .cal-cell:nth-child(7n) { border-right: none; }

        .cal-cell.other-month { background: rgba(30, 21, 16, 0.02); }
        .cal-cell.other-month .cal-date { color: rgba(30, 21, 16, 0.3); }

        .cal-cell.is-today {
            background: rgba(139, 100, 67, 0.05); /* very light brown */
        }
        .cal-cell.is-today .cal-date {
            background: var(--accent);
            color: white;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .cal-cell.is-booked {
            background: rgba(139, 100, 67, 0.02);
        }

        .cal-date {
            font-size: 14px;
            font-weight: 500;
            color: var(--text);
            margin-bottom: 8px;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .booking-tag {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 500;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .booking-tag.checkin  { background: var(--checkin-bg); color: var(--checkin-text); border-left: 3px solid var(--checkin-border); }
        .booking-tag.checkout { background: var(--checkout-bg); color: var(--checkout-text); border-left: 3px solid var(--checkout-border); }
        .booking-tag.occupied { background: var(--booked-bg); color: var(--booked-text); border-left: 3px solid var(--booked-border); }

        /* Responsive Breakpoints */
        @media (max-width: 900px) {
            nav, .hero, .container { padding-left: 20px; padding-right: 20px; }
            .hero { flex-direction: column; align-items: flex-start; gap: 16px; padding-top: 24px; padding-bottom: 24px; }
            .legend { flex-wrap: wrap; gap: 12px; }
            .cal-cell { min-height: 90px; padding: 6px; }
        }

        @media (max-width: 600px) {
            nav { flex-direction: column; align-items: flex-start; gap: 8px; padding-top: 16px; padding-bottom: 16px; }
            .nav-logo { font-size: 20px; }
            .hero-title { font-size: 22px; }
            .hero-sub { font-size: 13px; }
            
            .cal-nav { flex-direction: column; align-items: flex-start; gap: 12px; padding: 12px 16px; }
            .cal-month { font-size: 16px; }
            .cal-controls { width: 100%; justify-content: space-between; }
            .cal-btn { width: 32px; height: 32px; font-size: 14px; flex-shrink: 0; }
            .cal-today-btn { padding: 0 12px; font-size: 12px; white-space: nowrap; min-width: fit-content; }

            .calendar { border-radius: 8px; }
            .cal-header-day { padding: 8px 2px; font-size: 10px; }
            .cal-cell { min-height: 70px; padding: 4px; }
            .cal-date { width: 22px; height: 22px; font-size: 12px; margin-bottom: 2px; }
            .cal-cell.is-today .cal-date { width: 22px; height: 22px; font-size: 11px; }

            .booking-tag { 
                font-size: 8.5px; 
                padding: 2px 4px; 
                border-left-width: 2px; 
                margin-bottom: 2px;
                letter-spacing: -0.2px;
            }
        }
    </style>
</head>
<body>

<nav>
    <a href="/" class="nav-logo">Villa Oking</a>
    <div class="nav-right">
        <span class="nav-villa">Jadwal untuk: <span>{{ $villa->nama }}</span></span>
    </div>
</nav>

<div class="hero">
    <div>
        <h1 class="hero-title">Kalender Ketersediaan</h1>
        <p class="hero-sub">Informasi jadwal ketersediaan untuk {{ $villa->nama }}</p>
    </div>
    <div class="legend">
        <div class="legend-item">
            <div class="legend-dot today"></div>
            <span>Hari ini</span>
        </div>
        <div class="legend-item">
            <div class="legend-dot booked"></div>
            <span>Terisi</span>
        </div>
        <div class="legend-item">
            <div class="legend-dot checkin"></div>
            <span>Check-in</span>
        </div>
        <div class="legend-item">
            <div class="legend-dot checkout"></div>
            <span>Check-out</span>
        </div>
    </div>
</div>

<div class="container">

    @php
        $now       = \Carbon\Carbon::now();
        $month     = request('month', $now->month);
        $year      = request('year',  $now->year);
        $firstDay  = \Carbon\Carbon::createFromDate($year, $month, 1);
        $lastDay   = $firstDay->copy()->endOfMonth();
        $prevMonth = $firstDay->copy()->subMonth();
        $nextMonth = $firstDay->copy()->addMonth();

        $monthBookings = $bookings->filter(function($b) use ($firstDay, $lastDay) {
            $checkin  = \Carbon\Carbon::parse($b->tanggal_checkin);
            $checkout = \Carbon\Carbon::parse($b->tanggal_checkout);
            return $checkout->gte($firstDay) && $checkin->lte($lastDay);
        });

        $bookedMap = [];
        foreach ($monthBookings as $b) {
            $checkin  = \Carbon\Carbon::parse($b->tanggal_checkin);
            $checkout = \Carbon\Carbon::parse($b->tanggal_checkout);
            $current  = $checkin->copy();
            while ($current->lte($checkout)) {
                $key = $current->format('Y-m-d');
                if (!isset($bookedMap[$key])) $bookedMap[$key] = [];
                $bookedMap[$key][] = $b;
                $current->addDay();
            }
        }

        $monthNames = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
    @endphp

    {{-- CALENDAR NAV --}}
    <div class="cal-nav">
        <div class="cal-month">
            {{ $monthNames[$month] }} <span>{{ $year }}</span>
        </div>
        <div class="cal-controls">
            <a href="?month={{ $prevMonth->month }}&year={{ $prevMonth->year }}" class="cal-btn">‹</a>
            <a href="?month={{ $now->month }}&year={{ $now->year }}" class="cal-btn cal-today-btn">Hari Ini</a>
            <a href="?month={{ $nextMonth->month }}&year={{ $nextMonth->year }}" class="cal-btn">›</a>
        </div>
    </div>

    {{-- CALENDAR --}}
    <div class="calendar">
        <div class="cal-header">
            <div class="cal-header-day">Min</div>
            <div class="cal-header-day">Sen</div>
            <div class="cal-header-day">Sel</div>
            <div class="cal-header-day">Rab</div>
            <div class="cal-header-day">Kam</div>
            <div class="cal-header-day">Jum</div>
            <div class="cal-header-day">Sab</div>
        </div>

        <div class="cal-body">
            @php
                $startOfGrid = $firstDay->copy()->startOfWeek(\Carbon\Carbon::SUNDAY);
                $endOfGrid   = $lastDay->copy()->endOfWeek(\Carbon\Carbon::SATURDAY);
                $current     = $startOfGrid->copy();
            @endphp

            @while($current->lte($endOfGrid))
                @php
                    $dateKey    = $current->format('Y-m-d');
                    $isToday    = $current->isToday();
                    $isThisMonth= $current->month === (int)$month;
                    $isBooked   = isset($bookedMap[$dateKey]);
                    $dayBookings= $bookedMap[$dateKey] ?? [];

                    $classes = 'cal-cell';
                    if (!$isThisMonth) $classes .= ' other-month';
                    if ($isToday)      $classes .= ' is-today';
                    if ($isBooked && $isThisMonth) $classes .= ' is-booked';
                @endphp

                <div class="{{ $classes }}">
                    <div class="cal-date">{{ $current->day }}</div>

                    @if($isBooked && $isThisMonth)
                        @foreach($dayBookings as $b)
                            @php
                                $checkinDate  = \Carbon\Carbon::parse($b->tanggal_checkin)->format('Y-m-d');
                                $checkoutDate = \Carbon\Carbon::parse($b->tanggal_checkout)->format('Y-m-d');
                            @endphp

                            @if($dateKey === $checkinDate)
                                <div class="booking-tag checkin">
                                    Check-in
                                </div>
                            @elseif($dateKey === $checkoutDate)
                                <div class="booking-tag checkout">
                                    Check-out
                                </div>
                            @else
                                <div class="booking-tag occupied">
                                    Terisi
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>

                @php $current->addDay(); @endphp
            @endwhile
        </div>
    </div>

</div>

</body>
</html>