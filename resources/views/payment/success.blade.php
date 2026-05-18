<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil – Booking #{{ $booking->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --cream:   #f8fafc;
            --sand:    #e2e8f0;
            --brown:   #2563eb;
            --dark:    #0f172a;
            --muted:   #64748b;
            --white:   #FFFFFF;
            --border:  #cbd5e1;
            --success: #10b981;
            --radius:  8px;
        }
        body { font-family: 'Poppins', sans-serif; background: var(--cream); color: var(--dark); min-height: 100vh; }

        nav {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 40px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .nav-logo { font-size: 22px; font-weight: 700; color: var(--dark); text-decoration: none; }
        .nav-step { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--muted); }
        .nav-step span.done { color: var(--success); font-weight: 500; }
        .nav-step .dot { width: 4px; height: 4px; border-radius: 50%; background: var(--border); }

        .page {
            max-width: 680px;
            margin: 60px auto;
            padding: 0 24px;
        }

        /* SUCCESS HERO */
        .hero {
            text-align: center;
            margin-bottom: 40px;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            background: #DCFCE7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            animation: pop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        @keyframes pop {
            0%   { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .hero h1 { font-size: 28px; font-weight: 700; margin-bottom: 8px; }
        .hero p { font-size: 14px; color: var(--muted); line-height: 1.6; }

        /* BOOKING ID BADGE */
        .booking-id {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 13px;
            color: #166534;
            font-weight: 500;
            margin-top: 12px;
        }

        /* CARD */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px;
            margin-bottom: 16px;
        }
        .card-title {
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 20px;
        }

        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .info-item .info-label {
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 4px;
            font-weight: 500;
        }
        .info-item .info-value { font-size: 14px; font-weight: 500; }

        /* PRICE ROWS */
        .price-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 14px;
            border-bottom: 1px solid var(--border);
        }
        .price-row:last-of-type { border-bottom: none; }
        .price-row .label { color: var(--muted); }
        .price-total {
            display: flex;
            justify-content: space-between;
            padding: 14px 0 0;
            margin-top: 8px;
            border-top: 2px solid var(--dark);
        }
        .price-total .label { font-size: 12px; letter-spacing: 0.1em; text-transform: uppercase; font-weight: 500; }
        .price-total .value { font-size: 20px; font-weight: 700; color: var(--success); }

        /* STATUS */
        .badge-paid {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #DCFCE7;
            color: #166534;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-paid .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

        /* ACTIONS */
        .actions { display: flex; gap: 12px; margin-top: 8px; }
        .btn {
            flex: 1;
            padding: 14px;
            border-radius: var(--radius);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.05em;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background 0.2s, transform 0.1s;
            display: block;
        }
        .btn:active { transform: scale(0.99); }
        .btn-primary { background: var(--dark); color: var(--white); border: none; }
        .btn-primary:hover { background: var(--brown); }
        .btn-outline { background: var(--white); color: var(--dark); border: 1px solid var(--border); }
        .btn-outline:hover { background: var(--cream); }
    </style>
</head>
<body>

<nav>
    <a href="/" class="nav-logo">Villa App</a>
    <div class="nav-step">
        <span class="done">✓ 01 Detail</span>
        <div class="dot"></div>
        <span class="done">✓ 02 Pembayaran</span>
        <div class="dot"></div>
        <span class="done">✓ 03 Konfirmasi</span>
    </div>
</nav>

<div class="page">

    {{-- HERO --}}
    <div class="hero">
        <div class="success-icon">
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#16a34a" stroke-width="2.5">
                <polyline points="20 6 9 17 4 12"/>
            </svg>
        </div>
        <h1>Pembayaran Berhasil!</h1>
        <p>Terima kasih, booking kamu sudah dikonfirmasi.<br>Detail reservasi tersedia di bawah ini.</p>
        <div class="booking-id">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                <rect x="9" y="3" width="6" height="4" rx="1"/>
            </svg>
            Booking #{{ $booking->id }}
        </div>
    </div>

    {{-- DATA TAMU --}}
    <div class="card">
        <div class="card-title">Data Tamu</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Nama Lengkap</div>
                <div class="info-value">{{ $booking->guest->nama }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Nomor Telepon</div>
                <div class="info-value">{{ $booking->guest->nomor_telpon }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Status</div>
                <div class="info-value">
                    <span class="badge-paid"><span class="dot"></span> Paid</span>
                </div>
            </div>
        </div>
    </div>

    {{-- DETAIL MENGINAP --}}
    <div class="card">
        <div class="card-title">Detail Menginap</div>
        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">Villa</div>
                <div class="info-value">{{ $booking->villa->nama }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Jumlah Tamu</div>
                <div class="info-value">{{ $booking->jumlah_tamu }} orang</div>
            </div>
            <div class="info-item">
                <div class="info-label">Check-in</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($booking->tanggal_checkin)->translatedFormat('d F Y') }}
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Check-out</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($booking->tanggal_checkout)->translatedFormat('d F Y') }}
                </div>
            </div>
            <div class="info-item">
                <div class="info-label">Durasi</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($booking->tanggal_checkin)->diffInDays($booking->tanggal_checkout) }} malam
                </div>
            </div>
        </div>
    </div>

    {{-- RINCIAN BIAYA --}}
    <div class="card">
        <div class="card-title">Rincian Biaya</div>

        @php $malam = \Carbon\Carbon::parse($booking->tanggal_checkin)->diffInDays($booking->tanggal_checkout); @endphp

        <div class="price-row">
            <span class="label">Harga per malam</span>
            <span>Rp {{ number_format($booking->villa->harga_permalam, 0, ',', '.') }}</span>
        </div>
        <div class="price-row">
            <span class="label">Durasi menginap</span>
            <span>{{ $malam }} malam</span>
        </div>
        <div class="price-row">
            <span class="label">Biaya layanan</span>
            <span>Rp 0</span>
        </div>
        <div class="price-total">
            <span class="label">Total Dibayar</span>
            <span class="value">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- ACTIONS --}}
    <div class="actions">
        <a href="/" class="btn btn-outline">Kembali ke Beranda</a>
        <a href="{{ route('booking.create', $booking->villa_id) }}" class="btn btn-primary">Booking Lagi</a>
    </div>

</div>
</body>
</html>