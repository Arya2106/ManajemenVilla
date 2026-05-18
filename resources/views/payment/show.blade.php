<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran – Booking #{{ $booking->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream:   #f8fafc;
            --sand:    #e2e8f0;
            --brown:   #2563eb;
            --dark:    #0f172a;
            --muted:   #64748b;
            --accent:  #3b82f6;
            --white:   #FFFFFF;
            --border:  #cbd5e1;
            --success: #10b981;
            --danger:  #ef4444;
            --radius:  8px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--dark);
            min-height: 100vh;
        }

        nav {
            background: var(--white);
            border-bottom: 1px solid var(--border);
            padding: 0 40px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .nav-logo {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 0.05em;
            color: var(--dark);
            text-decoration: none;
        }
        .nav-step {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--muted);
        }
        .nav-step span.active { color: var(--dark); font-weight: 500; }
        .nav-step span.done   { color: var(--success); font-weight: 500; }
        .nav-step .dot { width: 4px; height: 4px; border-radius: 50%; background: var(--border); }

        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 48px 24px;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 40px;
            align-items: start;
        }

        .section-label {
            font-size: 11px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 20px;
            font-weight: 500;
        }
        h1 {
            font-size: 32px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 8px;
        }
        .sub {
            font-size: 14px;
            color: var(--muted);
            margin-bottom: 40px;
        }

        /* CARDS */
        .card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 28px 32px;
            margin-bottom: 20px;
        }
        .card h2 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card h2 .icon {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* INFO ROWS */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .info-item {}
        .info-item .info-label {
            font-size: 11px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 4px;
            font-weight: 500;
        }
        .info-item .info-value {
            font-size: 14px;
            font-weight: 500;
            color: var(--dark);
        }

        /* STATUS BADGE */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .badge-pending {
            background: #FEF9C3;
            color: #854D0E;
        }
        .badge-paid {
            background: #DCFCE7;
            color: #166534;
        }
        .badge-cancelled {
            background: #FEE2E2;
            color: #991B1B;
        }
        .badge .dot-badge {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        /* DIVIDER */
        .divider {
            height: 1px;
            background: var(--border);
            margin: 20px 0;
        }

        /* SIDEBAR */
        .sidebar { position: sticky; top: 88px; }

        .villa-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            margin-bottom: 20px;
        }
        .villa-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
        }
        .villa-img-placeholder {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, var(--sand) 0%, var(--border) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .villa-info { padding: 20px; }
        .villa-name {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 6px;
        }
        .villa-meta {
            display: flex;
            gap: 16px;
            font-size: 13px;
            color: var(--muted);
        }

        /* PRICE CARD */
        .price-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            margin-bottom: 20px;
        }
        .price-card h3 {
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 18px;
        }
        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 9px 0;
            font-size: 13px;
            border-bottom: 1px solid var(--border);
        }
        .price-row:last-of-type { border-bottom: none; }
        .price-row .label { color: var(--muted); }
        .price-row .value { font-weight: 500; }
        .price-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0 0;
            margin-top: 6px;
            border-top: 2px solid var(--dark);
        }
        .price-total .label {
            font-size: 12px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 500;
        }
        .price-total .value {
            font-size: 22px;
            font-weight: 700;
            color: var(--brown);
        }

        /* BUTTON */
        .btn-pay {
            width: 100%;
            padding: 16px;
            background: var(--dark);
            color: var(--white);
            border: none;
            border-radius: var(--radius);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-bottom: 12px;
        }
        .btn-pay:hover { background: var(--brown); }
        .btn-pay:active { transform: scale(0.99); }
        .btn-pay:disabled {
            background: var(--muted);
            cursor: not-allowed;
        }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 12px;
            color: var(--muted);
        }

        /* PAYMENT METHODS HINT */
        .payment-methods {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 16px;
            justify-content: center;
        }
        .pay-method {
            font-size: 11px;
            color: var(--muted);
            background: var(--sand);
            border-radius: 4px;
            padding: 3px 8px;
            font-weight: 500;
        }

        /* LOADING STATE */
        .loading-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.5);
            z-index: 999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 16px;
            color: var(--white);
            font-size: 14px;
        }
        .loading-overlay.active { display: flex; }
        .spinner {
            width: 36px;
            height: 36px;
            border: 3px solid rgba(255,255,255,0.3);
            border-top-color: var(--white);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        @media (max-width: 768px) {
            .page { grid-template-columns: 1fr; }
            .sidebar { position: static; }
            .info-grid { grid-template-columns: 1fr; }
            nav { padding: 0 16px; }
        }
    </style>
</head>
<body>

{{-- LOADING OVERLAY --}}
<div class="loading-overlay" id="loading">
    <div class="spinner"></div>
    <span>Membuka halaman pembayaran...</span>
</div>

<nav>
    <a href="/" class="nav-logo">Villa App</a>
    <div class="nav-step">
        <span class="done">✓ 01 Detail</span>
        <div class="dot"></div>
        <span class="active">02 Pembayaran</span>
        <div class="dot"></div>
        <span>03 Konfirmasi</span>
    </div>
</nav>

<div class="page">

    {{-- KIRI --}}
    <div>
        <p class="section-label">Langkah 2 dari 3</p>
        <h1>Selesaikan<br>Pembayaran</h1>
        <p class="sub">Periksa ringkasan booking kamu sebelum melanjutkan pembayaran.</p>

        {{-- Data Tamu --}}
        <div class="card">
            <h2>
                <span class="icon" style="background:#EFF6FF">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#2563eb" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                </span>
                Data Tamu
            </h2>
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
                    <div class="info-label">Nomor KTP</div>
                    <div class="info-value">{{ $booking->guest->nomor_ktp }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Status Booking</div>
                    <div class="info-value">
                        <span class="badge badge-{{ $booking->status }}">
                            <span class="dot-badge"></span>
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Detail Menginap --}}
        <div class="card">
            <h2>
                <span class="icon" style="background:#F0FDF4">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#16a34a" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                </span>
                Detail Menginap
            </h2>
            <div class="info-grid">
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
                <div class="info-item">
                    <div class="info-label">Jumlah Tamu</div>
                    <div class="info-value">{{ $booking->jumlah_tamu }} orang</div>
                </div>
                @if($booking->catatan)
                <div class="info-item" style="grid-column: 1 / -1">
                    <div class="info-label">Catatan</div>
                    <div class="info-value" style="font-weight:400;color:var(--muted)">{{ $booking->catatan }}</div>
                </div>
                @endif
            </div>
        </div>

        {{-- Info Midtrans --}}
        <div style="display:flex;align-items:flex-start;gap:12px;padding:16px;background:#EFF6FF;border:1px solid #BFDBFE;border-radius:var(--radius);font-size:13px;color:#1e40af">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <span>Pembayaran diproses melalui <strong>Midtrans</strong> — mendukung transfer bank, QRIS, GoPay, OVO, kartu kredit, dan lainnya.</span>
        </div>
    </div>

    {{-- KANAN: SIDEBAR --}}
    <div class="sidebar">

        {{-- Villa Card --}}
        <div class="villa-card">
            @if($booking->villa->villa_photos && $booking->villa->villa_photos->first())
                <img class="villa-img"
                     src="{{ asset('storage/' . $booking->villa->villa_photos->first()->foto) }}"
                     alt="{{ $booking->villa->nama }}">
            @else
                <div class="villa-img-placeholder">
                    <svg width="36" height="36" fill="none" viewBox="0 0 24 24" stroke="#94a3b8" stroke-width="1.5">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
            @endif
            <div class="villa-info">
                <div class="villa-name">{{ $booking->villa->nama }}</div>
                <div class="villa-meta">
                    <span>Maks {{ $booking->villa->kapasitas }} orang</span>
                    <span>·</span>
                    <span>Rp {{ number_format($booking->villa->harga_permalam, 0, ',', '.') }}/malam</span>
                </div>
            </div>
        </div>

        {{-- Price Breakdown --}}
        <div class="price-card">
            <h3>Rincian Biaya</h3>

            @php
                $malam = \Carbon\Carbon::parse($booking->tanggal_checkin)->diffInDays($booking->tanggal_checkout);
            @endphp

            <div class="price-row">
                <span class="label">Harga per malam</span>
                <span class="value">Rp {{ number_format($booking->villa->harga_permalam, 0, ',', '.') }}</span>
            </div>
            <div class="price-row">
                <span class="label">Durasi menginap</span>
                <span class="value">{{ $malam }} malam</span>
            </div>
            <div class="price-row">
                <span class="label">Subtotal</span>
                <span class="value">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
            </div>
            <div class="price-row">
                <span class="label">Biaya layanan</span>
                <span class="value">Rp 0</span>
            </div>

            <div class="price-total">
                <span class="label">Total</span>
                <span class="value">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- PAY BUTTON --}}
        <button class="btn-pay" id="pay-button">
            Bayar Sekarang
        </button>

        <p class="secure-note">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="12" height="12">
                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
            </svg>
            Transaksi aman &amp; terenkripsi
        </p>

        <div class="payment-methods">
            <span class="pay-method">Transfer Bank</span>
            <span class="pay-method">QRIS</span>
            <span class="pay-method">GoPay</span>
            <span class="pay-method">OVO</span>
            <span class="pay-method">Kartu Kredit</span>
        </div>

    </div>
</div>

{{-- Midtrans Snap.js --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.client_key') }}"></script>

<script>
    document.getElementById('pay-button').onclick = function () {
        document.getElementById('loading').classList.add('active');

        snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                document.getElementById('loading').classList.remove('active');
                window.location.href = '/booking/success?order_id=' + result.order_id;
            },
            onPending: function (result) {
                document.getElementById('loading').classList.remove('active');
                window.location.href = '/booking/pending?order_id=' + result.order_id;
            },
            onError: function (result) {
                document.getElementById('loading').classList.remove('active');
                alert('Pembayaran gagal. Silakan coba lagi.');
                console.error('Payment error:', result);
            },
            onClose: function () {
                document.getElementById('loading').classList.remove('active');
                // tidak redirect, biarkan user di halaman payment
            }
        });


    };

   
</script>

</body>
</html>