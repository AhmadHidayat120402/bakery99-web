@extends('admin.layouts.admin')

@section('title', 'Kelola Banner Carousel Hero - CMS 99 Bakery')

@push('styles')
<style>
.drag-handle-cell {
  cursor: grab;
  user-select: none;
  width: 60px;
  text-align: center;
}
.drag-handle-cell .drag-icon {
  display: none;
}
tr:hover .drag-handle-cell .row-number {
  display: none !important;
}
tr:hover .drag-handle-cell .drag-icon {
  display: inline-block !important;
}
tr.sortable-ghost {
  opacity: 0.4;
  background-color: #ffebee !important;
}
</style>
@endpush

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Banner Carousel Hero</h1>
    <p class="page-subtitle-text">Atur foto slide carousel & teks badge promo pada jumbotron beranda publik. Arahkan kursor pada angka urutan untuk menggeser baris.</p>
  </div>
  <div>
    <button class="btn-99-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBanner">
      <i class="bi bi-plus-lg"></i> Tambah Banner Baru
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

<!-- BANNERS TABLE CARD -->
<div class="admin-card">
  <div class="admin-card-header d-flex align-items-center justify-content-between">
    <div>
      <h5 class="admin-card-title">Daftar Slide Banner Jumbotron</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Total {{ $banners->count() }} slide banner terdaftar (Arahkan kursor ke nomor untuk geser)</span>
    </div>
    <span class="badge bg-light text-muted border px-3 py-1.5 rounded-pill"><i class="bi bi-arrows-move me-1"></i> Hover nomor untuk geser urutan</span>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle mb-0">
      <thead>
        <tr>
          <th style="width: 60px;" class="text-center">#</th>
          <th>Foto Banner</th>
          <th>Teks Badge Promo</th>
          <th style="width: 80px;">Urutan</th>
          <th>Status</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody id="sortableBannerList">
        @forelse($banners as $banner)
        <tr data-id="{{ $banner->id }}">
          <td class="drag-handle-cell drag-handle" title="Arahkan kursor & geser untuk mengubah urutan slide">
            <span class="fw-bold text-dark row-number">{{ $loop->iteration }}</span>
            <i class="bi bi-list fs-4 text-danger drag-icon"></i>
          </td>
          <td>
            <img src="{{ asset($banner->image) }}" class="img-thumb-admin shadow-sm" alt="{{ $banner->badge_text }}" style="width: 95px; height: 55px; object-fit: cover; border-radius: 8px;">
          </td>
          <td>
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 rounded-pill fw-bold" style="font-size: 0.82rem;">
              <i class="bi bi-star-fill text-warning me-1"></i> {{ $banner->badge_text }}
            </span>
          </td>
          <td><span class="badge bg-secondary badge-urutan">#{{ $banner->sort_order }}</span></td>
          <td>
            @if($banner->is_active)
              <span class="badge bg-success">Tampil</span>
            @else
              <span class="badge bg-danger">Disembunyikan</span>
            @endif
          </td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Banner" data-bs-toggle="modal" data-bs-target="#modalEditBanner{{ $banner->id }}">
              <i class="bi bi-pencil-square"></i>
            </button>
            <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus slide {{ $banner->badge_text }}?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-action-icon btn-action-delete" title="Hapus">
                <i class="bi bi-trash text-danger"></i>
              </button>
            </form>
          </td>
        </tr>

        <!-- MODAL EDIT BANNER -->
        <div class="modal fade" id="modalEditBanner{{ $banner->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
              <div class="modal-header bg-dark text-white py-3">
                <h5 class="modal-title fw-bold fs-6"><i class="bi bi-pencil-square me-1"></i> Edit Slide Banner</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-4">
                <form action="{{ route('admin.banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  
                  <div class="row g-2 mb-3">
                    <div class="col-8">
                      <label class="form-label fw-semibold small">Teks Badge Promo <span class="text-danger">*</span></label>
                      <input type="text" name="badge_text" class="form-control" value="{{ $banner->badge_text }}" placeholder="Contoh: BEST SELLER HAJATAN" required>
                    </div>
                    <div class="col-4">
                      <label class="form-label fw-semibold small">Urutan Tampil</label>
                      <input type="number" name="sort_order" class="form-control" value="{{ $banner->sort_order }}">
                    </div>
                  </div>

                  <!-- UPLOAD GAMBAR BANNER WITH LIVE PREVIEW (EDIT) -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block">Ganti Gambar Banner (Opsional)</label>
                    <div class="banner-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
                      <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;">
                      <div class="upload-placeholder-content d-none">
                        <i class="bi bi-cloud-arrow-up-fill fs-2 text-danger"></i>
                        <div class="fw-bold small text-dark mt-1">Klik atau Geser Foto ke Sini</div>
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Format JPG, PNG, WEBP (Maks 10MB)</small>
                      </div>
                      <div class="upload-preview-container mt-1">
                        <img src="{{ asset($banner->image) }}" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 160px; object-fit: contain;">
                        <div class="mt-2"><span class="badge bg-secondary rounded-pill px-3 py-1">Klik untuk Ganti Foto Banner</span></div>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark btn-sm rounded-pill">Update Banner</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @empty
        <tr>
          <td colspan="6" class="text-center py-4 text-muted">Belum ada slide banner terdaftar.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH BANNER -->
