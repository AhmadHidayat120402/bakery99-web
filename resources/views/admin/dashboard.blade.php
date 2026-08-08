@extends('layouts.admin')

@section('title', 'CMS Admin Landing Page - 99 Bakery Jember')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Pengelola Konten Landing Page</h1>
    <p class="page-subtitle-text">Kelola teks, foto banner carousel, cerita tentang toko, kategori, dan kontak pada website 99 Bakery.</p>
  </div>
</div>

<!-- STAT CARDS ROW -->
<div class="row g-3 mb-4">
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-card-99">
      <div class="d-flex justify-content-between align-items-start">
        <div class="stat-card-icon stat-icon-red">
          <i class="bi bi-images"></i>
        </div>
        <span class="badge bg-success">Aktif</span>
      </div>
      <div class="stat-value">3 Banner</div>
      <div class="stat-label">Slide Carousel Hero Utama</div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-card-99">
      <div class="d-flex justify-content-between align-items-start">
        <div class="stat-card-icon stat-icon-gold">
          <i class="bi bi-card-heading"></i>
        </div>
        <span class="badge bg-success">Terisi</span>
      </div>
      <div class="stat-value">4 Poin</div>
      <div class="stat-label">Keunggulan Toko Roti</div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-card-99">
      <div class="d-flex justify-content-between align-items-start">
        <div class="stat-card-icon stat-icon-blue">
          <i class="bi bi-tags-fill"></i>
        </div>
        <span class="badge bg-primary">4 Kategori</span>
      </div>
      <div class="stat-value">42 Produk</div>
      <div class="stat-label">Tampil di Katalog Landing Page</div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-card-99">
      <div class="d-flex justify-content-between align-items-start">
        <div class="stat-card-icon stat-icon-green">
          <i class="bi bi-shop"></i>
        </div>
        <span class="badge bg-success">2 Cabang</span>
      </div>
      <div class="stat-value">2 Outlet</div>
      <div class="stat-label">Lokasi & WA Landing Page</div>
    </div>
  </div>
</div>

<!-- SECTIONS CONTROL GRID -->
<h5 class="fw-bold mb-3 text-dark">Seksi Konten Landing Page</h5>
<div class="row g-3 mb-4">

  <!-- Section 1: Hero Carousel -->
  <div class="col-12 col-md-6 col-lg-4">
    <div class="cms-section-card h-100 d-flex flex-column justify-content-between">
      <div>
        <div class="d-flex align-items-center justify-content-between mb-2">
          <span class="badge bg-danger">Seksi 1</span>
          <span class="text-muted small"><i class="bi bi-check-circle-fill text-success"></i> Tampil</span>
        </div>
        <h6 class="fw-bold text-dark fs-6"><i class="bi bi-images me-2 text-danger"></i>Banner Hero & Topbar Promo</h6>
        <p class="text-muted small mb-3">Atur pengumuman promo di baris paling atas dan foto slider carousel utama.</p>
      </div>
      <a href="{{ route('admin.banner') }}" class="btn btn-outline-danger btn-sm rounded-pill w-100 mt-2">
        <i class="bi bi-pencil me-1"></i> Edit Carousel & Banner
      </a>
    </div>
  </div>

  <!-- Section 2: Tentang Toko -->
  <div class="col-12 col-md-6 col-lg-4">
    <div class="cms-section-card h-100 d-flex flex-column justify-content-between">
      <div>
        <div class="d-flex align-items-center justify-content-between mb-2">
          <span class="badge bg-danger">Seksi 2</span>
          <span class="text-muted small"><i class="bi bi-check-circle-fill text-success"></i> Tampil</span>
        </div>
        <h6 class="fw-bold text-dark fs-6"><i class="bi bi-card-heading me-2 text-danger"></i>Tentang 99 Bakery</h6>
        <p class="text-muted small mb-3">Ubah deskripsi profil toko, 4 poin keunggulan utama, dan foto sertifikasi halal.</p>
      </div>
      <a href="{{ route('admin.tentang') }}" class="btn btn-outline-danger btn-sm rounded-pill w-100 mt-2">
        <i class="bi bi-pencil me-1"></i> Edit Konten Tentang
      </a>
    </div>
  </div>

  <!-- Section 3: Kelola Kategori -->
  <div class="col-12 col-md-6 col-lg-4">
    <div class="cms-section-card h-100 d-flex flex-column justify-content-between">
      <div>
        <div class="d-flex align-items-center justify-content-between mb-2">
          <span class="badge bg-danger">Seksi 3A</span>
          <span class="text-muted small"><i class="bi bi-check-circle-fill text-success"></i> Tampil</span>
        </div>
        <h6 class="fw-bold text-dark fs-6"><i class="bi bi-tags-fill me-2 text-danger"></i>Kategori Produk</h6>
        <p class="text-muted small mb-3">Tambah/edit nama kategori (Roti Hajatan, Snackbox, Kue) & icon cover.</p>
      </div>
      <a href="{{ route('admin.kategori') }}" class="btn btn-outline-danger btn-sm rounded-pill w-100 mt-2">
        <i class="bi bi-pencil me-1"></i> Edit Kategori Produk
      </a>
    </div>
  </div>

  <!-- Section 4: Kelola Produk -->
  <div class="col-12 col-md-6 col-lg-4">
    <div class="cms-section-card h-100 d-flex flex-column justify-content-between">
      <div>
        <div class="d-flex align-items-center justify-content-between mb-2">
          <span class="badge bg-danger">Seksi 3B</span>
          <span class="text-muted small"><i class="bi bi-check-circle-fill text-success"></i> Tampil</span>
        </div>
        <h6 class="fw-bold text-dark fs-6"><i class="bi bi-box-seam-fill me-2 text-danger"></i>Katalog Produk Roti</h6>
        <p class="text-muted small mb-3">Tambah roti baru, upload foto dengan preview live, dan atur harga.</p>
      </div>
      <a href="{{ route('admin.produk') }}" class="btn btn-outline-danger btn-sm rounded-pill w-100 mt-2">
        <i class="bi bi-pencil me-1"></i> Edit Item Produk
      </a>
    </div>
  </div>

  <!-- Section 5: Outlet & Floating WA -->
  <div class="col-12 col-md-6 col-lg-4">
    <div class="cms-section-card h-100 d-flex flex-column justify-content-between">
      <div>
        <div class="d-flex align-items-center justify-content-between mb-2">
          <span class="badge bg-danger">Seksi 4</span>
          <span class="text-muted small"><i class="bi bi-check-circle-fill text-success"></i> Tampil</span>
        </div>
        <h6 class="fw-bold text-dark fs-6"><i class="bi bi-shop me-2 text-danger"></i>Lokasi Outlet & Kontak WA</h6>
        <p class="text-muted small mb-3">Atur alamat cabang Tawang Alun & Kampus, jam operasional, dan tombol WA pemesanan.</p>
      </div>
      <a href="{{ route('admin.outlet') }}" class="btn btn-outline-danger btn-sm rounded-pill w-100 mt-2">
        <i class="bi bi-pencil me-1"></i> Edit Outlet & Kontak WA
      </a>
    </div>
  </div>

</div>
@endsection
