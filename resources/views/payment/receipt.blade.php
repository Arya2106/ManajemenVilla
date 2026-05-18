<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kwitansi Pembayaran - Booking #{{ $booking->id }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --cream: #f5efe6;
            --sand:  #e8d9c5;
            --brown: #8b6443;
            --dark:  #1e1510;
            --gold:  #c9a96e;
            --green: #3d5a3e;
            --white: #fdfaf6;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            background: var(--sand);
            color: var(--dark);
            min-height: 100vh;
            padding: 48px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ── Outer Frame ── */
        .receipt-wrapper {
            width: 100%;
            max-width: 740px;
            background: var(--white);
            border: 1px solid var(--sand);
            position: relative;
        }

        /* Decorative inner border */
        .receipt-wrapper::before {
            content: '';
            position: absolute;
            top: 12px; left: 12px; right: 12px; bottom: 12px;
            border: 0.5px solid var(--gold);
            pointer-events: none;
            z-index: 0;
        }
        .receipt-wrapper::after {
            content: '';
            position: absolute;
            top: 15px; left: 15px; right: 15px; bottom: 15px;
            border: 0.5px solid var(--sand);
            pointer-events: none;
            z-index: 0;
        }

        /* ── Header Band ── */
        .header {
            background: var(--dark);
            padding: 36px 48px 28px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            position: relative;
            z-index: 1;
        }

        .logo-block .wordmark {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--white);
            letter-spacing: 0.04em;
            line-height: 1;
        }

        .logo-block .sub {
            margin-top: 5px;
            font-size: 10px;
            font-weight: 400;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--gold);
        }

        .doc-meta { text-align: right; }

        .doc-meta .doc-title {
            font-size: 10px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 6px;
        }

        .doc-meta .booking-id {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            color: var(--cream);
            font-weight: 600;
        }

        .doc-meta .doc-date {
            margin-top: 4px;
            font-size: 11px;
            color: var(--brown);
        }

        /* Gold rule under header */
        .gold-rule {
            height: 3px;
            background: linear-gradient(90deg, var(--brown) 0%, var(--gold) 40%, var(--gold) 60%, var(--brown) 100%);
            position: relative;
            z-index: 1;
        }

        /* ── Body ── */
        .body {
            padding: 36px 48px 40px;
            position: relative;
            z-index: 1;
        }

        /* Address row */
        .address-row {
            display: flex;
            justify-content: space-between;
            gap: 32px;
            padding-bottom: 28px;
            border-bottom: 0.5px solid var(--sand);
        }

        .address-block .block-label {
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--brown);
            margin-bottom: 8px;
        }

        .address-block p {
            font-size: 12.5px;
            line-height: 1.75;
            color: var(--dark);
        }

        .address-block strong {
            font-weight: 600;
            display: block;
            font-size: 13.5px;
            margin-bottom: 1px;
            color: var(--dark);
        }

        /* Status row */
        .status-row {
            margin-top: 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding-bottom: 24px;
            border-bottom: 0.5px solid var(--sand);
        }

        .status-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .status-group .s-label {
            font-size: 9px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--brown);
        }

        .badge-lunas {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 5px 14px;
            border: 1px solid var(--green);
            background: #eef3ee;
            color: var(--green);
            font-size: 10.5px;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .badge-lunas::before {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--green);
            flex-shrink: 0;
        }

        .method-group { text-align: right; }

        .method-group .s-label {
            font-size: 9px;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--brown);
            margin-bottom: 5px;
        }

        .method-group .method-val {
            font-size: 13px;
            font-weight: 500;
            color: var(--dark);
        }

        /* ── Line-items ── */
        .items-section { margin-top: 28px; }

        .items-header {
            display: grid;
            grid-template-columns: 1fr auto;
            padding: 8px 0;
            border-bottom: 1.5px solid var(--dark);
            margin-bottom: 2px;
        }

        .items-header span {
            font-size: 9px;
            font-weight: 600;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--dark);
        }

        .items-header span:last-child { text-align: right; }

        .line-item {
            display: grid;
            grid-template-columns: 1fr auto;
            align-items: start;
            padding: 14px 0;
            border-bottom: 0.5px solid var(--sand);
            gap: 16px;
        }

        .line-item:last-child { border-bottom: none; }

        .item-desc .item-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 4px;
        }

        .item-desc .item-meta {
            font-size: 11.5px;
            color: var(--brown);
            line-height: 1.7;
        }

        .item-price {
            font-size: 13px;
            font-weight: 500;
            color: var(--dark);
            white-space: nowrap;
            text-align: right;
            padding-top: 1px;
        }

        /* ── Total strip ── */
        .total-strip {
            margin-top: 20px;
            background: var(--dark);
            padding: 18px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .total-strip .total-label {
            font-size: 10px;
            letter-spacing: 0.22em;
            text-transform: uppercase;
            color: var(--brown);
        }

        .total-strip .total-amount {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            font-weight: 600;
            color: var(--gold);
            letter-spacing: 0.02em;
        }

        /* ── Footer ── */
        .footer {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 0.5px solid var(--sand);
            text-align: center;
        }

        .footer p {
            font-size: 11px;
            color: var(--brown);
            line-height: 1.7;
        }

        .footer .villa-sig {
            margin-top: 12px;
            font-family: 'Playfair Display', serif;
            font-size: 14px;
            color: var(--dark);
            letter-spacing: 0.06em;
        }

        .footer .gold-ornament {
            color: var(--gold);
            margin: 0 8px;
        }

        /* ── Print button ── */
        .print-bar {
            margin-top: 24px;
            display: flex;
            gap: 12px;
        }

        .btn {
            padding: 10px 28px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            border: none;
            transition: opacity .15s;
        }

        .btn:hover { opacity: 0.85; }

        .btn-primary {
            background: var(--dark);
            color: var(--cream);
        }

        /* ── Print styles ── */
        @media print {
            body { background: white; padding: 0; }
            .receipt-wrapper { box-shadow: none; border: 1px solid var(--sand); }
            .print-bar { display: none; }
            .gold-rule,
            .header,
            .total-strip {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }

        @media (max-width: 600px) {
            body { padding: 24px 12px; }
            .header, .body { padding-left: 28px; padding-right: 28px; }
            .address-row { flex-direction: column; gap: 20px; }
            .address-row .address-block:last-child { border-top: 0.5px solid var(--sand); padding-top: 20px; }
        }
    </style>
</head>
<body>

    <div class="receipt-wrapper">

        <!-- Header -->
        <div class="header">
            <div class="logo-block">
                <div class="wordmark">Villa Oking</div>
                <div class="sub">Puncak Gadog &mdash; Bogor</div>
            </div>
            <div class="doc-meta">
                <div class="doc-title">Kwitansi Pembayaran</div>
                <div class="booking-id">BK-{{ $booking->id }}</div>
                <div class="doc-date">Terbit: {{ now()->translatedFormat('d F Y') }}</div>
            </div>
        </div>

        <div class="gold-rule"></div>

        <!-- Body -->
        <div class="body">

            <!-- Addresses -->
            <div class="address-row">
                <div class="address-block">
                    <div class="block-label">Dari</div>
                    <p>
                        <strong>Villa Oking</strong>
                        Jl. Raya Puncak Gadog<br>
                        Bogor, Jawa Barat
                    </p>
                </div>
                <div class="address-block" style="text-align:right;">
                    <div class="block-label">Diterima dari</div>
                    <p>
                        <strong>{{ $booking->guest->nama }}</strong>
                        {{ $booking->guest->nomor_telpon }}
                    </p>
                </div>
            </div>

            <!-- Status -->
            <div class="status-row">
                <div class="status-group">
                    <span class="s-label">Status Pembayaran</span>
                    <span class="badge-lunas">Lunas &bull; Paid</span>
                </div>
                <div class="method-group">
                    <div class="s-label">Metode Pembayaran</div>
                    <div class="method-val">
                        @if($booking->payments->isNotEmpty())
                            {{ strtoupper($booking->payments->first()->metode_pembayaran) }}
                        @else
                            Midtrans Payment Gateway
                        @endif
                    </div>
                </div>
            </div>

            <!-- Line items -->
            <div class="items-section">
                <div class="items-header">
                    <span>Rincian Reservasi</span>
                    <span>Harga</span>
                </div>

                <div class="line-item">
                    <div class="item-desc">
                        <div class="item-title">{{ $booking->villa->nama }}</div>
                        <div class="item-meta">
                            Check-in &nbsp;&bull;&nbsp; {{ \Carbon\Carbon::parse($booking->tanggal_checkin)->translatedFormat('d F Y') }}<br>
                            Check-out &nbsp;&bull;&nbsp; {{ \Carbon\Carbon::parse($booking->tanggal_checkout)->translatedFormat('d F Y') }}<br>
                            Durasi: {{ \Carbon\Carbon::parse($booking->tanggal_checkin)->diffInDays($booking->tanggal_checkout) }} Malam
                        </div>
                    </div>
                    <div class="item-price">
                        Rp {{ number_format($booking->villa->harga_permalam, 0, ',', '.') }}<span style="font-weight:400;font-size:11px;color:var(--muted);">/malam</span>
                    </div>
                </div>

                <div class="line-item">
                    <div class="item-desc">
                        <div class="item-title">Jumlah Tamu</div>
                    </div>
                    <div class="item-price">{{ $booking->jumlah_tamu }} Orang</div>
                </div>
            </div>

            <!-- Total -->
            <div class="total-strip">
                <span class="total-label">Total Pembayaran</span>
                <span class="total-amount">Rp {{ number_format($booking->total_harga, 0, ',', '.') }}</span>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>Dokumen ini merupakan bukti pembayaran yang sah atas reservasi Anda.<br>Simpan kwitansi ini sebagai referensi selama masa menginap.</p>
                <div class="villa-sig">
                    <span class="gold-ornament">&#10022;</span>
                    Terima kasih telah memilih Villa Oking
                    <span class="gold-ornament">&#10022;</span>
                </div>
            </div>

        </div><!-- /body -->
    </div><!-- /receipt-wrapper -->

    <div class="print-bar">
        <button class="btn btn-primary" onclick="window.print()">Cetak Dokumen</button>
    </div>

    <script>
        window.onload = function () {
            setTimeout(function () { window.print(); }, 600);
        };
    </script>

</body>
</html>