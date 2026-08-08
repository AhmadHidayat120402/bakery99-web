@extends('layouts.admin')

@section('title', 'Kelola Konten Tentang Toko - CMS 99 Bakery')

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

<!-- FORM 2: 4 POIN KEUNGGULAN UTAMA -->
<div class="admin-card">
  <div class="admin-card-header">
    <h5 class="admin-card-title"><i class="bi bi-star-fill text-warning me-2"></i>4 Poin Keunggulan Utama 99 Bakery</h5>
  </div>
  <div class="p-4">
    <form onsubmit="event.preventDefault(); alert('[Simulasi] Poin keunggulan toko diperbarui!');">
      <div class="row g-4">

        <!-- Poin 1 -->
        <div class="col-12 col-md-6">
          <div class="p-3 border rounded bg-light">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-danger">Keunggulan 1</span>
              <i class="bi bi-gift-fill text-danger fs-5 ms-auto"></i>
            </div>
            <label class="form-label small fw-bold">Judul Poin 1</label>
            <input type="text" class="form-control mb-2" value="Spesialis Roti Hajatan & Snack Box">
            <label class="form-label small fw-bold">Penjelasan Ringkas</label>
            <textarea class="form-control" rows="2">Siap melayani pesanan partai besar & kecil untuk acara syukuran, rapat, dan pernikahan.</textarea>
          </div>
        </div>

        <!-- Poin 2 -->
        <div class="col-12 col-md-6">
          <div class="p-3 border rounded bg-light">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-danger">Keunggulan 2</span>
              <i class="bi bi-clock-history text-danger fs-5 ms-auto"></i>
            </div>
            <label class="form-label small fw-bold">Judul Poin 2</label>
            <input type="text" class="form-control mb-2" value="Fresh Every Day">
            <label class="form-label small fw-bold">Penjelasan Ringkas</label>
            <textarea class="form-control" rows="2">Roti dan kue selalu diproduksi baru setiap hari tanpa bahan pengawet berbahaya.</textarea>
          </div>
        </div>

        <!-- Poin 3 -->
        <div class="col-12 col-md-6">
          <div class="p-3 border rounded bg-light">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-danger">Keunggulan 3</span>
              <i class="bi bi-award-fill text-danger fs-5 ms-auto"></i>
            </div>
            <label class="form-label small fw-bold">Judul Poin 3</label>
            <input type="text" class="form-control mb-2" value="Bahan Pilihan Premium">
            <label class="form-label small fw-bold">Penjelasan Ringkas</label>
            <textarea class="form-control" rows="2">Dibuat menggunakan margarin dan tepung kualitas super untuk kelembutan optimal.</textarea>
          </div>
        </div>

        <!-- Poin 4 -->
        <div class="col-12 col-md-6">
          <div class="p-3 border rounded bg-light">
            <div class="d-flex align-items-center gap-2 mb-2">
              <span class="badge bg-danger">Keunggulan 4</span>
              <i class="bi bi-patch-check-fill text-danger fs-5 ms-auto"></i>
            </div>
            <label class="form-label small fw-bold">Judul Poin 4</label>
            <input type="text" class="form-control mb-2" value="100% Halal & Higienis">
            <label class="form-label small fw-bold">Penjelasan Ringkas</label>
            <textarea class="form-control" rows="2">Terjamin kehalalan bahan dan proses pengolahan yang bersih dan aman.</textarea>
          </div>
        </div>

      </div>
      <div class="mt-4 text-end">
        <button type="submit" class="btn-99-primary">Simpan Poin Keunggulan</button>
      </div>
    </form>
  </div>
</div>
@endsection
