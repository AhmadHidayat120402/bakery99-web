@extends('public.layouts.app')

@section('title', 'Profil & Nilai SONGO - 99 Bakery Jember')
@section('meta_description', 'Mengenal profil 99 Bakery Jember, sejarah usaha, komitmen kualitas roti hajatan & snackbox, serta nilai keunggulan SONGO.')

@section('content')
<!-- BREADCRUMB & HEADER HERO -->
<section class="bg-warm-section py-4 border-bottom">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-2 small">
        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger fw-semibold">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profil & SONGO</li>
      </ol>
    </nav>
    <div>
      <h1 class="h2 fw-extrabold mb-1">Profil Perusahaan & Nilai <span class="text-danger">SONGO</span></h1>
      <p class="text-muted mb-0 small">Mengenal perjalanan 99 Bakery Jember dalam menghadirkan roti hajatan, brownies,
        bolen, dan kue basah berkualitas tinggi dengan kehangatan rasa keluarga.</p>
    </div>
  </div>
</section>

<!-- 1. KOMITMEN 99 BAKERY -->
<section class="py-5 bg-white border-bottom">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="position-relative">
          <img src="{{ asset('img/outlet.webp') }}" loading="lazy"
            class="img-fluid rounded-4 shadow-lg border border-3 border-white w-100 lazy-blur"
            alt="Gerai Toko Roti 99 Bakery Jember - Komitmen Kualitas 100% Halal & Fresh Daily" style="max-height: 580px; object-fit: cover;">
          <div
            class="position-absolute bottom-0 start-0 m-3 bg-white bg-opacity-95 backdrop-blur px-3 py-2 rounded-3 shadow-sm border border-white">
            <span class="fw-bold text-danger fs-7"><i class="bi bi-patch-check-fill text-danger me-1"></i> 100% Halal
              & Fresh Daily</span>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="section-badge">KOMITMEN KUALITAS</div>
        <h2 class="section-title">Solusi Roti Fresh & Terpercaya</h2>
        <p class="text-muted mb-3" style="line-height:1.8;">
          <strong>99 Bakery Jember</strong> adalah usaha kuliner spesialis toko roti dan kue yang berfokus pada
          penyediaan <strong>Roti Hajatan, Snackbox Syukuran, Brownies, Bolen, Kue Basah, Dessert, dan Kue Tart</strong>.
        </p>
        <p class="text-muted mb-4" style="line-height:1.8;">
          Dengan tekad untuk selalu memberikan yang terbaik bagi setiap pelanggan, kami senantiasa menggunakan bahan-bahan pilihan bermutu tinggi tanpa pengawet berbahaya, diolah secara higienis oleh tenaga berpengalaman, serta selalu disajikan <em>fresh baked</em> setiap hari
        </p>
        <div class="row g-3">
          <div class="col-6">
            <div class="p-3 bg-warm-section rounded-3 border border-danger border-opacity-25">
              <div class="h4 fw-bold text-danger mb-1"><i class="bi bi-shop me-1"></i> 2 Outlet</div>
              <small class="text-muted fw-semibold">Tawang Alun & Kampus Jember</small>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 bg-warm-section rounded-3 border border-danger border-opacity-25">
              <div class="h4 fw-bold text-danger mb-1"><i class="bi bi-fire me-1"></i> 100% Fresh</div>
              <small class="text-muted fw-semibold">Dioven Setiap Hari</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 2. FILOSOFI BRAND & 5 PILAR NILAI SONGO -->
