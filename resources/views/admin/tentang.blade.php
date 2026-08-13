@extends('admin.layouts.admin')

@section('title', 'Kelola Konten Tentang Toko')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Konten Tentang Toko</h1>
    <p class="page-subtitle-text">Atur narasi profil 99 Bakery, 4 poin keunggulan utama, dan sertifikat jaminan kualitas halal.</p>
  </div>
</div>

<!-- FORM 1: PROFIL RINGKAS & CERITA TOKO -->
<div class="admin-card mb-4">
  <div class="admin-card-header">
    <h5 class="admin-card-title"><i class="bi bi-journal-text text-danger me-2"></i>Profil & Deskripsi Cerita Toko</h5>
  </div>
  <div class="p-4">
    <form onsubmit="event.preventDefault(); alert('[Simulasi] Profil toko berhasil disimpan!');">
      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label class="form-label small fw-bold">Judul Seksi (Subheading)</label>
          <input type="text" class="form-control" value="Tentang 99 Bakery Jember">
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label small fw-bold">Tagline Singkat</label>
          <input type="text" class="form-control" value="Roti Fresh Setiap Hari dengan Bahan Pilihan">
        </div>
        <div class="col-12">
          <label class="form-label small fw-bold">Deskripsi Cerita Toko (Tampil di Seksi About Us)</label>
          <textarea class="form-control" rows="4">99 Bakery Jember berdiri dengan komitmen menghadirkan produk olahan roti, brownies, bolen, kue basah, dan snack box berkualitas tinggi. Kami mengutamakan bahan-bahan higienis pilihan, tekstur empuk, serta kelezatan khas yang selalu segar dari panggangan setiap harinya.</textarea>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label small fw-bold">Foto Profil Toko / Outlet</label>
          <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewTokoPhoto">
          <div class="img-preview-box">
            <span class="img-preview-label">Live Preview Foto Toko:</span>
            <img id="previewTokoPhoto" class="img-preview-target" src="{{ asset('img/outlet.webp') }}" alt="Toko Photo">
          </div>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label small fw-bold">Logo Sertifikasi Halal</label>
          <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewHalalLogo">
          <div class="img-preview-box">
            <span class="img-preview-label">Live Preview Sertifikat Halal:</span>
            <img id="previewHalalLogo" class="img-preview-target" src="{{ asset('img/logo-halal.jpeg') }}" alt="Halal Logo">
          </div>
        </div>
      </div>
      <div class="mt-4 text-end">
        <button type="submit" class="btn-99-primary">Simpan Profil Toko</button>
      </div>
    </form>
  </div>
</div>

@endsection
