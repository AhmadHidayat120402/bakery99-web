@extends('admin.layouts.admin')

@section('title', 'Kelola Item Produk Landing Page - CMS 99 Bakery')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Item Produk Landing Page</h1>
    <p class="page-subtitle-text">Tambah roti baru, ubah harga, upload foto dengan preview live, dan atur produk unggulan di beranda.</p>
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
<div class="admin-card" id="adminProductListApp">
  <div class="admin-card-header flex-wrap gap-2">
    <div>
      <h5 class="admin-card-title">Katalog Roti & Kue Landing Page</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Daftar item produk yang dipajang di katalog produk (Total {{ $products->count() }} item)</span>
    </div>
    <div class="d-flex align-items-center flex-wrap gap-2">
      <!-- BUTTON MODAL TABEL PRODUK UNGGULAN -->
      <button type="button" class="btn btn-sm btn-outline-warning text-dark border-warning rounded-pill px-3 py-1.5 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalFeaturedProductsTable" id="btnOpenFeaturedTableModal">
        <i class="bi bi-star-fill text-warning me-1"></i> Produk Unggulan: <span id="featuredCountBadgeText">{{ $featuredProducts->count() }}</span>/8 Slot
      </button>

      <!-- LIVE SEARCH INPUT -->
      <div class="position-relative">
        <input type="text" class="form-control form-control-sm search shadow-none" placeholder="Cari nama / deskripsi..." style="width: 200px; border-radius: 20px; padding-left: 36px;">
        <i class="bi bi-search position-absolute top-50 translate-middle-y text-muted small" style="left: 14px; pointer-events: none;"></i>
      </div>

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
          <th class="sort cursor-pointer" data-sort="name">Nama Produk <i class="bi bi-arrow-down-up small text-muted"></i></th>
          <th class="sort cursor-pointer" data-sort="category">Kategori <i class="bi bi-arrow-down-up small text-muted"></i></th>
          <th class="sort cursor-pointer" data-sort="price">Harga <i class="bi bi-arrow-down-up small text-muted"></i></th>
          <th>Badge Promo</th>
          <th class="text-center" style="width: 100px;">Unggulan</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody class="list">
        @forelse($products as $product)
        <tr id="productRow{{ $product->id }}">
          <td class="fw-bold text-muted row-number">{{ $loop->iteration }}</td>
          <td>
            <img src="{{ asset($product->image) }}" class="img-thumb-admin" alt="{{ $product->name }}" style="width: 54px; height: 54px; object-fit: cover; border-radius: 8px;">
          </td>
          <td>
            <div class="fw-bold text-dark d-flex align-items-center gap-2">
              <span class="product-name-text name">{{ $product->name }}</span>
{{--              <span class="badge bg-warning-subtle text-dark border border-warning px-2 py-0.5 rounded-pill fw-bold featured-badge-inline {{ $product->is_popular ? '' : 'd-none' }}" style="font-size: 0.7rem;" title="Tampil di Seksi Produk Unggulan Beranda">--}}
{{--                <i class="bi bi-star-fill text-warning me-1"></i> Unggulan--}}
{{--              </span>--}}
            </div>
            <span class="text-muted desc" style="font-size: 0.78rem;">{{ Str::limit($product->description, 45) }}</span>
          </td>
          <td><span class="badge bg-light text-dark border category">{{ $product->category->name ?? 'Uncategorized' }}</span></td>
          <td class="fw-bold text-danger price">Rp {{ number_format($product->price, 0, ',', '.') }} <span class="text-muted fw-normal fs-7">/ {{ $product->unit }}</span></td>
          <td>
            @if($product->badge)
              <span class="badge px-2.5 py-1 rounded-pill fw-bold shadow-sm" style="background-color: {{ $product->badge->bg_color }}; color: {{ $product->badge->text_color }}; font-size: 0.75rem;">
                @if($product->badge->icon)<i class="{{ $product->badge->icon }} me-1"></i>@endif{{ $product->badge->name }}
              </span>
            @else
              <span class="badge bg-secondary">Tanpa Badge</span>
            @endif
          </td>
          <!-- CENTANG UNGGULAN DIRECT TABEL -->
          <td class="text-center">
            <div class="form-check form-switch d-inline-block">
              <input class="form-check-input table-featured-checkbox cursor-pointer" type="checkbox" role="switch" data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}" {{ $product->is_popular ? 'checked' : '' }} title="Klik centang untuk atur status Produk Unggulan Beranda">
            </div>
          </td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Item Produk" data-bs-toggle="modal" data-bs-target="#modalEditProduk{{ $product->id }}">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete" title="Hapus Produk" data-bs-toggle="modal" data-bs-target="#modalDeleteProduk{{ $product->id }}">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <!-- MODAL DELETE PRODUK -->
        <div class="modal fade" id="modalDeleteProduk{{ $product->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-3">
              <div class="modal-body py-4">
                <div class="mb-3 text-danger">
                  <i class="bi bi-exclamation-triangle-fill display-4"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Hapus Produk?</h5>
                <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus produk <strong>"{{ $product->name }}"</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                <form action="{{ route('admin.produk.destroy', $product->id) }}" method="POST">
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
                      <label class="form-label fw-semibold small">Harga Landing Page</label>
                      <div class="input-group">
                        <span class="input-group-text bg-light text-muted small">Rp</span>
                        <input type="text" name="price" class="form-control rupiah-format-input" value="{{ number_format($product->price, 0, ',', '.') }}" required>
                      </div>
                    </div>
                  </div>
                  <div class="row g-2 mb-3">
                    <div class="col-6">
                      <label class="form-label fw-semibold small">Satuan</label>
                      <input type="text" name="unit" class="form-control" value="{{ $product->unit }}" placeholder="box / pcs / loyang">
                    </div>
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block mb-1">Badge Promo (Opsional)</label>
                    <input type="hidden" name="product_badge_id" class="input-badge-edit-{{ $product->id }}" value="{{ $product->product_badge_id }}">
                    <div class="d-flex flex-wrap gap-2 mb-2">
                      <button type="button" 
                              class="btn btn-sm rounded-pill badge-picker-pill btn-badge-picker-edit-{{ $product->id }} {{ empty($product->product_badge_id) ? 'btn-dark text-white active shadow-sm' : 'btn-outline-secondary' }}" 
                              data-badge-id=""
                              data-bg=""
                              data-text=""
                              data-name="(Tanpa Badge)">
                        (Tanpa Badge)
                        <i class="bi bi-check-circle-fill ms-1 check-icon {{ empty($product->product_badge_id) ? '' : 'd-none' }}"></i>
                      </button>
                      @foreach($badges as $b)
                        @php
                          $isSelected = ($product->product_badge_id == $b->id);
                          $darkColor = (strtolower($b->text_color) == '#ffffff') ? $b->bg_color : $b->text_color;
                        @endphp
                        <button type="button" 
                                class="btn btn-sm rounded-pill badge-picker-pill btn-badge-picker-edit-{{ $product->id }} {{ $isSelected ? 'active' : '' }}" 
                                data-badge-id="{{ $b->id }}" 
                                data-bg="{{ $b->bg_color }}" 
                                data-text="{{ $b->text_color }}"
                                data-dark-color="{{ $darkColor }}"
                                data-name="{{ $b->name }}"
                                data-icon="{{ $b->icon }}"
                                style="background-color: {{ $isSelected ? $b->bg_color : 'transparent' }}; color: {{ $isSelected ? $b->text_color : $darkColor }}; border: 1px solid {{ $darkColor }}; font-weight: 600;">
                          @if($b->icon)<i class="{{ $b->icon }} me-1"></i>@endif{{ $b->name }}
                          <i class="bi bi-check-circle-fill ms-1 check-icon {{ $isSelected ? '' : 'd-none' }}"></i>
                        </button>
                      @endforeach
                    </div>

                    <!-- LIVE PREVIEW BADGE TERPILIH EDIT -->
                    <div class="p-2 px-3 bg-light rounded-3 border text-center">
                      <span class="small text-muted me-2" style="font-size: 0.78rem;">Badge Terpilih:</span>
                      <span class="preview-badge-selected-edit-{{ $product->id }}">
                        @if($product->badge)
                          <span class="badge px-3 py-1 rounded-pill shadow-sm fw-bold" style="background-color: {{ $product->badge->bg_color }}; color: {{ $product->badge->text_color }}; font-size: 0.78rem;">
                            @if($product->badge->icon)<i class="{{ $product->badge->icon }} me-1"></i>@endif{{ $product->badge->name }}
                          </span>
                        @else
                          <span class="badge bg-secondary rounded-pill px-3 py-1" style="font-size: 0.78rem;">Tanpa Badge</span>
                        @endif
                      </span>
                    </div>
                  </div>
                  </div>

                  <!-- UPLOAD FOTO WITH LIVE PREVIEW EDIT -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block">Ganti Foto Produk (Opsional)</label>
                    <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
                      <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;">
                      <div class="upload-preview-container mt-1">
                        <img src="{{ asset($product->image) }}" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 140px; object-fit: contain;">
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
                    <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Perubahan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @empty
        <tr>
          <td colspan="8" class="text-center py-5 text-muted">
            <i class="bi bi-box-seam fs-1 text-danger mb-2 d-block"></i>
            Belum ada item produk. Silakan tambah produk baru.
          </td>
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
        Menampilkan <span class="fw-bold text-dark product-page-start">1</span> - <span class="fw-bold text-dark product-page-end">10</span> dari <span class="fw-bold text-dark product-page-total">{{ $products->count() }}</span> total data
      </div>
    </div>
    <ul class="pagination pagination-sm mb-0"></ul>
  </div>
