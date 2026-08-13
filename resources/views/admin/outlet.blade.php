@extends('admin.layouts.admin')

@section('title', 'Kelola Outlet & Kontak Landing Page')

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
@endsection
