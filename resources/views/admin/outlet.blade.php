@extends('layouts.admin')

@section('title', 'Kelola Outlet & Kontak Landing Page - CMS 99 Bakery')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Outlet & Kontak Landing Page</h1>
    <p class="page-subtitle-text">Atur informasi alamat cabang, jam operasional, link Google Maps, dan tombol pemesanan WhatsApp.</p>
  </div>
</div>

<!-- OUTLETS LIST ROW -->
<div class="row g-4 mb-4">
  <!-- Outlet 1 -->
  <div class="col-12 col-md-6">
    <div class="admin-card h-100 mb-0">
      <div class="admin-card-header bg-light">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
          <h5 class="admin-card-title">Outlet Tawang Alun</h5>
        </div>
        <span class="badge bg-success text-white">Tampil di Landing Page</span>
      </div>
      <div class="p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Outlet Tawang Alun berhasil diperbarui!');">
          <div class="mb-3">
            <label class="small text-muted fw-bold">ALAMAT CABANG</label>
            <input type="text" class="form-control" value="Jl. Alun-Alun Tawang Alun No. 99, Rambipuji, Jember">
          </div>
          <div class="mb-3">
            <label class="small text-muted fw-bold">JAM OPERASIONAL</label>
            <input type="text" class="form-control" value="Senin - Minggu (06:00 - 21:00 WIB)">
          </div>
          <div class="mb-3">
            <label class="small text-muted fw-bold">NO. WHATSAPP OUTLET</label>
            <input type="text" class="form-control" value="0852-5722-0335">
          </div>
          <div class="mb-3">
            <label class="small text-muted fw-bold">LINK GOOGLE MAPS</label>
            <input type="text" class="form-control form-control-sm" value="https://maps.google.com/?q=99+Bakery+Tawang+Alun">
          </div>
          <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill w-100 mt-2">
            <i class="bi bi-save me-1"></i> Simpan Outlet Tawang Alun
          </button>
        </form>
      </div>
    </div>
  </div>

  <!-- Outlet 2 -->
  <div class="col-12 col-md-6">
    <div class="admin-card h-100 mb-0">
      <div class="admin-card-header bg-light">
        <div class="d-flex align-items-center gap-2">
          <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
          <h5 class="admin-card-title">Outlet Kampus Jember</h5>
        </div>
        <span class="badge bg-success text-white">Tampil di Landing Page</span>
      </div>
      <div class="p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Outlet Kampus berhasil diperbarui!');">
          <div class="mb-3">
            <label class="small text-muted fw-bold">ALAMAT CABANG</label>
            <input type="text" class="form-control" value="Jl. Kalimantan (Area Kampus UNEJ), Sumbersari, Jember">
          </div>
          <div class="mb-3">
            <label class="small text-muted fw-bold">JAM OPERASIONAL</label>
            <input type="text" class="form-control" value="Senin - Minggu (06:30 - 21:30 WIB)">
          </div>
          <div class="mb-3">
            <label class="small text-muted fw-bold">NO. WHATSAPP OUTLET</label>
            <input type="text" class="form-control" value="0852-5722-0335">
          </div>
          <div class="mb-3">
            <label class="small text-muted fw-bold">LINK GOOGLE MAPS</label>
            <input type="text" class="form-control form-control-sm" value="https://maps.google.com/?q=99+Bakery+Kampus">
          </div>
          <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill w-100 mt-2">
            <i class="bi bi-save me-1"></i> Simpan Outlet Kampus
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- STORE FLOATING WA & FOOTER SETTINGS CARD -->
<div class="admin-card">
  <div class="admin-card-header">
    <h5 class="admin-card-title"><i class="bi bi-whatsapp text-success me-2"></i>Pengaturan Floating WhatsApp & Footer Landing Page</h5>
  </div>
  <div class="p-4">
    <form onsubmit="event.preventDefault(); alert('[Simulasi] Pengaturan WhatsApp landing page berhasil disimpan!');">
      <div class="row g-3">
        <div class="col-12 col-md-6">
          <label class="form-label small fw-bold">Nomor WA Pemesanan Utama (Format Internasional)</label>
          <input type="text" class="form-control" value="6285257220335">
          <span class="text-muted small">Contoh: 6285257220335 (Digunakan pada tombol melayang / floating WA)</span>
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label small fw-bold">Teks Tombol Floating WA</label>
          <input type="text" class="form-control" value="Tanya / Pesan via WA">
        </div>
        <div class="col-12">
          <label class="form-label small fw-bold">Draft Pesan WhatsApp Otomatis (Auto-fill Message)</label>
          <textarea class="form-control" rows="3">Halo Admin 99 Bakery Jember, saya mau tanya/pesan Roti untuk hajatan. Mohon infonya ya!</textarea>
        </div>
      </div>
      <div class="mt-4 text-end">
        <button type="submit" class="btn-99-primary">Simpan Pengaturan WA & Footer</button>
      </div>
    </form>
  </div>
</div>
@endsection