</div>

<!-- MODAL TAMBAH PRODUK BARU -->
<div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-danger text-white py-3">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-plus-circle me-1"></i> Tambah Item Produk Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Produk</label>
            <input type="text" name="name" class="form-control" placeholder="Contoh: Roti Sobek Keju" required>
          </div>

          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Kategori</label>
              <select name="product_category_id" class="form-select" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $cat)
                  <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Harga Landing Page</label>
              <div class="input-group">
                <span class="input-group-text bg-light text-muted small">Rp</span>
                <input type="text" name="price" class="form-control rupiah-format-input" placeholder="15.000" required>
              </div>
            </div>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Satuan</label>
              <input type="text" name="unit" class="form-control" placeholder="box / pcs / loyang" value="pcs">
            </div>
          <!-- BADGE PROMO PILL SELECTOR -->
          <div class="mb-3">
            <label class="form-label fw-semibold small d-block mb-1">Badge Promo (Opsional)</label>
            <input type="hidden" name="product_badge_id" id="inputBadgeCreate" value="">
            <div class="d-flex flex-wrap gap-2 mb-2">
              <button type="button" 
                      class="btn btn-sm btn-dark text-white rounded-pill badge-picker-pill btn-badge-picker-create active shadow-sm" 
                      data-badge-id=""
                      data-bg=""
                      data-text=""
                      data-name="(Tanpa Badge)">
                (Tanpa Badge)
                <i class="bi bi-check-circle-fill ms-1 check-icon"></i>
              </button>
              @foreach($badges as $b)
                @php
                  $darkColor = (strtolower($b->text_color) == '#ffffff') ? $b->bg_color : $b->text_color;
                @endphp
                <button type="button" 
                        class="btn btn-sm rounded-pill badge-picker-pill btn-badge-picker-create" 
                        data-badge-id="{{ $b->id }}"
                        data-bg="{{ $b->bg_color }}"
                        data-text="{{ $b->text_color }}"
                        data-dark-color="{{ $darkColor }}"
                        data-name="{{ $b->name }}"
                        data-icon="{{ $b->icon }}"
                        style="border: 1px solid {{ $darkColor }}; color: {{ $darkColor }}; background-color: transparent; font-weight: 600;">
                  @if($b->icon)<i class="{{ $b->icon }} me-1"></i>@endif{{ $b->name }}
                  <i class="bi bi-check-circle-fill ms-1 check-icon d-none"></i>
                </button>
              @endforeach
            </div>

            <!-- LIVE PREVIEW BADGE TERPILIH CREATE -->
            <div class="p-2 px-3 bg-light rounded-3 border text-center">
              <span class="small text-muted me-2" style="font-size: 0.78rem;">Badge Terpilih:</span>
              <span id="previewBadgeSelectedCreate">
                <span class="badge bg-secondary rounded-pill px-3 py-1" style="font-size: 0.78rem;">Tanpa Badge</span>
              </span>
            </div>
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