<section class="py-5 bg-warm-section border-bottom">
  <div class="container">
    <div class="text-center mb-5">
      <div class="section-badge"><i class="bi bi-gem me-1"></i> FILOSOFI BRAND</div>
      <h2 class="section-title">5 Pilar Nilai Utama "SONGO"</h2>
      <p class="section-subtitle">
        Filosofi nama "SONGO" (Bahasa Jawa: Sembilan) yang melandasi komitmen kerja dan kualitas produk di 99 Bakery.
      </p>
    </div>

    <div class="row g-4 justify-content-center">

      <!-- S - Sempurna -->
      <div class="col-md-6 col-lg-4">
        <div class="songo-card">
          <div class="songo-letter">S</div>
          <h3 class="songo-title">Sempurna</h3>
          <p class="songo-desc">
            Menghadirkan cita rasa, tekstur kelembutan roti, dan penampilan produk yang sempurna di setiap gigitan
            untuk kepuasan pelanggan.
          </p>
        </div>
      </div>

      <!-- O - Orisinil -->
      <div class="col-md-6 col-lg-4">
        <div class="songo-card">
          <div class="songo-letter">O</div>
          <h3 class="songo-title">Orisinil</h3>
          <p class="songo-desc">
            Resep kelezatan otentik khas 99 Bakery yang dibuat dari racikan resep rahasia berkualitas tanpa tiruan.
          </p>
        </div>
      </div>

      <!-- N - Nyaman -->
      <div class="col-md-6 col-lg-4">
        <div class="songo-card">
          <div class="songo-letter">N</div>
          <h3 class="songo-title">Nyaman</h3>
          <p class="songo-desc">
            Memberikan kenyamanan belanja melalui gerai yang bersih, respon pemesanan WA yang ramah, serta kemasan
            aman.
          </p>
        </div>
      </div>

      <!-- G - Gizi -->
      <div class="col-md-6 col-lg-4">
        <div class="songo-card">
          <div class="songo-letter">G</div>
          <h3 class="songo-title">Gizi</h3>
          <p class="songo-desc">
            Menggunakan bahan bernutrisi, terigu pilihan, telur fresh, mentega bermutu, dan tanpa bahan pengawet
            berbahaya.
          </p>
        </div>
      </div>

      <!-- O - Optimal -->
      <div class="col-md-6 col-lg-4">
        <div class="songo-card">
          <div class="songo-letter">O</div>
          <h3 class="songo-title">Optimal</h3>
          <p class="songo-desc">
            Pelayanan optimal dan kapasitas produksi siap melayani pemesanan skala kecil maupun ratusan snackbox acara
            hajatan.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 3. VISI & MISI 99 BAKERY -->
<section class="py-5 bg-white border-bottom">
  <div class="container">
    <div class="text-center mb-5">
      <div class="section-badge">ARAH PERUSAHAAN</div>
      <h2 class="section-title">Visi & Misi 99 Bakery</h2>
      <p class="section-subtitle">
        Panduan dan cita-cita utama 99 Bakery Jember dalam melayani masyarakat dan berkembang secara berkelanjutan.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-md-6">
        <div class="bg-white p-4 p-lg-5 rounded-4 border border-danger border-opacity-25 shadow-sm h-100 position-relative overflow-hidden">
          <div class="feature-icon-wrapper mb-3">
            <i class="bi bi-compass-fill fs-3"></i>
          </div>
          <h3 class="fw-extrabold mb-3 text-dark">Visi Perusahaan</h3>
          <p class="text-muted mb-0" style="line-height:1.8;">
            Menjadi toko roti spesialis pilihan utama di Jember dan sekitarnya yang dikenal atas kelezatan khas,
            kualitas higienis terjamin, serta menjadi bagian dari setiap momen kebahagiaan dan acara hajatan keluarga
            Indonesia.
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="bg-white p-4 p-lg-5 rounded-4 border border-danger border-opacity-25 shadow-sm h-100 position-relative overflow-hidden">
          <div class="feature-icon-wrapper mb-3">
            <i class="bi bi-bullseye fs-3"></i>
          </div>
          <h3 class="fw-extrabold mb-3 text-dark">Misi Perusahaan</h3>
          <ul class="text-muted mb-0 ps-3" style="line-height:1.8;">
            <li class="mb-2">Menyajikan produk roti & kue bermutu tinggi dengan harga yang terjangkau bagi seluruh lapisan masyarakat.</li>
            <li class="mb-2">Menjaga konsistensi kesegaran produk (<em>fresh daily</em>) tanpa bahan pengawet berbahaya.</li>
            <li class="mb-2">Memberikan pelayanan terbaik, cepat, dan ramah baik untuk pembelian langsung maupun pemesanan hajatan.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 4. CTA CATALOG BANNER -->
<section class="py-5 bg-warm-section border-top">
  <div class="container text-center">
    <div class="hajatan-banner max-w-900 mx-auto">
      <h3 class="mb-3 text-white">Ingin Mencoba Varian Kelezatan 99 Bakery?</h3>
      <p class="text-white-50 mb-4 fs-5">
        Jelajahi katalog lengkap roti hajatan, brownies, bolen, kue basah, dessert box, hingga kue tart ulang tahun.
      </p>
      <a href="{{ route('produk') }}" class="btn btn-light text-danger fw-bold btn-lg px-5 shadow-sm">
        <i class="bi bi-grid-fill me-2"></i> Lihat Katalog Produk
      </a>
    </div>
  </div>
</section>
@endsection
