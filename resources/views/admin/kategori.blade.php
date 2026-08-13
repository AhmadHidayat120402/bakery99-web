@extends('admin.layouts.admin')

@section('title', 'Kelola Kategori Produk')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Kategori Produk Landing Page</h1>
    <p class="page-subtitle-text">Tambah kategori produk baru, ubah nama, deskripsi, icon, dan foto sampul kategori.</p>
  </div>
  <div>
    <button class="btn-99-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
      <i class="bi bi-plus-lg"></i> Tambah Kategori Baru
    </button>
  </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
  <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
  <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Gagal menyimpan data:</strong>
  <ul class="mb-0 mt-1 ps-3">
    @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
  </ul>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- CATEGORIES TABLE CARD -->
<div class="admin-card" id="adminCategoryListApp">
  <div class="admin-card-header flex-wrap gap-2">
    <div>
      <h5 class="admin-card-title">Daftar Kategori Produk Landing Page</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Total {{ $categories->count() }} kategori terdaftar</span>
    </div>
    <div class="d-flex align-items-center flex-wrap gap-2">
      <!-- LIVE SEARCH INPUT -->
      <div class="position-relative">
        <input type="text" class="form-control form-control-sm search shadow-none" placeholder="Cari nama kategori..." style="width: 200px; border-radius: 20px; padding-left: 36px;">
        <i class="bi bi-search position-absolute top-50 translate-middle-y text-muted small" style="left: 14px; pointer-events: none;"></i>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle">
      <thead>
        <tr>
          <th style="width: 40px;">No</th>
          <th>Cover Gambar</th>
          <th class="sort cursor-pointer" data-sort="name">Nama Kategori <i class="bi bi-arrow-down-up small text-muted"></i></th>
          <th>Jumlah Produk</th>
          <th>Status Tampil</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody class="list">
        @forelse($categories as $category)
        <tr>
          <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
          <td>
            <img src="{{ asset($category->image ?? 'img/products/roti/Sobek pisang.jpg') }}" class="img-thumb-admin" alt="{{ $category->name }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 8px;">
          </td>
          <td>
            <div class="fw-bold text-dark name">{{ $category->name }}</div>
            <span class="text-muted small desc">{{ Str::limit($category->description, 55) }}</span>
          </td>
          <td><span class="badge bg-secondary">{{ $category->products_count }} Item</span></td>
          <td>
            @if($category->is_active)
              <span class="badge bg-success">Tampil</span>
            @else
              <span class="badge bg-danger">Disembunyikan</span>
            @endif
          </td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Kategori" data-bs-toggle="modal" data-bs-target="#modalEditKategori{{ $category->id }}">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete" title="Hapus Kategori" data-bs-toggle="modal" data-bs-target="#modalDeleteKategori{{ $category->id }}">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <!-- MODAL DELETE KATEGORI -->
        <div class="modal fade" id="modalDeleteKategori{{ $category->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-3">
              <div class="modal-body py-4">
                <div class="mb-3 text-danger">
                  <i class="bi bi-exclamation-triangle-fill display-4"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Hapus Kategori?</h5>
                <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus kategori <strong>"{{ $category->name }}"</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                <form action="{{ route('admin.kategori.destroy', $category->id) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <div class="d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-light btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3 fw-bold">Ya, Hapus</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- MODAL EDIT KATEGORI -->
        <div class="modal fade" id="modalEditKategori{{ $category->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
              <div class="modal-header bg-dark text-white py-3">
                <h5 class="modal-title fw-bold fs-6"><i class="bi bi-pencil-square me-1"></i> Edit Data Kategori</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-4">
                <form action="{{ route('admin.kategori.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Kategori</label>
                    <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                  </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Bootstrap Icon (Opsional)</label>
                    <input type="text" name="icon" class="form-control" value="{{ $category->icon }}" placeholder="bi-box-seam-fill">
                  </div>

                  <!-- UPLOAD COVER KATEGORI EDIT -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block">Ganti Foto Sampul Kategori (Opsional)</label>
                    <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
                      <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;">
                      <div class="upload-preview-container mt-1">
                        <img src="{{ asset($category->image ?? 'img/products/roti/Sobek pisang.jpg') }}" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 120px; object-fit: contain;">
                        <div class="mt-2"><span class="badge bg-secondary rounded-pill px-3 py-1">Klik untuk Ganti Foto</span></div>
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Deskripsi Singkat</label>
                    <textarea name="description" class="form-control" rows="2">{{ $category->description }}</textarea>
                  </div>

                  <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="catActive{{ $category->id }}" {{ $category->is_active ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold small" for="catActive{{ $category->id }}">Tampilkan Kategori di Landing Page</label>
                  </div>

                  <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Perubahan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @empty
        <tr>
          <td colspan="6" class="text-center py-5 text-muted">Belum ada kategori produk. Silakan tambah kategori baru.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- LIST.JS PAGINATION FOOTER -->
  <div class="admin-card-footer d-flex align-items-center justify-content-between flex-wrap gap-3 py-3 px-4 border-top bg-light">
    <div class="d-flex align-items-center gap-3 flex-wrap">
      <div class="d-flex align-items-center gap-2">
        <span class="small text-muted" style="font-size: 0.82rem;">Tampilkan:</span>
        <select class="form-select form-select-sm per-page-select" style="width: auto; border-radius: 20px;">
          <option value="10" selected>10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="all">Semua</option>
        </select>
        <span class="small text-muted" style="font-size: 0.82rem;">data</span>
      </div>
      <div class="small text-muted border-start ps-3 d-none d-sm-block">
        Menampilkan <span class="fw-bold text-dark cat-page-start">1</span> - <span class="fw-bold text-dark cat-page-end">10</span> dari <span class="fw-bold text-dark cat-page-total">{{ $categories->count() }}</span> total data
      </div>
    </div>
    <ul class="pagination pagination-sm mb-0"></ul>
  </div>
</div>

<!-- MODAL TAMBAH KATEGORI BARU -->
<div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-danger text-white py-3">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-plus-circle me-1"></i> Tambah Kategori Produk Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('admin.kategori.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Kategori</label>
            <input type="text" name="name" class="form-control" placeholder="Contoh: Roti Sobek Spesial" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Bootstrap Icon (Opsional)</label>
            <input type="text" name="icon" class="form-control" placeholder="bi-box-seam-fill" value="bi-box-seam-fill">
          </div>

          <!-- UPLOAD COVER KATEGORI TAMBAH -->
          <div class="mb-3">
            <label class="form-label fw-semibold small d-block">Upload Foto Sampul Kategori (Wajib)</label>
            <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
              <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" required style="z-index: 10;">
              <div class="upload-placeholder-content">
                <i class="bi bi-cloud-arrow-up-fill fs-2 text-danger"></i>
                <div class="fw-bold small text-dark mt-1">Klik atau Geser Foto ke Sini</div>
                <small class="text-muted d-block" style="font-size: 0.75rem;">Format JPG, PNG, WEBP (Maks 2MB)</small>
              </div>
              <div class="upload-preview-container mt-1 d-none">
                <img src="" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 120px; object-fit: contain;">
                <div class="mt-2"><span class="badge bg-danger rounded-pill px-3 py-1">Ganti Foto</span></div>
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label fw-semibold small">Deskripsi Singkat</label>
            <textarea name="description" class="form-control" rows="2" placeholder="Deskripsi kategori..."></textarea>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Live Image Preview Handler
  document.querySelectorAll('.img-upload-trigger').forEach(function (fileInput) {
    fileInput.addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
        const uploadBox = fileInput.closest('.product-upload-box');
        const placeholder = uploadBox.querySelector('.upload-placeholder-content');
        const previewContainer = uploadBox.querySelector('.upload-preview-container');
        const previewImg = uploadBox.querySelector('.preview-image-target');

        const reader = new FileReader();
        reader.onload = function (evt) {
          previewImg.src = evt.target.result;
          if (placeholder) placeholder.classList.add('d-none');
          if (previewContainer) previewContainer.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
      }
    });
  });

  // List.js Initialization for Admin Category Table
  if (document.getElementById('adminCategoryListApp')) {
    const categoryList = new List('adminCategoryListApp', {
      valueNames: ['name', 'desc'],
      page: 10,
      pagination: {
        innerWindow: 2,
        left: 0,
        right: 0,
        paginationClass: 'pagination'
      }
    });

    const updatePageInfo = () => {
      const total = categoryList.matchingItems.length;
      const page = categoryList.page;
      const i = categoryList.i;
      const start = total === 0 ? 0 : i;
      const end = Math.min(i + page - 1, total);

      document.querySelectorAll('.cat-page-start').forEach(el => el.textContent = start);
      document.querySelectorAll('.cat-page-end').forEach(el => el.textContent = end);
      document.querySelectorAll('.cat-page-total').forEach(el => el.textContent = total);
    };

    categoryList.on('updated', updatePageInfo);
    updatePageInfo();

    document.querySelectorAll('.per-page-select').forEach(select => {
      select.addEventListener('change', function () {
        const val = this.value;
        if (val === 'all') {
          categoryList.page = 10000;
        } else {
          categoryList.page = parseInt(val, 10);
        }
        categoryList.update();
      });
    });
  }
});
</script>
@endpush
@endsection
