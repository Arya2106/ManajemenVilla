<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $villa->nama }} - Villa Oking</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --cream: #f5efe6;
            --sand: #e8d9c5;
            --brown: #8b6443;
            --dark: #1e1510;
            --gold: #c9a96e;
            --green: #3d5a3e;
            --white: #fdfaf6;
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Poppins', sans-serif; background: var(--cream); color: var(--dark); overflow-x: hidden; }

        /* NAV */
        nav {
            position: fixed; top: 0; left: 0; right: 0; z-index: 100;
            display: flex; align-items: center; justify-content: space-between;
            padding: 1.8rem 4rem;
            transition: all 0.4s ease;
        }
        nav.scrolled {
            background: rgba(245,239,230,0.95);
            backdrop-filter: blur(12px);
            padding: 1.2rem 4rem;
            box-shadow: 0 1px 0 rgba(139,100,67,0.15);
        }
        .nav-logo {
            font-family: 'Poppins', sans-serif;
            font-size: 1.6rem; font-weight: 700;
            letter-spacing: 0.08em;
            color: var(--white); text-decoration: none;
            transition: color 0.4s;
        }
        nav.scrolled .nav-logo { color: var(--dark); }
        .nav-links { display: flex; gap: 2.5rem; list-style: none; }
        .nav-links a {
            font-size: 0.72rem; letter-spacing: 0.2em; text-transform: uppercase;
            color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.3s;
        }
        nav.scrolled .nav-links a { color: var(--dark); }
        .nav-links a:hover { color: var(--gold); }
        .nav-cta {
            padding: 0.65rem 1.8rem;
            border: 1px solid rgba(255,255,255,0.6);
            color: white; text-decoration: none;
            font-size: 0.72rem; letter-spacing: 0.18em; text-transform: uppercase;
            transition: all 0.3s;
        }
        nav.scrolled .nav-cta { border-color: var(--brown); color: var(--brown); }
        .nav-cta:hover { background: var(--gold); border-color: var(--gold); color: var(--dark) !important; }

        /* HERO */
        #hero {
            height: 100vh;
            position: relative;
            display: flex; align-items: flex-end;
            padding: 0 4rem 5rem;
            overflow: hidden;
        }
        .hero-bg {
            position: absolute; inset: 0;
            background-color: var(--dark);
        }
        .hero-bg img {
            width: 100%; height: 100%;
            object-fit: cover;
            opacity: 0.65;
        }
        .hero-bg-fallback {
            width: 100%; height: 100%;
            background: linear-gradient(160deg, #2d4a2e, #3d5a3e 40%, #8b6443 80%, #1e1510);
        }
        .hero-overlay {
            position: absolute; inset: 0;
            background: linear-gradient(to top, rgba(30,21,16,0.85) 0%, transparent 60%);
        }
        .hero-content {
            position: relative; z-index: 2;
            animation: fadeUp 1.2s cubic-bezier(0.16,1,0.3,1) both;
        }
        .hero-tag {
            font-size: 0.68rem; letter-spacing: 0.3em; text-transform: uppercase;
            color: var(--gold); margin-bottom: 1.2rem;
            display: flex; align-items: center; gap: 1rem;
        }
        .hero-tag::before { content: ''; width: 40px; height: 1px; background: var(--gold); }
        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700; line-height: 1.1;
            color: var(--white); margin-bottom: 1rem;
        }
        .hero-title em { font-style: italic; color: var(--gold); }
        .hero-meta {
            display: flex; gap: 2rem; margin-bottom: 2rem; flex-wrap: wrap;
        }
        .hero-meta-item {
            color: rgba(255,255,255,0.6);
            font-size: 0.78rem; letter-spacing: 0.1em;
            display: flex; align-items: center; gap: 0.5rem;
        }
        .hero-meta-item strong { color: var(--gold); }
        .hero-btns { display: flex; gap: 1.2rem; flex-wrap: wrap; }
        .btn-primary {
            padding: 1rem 2.5rem; background: var(--gold); color: var(--dark);
            text-decoration: none; font-size: 0.72rem;
            letter-spacing: 0.2em; text-transform: uppercase; font-weight: 500;
            transition: all 0.3s;
        }
        .btn-primary:hover { background: var(--brown); color: white; }
        .btn-outline {
            padding: 1rem 2.5rem; border: 1px solid rgba(255,255,255,0.4);
            color: white; text-decoration: none; font-size: 0.72rem;
            letter-spacing: 0.2em; text-transform: uppercase; font-weight: 300;
            transition: all 0.3s;
        }
        .btn-outline:hover { border-color: var(--gold); color: var(--gold); }

        /* STRIP */
        .strip {
            background: var(--green); padding: 1.2rem 4rem;
            display: flex; justify-content: center; gap: 4rem; flex-wrap: wrap;
        }
        .strip-item {
            color: rgba(255,255,255,0.75); font-size: 0.72rem;
            letter-spacing: 0.18em; text-transform: uppercase;
            display: flex; align-items: center; gap: 0.6rem;
        }
        .strip-item span { color: var(--gold); }

        /* SECTION HEADER */
        .section-header { text-align: center; margin-bottom: 3.5rem; }
        .section-tag {
            font-size: 0.65rem; letter-spacing: 0.3em; text-transform: uppercase;
            color: var(--brown); display: flex; align-items: center;
            justify-content: center; gap: 1rem; margin-bottom: 1rem;
        }
        .section-tag::before, .section-tag::after { content: ''; width: 30px; height: 1px; background: var(--gold); }
        .section-title {
            font-family: 'Poppins', sans-serif;
            font-size: clamp(2rem, 4vw, 3rem); font-weight: 700; line-height: 1.2;
        }
        .section-title em { font-style: italic; color: var(--brown); }

        /* DETAIL VILLA */
        #detail {
            padding: 7rem 4rem;
            max-width: 1200px; margin: 0 auto;
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 6rem; align-items: start;
        }
        .detail-text .section-tag { justify-content: flex-start; }
        .detail-text .section-tag::before { display: none; }
        .detail-text .section-title { text-align: left; margin-bottom: 1.5rem; }
        .detail-desc {
            color: rgba(30,21,16,0.65); line-height: 1.9;
            font-size: 0.92rem; font-weight: 300; margin-bottom: 2rem;
        }
        .detail-specs {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 1rem; margin-bottom: 2rem;
        }
        .spec-item {
            padding: 1.2rem; border: 1px solid var(--sand);
            display: flex; flex-direction: column; gap: 0.3rem;
        }
        .spec-label {
            font-size: 0.62rem; letter-spacing: 0.2em;
            text-transform: uppercase; color: rgba(30,21,16,0.4);
        }
        .spec-value {
            font-family: 'Poppins', sans-serif;
            font-size: 1.4rem; color: var(--brown); font-weight: 600;
        }
        .price-box {
            background: var(--dark); padding: 2rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .price-label { font-size: 0.65rem; letter-spacing: 0.2em; text-transform: uppercase; color: rgba(255,255,255,0.4); }
        .price-amount {
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem; color: var(--gold); font-weight: 700;
        }
        .price-per { font-size: 0.72rem; color: rgba(255,255,255,0.35); }

        /* STATUS BADGE */
        .status-badge {
            display: inline-block; padding: 0.4rem 1.2rem;
            font-size: 0.62rem; letter-spacing: 0.2em; text-transform: uppercase;
            margin-bottom: 1.5rem;
        }
        .status-available { background: rgba(61,90,62,0.12); color: var(--green); border: 1px solid var(--green); }
        .status-booked    { background: rgba(139,100,67,0.12); color: var(--brown); border: 1px solid var(--brown); }

        /* GALERI */
        #galeri { padding: 0 4rem 7rem; }
        #galeri .section-header { margin-bottom: 2.5rem; }
        .galeri-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: 260px;
            gap: 0.8rem;
            max-width: 1200px; margin: 0 auto;
        }
        .galeri-item {
            overflow: hidden; position: relative; cursor: pointer;
        }
        .galeri-item:first-child {
            grid-column: span 2;
            grid-row: span 2;
        }
        .galeri-item img {
            width: 100%; height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .galeri-item:hover img { transform: scale(1.06); }
        .galeri-item-overlay {
            position: absolute; inset: 0;
            background: rgba(30,21,16,0);
            transition: background 0.3s;
            display: flex; align-items: flex-end; padding: 1.2rem;
        }
        .galeri-item:hover .galeri-item-overlay { background: rgba(30,21,16,0.35); }
        .galeri-item-label {
            color: white; font-size: 0.72rem;
            letter-spacing: 0.15em; text-transform: uppercase;
            opacity: 0; transform: translateY(8px);
            transition: all 0.3s;
        }
        .galeri-item:hover .galeri-item-label { opacity: 1; transform: translateY(0); }
        .galeri-empty {
            grid-column: span 3;
            padding: 4rem; text-align: center;
            border: 1px dashed var(--sand);
            color: rgba(30,21,16,0.35);
        }
        .galeri-empty p { font-size: 0.85rem; letter-spacing: 0.1em; }

        /* LIGHTBOX */
        .lightbox {
            display: none; position: fixed; inset: 0; z-index: 200;
            background: rgba(0,0,0,0.92);
            align-items: center; justify-content: center;
        }
        .lightbox.open { display: flex; }
        .lightbox img { max-width: 90vw; max-height: 85vh; object-fit: contain; }
        .lightbox-close {
            position: absolute; top: 2rem; right: 2rem;
            color: white; font-size: 2rem; cursor: pointer;
            background: none; border: none; opacity: 0.7; transition: opacity 0.2s;
        }
        .lightbox-close:hover { opacity: 1; }
        .lightbox-caption {
            position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%);
            color: rgba(255,255,255,0.6); font-size: 0.75rem;
            letter-spacing: 0.18em; text-transform: uppercase;
        }

        /* LOKASI */
        #lokasi { padding: 0 4rem 7rem; }
        .map-container {
            max-width: 1200px; margin: 0 auto; height: 450px;
            background: var(--sand);
            position: relative; overflow: hidden;
            border: 1px solid rgba(139,100,67,0.2);
        }
        .map-container iframe {
            width: 100%; height: 100%; border: none; filter: grayscale(20%) contrast(1.1);
        }

        /* BOOKING */
        #booking {
            margin: 0 4rem 7rem;
            background: var(--green); padding: 5rem;
            display: grid; grid-template-columns: 1fr auto;
            gap: 3rem; align-items: center;
            position: relative; overflow: hidden;
        }
        #booking::before {
            content: 'BOOK';
            position: absolute; right: -2rem; top: 50%; transform: translateY(-50%);
            font-family: 'Poppins', sans-serif;
            font-size: 10rem; color: rgba(255,255,255,0.04);
            font-weight: 800; pointer-events: none;
        }
        .booking-title {
            font-family: 'Poppins', sans-serif;
            font-size: 2.5rem; color: var(--white); font-weight: 600;
            line-height: 1.2; margin-bottom: 0.8rem;
        }
        .booking-sub { color: rgba(255,255,255,0.6); font-size: 0.85rem; font-weight: 300; letter-spacing: 0.05em; }

        /* FOOTER */
        footer { background: var(--dark); padding: 4rem; display: grid; grid-template-columns: 2fr 1fr 1fr; gap: 3rem; }
        .footer-brand { font-family: 'Poppins', sans-serif; font-size: 2rem; color: var(--white); font-weight: 700; margin-bottom: 1rem; }
        .footer-desc { color: rgba(255,255,255,0.4); font-size: 0.8rem; line-height: 1.8; max-width: 280px; font-weight: 300; }
        .footer-title { font-size: 0.65rem; letter-spacing: 0.25em; text-transform: uppercase; color: var(--gold); margin-bottom: 1.5rem; }
        .footer-links { list-style: none; }
        .footer-links li { margin-bottom: 0.8rem; }
        .footer-links a { color: rgba(255,255,255,0.45); text-decoration: none; font-size: 0.82rem; font-weight: 300; transition: color 0.3s; }
        .footer-links a:hover { color: var(--gold); }
        .footer-bottom {
            background: var(--dark); border-top: 1px solid rgba(255,255,255,0.06);
            padding: 1.5rem 4rem; display: flex; justify-content: space-between; align-items: center;
        }
        .footer-copy { color: rgba(255,255,255,0.25); font-size: 0.7rem; letter-spacing: 0.12em; }

        /* ANIMATIONS */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(40px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .reveal { opacity: 0; transform: translateY(30px); transition: opacity 0.8s ease, transform 0.8s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        @media (max-width: 900px) {
            nav, .strip, #galeri, #lokasi, #booking, footer, .footer-bottom { padding-left: 1.5rem; padding-right: 1.5rem; }
            #lokasi { padding-bottom: 4rem; }
            .map-container { height: 350px; }
            #hero { padding: 0 1.5rem 4rem; }
            #detail { grid-template-columns: 1fr; gap: 3rem; padding: 4rem 1.5rem; }
            .galeri-grid { grid-template-columns: 1fr 1fr; }
            .galeri-item:first-child { grid-column: span 2; grid-row: span 1; }
            #booking { grid-template-columns: 1fr; margin: 0 1.5rem 4rem; padding: 3rem 2rem; }
            footer { grid-template-columns: 1fr; }
            .nav-links { display: none; }
            .hero-btns { flex-direction: column; width: 100%; }
            .hero-btns a { text-align: center; width: 100%; justify-content: center; display: flex; align-items: center; }
        }
    </style>
</head>
<body>

    <!-- NAV -->
    <nav id="navbar">
        <a href="#" class="nav-logo">Villa Oking</a>
        <ul class="nav-links">
            <li><a href="#detail">Detail</a></li>
            <li><a href="#galeri">Galeri</a></li>
            <li><a href="#lokasi">Lokasi</a></li>
            <li><a href="#booking">Reservasi</a></li>
        </ul>
        <a href="#booking" class="nav-cta">Reservasi</a>
    </nav>

    <!-- HERO -->
    <section id="hero">
        <div class="hero-bg">
            @if($villa->villa_photos->where('status', true)->first())
                <img src="{{ asset('storage/' . $villa->villa_photos->where('status', true)->first()->foto) }}"
                     alt="{{ $villa->nama }}">
            @else
                <div class="hero-bg-fallback"></div>
            @endif
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-tag">Villa Premium · Alam & Kemewahan</div>
            <h1 class="hero-title">
                Selamat Datang di<br>
                <em>{{ $villa->nama }}</em>
            </h1>
            <div class="hero-meta">
                <div class="hero-meta-item">👥 Kapasitas <strong>{{ $villa->kapasitas }} Orang</strong></div>
                <div class="hero-meta-item">
                    Status
                     <strong>{{ $activeBooking ? 'Sedang Dipesan' : 'Tersedia' }}</strong>
                </div>
            </div>
            <div class="hero-btns">
                <a href="#galeri" class="btn-primary">Lihat Galeri</a>
                <a href="{{ route('booking.create', $villa) }}" class="btn-outline">Reservasi Sekarang</a>
                <a href="{{ route('booking.schedule') }}" class="btn-outline">Cek Ketersediaan</a>
            </div>
        </div>
    </section>

    <!-- STRIP -->
    <div class="strip">
        <div class="strip-item"><span>✦</span> Check-in Fleksibel</div>
        <div class="strip-item"><span>✦</span> Pemandangan Alam</div>
        <div class="strip-item"><span>✦</span> Private Pool</div>
        <div class="strip-item"><span>✦</span> 24/7 Concierge</div>
    </div>

    <!-- DETAIL VILLA -->
    <section id="detail">
        <div class="detail-text reveal">
            <div class="section-tag">Detail Villa</div>
            <h2 class="section-title">{{ $villa->nama }}</h2>

           <span class="status-badge {{ $activeBooking ? 'status-booked' : 'status-available' }}">
    {{ $activeBooking ? '● Sedang Dipesan' : '● Tersedia' }}
</span>

            @if($villa->keterangan)
                <p class="detail-desc">{{ $villa->keterangan }}</p>
            @endif

            <div class="detail-specs">
                <div class="spec-item">
                    <span class="spec-label">Kapasitas</span>
                    <span class="spec-value">{{ $villa->kapasitas }} Orang</span>
                </div>
                <div class="spec-item">
                    <span class="spec-label">Total Foto</span>
                    <span class="spec-value">{{ $villa->villa_photos->where('status', true)->count() }} Foto</span>
                </div>
            </div>

            <div class="price-box">
                <div>
                    <div class="price-label">Harga per malam</div>
                    <div class="price-amount">Rp {{ number_format($villa->harga_permalam, 0, ',', '.') }}</div>
                </div>
                <span class="price-per">/ malam</span>
            </div>
        </div>

        <!-- Foto thumbnail di kanan -->
        <div class="reveal">
            @if($villa->villa_photos->where('status', true)->count() > 0)
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.6rem;">
                    @foreach($villa->villa_photos->where('status', true)->take(4) as $photo)
                        <div style="aspect-ratio:1; overflow:hidden;">
                            <img src="{{ asset('storage/' . $photo->foto) }}"
                                 alt="{{ $photo->keterangan ?? $villa->nama }}"
                                 style="width:100%; height:100%; object-fit:cover; transition:transform 0.5s;"
                                 onmouseover="this.style.transform='scale(1.06)'"
                                 onmouseout="this.style.transform='scale(1)'">
                        </div>
                    @endforeach
                </div>
            @else
                <div style="aspect-ratio:1; background:var(--sand); display:flex; align-items:center; justify-content:center;">
                    <span style="color:rgba(30,21,16,0.3); font-size:0.8rem; letter-spacing:0.15em;">Belum Ada Foto</span>
                </div>
            @endif
        </div>
    </section>

    <!-- GALERI -->
    <section id="galeri">
        <div class="section-header reveal">
            <div class="section-tag">Galeri Foto</div>
            <h2 class="section-title">Lihat <em>Keindahannya</em></h2>
        </div>

        <div class="galeri-grid">
          @foreach($villa->villa_photos as $photo)
    @php
        $url = asset('storage/' . $photo->foto);
        $ket = $photo->keterangan ?? $villa->nama;
    @endphp

    <div class="galeri-item reveal" onclick="openLightbox('{{ $url }}', '{{ $ket }}')">
        <img src="{{ $url }}"
             alt="{{ $ket }}"
             loading="lazy">
        <div class="galeri-item-overlay">
            <span class="galeri-item-label">{{ $photo->keterangan ?? 'Lihat Foto' }}</span>
        </div>
    </div>
@endforeach
        </div>
    </section>

    <!-- LIGHTBOX -->
    <div class="lightbox" id="lightbox" onclick="closeLightbox()">
        <button class="lightbox-close" onclick="closeLightbox()">✕</button>
        <img id="lightbox-img" src="" alt="">
        <div class="lightbox-caption" id="lightbox-caption"></div>
    </div>

    <!-- LOKASI -->
    <section id="lokasi">
        <div class="section-header reveal">
            <div class="section-tag">Lokasi Kami</div>
            <h2 class="section-title">Temukan <em>Villa Oking</em></h2>
        </div>
        <div class="map-container reveal">
            <iframe src="https://maps.google.com/maps?q=Villa%20Oking,%208X29%2B435,%20Unnamed%20Road,%20Tugu%20Sel.,%20Kec.%20Cisarua,%20Kabupaten%20Bogor,%20Jawa%20Barat%2016750&t=&z=15&ie=UTF8&iwloc=&output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <!-- BOOKING -->
    <div id="booking">
        <div>
            <h2 class="booking-title">Siap Menikmati {{ $villa->nama }}?</h2>
            <p class="booking-sub">Hubungi kami dan dapatkan penawaran terbaik untuk reservasi kamu.</p>
        </div>
        <a href="https://wa.me/6285216399504?text=Halo,%20saya%20ingin%20bertanya%20tentang%20reservasi%20di%20{{ urlencode($villa->nama) }}" 
           class="btn-primary" 
           target="_blank"
           style="white-space:nowrap; padding:1.2rem 3rem;">Hubungi Kami</a>
    </div>

    <!-- FOOTER -->
    <footer>
        <div>
            <div class="footer-brand">Villa Oking</div>
            <p class="footer-desc">{{ $villa->keterangan ?? 'Destinasi peristirahatan premium dengan keindahan alam yang memukau.' }}</p>
        </div>
        <div>
            <div class="footer-title">Navigasi</div>
            <ul class="footer-links">
                <li><a href="#detail">Detail Villa</a></li>
                <li><a href="#galeri">Galeri Foto</a></li>
                <li><a href="#lokasi">Lokasi</a></li>
                <li><a href="#booking">Reservasi</a></li>
            </ul>
        </div>
        <div>
            <div class="footer-title">Kontak</div>
            <ul class="footer-links">
                <li><a href="#">+62 85216399504</a></li>
                <li><a href="#">villaoking@gmail.com</a></li>
                <li><a href="#">Puncak, Bogor, Jawa Barat</a></li>
                <li><a href="https://wa.me/6285216399504" target="_blank">WhatsApp</a></li>
            </ul>
        </div>
    </footer>
    <div class="footer-bottom">
        <span class="footer-copy">© {{ date('Y') }} Villa Oking. All rights reserved.</span>
        <span class="footer-copy">Dibuat dengan ♥</span>
    </div>

    <script>
        const nav = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('scrolled', window.scrollY > 80);
        });

        const obs = new IntersectionObserver(entries => {
            entries.forEach((e, i) => {
                if (e.isIntersecting) {
                    setTimeout(() => e.target.classList.add('visible'), i * 80);
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('.reveal').forEach(el => obs.observe(el));

        function openLightbox(src, caption) {
            document.getElementById('lightbox-img').src = src;
            document.getElementById('lightbox-caption').textContent = caption;
            document.getElementById('lightbox').classList.add('open');
            document.body.style.overflow = 'hidden';
        }
        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('open');
            document.body.style.overflow = '';
        }
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape') closeLightbox();
        });
    </script>
</body>
</html>