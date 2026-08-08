@extends('public.layouts.app')

@section('title', 'Outlet & Lokasi Gerai - 99 Bakery Jember')

@section('content')
<!-- BREADCRUMB & HEADER HERO -->
<section class="bg-warm-section py-4 border-bottom">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-2 small">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger fw-semibold">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Outlet Kami</li>
      </ol>
    </nav>
    <div>
      <h1 class="h2 fw-extrabold mb-1">Outlet <span class="text-danger">99 Bakery</span></h1>
      <p class="text-muted mb-0 small">Temukan lokasi outlet resmi 99 Bakery Jember untuk pembelian roti hajatan,
        brownies, bolen, dan snackbox berkualitas dengan rasa lezat dan fresh setiap hari.</p>
    </div>
  </div>
</section>

<!-- OUTLET LIST SECTION -->
<section class="py-5 bg-warm-section">
  <div class="container">
    <div class="text-center mb-5">
      <div class="section-badge">GERAI TERDEKAT</div>
      <h2 class="section-title">2 Pilihan Outlet Resmi 99 Bakery</h2>
      <p class="section-subtitle">
        Pilih lokasi outlet terdekat dari tempat tinggal Anda untuk belanja roti fresh atau ambil pesanan.
      </p>
    </div>

    <div class="row g-4 justify-content-center">

      <!-- Outlet 1: Tawang Alun (Pusat) -->
      <div class="col-lg-6">
        <div class="outlet-card">
          <div class="outlet-header-hero">
            <span class="status-badge-pill" id="statusTawangAlun">
              <span class="status-pulse"></span> Memuat Status...
            </span>
            <div class="outlet-icon-badge">
              <i class="bi bi-building"></i>
            </div>
            <h3 class="outlet-hero-title">99 Bakery Tawang Alun (Pusat)</h3>
            <div class="outlet-hero-tag">
              <i class="bi bi-star-fill text-warning me-1"></i> Dapur Utama & Penjualan Pusat
            </div>
          </div>

          <div class="outlet-body-content">
            <div class="outlet-info-row">
              <div class="outlet-info-icon">
                <i class="bi bi-geo-alt-fill"></i>
              </div>
              <div>
                <div class="outlet-info-label">Alamat Gerai</div>
                <div class="outlet-info-text">
                  Jl. Dharmawangsa No.64, Jubung, Tawang Alun, Jember
                </div>
              </div>
            </div>

            <div class="outlet-info-row">
              <div class="outlet-info-icon">
                <i class="bi bi-clock-fill"></i>
              </div>
              <div>
                <div class="outlet-info-label">Jam Operasional</div>
                <div class="outlet-info-text">
                  Setiap Hari: <strong>07.00 – 21.00 WIB</strong>
                </div>
              </div>
            </div>

            <div class="outlet-info-row">
              <div class="outlet-info-icon">
                <i class="bi bi-whatsapp"></i>
              </div>
              <div>
                <div class="outlet-info-label">Kontak Direct WA</div>
                <div class="outlet-info-text">
                  0852-5722-0335
                </div>
              </div>
            </div>

            <div class="outlet-chip-group">
              <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Dapur Produksi Utama</span>
              <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Pesanan Syukuran</span>
              <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Takeaway & Retail</span>
              <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Parkir Luas</span>
            </div>

            <div class="outlet-actions-flex">
              <a href="https://wa.me/6285257220335?text=Halo%2099%20Bakery%20Tawang%20Alun,%20saya%20mau%20tanya%20stok%20dan%20pemesanan"
                target="_blank" class="btn-outlet-wa-pill">
                <i class="bi bi-whatsapp fs-5"></i> Chat WhatsApp
              </a>
              <a href="https://maps.app.google.gl/8UbLLqnQufXAxYcB6" target="_blank" class="btn-outlet-maps-pill"
                title="Petunjuk Arah Google Maps">
                <i class="bi bi-geo-alt-fill"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Outlet 2: Kampus Sumbersari -->
      <div class="col-lg-6">
        <div class="outlet-card">
          <div class="outlet-header-hero">
            <span class="status-badge-pill" id="statusKampus">
              <span class="status-pulse"></span> Memuat Status...
            </span>
            <div class="outlet-icon-badge">
              <i class="bi bi-shop"></i>
            </div>
            <h3 class="outlet-hero-title">99 Bakery Kampus (Sumbersari)</h3>
            <div class="outlet-hero-tag">
              <i class="bi bi-geo-fill me-1"></i> Gerai Area Mahasiswa & Kampus
            </div>
          </div>

          <div class="outlet-body-content">
            <div class="outlet-info-row">
              <div class="outlet-info-icon">
                <i class="bi bi-geo-alt-fill"></i>
              </div>
              <div>
                <div class="outlet-info-label">Alamat Gerai</div>
                <div class="outlet-info-text">
                  Jl. Danau Toba No.8, Tegalgede, Sumbersari, Jember
                </div>
              </div>
            </div>

            <div class="outlet-info-row">
              <div class="outlet-info-icon">
                <i class="bi bi-clock-fill"></i>
              </div>
              <div>
                <div class="outlet-info-label">Jam Operasional</div>
                <div class="outlet-info-text">
                  Setiap Hari: <strong>06.30 – 21.00 WIB</strong>
                </div>
              </div>
            </div>

            <div class="outlet-info-row">
              <div class="outlet-info-icon">
                <i class="bi bi-whatsapp"></i>
              </div>
              <div>
                <div class="outlet-info-label">Kontak Direct WA</div>
                <div class="outlet-info-text">
                  0852-8491-1654
                </div>
              </div>
            </div>

            <div class="outlet-chip-group">
              <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Roti Fresh Harian</span>
              <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Snack Box Rapat</span>
              <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Dessert Box</span>
              <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Akses Mudah</span>
            </div>

            <div class="outlet-actions-flex">
              <a href="https://wa.me/6285284911654?text=Halo%2099%20Bakery%20Kampus,%20saya%20mau%20tanya%20stok%20dan%20pemesanan"
                target="_blank" class="btn-outlet-wa-pill">
                <i class="bi bi-whatsapp fs-5"></i> Chat WhatsApp
              </a>
              <a href="https://maps.app.goo.gl/r6W5yHjQ861XbEQLA" target="_blank" class="btn-outlet-maps-pill"
                title="Petunjuk Arah Google Maps">
                <i class="bi bi-geo-alt-fill"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CTA BANNER -->
<section class="py-5 bg-warm-section">
  <div class="container text-center">
    <div class="hajatan-banner max-w-900 mx-auto">
      <h3 class="mb-3 text-white">Mau Konsultasi / Pesan Roti Sebelum Berkunjung?</h3>
      <p class="text-white-50 mb-4 fs-5">
        Hubungi admin WhatsApp kami untuk cek ketersediaan stok roti kesukaan Anda atau konsultasi paket hajatan.
      </p>
      <a href="https://wa.me/6285257220335?text=Halo%2099%20Bakery,%20saya%20ingin%20tanya%20stok%20dan%20pemesanan"
        target="_blank" class="btn btn-light text-danger fw-bold btn-lg px-5 shadow-sm">
        <i class="bi bi-whatsapp me-2 fs-5"></i> Hubungi WhatsApp Admin
      </a>
    </div>
  </div>
</section>
@endsection
