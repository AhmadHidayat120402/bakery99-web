@extends('admin.layouts.admin')

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
@endsection
