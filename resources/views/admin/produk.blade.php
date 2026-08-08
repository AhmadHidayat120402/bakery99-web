@extends('layouts.admin')

@section('title', 'Kelola Item Produk Landing Page - CMS 99 Bakery')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Item Produk Landing Page</h1>
    <p class="page-subtitle-text">Tambah roti baru, ubah harga, upload foto dengan preview live, dan atur badge promo pada katalog.</p>
  </div>
  <div>
    <button class="btn-99-primary" data-bs-toggle="modal" data-bs-target="#modalTambahProduk">
      <i class="bi bi-plus-lg"></i> Tambah Produk Baru
    </button>
  </div>
</div>

<!-- DATATABLE ITEM PRODUK -->
<div class="admin-card">
  <div class="admin-card-header">
    <div>
      <h5 class="admin-card-title">Katalog Roti & Kue Landing Page</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Daftar item roti yang dipajang di katalog beranda publik</span>
    </div>
    <div class="d-flex align-items-center gap-2">
      <label class="small text-muted d-none d-sm-inline">Filter Kategori:</label>
      <select id="categoryFilterSelect" class="form-select form-select-sm" style="width: auto; border-radius: 20px;">
        <option value="all">Semua Kategori</option>
        <option value="roti">Roti Hajatan</option>
        <option value="snackbox">Snack Box</option>
        <option value="kue">Kue & Brownies</option>
        <option value="bolen">Bolen & Pastry</option>
      </select>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle">
      <thead>
        <tr>
          <th>Foto Roti</th>
          <th>Nama Produk</th>
          <th>Kategori</th>
          <th>Harga Landing Page</th>
          <th>Badge Landing Page</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr data-category="roti">
          <td>
            <img src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" class="img-thumb-admin" alt="Roti Sobek Pisang">
          </td>
          <td>
            <div class="fw-bold text-dark">Roti Sobek Pisang</div>
            <span class="text-muted" style="font-size: 0.78rem;">Tekstur empuk dengan isian pisang manis</span>
          </td>
          <td><span class="badge bg-light text-dark border">Roti Hajatan</span></td>
          <td class="fw-bold text-danger">Rp 12.000</td>
          <td><span class="badge bg-warning text-dark"><i class="bi bi-star-fill"></i> Terlaris</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Item Produk" data-bs-toggle="modal" data-bs-target="#modalEditProduk">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Roti Sobek Pisang" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <tr data-category="roti">
          <td>
            <img src="{{ asset('img/products/roti/Pizza besar.jpg') }}" class="img-thumb-admin" alt="Pizza Besar">
          </td>
          <td>
            <div class="fw-bold text-dark">Pizza Besar 99 Special</div>
            <span class="text-muted" style="font-size: 0.78rem;">Toping sosis, keju melt & saus spesial</span>
          </td>
          <td><span class="badge bg-light text-dark border">Roti Hajatan</span></td>
          <td class="fw-bold text-danger">Rp 25.000</td>
          <td><span class="badge bg-danger text-white"><i class="bi bi-fire"></i> Favorit</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Item Produk" data-bs-toggle="modal" data-bs-target="#modalEditProduk">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Pizza Besar" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <tr data-category="snackbox">
          <td>
            <img src="{{ asset('img/products/roti/sisir mini pandan.jpg') }}" class="img-thumb-admin" alt="Roti Sisir Mini">
          </td>
          <td>
            <div class="fw-bold text-dark">Roti Sisir Mini Pandan</div>
            <span class="text-muted" style="font-size: 0.78rem;">Pilihan utama isi snackbox syukuran</span>
          </td>
          <td><span class="badge bg-light text-dark border">Snack Box</span></td>
          <td class="fw-bold text-danger">Rp 8.000</td>
          <td><span class="badge bg-success text-white">Spesialis Hajatan</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Item Produk" data-bs-toggle="modal" data-bs-target="#modalEditProduk">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Roti Sisir" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <tr data-category="roti">
          <td>
            <img src="{{ asset('img/products/roti/tawar besar pandan.jpg') }}" class="img-thumb-admin" alt="Tawar Pandan">
          </td>
          <td>
            <div class="fw-bold text-dark">Roti Tawar Besar Pandan</div>
            <span class="text-muted" style="font-size: 0.78rem;">Aroma pandan harum dan lembut</span>
          </td>
          <td><span class="badge bg-light text-dark border">Roti Hajatan</span></td>
          <td class="fw-bold text-danger">Rp 15.000</td>
          <td><span class="badge bg-secondary">Standar</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Item Produk" data-bs-toggle="modal" data-bs-target="#modalEditProduk">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Roti Tawar" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH PRODUK WITH LIVE IMAGE PREVIEW -->
<div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-plus-circle me-1"></i> Tambah Produk Landing Page</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Produk baru berhasil ditambahkan ke landing page!'); bootstrap.Modal.getInstance(document.getElementById('modalTambahProduk')).hide();">
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Produk</label>
            <input type="text" class="form-control" placeholder="Contoh: Bolen Pisang Coklat Premium" required>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Kategori</label>
              <select class="form-select" required>
                <option value="roti">Roti Hajatan</option>
                <option value="snackbox">Snack Box</option>
                <option value="kue">Kue & Brownies</option>
                <option value="bolen">Bolen & Pastry</option>
              </select>
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Harga (Rp)</label>
              <input type="number" class="form-control" placeholder="15000" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Badge Promo (Opsional)</label>
            <select class="form-select">
              <option value="terlaris">Badge Terlaris</option>
              <option value="favorit">Badge Favorit</option>
              <option value="spesialis">Badge Spesialis Hajatan</option>
              <option value="none">Tanpa Badge</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Upload Foto Produk</label>
            <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewProdukTambah" required>
            <div class="img-preview-box">
              <span class="img-preview-label">Live Preview Foto Roti:</span>
              <img id="previewProdukTambah" class="img-preview-target" src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" alt="Preview Roti">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Deskripsi Singkat</label>
            <textarea class="form-control" rows="2" placeholder="Deskripsi singkat yang tampil di kartu produk..."></textarea>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Produk</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT PRODUK WITH LIVE IMAGE PREVIEW -->
<div class="modal fade" id="modalEditProduk" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-pencil-square me-1"></i> Edit Data Produk Landing Page</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Data produk landing page disimpan!'); bootstrap.Modal.getInstance(document.getElementById('modalEditProduk')).hide();">
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Produk</label>
            <input type="text" class="form-control" value="Roti Sobek Pisang" required>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Kategori</label>
              <select class="form-select">
                <option value="roti" selected>Roti Hajatan</option>
                <option value="snackbox">Snack Box</option>
                <option value="kue">Kue & Brownies</option>
              </select>
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Harga (Rp)</label>
              <input type="number" class="form-control" value="12000" required>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Ganti Foto Produk</label>
            <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewProdukEdit">
            <div class="img-preview-box">
              <span class="img-preview-label">Live Preview Foto Roti:</span>
              <img id="previewProdukEdit" class="img-preview-target" src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" alt="Preview Roti">
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-dark btn-sm rounded-pill">Update Produk</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
