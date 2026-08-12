@extends('admin.layouts.admin')

@section('title', 'Kelola Hero Carousel Banner - CMS 99 Bakery')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Hero Carousel Banner</h1>
    <p class="page-subtitle-text">Atur foto slider carousel pada bagian kanan jumbotron utama lengkap dengan teks badge promo & fitur drag & drop urutan.</p>
  </div>
  <div>
    <button class="btn-99-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBanner">
      <i class="bi bi-plus-lg"></i> Tambah Slide Banner
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
<div class="admin-card" id="adminBannerListApp">
  <div class="admin-card-header flex-wrap gap-2">
    <div>
      <h5 class="admin-card-title">Daftar Slide Banner Jumbotron</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Total {{ $banners->count() }} slide banner terdaftar (Arahkan kursor ke nomor untuk geser)</span>
    </div>
    <div class="d-flex align-items-center flex-wrap gap-2">
      <!-- LIVE SEARCH INPUT -->
      <div class="position-relative">
        <input type="text" class="form-control form-control-sm search shadow-none" placeholder="Cari teks badge..." style="width: 200px; border-radius: 20px; padding-left: 36px;">
        <i class="bi bi-search position-absolute top-50 translate-middle-y text-muted small" style="left: 14px; pointer-events: none;"></i>
      </div>

      <span class="badge bg-light text-muted border px-3 py-1.5 rounded-pill"><i class="bi bi-arrows-move me-1"></i> Hover nomor untuk geser</span>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle mb-0">
      <thead>
        <tr>
          <th style="width: 60px;" class="text-center">#</th>
          <th>Foto Banner</th>
          <th class="sort cursor-pointer" data-sort="badge-text">Teks Badge Promo <i class="bi bi-arrow-down-up small text-muted"></i></th>
          <th style="width: 80px;">Urutan</th>
          <th>Status</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody id="sortableBannerList" class="list">
        @forelse($banners as $banner)
        <tr data-id="{{ $banner->id }}">
          <td class="drag-handle-cell drag-handle text-center" title="Arahkan kursor & geser untuk mengubah urutan slide">
            <span class="fw-bold text-dark row-number">{{ $loop->iteration }}</span>
            <i class="bi bi-list fs-4 text-danger drag-icon"></i>
          </td>
          <td>
            <img src="{{ asset($banner->image) }}" class="img-thumb-admin shadow-sm" alt="{{ $banner->badge_text }}" style="width: 95px; height: 55px; object-fit: cover; border-radius: 8px;">
          </td>
          <td>
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1.5 rounded-pill fw-bold badge-text" style="font-size: 0.82rem;">
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
            <button class="btn-action-icon btn-action-delete" title="Hapus Banner" data-bs-toggle="modal" data-bs-target="#modalDeleteBanner{{ $banner->id }}">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <!-- MODAL DELETE BANNER -->
        <div class="modal fade" id="modalDeleteBanner{{ $banner->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-3">
              <div class="modal-body py-4">
                <div class="mb-3 text-danger">
                  <i class="bi bi-exclamation-triangle-fill display-4"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Hapus Slide Banner?</h5>
                <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus slide <strong>"{{ $banner->badge_text }}"</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                <form action="{{ route('admin.banner.destroy', $banner->id) }}" method="POST">
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

                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Teks Badge Promo (Wajib)</label>
                    <input type="text" name="badge_text" class="form-control" value="{{ $banner->badge_text }}" placeholder="Contoh: ⭐ BEST SELLER HAJATAN" required>
                  </div>

                  <!-- UPLOAD FOTO WITH LIVE PREVIEW EDIT -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block">Ganti Foto Banner Carousel (Opsional)</label>
                    <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
                      <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;">
                      <div class="upload-preview-container mt-1">
                        <img src="{{ asset($banner->image) }}" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 140px; object-fit: contain;">
                        <div class="mt-2"><span class="badge bg-secondary rounded-pill px-3 py-1">Klik untuk Ganti Foto</span></div>
                      </div>
                    </div>
                  </div>

                  <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="bannerActive{{ $banner->id }}" {{ $banner->is_active ? 'checked' : '' }}>
                    <label class="form-check-label fw-semibold small" for="bannerActive{{ $banner->id }}">Tampilkan Slide ini di Hero Carousel</label>
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
          <td colspan="6" class="text-center py-5 text-muted">Belum ada slide banner. Silakan tambah banner baru.</td>
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
        Menampilkan <span class="fw-bold text-dark banner-page-start">1</span> - <span class="fw-bold text-dark banner-page-end">10</span> dari <span class="fw-bold text-dark banner-page-total">{{ $banners->count() }}</span> total data
      </div>
    </div>
    <ul class="pagination pagination-sm mb-0"></ul>
  </div>
</div>

<!-- MODAL TAMBAH BANNER BARU -->
<div class="modal fade" id="modalTambahBanner" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-danger text-white py-3">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-plus-circle me-1"></i> Tambah Slide Banner Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('admin.banner.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          
          <div class="mb-3">
            <label class="form-label fw-semibold small">Teks Badge Promo (Wajib)</label>
            <input type="text" name="badge_text" class="form-control" placeholder="Contoh: ⭐ BEST SELLER HAJATAN" required>
            <small class="text-muted" style="font-size: 0.75rem;">Teks ini akan tampil di atas gambar slider carousel.</small>
          </div>

          <!-- UPLOAD FOTO WITH LIVE PREVIEW TAMBAH -->
          <div class="mb-3">
            <label class="form-label fw-semibold small d-block">Upload Gambar Banner Carousel (Wajib)</label>
            <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
              <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" required style="z-index: 10;">
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
            <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Slide Banner</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
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

  // SortableJS for Drag and Drop Reordering
  const sortableEl = document.getElementById('sortableBannerList');
  if (sortableEl) {
    Sortable.create(sortableEl, {
      handle: '.drag-handle',
      animation: 150,
      onEnd: function () {
        const orders = [];
        $('#sortableBannerList tr').each(function (index) {
          const bannerId = $(this).data('id');
          $(this).find('.badge-urutan').text('#' + (index + 1));
          $(this).find('.row-number').text(index + 1);
          orders.push({ id: bannerId, sort_order: index + 1 });
        });

        $.ajax({
          url: "{{ route('admin.banner.reorder') }}",
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            orders: orders
          },
          success: function (res) {
            console.log("Banner order updated successfully");
          }
        });
      }
    });
  }

  // List.js Initialization for Admin Banner Table
  if (document.getElementById('adminBannerListApp')) {
    const bannerList = new List('adminBannerListApp', {
      valueNames: ['badge-text'],
      page: 10,
      pagination: {
        innerWindow: 2,
        left: 0,
        right: 0,
        paginationClass: 'pagination'
      }
    });

    const updatePageInfo = () => {
      const total = bannerList.matchingItems.length;
      const page = bannerList.page;
      const i = bannerList.i;
      const start = total === 0 ? 0 : i;
      const end = Math.min(i + page - 1, total);

      document.querySelectorAll('.banner-page-start').forEach(el => el.textContent = start);
      document.querySelectorAll('.banner-page-end').forEach(el => el.textContent = end);
      document.querySelectorAll('.banner-page-total').forEach(el => el.textContent = total);
    };

    bannerList.on('updated', updatePageInfo);
    updatePageInfo();

    document.querySelectorAll('.per-page-select').forEach(select => {
      select.addEventListener('change', function () {
        const val = this.value;
        if (val === 'all') {
          bannerList.page = 10000;
        } else {
          bannerList.page = parseInt(val, 10);
        }
        bannerList.update();
      });
    });
  }
});
</script>
@endpush
@endsection