<!-- MODAL 1: TABEL PRODUK UNGGULAN (Daftar 8 Produk Unggulan Tampil) -->
<div class="modal fade" id="modalFeaturedProductsTable" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-warning text-dark py-3">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-star-fill text-warning me-1"></i> Kelola Daftar Produk Unggulan Beranda</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div class="alert alert-warning border border-warning bg-warning-subtle text-dark small rounded-3 mb-3">
          <i class="bi bi-info-circle-fill me-1"></i> Berikut adalah daftar produk yang saat ini <strong>ditampilkan di seksi Produk Unggulan Halaman Utama</strong> (Maksimal 8 produk).
        </div>

        <div class="table-responsive">
          <table class="table table-hover align-middle mb-0" style="font-size: 0.88rem;">
            <thead class="table-light">
              <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th class="text-end">Aksi</th>
              </tr>
            </thead>
            <tbody id="featuredModalTableBody">
              @forelse($featuredProducts as $fp)
              <tr id="featuredModalRow{{ $fp->id }}">
                <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
                <td>
                  <img src="{{ asset($fp->image) }}" style="width: 42px; height: 42px; object-fit: cover; border-radius: 6px;">
                </td>
                <td><span class="fw-bold text-dark">{{ $fp->name }}</span></td>
                <td><span class="badge bg-light text-dark border">{{ $fp->category->name ?? 'Aneka Roti' }}</span></td>
                <td class="fw-bold text-danger">Rp {{ number_format($fp->price, 0, ',', '.') }}</td>
                <td class="text-end">
                  <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 btn-remove-featured-modal" data-product-id="{{ $fp->id }}">
                    <i class="bi bi-x-circle me-1"></i> Lepas
                  </button>
                </td>
              </tr>
              @empty
              <tr id="featuredModalEmptyRow">
                <td colspan="6" class="text-center py-4 text-muted">Belum ada produk unggulan yang dipilih.</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer bg-light py-2.5">
        <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- MODAL 2: DIALOG TUKAR PRODUK UNGGULAN (Saat Kuota 8/8 Penuh) -->
