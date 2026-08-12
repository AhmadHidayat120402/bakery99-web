@extends('admin.layouts.admin')

@section('title', 'Kelola Kategori Produk - CMS 99 Bakery')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Kategori Produk</h1>
    <p class="page-subtitle-text">Atur nama kategori, foto cover/banner kategori, deskripsi, dan urutan kartu pada landing page.</p>
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

<!-- CATEGORIES TABLE CARD -->
<div class="admin-card">
  <div class="admin-card-header">
    <div>
      <h5 class="admin-card-title">Daftar Kategori Produk Landing Page</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Total {{ $categories->count() }} kategori terdaftar</span>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle">
      <thead>
        <tr>
          <th style="width: 40px;">No</th>
          <th>Cover Gambar</th>
          <th>Nama Kategori</th>
          <th>Jumlah Produk</th>
          <th>Status Tampil</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categories as $category)
        <tr>
          <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
          <td>
            <img src="{{ asset($category->image ?? 'img/products/roti/Sobek pisang.jpg') }}" class="img-thumb-admin" alt="{{ $category->name }}" style="width: 60px; height: 40px; object-fit: cover; border-radius: 8px;">
          </td>
          <td>
            <div class="fw-bold text-dark">{{ $category->name }}</div>
            <span class="text-muted small">{{ Str::limit($category->description, 55) }}</span>
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
            <form action="{{ route('admin.kategori.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori {{ $category->name }}?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-action-icon btn-action-delete" title="Hapus">
                <i class="bi bi-trash text-danger"></i>
              </button>
            </form>
          </td>
        </tr>

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
                    <label class="form-label fw-semibold small">Deskripsi Singkat Kategori</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi singkat kategori...">{{ $category->description }}</textarea>
                  </div>
                  
                  <!-- UPLOAD FOTO COVER KATEGORI WITH LIVE PREVIEW (EDIT) -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block">Ganti Foto Cover Kategori (Opsional)</label>
                    <div class="category-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
                      <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;">
                      <div class="upload-placeholder-content d-none">
                        <i class="bi bi-cloud-arrow-up-fill fs-2 text-danger"></i>
                        <div class="fw-bold small text-dark mt-1">Klik atau Geser Foto ke Sini</div>
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Format JPG, PNG, WEBP (Maks 2MB)</small>
                      </div>
                      <div class="upload-preview-container mt-1">
                        <img src="{{ asset($category->image ?? 'img/products/roti/Sobek pisang.jpg') }}" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 140px; object-fit: contain;">
                        <div class="mt-2"><span class="badge bg-secondary rounded-pill px-3 py-1">Klik untuk Ganti Foto</span></div>
                      </div>
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
        @empty
        <tr>
          <td colspan="6" class="text-center py-4 text-muted">Belum ada kategori produk. Sila tambahkan kategori baru.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH KATEGORI -->
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
            <label class="form-label fw-semibold small">Nama Kategori <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control" placeholder="Contoh: Donat & Dessert" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Deskripsi Singkat Kategori</label>
            <textarea name="description" class="form-control" rows="3" placeholder="Contoh: Donat kentang glaze assorted & dessert box red velvet."></textarea>
          </div>

          <!-- UPLOAD FOTO COVER KATEGORI WITH LIVE PREVIEW (WAJIB/REQUIRED) -->
          <div class="mb-3">
            <label class="form-label fw-semibold small d-block">Upload Foto Cover Kategori <span class="text-danger">*</span></label>
            <div class="category-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
              <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;" required>
              <div class="upload-placeholder-content">
                <i class="bi bi-cloud-arrow-up-fill fs-2 text-danger"></i>
                <div class="fw-bold small text-dark mt-1">Klik atau Geser Foto ke Sini</div>
                <small class="text-muted d-block" style="font-size: 0.75rem;">Format JPG, PNG, WEBP (Maks 2MB)</small>
              </div>
              <div class="upload-preview-container mt-1 d-none">
                <img src="" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 140px; object-fit: contain;">
                <div class="mt-2"><span class="badge bg-danger rounded-pill px-3 py-1">Ganti Foto</span></div>
              </div>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Live Image Preview for Category Upload Box
  document.querySelectorAll('.img-upload-trigger').forEach(function (fileInput) {
    fileInput.addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
        const uploadBox = fileInput.closest('.category-upload-box');
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
});
</script>
@endpush
@endsection