<div class="modal fade" id="modalTambahBanner" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-danger text-white py-3">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-plus-circle me-1"></i> Tambah Banner Carousel Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          
          <div class="row g-2 mb-3">
            <div class="col-8">
              <label class="form-label fw-semibold small">Teks Badge Promo <span class="text-danger">*</span></label>
              <input type="text" name="badge_text" class="form-control" placeholder="Contoh: BEST SELLER HAJATAN" required>
            </div>
            <div class="col-4">
              <label class="form-label fw-semibold small">Urutan Tampil</label>
              <input type="number" name="sort_order" class="form-control" value="{{ $banners->count() + 1 }}">
            </div>
          </div>

          <!-- UPLOAD GAMBAR BANNER WITH LIVE PREVIEW (WAJIB/REQUIRED) -->
          <div class="mb-3">
            <label class="form-label fw-semibold small d-block">Upload Gambar Banner <span class="text-danger">*</span></label>
            <div class="banner-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
              <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;" required>
              <div class="upload-placeholder-content">
                <i class="bi bi-cloud-arrow-up-fill fs-2 text-danger"></i>
                <div class="fw-bold small text-dark mt-1">Klik atau Geser Foto ke Sini</div>
                <small class="text-muted d-block" style="font-size: 0.75rem;">Format JPG, PNG, WEBP (Otomatis Kompresi WebP HD)</small>
              </div>
              <div class="upload-preview-container mt-1 d-none">
                <img src="" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 160px; object-fit: contain;">
                <div class="mt-2"><span class="badge bg-danger rounded-pill px-3 py-1">Ganti Foto</span></div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Banner</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  // 1. Live Image Preview for Banner Upload Box
  document.querySelectorAll('.img-upload-trigger').forEach(function (fileInput) {
    fileInput.addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file) {
        const uploadBox = fileInput.closest('.banner-upload-box');
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

  // 2. Drag & Drop Reordering via SortableJS
  const sortableList = document.getElementById('sortableBannerList');
  if (sortableList) {
    new Sortable(sortableList, {
      handle: '.drag-handle',
      animation: 150,
      ghostClass: 'sortable-ghost',
      onEnd: function () {
        const orders = [];
        document.querySelectorAll('#sortableBannerList tr[data-id]').forEach(function (row, index) {
          const newIndex = index + 1;
          row.querySelector('.row-number').textContent = newIndex;
          const badgeUrutan = row.querySelector('.badge-urutan');
          if (badgeUrutan) badgeUrutan.textContent = '#' + newIndex;

          orders.push({
            id: row.getAttribute('data-id'),
            sort_order: newIndex
          });
        });

        // Send AJAX request to reorder in database
        fetch("{{ route('admin.banner.reorder') }}", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
          },
          body: JSON.stringify({ orders: orders })
        })
        .then(response => response.json())
        .then(data => {
          console.log("Urutan slide berhasil disimpan:", data);
        })
        .catch(error => {
          console.error("Gagal menyimpan urutan:", error);
        });
      }
    });
  }
});
</script>
@endpush
@endsection
