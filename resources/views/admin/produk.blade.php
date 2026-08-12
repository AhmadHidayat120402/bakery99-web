@extends('admin.layouts.admin')

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

<!-- DATATABLE ITEM PRODUK -->
<div class="admin-card">
  <div class="admin-card-header">
    <div>
      <h5 class="admin-card-title">Katalog Roti & Kue Landing Page</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Daftar item roti yang dipajang di katalog beranda publik (Total {{ $products->count() }} item)</span>
    </div>
    <div class="d-flex align-items-center gap-2">
      <label class="small text-muted d-none d-sm-inline">Filter Kategori:</label>
      <form action="{{ route('admin.produk') }}" method="GET" id="filterCategoryForm">
        <select name="category_id" class="form-select form-select-sm" style="width: auto; border-radius: 20px;" onchange="document.getElementById('filterCategoryForm').submit();">
          <option value="all" {{ request('category_id') == 'all' ? 'selected' : '' }}>Semua Kategori</option>
          @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
          @endforeach
        </select>
      </form>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle">
      <thead>
        <tr>
          <th style="width: 40px;">No</th>
          <th>Foto Roti</th>
          <th>Nama Produk</th>
          <th>Kategori</th>
          <th>Harga Landing Page</th>
          <th>Badge Promo</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($products as $product)
        <tr>
          <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
          <td>
            <img src="{{ asset($product->image) }}" class="img-thumb-admin" alt="{{ $product->name }}" style="width: 54px; height: 54px; object-fit: cover; border-radius: 8px;">
          </td>
          <td>
            <div class="fw-bold text-dark">{{ $product->name }}</div>
            <span class="text-muted" style="font-size: 0.78rem;">{{ Str::limit($product->description, 45) }}</span>
          </td>
          <td><span class="badge bg-light text-dark border">{{ $product->category->name ?? 'Uncategorized' }}</span></td>
          <td class="fw-bold text-danger">Rp {{ number_format($product->price, 0, ',', '.') }} <span class="text-muted fw-normal fs-7">/ {{ $product->unit }}</span></td>
          <td>
            @if($product->badge)
              <span class="badge px-2.5 py-1 rounded-pill fw-bold shadow-sm" style="background-color: {{ $product->badge->bg_color }}; color: {{ $product->badge->text_color }}; font-size: 0.75rem;">
                {{ $product->badge->name }}
              </span>
            @else
              <span class="badge bg-secondary">Tanpa Badge</span>
            @endif
          </td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Item Produk" data-bs-toggle="modal" data-bs-target="#modalEditProduk{{ $product->id }}">
              <i class="bi bi-pencil-square"></i>
            </button>
            <form action="{{ route('admin.produk.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk {{ $product->name }}?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-action-icon btn-action-delete" title="Hapus">
                <i class="bi bi-trash text-danger"></i>
              </button>
            </form>
          </td>
        </tr>

        <!-- MODAL EDIT PRODUK -->
        <div class="modal fade" id="modalEditProduk{{ $product->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
              <div class="modal-header bg-dark text-white py-3">
                <h5 class="modal-title fw-bold fs-6"><i class="bi bi-pencil-square me-1"></i> Edit Data Produk</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-4">
                <form action="{{ route('admin.produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Produk</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                  </div>
                  <div class="row g-2 mb-3">
                    <div class="col-6">
                      <label class="form-label fw-semibold small">Kategori</label>
                      <select name="product_category_id" class="form-select" required>
                        @foreach($categories as $cat)
                          <option value="{{ $cat->id }}" {{ $product->product_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-6">
                      <label class="form-label fw-semibold small">Harga (Rp)</label>
                      <div class="input-group">
                        <span class="input-group-text bg-light fw-bold text-danger border-end-0">Rp</span>
                        <input type="text" name="price" class="form-control rupiah-format-input border-start-0" value="{{ number_format($product->price, 0, ',', '.') }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row g-2 mb-3">
                    <div class="col-6">
                      <label class="form-label fw-semibold small">Satuan</label>
                      <input type="text" name="unit" class="form-control" value="{{ $product->unit }}">
                    </div>
                    <div class="col-6">
                      <label class="form-label fw-semibold small">Badge Promo</label>
                      <select name="product_badge_id" class="form-select">
                        <option value="">Tanpa Badge</option>
                        @foreach($badges as $b)
                          <option value="{{ $b->id }}" {{ $product->product_badge_id == $b->id ? 'selected' : '' }}>{{ $b->name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  
                  <!-- UPLOAD FOTO WITH LIVE PREVIEW EDIT -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block">Foto Produk</label>
                    <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
                      <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;">
                      <div class="upload-placeholder-content d-none">
                        <i class="bi bi-cloud-arrow-up-fill fs-2 text-danger"></i>
                        <div class="fw-bold small text-dark mt-1">Klik atau Geser Foto ke Sini</div>
                        <small class="text-muted d-block" style="font-size: 0.75rem;">Format JPG, PNG, WEBP (Max 2MB)</small>
                      </div>
                      <div class="upload-preview-container mt-1">
                        <img src="{{ asset($product->image) }}" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 120px; object-fit: contain;">
                        <div class="mt-2"><span class="badge bg-secondary rounded-pill px-3 py-1">Klik untuk Ganti Foto</span></div>
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Deskripsi Singkat</label>
                    <textarea name="description" class="form-control" rows="2">{{ $product->description }}</textarea>
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
        @empty
        <tr>
          <td colspan="7" class="text-center py-4 text-muted">Belum ada produk terdaftar.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH PRODUK -->
<div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-danger text-white py-3">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-plus-circle me-1"></i> Tambah Produk Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Produk</label>
            <input type="text" name="name" class="form-control" placeholder="Contoh: Bolen Pisang Coklat Premium" required>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Kategori</label>
              <select name="product_category_id" class="form-select" required>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Harga (Rp)</label>
              <div class="input-group">
                <span class="input-group-text bg-light fw-bold text-danger border-end-0">Rp</span>
                <input type="text" name="price" class="form-control rupiah-format-input border-start-0" placeholder="15.000" required>
              </div>
            </div>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Satuan (opsional)</label>
              <input type="text" name="unit" class="form-control" placeholder="box / pcs / loyang" value="pcs">
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Badge Promo</label>
              <select name="product_badge_id" class="form-select">
                <option value="">Tanpa Badge</option>
                @foreach($badges as $b)
                  <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
          
          <!-- UPLOAD FOTO WITH LIVE PREVIEW TAMBAH -->
          <div class="mb-3">
            <label class="form-label fw-semibold small d-block">Upload Foto Produk</label>
            <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
              <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;">
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

          <div class="mb-3">
            <label class="form-label fw-semibold small">Deskripsi Singkat</label>
            <textarea name="description" class="form-control" rows="2" placeholder="Deskripsi singkat produk..."></textarea>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // 1. Live Thousands Auto-Formatting for Price Input (Rupiah)
  document.querySelectorAll('.rupiah-format-input').forEach(function (input) {
    input.addEventListener('input', function (e) {
      let value = this.value.replace(/[^0-9]/g, '');
      if (value) {
        this.value = new Intl.NumberFormat('id-ID').format(value);
      } else {
        this.value = '';
      }
    });
  });

  // 2. Live Image Preview for Product Upload Box
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
});
</script>
@endpush
@endsection
