@extends('admin.layouts.admin')

@section('title', 'Kelola Kategori Produk - CMS 99 Bakery')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Kategori Produk</h1>
    <p class="page-subtitle-text">Atur nama kategori, foto icon/cover kategori, dan urutan tab filter pada landing page.</p>
  </div>
  <div>
    <button class="btn-99-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
      <i class="bi bi-plus-lg"></i> Tambah Kategori Baru
    </button>
  </div>
</div>

<!-- CATEGORIES TABLE CARD -->
<div class="admin-card">
  <div class="admin-card-header">
    <div>
      <h5 class="admin-card-title">Daftar Kategori Produk Landing Page</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Total 4 kategori aktif di seksi katalog produk</span>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle">
      <thead>
        <tr>
          <th>Cover / Icon</th>
          <th>Nama Kategori</th>
          <th>Slug Kategori</th>
          <th>Jumlah Produk</th>
          <th>Status Tampil</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <img src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" class="img-thumb-admin" alt="Roti Hajatan">
          </td>
          <td>
            <div class="fw-bold text-dark">Roti Hajatan</div>
            <span class="text-muted small">Roti sisir, roti sobek, tawar & varian besar</span>
          </td>
          <td><code>roti-hajatan</code></td>
          <td><span class="badge bg-secondary">18 Item</span></td>
          <td><span class="badge bg-success">Tampil</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Kategori" data-bs-toggle="modal" data-bs-target="#modalEditKategori">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Kategori Roti Hajatan" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <tr>
          <td>
            <img src="{{ asset('img/products/roti/sisir mini pandan.jpg') }}" class="img-thumb-admin" alt="Snack Box">
          </td>
          <td>
            <div class="fw-bold text-dark">Snack Box</div>
            <span class="text-muted small">Paket hemat roti & kue untuk syukuran & rapat</span>
          </td>
          <td><code>snack-box</code></td>
          <td><span class="badge bg-secondary">12 Item</span></td>
          <td><span class="badge bg-success">Tampil</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Kategori" data-bs-toggle="modal" data-bs-target="#modalEditKategori">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Kategori Snackbox" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <tr>
          <td>
            <img src="{{ asset('img/products/roti/Pizza besar.jpg') }}" class="img-thumb-admin" alt="Kue & Brownies">
          </td>
          <td>
            <div class="fw-bold text-dark">Kue & Brownies</div>
            <span class="text-muted small">Brownies fudgy, tart ulang tahun & kue basah</span>
          </td>
          <td><code>kue-brownies</code></td>
          <td><span class="badge bg-secondary">8 Item</span></td>
          <td><span class="badge bg-success">Tampil</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Kategori" data-bs-toggle="modal" data-bs-target="#modalEditKategori">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Kategori Kue" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <tr>
          <td>
            <img src="{{ asset('img/products/roti/wholebread kopi.jpg') }}" class="img-thumb-admin" alt="Bolen & Pastry">
          </td>
          <td>
            <div class="fw-bold text-dark">Bolen & Pastry</div>
            <span class="text-muted small">Bolen pisang keju coklat & pastry renyah</span>
          </td>
          <td><code>bolen-pastry</code></td>
          <td><span class="badge bg-secondary">4 Item</span></td>
          <td><span class="badge bg-success">Tampil</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Kategori" data-bs-toggle="modal" data-bs-target="#modalEditKategori">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Kategori Bolen" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH KATEGORI WITH LIVE IMAGE PREVIEW -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-plus-circle me-1"></i> Tambah Kategori Produk Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Kategori baru berhasil ditambahkan!'); bootstrap.Modal.getInstance(document.getElementById('modalTambahKategori')).hide();">
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Kategori</label>
            <input type="text" class="form-control" placeholder="Contoh: Roti Manis Mini" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Deskripsi Singkat Kategori</label>
            <input type="text" class="form-control" placeholder="Aneka roti manis porsi personal...">
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Upload Cover / Icon Kategori</label>
            <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewKategoriTambah" required>
            <div class="img-preview-box">
              <span class="img-preview-label">Live Preview Gambar:</span>
              <img id="previewKategoriTambah" class="img-preview-target" src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" alt="Preview Gambar">
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Kategori</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT KATEGORI WITH LIVE IMAGE PREVIEW -->
<div class="modal fade" id="modalEditKategori" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-pencil-square me-1"></i> Edit Data Kategori</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Kategori berhasil diperbarui!'); bootstrap.Modal.getInstance(document.getElementById('modalEditKategori')).hide();">
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Kategori</label>
            <input type="text" class="form-control" value="Roti Hajatan" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Deskripsi Singkat</label>
            <input type="text" class="form-control" value="Roti sisir, roti sobek, tawar & varian besar">
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Ganti Foto Cover Kategori</label>
            <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewKategoriEdit">
            <div class="img-preview-box">
              <span class="img-preview-label">Live Preview Gambar:</span>
              <img id="previewKategoriEdit" class="img-preview-target" src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" alt="Preview Gambar">
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-dark btn-sm rounded-pill">Update Kategori</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