<div class="modal fade" id="modalSwapFeatured" tabindex="-1" aria-hidden="true" style="z-index: 1070;">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-warning text-dark py-3">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-exclamation-triangle-fill me-1"></i> Kuota Produk Unggulan Penuh (8/8)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <p class="text-muted small mb-3">
          Saat ini sudah ada <strong>8 produk unggulan</strong> yang tampil di Beranda. Silakan pilih <strong>1 produk</strong> yang ingin dilepas dari status unggulan untuk digantikan dengan <strong class="text-danger" id="swapTargetProductNameText">produk ini</strong>:
        </p>

        <div class="list-group mb-4" id="swapProductListGroup">
          @foreach($featuredProducts as $fp)
          <label class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-2.5 rounded-3 border mb-2 cursor-pointer swap-item-label">
            <div class="d-flex align-items-center gap-3">
              <input class="form-check-input me-1 swap-radio-btn" type="radio" name="temp_swap_radio" value="{{ $fp->id }}">
              <img src="{{ asset($fp->image) }}" class="rounded-2" style="width: 42px; height: 42px; object-fit: cover;">
              <div>
                <div class="fw-bold text-dark small mb-0">{{ $fp->name }}</div>
                <small class="text-muted" style="font-size: 0.75rem;">Rp {{ number_format($fp->price, 0, ',', '.') }} • {{ $fp->category->name ?? '' }}</small>
              </div>
            </div>
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle ms-2">Ganti Ini</span>
          </label>
          @endforeach
        </div>

        <div class="d-flex justify-content-end gap-2">
          <button type="button" class="btn btn-light btn-sm rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-warning btn-sm rounded-pill px-4 fw-bold text-dark" id="btnConfirmSwapSubmit">
            <i class="bi bi-arrow-repeat me-1"></i> Konfirmasi Tukar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const toggleUrlTemplate = "{{ route('admin.produk.toggle-featured', ':id') }}";
  const csrfToken = "{{ csrf_token() }}";
  let targetProductToEnable = null;

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

  // 3. Direct Table Checkbox Toggle Event Listener (Vanilla JS Delegation)
  document.addEventListener('change', function (e) {
    if (e.target && e.target.classList.contains('table-featured-checkbox')) {
      const checkbox = e.target;
      const productId = checkbox.getAttribute('data-product-id');
      const productName = checkbox.getAttribute('data-product-name');
      const isChecked = checkbox.checked;

      sendToggleFeatured(productId, isChecked, null, checkbox, productName);
    }
  });

  // 4. Function to Send AJAX Fetch Request for Toggle Featured
  function sendToggleFeatured(productId, desiredState, swapProductId = null, checkbox = null, productName = '') {
    const url = toggleUrlTemplate.replace(':id', productId);

    const formData = new FormData();
    formData.append('_token', csrfToken);
    if (swapProductId) {
      formData.append('swap_product_id', swapProductId);
    }

    fetch(url, {
      method: 'POST',
      body: formData,
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      }
    })
    .then(async (res) => {
      const data = await res.json();
      if (res.ok && data.success) {
        updateFeaturedUiState(data);
        if (desiredState || swapProductId) {
          showToastMessage(data.message || 'Berhasil memperbarui produk unggulan!');
        }
      } else if (res.status === 422 && data.quota_full) {
        // Revert checkbox state first
        if (checkbox) checkbox.checked = false;
        targetProductToEnable = { id: productId, name: productName, checkbox: checkbox };

        const nameElem = document.getElementById('swapTargetProductNameText');
        if (nameElem) nameElem.textContent = '"' + productName + '"';

        if (data.featured_products) {
          renderSwapListGroup(data.featured_products);
        }

        const modalSwapElem = document.getElementById('modalSwapFeatured');
        if (modalSwapElem) {
          const swapModal = bootstrap.Modal.getOrCreateInstance(modalSwapElem);
          swapModal.show();
        }
      } else {
        if (checkbox) checkbox.checked = !desiredState;
        alert(data.message || 'Terjadi kesalahan saat mengubah status produk unggulan.');
      }
    })
    .catch((err) => {
      console.error(err);
      if (checkbox) checkbox.checked = !desiredState;
      alert('Terjadi kesalahan jaringan.');
    });
  }

  // 5. Handle Swap Confirmation Click inside Modal Swap
  const btnConfirmSwap = document.getElementById('btnConfirmSwapSubmit');
  if (btnConfirmSwap) {
    btnConfirmSwap.addEventListener('click', function () {
      const selectedRadio = document.querySelector('input[name="temp_swap_radio"]:checked');
      if (!selectedRadio) {
        alert('Silakan pilih salah satu produk unggulan yang ingin digantikan.');
        return;
      }

      if (targetProductToEnable) {
        sendToggleFeatured(targetProductToEnable.id, true, selectedRadio.value, targetProductToEnable.checkbox, targetProductToEnable.name);

        const swapModalElem = document.getElementById('modalSwapFeatured');
        if (swapModalElem) {
          const swapModal = bootstrap.Modal.getInstance(swapModalElem);
          if (swapModal) swapModal.hide();
        }
      }
    });
  }

  // 6. Handle "Lepas" Button inside Modal Tabel Produk Unggulan
  document.addEventListener('click', function (e) {
    const btn = e.target.closest('.btn-remove-featured-modal');
    if (btn) {
      const productId = btn.getAttribute('data-product-id');
      const mainCheckbox = document.querySelector('.table-featured-checkbox[data-product-id="' + productId + '"]');
      sendToggleFeatured(productId, false, null, mainCheckbox);
    }
  });

  // 7. Update UI Elements Dynamically Without Page Reload
  function updateFeaturedUiState(res) {
    if (res.featured_count !== undefined) {
      const badgeText = document.getElementById('featuredCountBadgeText');
      if (badgeText) badgeText.textContent = res.featured_count;
    }

    if (res.featured_products) {
      // A. Update Main Table Checkboxes & Badges
      document.querySelectorAll('.table-featured-checkbox').forEach(cb => cb.checked = false);
      document.querySelectorAll('.featured-badge-inline').forEach(b => b.classList.add('d-none'));

      res.featured_products.forEach(function (fp) {
        const row = document.getElementById('productRow' + fp.id);
        if (row) {
          const cb = row.querySelector('.table-featured-checkbox');
          const badge = row.querySelector('.featured-badge-inline');
          if (cb) cb.checked = true;
          if (badge) badge.classList.remove('d-none');
        }
      });

      // B. Update Modal Featured Table Rows
      renderModalFeaturedTable(res.featured_products);

      // C. Update Swap List Group Items
      renderSwapListGroup(res.featured_products);
    }
  }

  function renderModalFeaturedTable(featuredList) {
    const tbody = document.getElementById('featuredModalTableBody');
    if (!tbody) return;

    tbody.innerHTML = '';

    if (!featuredList || featuredList.length === 0) {
      tbody.innerHTML = '<tr id="featuredModalEmptyRow"><td colspan="6" class="text-center py-4 text-muted">Belum ada produk unggulan yang dipilih.</td></tr>';
      return;
    }

    featuredList.forEach(function (fp, index) {
      const priceFormatted = new Intl.NumberFormat('id-ID').format(fp.price);
      const catName = fp.category ? fp.category.name : 'Aneka Roti';
      const imgUrl = '{{ asset("") }}' + fp.image;

      const rowHtml = '<tr id="featuredModalRow' + fp.id + '">' +
        '<td class="fw-bold text-muted">' + (index + 1) + '</td>' +
        '<td><img src="' + imgUrl + '" style="width: 42px; height: 42px; object-fit: cover; border-radius: 6px;"></td>' +
        '<td><span class="fw-bold text-dark">' + fp.name + '</span></td>' +
        '<td><span class="badge bg-light text-dark border">' + catName + '</span></td>' +
        '<td class="fw-bold text-danger">Rp ' + priceFormatted + '</td>' +
        '<td class="text-end">' +
          '<button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 btn-remove-featured-modal" data-product-id="' + fp.id + '">' +
            '<i class="bi bi-x-circle me-1"></i> Lepas' +
          '</button>' +
        '</td>' +
      '</tr>';

      tbody.insertAdjacentHTML('beforeend', rowHtml);
    });
  }

  function renderSwapListGroup(featuredList) {
    const group = document.getElementById('swapProductListGroup');
    if (!group) return;

    group.innerHTML = '';
    if (!featuredList) return;

    featuredList.forEach(function (fp) {
      const priceFormatted = new Intl.NumberFormat('id-ID').format(fp.price);
      const catName = fp.category ? fp.category.name : '';
      const imgUrl = '{{ asset("") }}' + fp.image;

      const itemHtml = '<label class="list-group-item list-group-item-action d-flex align-items-center justify-content-between p-2.5 rounded-3 border mb-2 cursor-pointer swap-item-label">' +
        '<div class="d-flex align-items-center gap-3">' +
          '<input class="form-check-input me-1 swap-radio-btn" type="radio" name="temp_swap_radio" value="' + fp.id + '">' +
          '<img src="' + imgUrl + '" class="rounded-2" style="width: 42px; height: 42px; object-fit: cover;">' +
          '<div>' +
            '<div class="fw-bold text-dark small mb-0">' + fp.name + '</div>' +
            '<small class="text-muted" style="font-size: 0.75rem;">Rp ' + priceFormatted + ' • ' + catName + '</small>' +
          '</div>' +
        '</div>' +
        '<span class="badge bg-danger-subtle text-danger border border-danger-subtle ms-2">Ganti Ini</span>' +
      '</label>';

      group.insertAdjacentHTML('beforeend', itemHtml);
    });
  }

  function showToastMessage(msg) {
    let toastWrapper = document.getElementById('featuredToastAlert');
    if (!toastWrapper) {
      document.body.insertAdjacentHTML('beforeend',
        '<div id="featuredToastAlert" class="position-fixed bottom-0 end-0 p-3" style="z-index: 1090;">' +
          '<div class="toast align-items-center text-bg-dark border-0 show rounded-4 p-1 shadow-lg" role="alert">' +
            '<div class="d-flex">' +
              '<div class="toast-body small fw-semibold"><i class="bi bi-star-fill text-warning me-2"></i><span id="toastMsgContent"></span></div>' +
              '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>' +
            '</div>' +
          '</div>' +
        '</div>'
      );
      toastWrapper = document.getElementById('featuredToastAlert');
    }
    const msgContent = document.getElementById('toastMsgContent');
    if (msgContent) msgContent.textContent = msg;

    setTimeout(function() {
      if (toastWrapper) toastWrapper.remove();
    }, 3000);
  }

  // 7.5. Badge Picker Pill Buttons Handler for Create & Edit Product Modals (Opsi 1 Shimmer Wave & Theme Glow Shadow)
  function hexToRgba(hex, alpha) {
    if (!hex || hex.charAt(0) !== '#') return 'rgba(0,0,0,' + alpha + ')';
    let c = hex.substring(1);
    if (c.length === 3) c = c.split('').map(x => x + x).join('');
    let num = parseInt(c, 16);
    return `rgba(${(num >> 16) & 255}, ${(num >> 8) & 255}, ${num & 255}, ${alpha})`;
  }

  const inputBadgeCreate = document.getElementById('inputBadgeCreate');
  const previewBadgeSelectedCreate = document.getElementById('previewBadgeSelectedCreate');

  document.querySelectorAll('.btn-badge-picker-create').forEach(function(btn) {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.btn-badge-picker-create').forEach(b => {
        b.classList.remove('active');
        b.style.boxShadow = 'none';
        const check = b.querySelector('.check-icon');
        if (check) check.classList.add('d-none');

        const darkColor = b.getAttribute('data-dark-color') || b.getAttribute('data-bg');
        if (darkColor) {
          b.style.backgroundColor = 'transparent';
          b.style.color = darkColor;
          b.style.border = '1px solid ' + darkColor;
        } else {
          b.className = 'btn btn-sm btn-outline-secondary rounded-pill badge-picker-pill btn-badge-picker-create';
          b.style.border = '';
        }
      });

      this.classList.add('active');
      const check = this.querySelector('.check-icon');
      if (check) check.classList.remove('d-none');

      const badgeId = this.getAttribute('data-badge-id');
      if (inputBadgeCreate) inputBadgeCreate.value = badgeId;

      const bg = this.getAttribute('data-bg');
      const text = this.getAttribute('data-text');
      const darkColor = this.getAttribute('data-dark-color') || bg;
      const name = this.getAttribute('data-name');
      const icon = this.getAttribute('data-icon');

      if (bg && text) {
        this.style.backgroundColor = bg;
        this.style.color = text;
        this.style.border = '1px solid ' + darkColor;
        this.style.boxShadow = '0 4px 14px ' + hexToRgba(darkColor, 0.45);

        const iconHtml = icon ? `<i class="${icon} me-1"></i>` : '';
        if (previewBadgeSelectedCreate) {
          previewBadgeSelectedCreate.innerHTML = `<span class="badge px-3 py-1 rounded-pill shadow-sm fw-bold" style="background-color: ${bg}; color: ${text}; font-size: 0.78rem;">${iconHtml}${name}</span>`;
        }
      } else {
        this.className = 'btn btn-sm btn-dark text-white rounded-pill badge-picker-pill btn-badge-picker-create active';
        this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.2)';
        if (previewBadgeSelectedCreate) {
          previewBadgeSelectedCreate.innerHTML = `<span class="badge bg-secondary rounded-pill px-3 py-1" style="font-size: 0.78rem;">Tanpa Badge</span>`;
        }
      }
    });
  });

  @foreach($products as $product)
  (function() {
    const productId = "{{ $product->id }}";
    const inputBadgeEdit = document.querySelector('.input-badge-edit-' + productId);
    const previewBadgeEdit = document.querySelector('.preview-badge-selected-edit-' + productId);

    document.querySelectorAll('.btn-badge-picker-edit-' + productId).forEach(function(btn) {
      // Set initial glow shadow on pre-selected button
      if (btn.classList.contains('active')) {
        const bg = btn.getAttribute('data-bg');
        const darkColor = btn.getAttribute('data-dark-color') || bg;
        if (darkColor) {
          btn.style.boxShadow = '0 4px 14px ' + hexToRgba(darkColor, 0.45);
        } else {
          btn.style.boxShadow = '0 4px 12px rgba(0,0,0,0.2)';
        }
      }

      btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-badge-picker-edit-' + productId).forEach(b => {
          b.classList.remove('active');
          b.style.boxShadow = 'none';
          const check = b.querySelector('.check-icon');
          if (check) check.classList.add('d-none');

          const darkColor = b.getAttribute('data-dark-color') || b.getAttribute('data-bg');
          if (darkColor) {
            b.style.backgroundColor = 'transparent';
            b.style.color = darkColor;
            b.style.border = '1px solid ' + darkColor;
          } else {
            b.className = 'btn btn-sm btn-outline-secondary rounded-pill badge-picker-pill btn-badge-picker-edit-' + productId;
            b.style.border = '';
          }
        });

        this.classList.add('active');
        const check = this.querySelector('.check-icon');
        if (check) check.classList.remove('d-none');

        const badgeId = this.getAttribute('data-badge-id');
        if (inputBadgeEdit) inputBadgeEdit.value = badgeId;

        const bg = this.getAttribute('data-bg');
        const text = this.getAttribute('data-text');
        const darkColor = this.getAttribute('data-dark-color') || bg;
        const name = this.getAttribute('data-name');
        const icon = this.getAttribute('data-icon');

        if (bg && text) {
          this.style.backgroundColor = bg;
          this.style.color = text;
          this.style.border = '1px solid ' + darkColor;
          this.style.boxShadow = '0 4px 14px ' + hexToRgba(darkColor, 0.45);

          const iconHtml = icon ? `<i class="${icon} me-1"></i>` : '';
          if (previewBadgeEdit) {
            previewBadgeEdit.innerHTML = `<span class="badge px-3 py-1 rounded-pill shadow-sm fw-bold" style="background-color: ${bg}; color: ${text}; font-size: 0.78rem;">${iconHtml}${name}</span>`;
          }
        } else {
          this.className = 'btn btn-sm btn-dark text-white rounded-pill badge-picker-pill btn-badge-picker-edit-' + productId + ' active';
          this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.2)';
          if (previewBadgeEdit) {
            previewBadgeEdit.innerHTML = `<span class="badge bg-secondary rounded-pill px-3 py-1" style="font-size: 0.78rem;">Tanpa Badge</span>`;
          }
        }
      });
    });
  })();
  @endforeach

  // 8. List.js Pagination & Per Page Selector Initialization
  if (document.getElementById('adminProductListApp')) {
    const productList = new List('adminProductListApp', {
      valueNames: ['name', 'category', 'desc', 'price'],
      page: 10,
      pagination: {
        innerWindow: 2,
        left: 0,
        right: 0,
        paginationClass: 'pagination'
      }
    });

    const updatePageInfo = () => {
      const total = productList.matchingItems.length;
      const page = productList.page;
      const i = productList.i;
      const start = total === 0 ? 0 : i;
      const end = Math.min(i + page - 1, total);

      document.querySelectorAll('.product-page-start').forEach(el => el.textContent = start);
      document.querySelectorAll('.product-page-end').forEach(el => el.textContent = end);
      document.querySelectorAll('.product-page-total').forEach(el => el.textContent = total);
    };

    productList.on('updated', updatePageInfo);
    updatePageInfo();

    document.querySelectorAll('.per-page-select').forEach(select => {
      select.addEventListener('change', function () {
        const val = this.value;
        if (val === 'all') {
          productList.page = 10000;
        } else {
          productList.page = parseInt(val, 10);
        }
        productList.update();
      });
    });
  }
});
</script>
@endpush
@endsection
