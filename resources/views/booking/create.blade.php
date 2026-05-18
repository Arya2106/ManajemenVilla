<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Villa – {{ $villa->nama }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            --radius:  8px;
        }

        

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--dark);
            min-height: 100vh;
        }

        /* NAV */
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
            font-family: 'Poppins', sans-serif;
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
        .nav-step .dot { width: 4px; height: 4px; border-radius: 50%; background: var(--border); }

        /* LAYOUT */
        .page {
            max-width: 1100px;
            margin: 0 auto;
            padding: 48px 24px;
            display: grid;
            grid-template-columns: 1fr 420px;
            gap: 40px;
            align-items: start;
        }

        /* SECTION TITLE */
        .section-label {
            font-size: 11px;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 20px;
            font-weight: 500;
        }
        h1 {
            font-family: 'Poppins', sans-serif;
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

        /* FORM */
        .form-section {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 32px;
            margin-bottom: 24px;
        }
        .form-section h2 {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 20px; }
        .form-group:last-child { margin-bottom: 0; }

        label {
            display: block;
            font-size: 12px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 8px;
            font-weight: 500;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            background: var(--cream);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            color: var(--dark);
            transition: border-color 0.2s, background 0.2s;
            outline: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--brown);
            background: var(--white);
        }
        textarea { resize: vertical; min-height: 88px; }

        /* STAY DURATION BADGE */
        .duration-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--sand);
            border: 1px solid var(--border);
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 13px;
            color: var(--brown);
            margin-top: 12px;
            font-weight: 500;
        }

        /* SIDEBAR */
        .sidebar { position: sticky; top: 88px; }

        .villa-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }
        .villa-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            background: var(--sand);
        }
        .villa-img-placeholder {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, var(--sand) 0%, var(--border) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .villa-info { padding: 24px; }
        .villa-name {
            font-family: 'Poppins', sans-serif;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .villa-meta {
            display: flex;
            gap: 16px;
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 16px;
        }
        .villa-meta span { display: flex; align-items: center; gap: 4px; }

        /* PRICE BREAKDOWN */
        .price-card {
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 20px;
        }
        .price-card h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
        }
        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            font-size: 14px;
            border-bottom: 1px solid var(--border);
        }
        .price-row:last-of-type { border-bottom: none; }
        .price-row .label { color: var(--muted); }
        .price-row .value { font-weight: 500; }

        .price-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0 0;
            margin-top: 8px;
            border-top: 2px solid var(--dark);
        }
        .price-total .label {
            font-size: 13px;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            font-weight: 500;
        }
        .price-total .value {
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
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

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 12px;
            color: var(--muted);
        }
        .secure-note svg { width: 12px; height: 12px; }

        /* ALERT */
        .alert-error {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            border-radius: var(--radius);
            padding: 12px 16px;
            font-size: 13px;
            color: #B91C1C;
            margin-bottom: 20px;
        }
        .alert-success {
            background: #F0FDF4;
            border: 1px solid #BBF7D0;
            border-radius: var(--radius);
            padding: 12px 16px;
            font-size: 13px;
            color: var(--success);
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .page { grid-template-columns: 1fr; }
            .sidebar { position: static; }
            .form-row { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<nav>
    <a href="/" class="nav-logo">Villa Oking</a>
    <div class="nav-step">
        <span class="active">01 Detail</span>
        <div class="dot"></div>
        <span>02 Pembayaran</span>
        <div class="dot"></div>
        <span>03 Konfirmasi</span>
    </div>
</nav>

<div class="page">

    {{-- KIRI: FORM --}}
    <div>
        <p class="section-label">Reservasi Villa</p>
        <h1>Lengkapi Data<br>Pemesanan</h1>
        <p class="sub">Isi data dengan benar, konfirmasi akan dikirim via email.</p>

        {{-- Error --}}
        @if ($errors->any())
        <div class="alert-error">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin-top:6px;padding-left:16px">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('booking.store') }}" method="POST" id="booking-form">
            @csrf

            {{-- DATA TAMU --}}
            <div class="form-section">
                <h2>Data Tamu</h2>

                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama"
                           value="{{ old('nama', auth()->user()->nama ?? '') }}"
                           placeholder="Nama sesuai KTP" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Nomor Telepon</label>
                        <input type="text" name="nomor_telpon"
                               value="{{ old('nomor_telpon') }}"
                               placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="form-group">
                        <label>Nomor KTP</label>
                      <input type="text"
       name="nomor_ktp"
       value="{{ old('nomor_ktp') }}"
       placeholder="16 digit NIK"
       required
       maxlength="16"
       minlength="16"
       pattern="[0-9]{16}"
       inputmode="numeric"
       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    </div>
                    <input type="hidden" value="-" name="foto_ktp" id="foto_ktp">
                </div>
            </div>

            {{-- DETAIL MENGINAP --}}
            <div class="form-section">
                <h2>Detail Menginap</h2>

                <div class="form-row">
                    <div class="form-group">
                        <label>Check-in</label>
                        <input type="date" name="tanggal_checkin"
                               id="checkin"
                               value="{{ old('tanggal_checkin') }}"
                               min="{{ date('Y-m-d') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Check-out</label>
                        <input type="date" name="tanggal_checkout"
                               id="checkout"
                               value="{{ old('tanggal_checkout') }}"
                               min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>
                </div>

                <div id="duration-info" style="display:none">
                    <div class="duration-badge">
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                        </svg>
                        <span id="duration-text">0 malam</span>
                    </div>
                </div>

                <div class="form-group" style="margin-top:20px">
                    <label>Jumlah Tamu</label>
                    <select name="jumlah_tamu" required>
                        @for($i = 1; $i <= $villa->kapasitas; $i++)
                            <option value="{{ $i }}" {{ old('jumlah_tamu') == $i ? 'selected' : '' }}>
                                {{ $i }} orang
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="form-group">
                    <label>Catatan Khusus <span style="color:var(--muted);text-transform:none;font-size:11px">(opsional)</span></label>
                    <textarea name="catatan" placeholder="Permintaan khusus, jam kedatangan, dll...">{{ old('catatan') }}</textarea>
                </div>

                <input type="hidden" name="villa_id" value="{{ $villa->id }}">
            </div>

        </form>
    </div>

    {{-- KANAN: SIDEBAR --}}
    <div class="sidebar">

        {{-- Villa Card --}}
        <div class="villa-card">
            @if($villa->villa_photos->first())
                <img class="villa-img"
                     src="{{ asset('storage/' . $villa->villa_photos->first()->foto) }}"
                     alt="{{ $villa->nama }}">
            @else
                <div class="villa-img-placeholder">
                    <svg width="40" height="40" fill="none" viewBox="0 0 24 24" stroke="#C4B8AC" stroke-width="1">
                        <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                    </svg>
                </div>
            @endif
            <div class="villa-info">
                <div class="villa-name">{{ $villa->nama }}</div>
                <div class="villa-meta">
                    <span>
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        </svg>
                        Maks {{ $villa->kapasitas }} orang
                    </span>
                    <span>
                        <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                        Per malam
                    </span>
                </div>
                @if($villa->keterangan)
                    <p style="font-size:13px;color:var(--muted);line-height:1.6">{{ $villa->keterangan }}</p>
                @endif
            </div>
        </div>

        {{-- Price Breakdown --}}
        <div class="price-card">
            <h3>Rincian Biaya</h3>

            <div class="price-row">
                <span class="label">Harga per malam</span>
                <span class="value">Rp {{ number_format($villa->harga_permalam, 0, ',', '.') }}</span>
            </div>
            <div class="price-row">
                <span class="label">Durasi menginap</span>
                <span class="value" id="sidebar-nights">— malam</span>
            </div>
            <div class="price-row">
                <span class="label">Subtotal</span>
                <span class="value" id="sidebar-subtotal">—</span>
            </div>
            <div class="price-row">
                <span class="label">Biaya layanan</span>
                <span class="value">Rp 0</span>
            </div>

            <div class="price-total">
                <span class="label">Total</span>
                <span class="value" id="sidebar-total">—</span>
            </div>
        </div>

        <button class="btn-pay" onclick="document.getElementById('booking-form').submit()">
            Lanjutkan ke Pembayaran
        </button>

        <p class="secure-note">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
            </svg>
            Transaksi aman &amp; terenkripsi
        </p>

    </div>
</div>

<!-- <script>
    const hargaPermalam = {{ $villa->harga_permalam }};

    function formatRupiah(n) {
        return 'Rp ' + n.toLocaleString('id-ID');
    }

    function hitungMalam() {
        const checkin  = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;

        if (!checkin || !checkout) return;

        const d1 = new Date(checkin);
        const d2 = new Date(checkout);
        const malam = Math.round((d2 - d1) / (1000 * 60 * 60 * 24));

        if (malam <= 0) {
            document.getElementById('checkout').setCustomValidity('Checkout harus setelah check-in.');
            return;
        }

        document.getElementById('checkout').setCustomValidity('');

        const subtotal = malam * hargaPermalam;

        document.getElementById('duration-info').style.display = 'block';
        document.getElementById('duration-text').textContent   = malam + ' malam';
        document.getElementById('sidebar-nights').textContent  = malam + ' malam';
        document.getElementById('sidebar-subtotal').textContent = formatRupiah(subtotal);
        document.getElementById('sidebar-total').textContent   = formatRupiah(subtotal);
    }

    document.getElementById('checkin').addEventListener('change', function() {
        const nextDay = new Date(this.value);
        nextDay.setDate(nextDay.getDate() + 1);
        document.getElementById('checkout').min = nextDay.toISOString().split('T')[0];
        hitungMalam();
    });

    document.getElementById('checkout').addEventListener('change', hitungMalam);
</script> -->

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
    /* Tanggal masa lalu — abu-abu default */
    .flatpickr-day.flatpickr-disabled,
    .flatpickr-day.flatpickr-disabled:hover {
        background: transparent !important;
        color: #cbd5e1 !important;
        border-color: transparent !important;
        opacity: 1 !important;
        cursor: not-allowed !important;
        border-radius: 5px !important; /* ← kotak */
    }

    /* Tanggal yang sudah dibooking — oranye */
    .flatpickr-day.booked,
    .flatpickr-day.booked:hover {
        background: #FED7AA !important;
        color: #C2410C !important;
        border-color: #FDBA74 !important;
        opacity: 1 !important;
        cursor: not-allowed !important;
        border-radius: 5px !important; /* ← kotak */
    }
</style>


<script>
    const hargaPermalam = {{ $villa->harga_permalam }};
    const bookedRanges  = @json($bookedDates);

    // Generate semua tanggal yang diblok
    function getDisabledDates() {
        const dates = [];
        bookedRanges.forEach(range => {
            let current = new Date(range.checkin);
            const end   = new Date(range.checkout);
            while (current < end) {
                dates.push(current.toISOString().split('T')[0]);
                current.setDate(current.getDate() + 1);
            }
        });
        return dates;
    }

    const disabledDates = getDisabledDates();

  const checkinPicker = flatpickr('#checkin', {
    minDate: 'today',
    dateFormat: 'Y-m-d',
    disable: disabledDates,
    onDayCreate: function(dObj, dStr, fp, dayElem) {
        const dateStr = dayElem.dateObj.toISOString().split('T')[0];
        if (disabledDates.includes(dateStr)) {
            dayElem.classList.add('booked');
        }
    },
    onChange: function(selectedDates, dateStr) {
        checkoutPicker.set('minDate', new Date(dateStr).fp_incr(1));
        checkoutPicker.clear();
        hitungMalam();
    }
});

const checkoutPicker = flatpickr('#checkout', {
    minDate: new Date().fp_incr(1),
    dateFormat: 'Y-m-d',
    disable: disabledDates,
    onDayCreate: function(dObj, dStr, fp, dayElem) {
        const dateStr = dayElem.dateObj.toISOString().split('T')[0];
        if (disabledDates.includes(dateStr)) {
            dayElem.classList.add('booked');
        }
    },
    onChange: function() {
        hitungMalam();
    }
});


    function formatRupiah(n) {
        return 'Rp ' + n.toLocaleString('id-ID');
    }

    function hitungMalam() {
        const checkin  = document.getElementById('checkin').value;
        const checkout = document.getElementById('checkout').value;
        if (!checkin || !checkout) return;

        const d1    = new Date(checkin);
        const d2    = new Date(checkout);
        const malam = Math.round((d2 - d1) / (1000 * 60 * 60 * 24));
        if (malam <= 0) return;

        const subtotal = malam * hargaPermalam;

        document.getElementById('duration-info').style.display  = 'block';
        document.getElementById('duration-text').textContent    = malam + ' malam';
        document.getElementById('sidebar-nights').textContent   = malam + ' malam';
        document.getElementById('sidebar-subtotal').textContent = formatRupiah(subtotal);
        document.getElementById('sidebar-total').textContent    = formatRupiah(subtotal);
    }
</script>

</body>
</html>