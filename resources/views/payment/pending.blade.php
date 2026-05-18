<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menunggu Pembayaran – Booking #{{ $booking->id }}</title>
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
            --warning: #f59e0b;
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
        .nav-step span.done    { color: #10b981; font-weight: 500; }
        .nav-step span.active  { color: var(--warning); font-weight: 500; }
        .nav-step .dot { width: 4px; height: 4px; border-radius: 50%; background: var(--border); }

        .page { max-width: 680px; margin: 60px auto; padding: 0 24px; }

        /* PENDING HERO */
        .hero { text-align: center; margin-bottom: 40px; }
        .pending-icon {
            width: 80px;
            height: 80px;
            background: #FEF9C3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.3); }
            50%       { box-shadow: 0 0 0 12px rgba(245, 158, 11, 0); }
        }
        .hero h1 { font-size: 28px; font-weight: 700; margin-bottom: 8px; }
        .hero p { font-size: 14px; color: var(--muted); line-height: 1.6; }

        .booking-id {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #FEF9C3;
            border: 1px solid #FDE68A;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 13px;
            color: #854D0E;
            font-weight: 500;
            margin-top: 12px;
        }

        /* WARNING BANNER */
        .banner {
            background: #FFFBEB;
            border: 1px solid #FDE68A;
            border-radius: var(--radius);
            padding: 16px 20px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 16px;
            font-size: 13px;
            color: #92400E;
            line-height: 1.6;
        }
        .banner svg { flex-shrink: 0; margin-top: 1px; }

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
        .price-total .value { font-size: 20px; font-weight: 700; color: var(--warning); }

        .badge-pending {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #FEF9C3;
            color: #854D0E;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-pending .dot { width: 6px; height: 6px; border-radius: 50%; background: currentColor; }

        /* STEPS */
        .steps { display: flex; flex-direction: column; gap: 0; }
        .step {
            display: flex;
            gap: 16px;
            padding-bottom: 20px;
            position: relative;
        }
        .step:last-child { padding-bottom: 0; }
        .step:not(:last-child)::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 32px;
            bottom: 0;
            width: 1px;
            background: var(--border);
        }
        .step-num {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--sand);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            flex-shrink: 0;
        }
        .step-content { padding-top: 4px; }
        .step-content strong { display: block; font-size: 14px; font-weight: 600; margin-bottom: 4px; }
        .step-content span { font-size: 13px; color: var(--muted); line-height: 1.5; }

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
        <span class="active">⏳ 03 Konfirmasi</span>
    </div>
</nav>

<div class="page">

    {{-- HERO --}}
    <div class="hero">
        <div class="pending-icon">
            <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#d97706" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
            </svg>
        </div>
        <h1>Menunggu Pembayaran</h1>
        <p>Booking kamu sudah dibuat, tapi pembayaran belum selesai.<br>Selesaikan pembayaran sebelum waktu habis.</p>
        <div class="booking-id">
            <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/>
                <rect x="9" y="3" width="6" height="4" rx="1"/>
            </svg>
            Booking #{{ $booking->id }}
        </div>
    </div>

    {{-- WARNING BANNER --}}
    <div class="banner">
        <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path d="M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
            <line x1="12" y1="9" x2="12" y2="13"/><line x1="12" y1="17" x2="12.01" y2="17"/>
        </svg>
        <span>Booking akan <strong>otomatis dibatalkan</strong> jika pembayaran tidak diselesaikan dalam 24 jam. Segera selesaikan pembayaran kamu.</span>
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
                    <span class="badge-pending"><span class="dot"></span> Pending</span>
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
            <span class="label">Total Tagihan</span>
            <span class="value">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
        </div>
    </div>

    {{-- CARA BAYAR --}}
    <div class="card">
        <div class="card-title">Cara Menyelesaikan Pembayaran</div>
        <div class="steps">
            <div class="step">
                <div class="step-num">1</div>
                <div class="step-content">
                    <strong>Cek email atau aplikasi kamu</strong>
                    <span>Midtrans sudah mengirim instruksi pembayaran ke email yang kamu daftarkan.</span>
                </div>
            </div>
            <div class="step">
                <div class="step-num">2</div>
                <div class="step-content">
                    <strong>Selesaikan pembayaran</strong>
                    <span>Ikuti instruksi sesuai metode yang kamu pilih (transfer bank, QRIS, e-wallet, dll).</span>
                </div>
            </div>
            <div class="step">
                <div class="step-num">3</div>
                <div class="step-content">
                    <strong>Status otomatis terupdate</strong>
                    <span>Setelah pembayaran diterima, status booking kamu akan berubah menjadi <strong>Paid</strong> secara otomatis.</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ACTIONS --}}
    <div class="actions">
        <a href="/" class="btn btn-outline">Kembali ke Beranda</a>
        <a href="{{ route('payment.show', $booking->id) }}" class="btn btn-primary">Bayar Sekarang</a>
    </div>

</div>
</body>
</html>