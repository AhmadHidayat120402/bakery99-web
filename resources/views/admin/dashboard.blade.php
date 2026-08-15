@extends('admin.layouts.admin')

@section('title', 'Admin Landing Page')

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
  <!-- CARD 1: BANNER -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-card-99">
      <div class="d-flex justify-content-between align-items-start">
        <div class="stat-card-icon stat-icon-red">
          <i class="bi bi-images"></i>
        </div>
        <span class="badge bg-success">{{ $activeBannersCount }} Aktif</span>
      </div>
      <div class="stat-value">{{ $bannersCount }} Banner</div>
      <div class="stat-label">Slide Carousel Hero Utama</div>
    </div>
  </div>

  <!-- CARD 2: KATEGORI PRODUK (MENGGANTIKAN KEUNGGULAN) -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-card-99">
      <div class="d-flex justify-content-between align-items-start">
        <div class="stat-card-icon stat-icon-gold">
          <i class="bi bi-grid-fill"></i>
        </div>
        <span class="badge bg-warning text-dark">Terisi</span>
      </div>
      <div class="stat-value">{{ $categoriesCount }} Kategori</div>
      <div class="stat-label">Kategori Produk Roti & Kue</div>
    </div>
  </div>

  <!-- CARD 3: PRODUK -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-card-99">
      <div class="d-flex justify-content-between align-items-start">
        <div class="stat-card-icon stat-icon-blue">
          <i class="bi bi-tags-fill"></i>
        </div>
        <span class="badge bg-primary">{{ $categoriesCount }} Kategori</span>
      </div>
      <div class="stat-value">{{ $productsCount }} Produk</div>
      <div class="stat-label">Tampil di Halaman Katalog Produk</div>
    </div>
  </div>

  <!-- CARD 4: OUTLET -->
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="stat-card-99">
      <div class="d-flex justify-content-between align-items-start">
        <div class="stat-card-icon stat-icon-green">
          <i class="bi bi-shop"></i>
        </div>
        <span class="badge bg-success">{{ $activeOutletsCount }} Cabang</span>
      </div>
      <div class="stat-value">{{ $outletsCount }} Outlet</div>
      <div class="stat-label">Lokasi & WA Landing Page</div>
    </div>
  </div>
</div>
@endsection
