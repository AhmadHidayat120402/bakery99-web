@extends('layouts.admin')

@section('title', 'Kelola Banner & Slider Hero - CMS 99 Bakery')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Banner & Slider Hero</h1>
    <p class="page-subtitle-text">Atur teks pengumuman topbar dan foto slide carousel utama di bagian paling atas landing page.</p>
  </div>
  <div>
    <button class="btn-99-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSlide">
      <i class="bi bi-plus-lg"></i> Tambah Slide Carousel
    </button>
  </div>
</div>

<!-- FORM 1: TOP MINI ANNOUNCEMENT BAR -->
<div class="admin-card mb-4">
  <div class="admin-card-header">
    <h5 class="admin-card-title"><i class="bi bi-megaphone-fill text-danger me-2"></i>Pengumuman Bar Atas (Top Announcement Bar)</h5>
  </div>
  <div class="p-4">
    <form onsubmit="event.preventDefault(); alert('[Simulasi] Topbar announcement berhasil diperbarui!');">
      <div class="row g-3">
        <div class="col-12 col-md-8">
          <label class="form-label small fw-bold">Teks Pengumuman Promo Bar</label>
          <input type="text" class="form-control" value="🎁 Spesialis Roti Hajatan & Snack Box Jember • Fresh Setiap Hari • Pesan via WA:">
        </div>
        <div class="col-12 col-md-4">
          <label class="form-label small fw-bold">Nomor WhatsApp Tampil</label>
          <input type="text" class="form-control" value="0852-5722-0335">
        </div>
      </div>
      <div class="mt-3 text-end">
        <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4">Simpan Bar Topbar</button>
      </div>
    </form>
  </div>
</div>

<!-- TABLE: HERO CAROUSEL SLIDERS -->
<div class="admin-card">
  <div class="admin-card-header">
    <div>
      <h5 class="admin-card-title">Daftar Slide Carousel Banner Hero</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Slide carousel berganti secara otomatis di halaman beranda publik</span>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle">
      <thead>
        <tr>
          <th>Urutan</th>
          <th>Gambar Slider</th>
          <th>Judul Slide (Heading)</th>
          <th>Subjudul / Deskripsi</th>
          <th>Status</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="fw-bold text-muted">#1</td>
          <td>
            <img src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" class="carousel-thumb-admin" alt="Slide 1">
          </td>
          <td>
            <div class="fw-bold text-dark">Roti Hajatan & Snack Box Spesialis Jember</div>
            <span class="text-muted small">Tombol: "Pesan Sekarang"</span>
          </td>
          <td>Tekstur empuk, wangi mentega pilihan, fresh diolah setiap pagi.</td>
          <td><span class="badge bg-success">Tampil (Aktif)</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Slide" data-bs-toggle="modal" data-bs-target="#modalEditSlide">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Slide 1" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <tr>
          <td class="fw-bold text-muted">#2</td>
          <td>
            <img src="{{ asset('img/products/roti/Pizza besar.jpg') }}" class="carousel-thumb-admin" alt="Slide 2">
          </td>
          <td>
            <div class="fw-bold text-dark">Aneka Brownies & Bolen Pisang Meleleh</div>
            <span class="text-muted small">Tombol: "Lihat Katalog"</span>
          </td>
          <td>Kue brownies fudgy gurih & bolen pisang keju coklat favorit keluarga.</td>
          <td><span class="badge bg-success">Tampil (Aktif)</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Slide" data-bs-toggle="modal" data-bs-target="#modalEditSlide">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Slide 2" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <tr>
          <td class="fw-bold text-muted">#3</td>
          <td>
            <img src="{{ asset('img/outlet.webp') }}" class="carousel-thumb-admin" alt="Slide 3">
          </td>
          <td>
            <div class="fw-bold text-dark">Melayani Pesanan Besar untuk Hajatan & Acara</div>
            <span class="text-muted small">Tombol: "Hubungi Outlet"</span>
          </td>
          <td>Dapatkan harga spesial grosir untuk pesanan di atas 100 box.</td>
          <td><span class="badge bg-success">Tampil (Aktif)</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Slide" data-bs-toggle="modal" data-bs-target="#modalEditSlide">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Slide 3" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH SLIDE WITH LIVE PREVIEW -->
<div class="modal fade" id="modalTambahSlide" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-plus-circle me-1"></i> Tambah Slide Carousel</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Slide Carousel baru berhasil ditambahkan!'); bootstrap.Modal.getInstance(document.getElementById('modalTambahSlide')).hide();">
          <div class="mb-3">
            <label class="form-label fw-semibold small">Judul Slide (Heading Utama)</label>
            <input type="text" class="form-control" placeholder="Contoh: Promo Spesial Roti Sobek Jember" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Subjudul / Teks Deskripsi</label>
            <textarea class="form-control" rows="2" placeholder="Nikmati kelembutan roti khas 99 Bakery..."></textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Upload Foto Carousel Banner</label>
            <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewSlideTambah" required>
            <div class="img-preview-box">
              <span class="img-preview-label">Live Preview Banner Carousel:</span>
              <img id="previewSlideTambah" class="img-preview-target" src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" alt="Preview Banner">
            </div>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Teks Tombol CTA</label>
              <input type="text" class="form-control" value="Pesan Sekarang">
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Status Tampil</label>
              <select class="form-select">
                <option value="aktif">Tampil (Aktif)</option>
                <option value="draft">Sembunyikan (Draft)</option>
              </select>
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Slide</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT SLIDE WITH LIVE PREVIEW -->
<div class="modal fade" id="modalEditSlide" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-pencil-square me-1"></i> Edit Slide Carousel</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Perubahan Slide Carousel disimpan!'); bootstrap.Modal.getInstance(document.getElementById('modalEditSlide')).hide();">
          <div class="mb-3">
            <label class="form-label fw-semibold small">Judul Slide (Heading Utama)</label>
            <input type="text" class="form-control" value="Roti Hajatan & Snack Box Spesialis Jember" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Subjudul / Teks Deskripsi</label>
            <textarea class="form-control" rows="2">Tekstur empuk, wangi mentega pilihan, fresh diolah setiap pagi.</textarea>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Ganti Foto Banner Carousel</label>
            <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewSlideEdit">
            <div class="img-preview-box">
              <span class="img-preview-label">Live Preview Banner Carousel:</span>
              <img id="previewSlideEdit" class="img-preview-target" src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" alt="Preview Banner">
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-dark btn-sm rounded-pill">Update Slide</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
