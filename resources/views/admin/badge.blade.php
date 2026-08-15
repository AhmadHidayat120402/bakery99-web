@extends('admin.layouts.admin')

@section('title', 'Kelola Badge Promo Produk')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Badge Promo Produk</h1>
    <p class="page-subtitle-text">Buat label badge promo baru (contoh: ⭐ Best Seller, Fresh Daily, Terlaris) lengkap dengan warna latar & teks kustom.</p>
  </div>
  <div>
    <button class="btn-99-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBadge">
      <i class="bi bi-plus-lg"></i> Tambah Badge Baru
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

<!-- BADGES TABLE CARD -->
<div class="admin-card" id="adminBadgeListApp">
  <div class="admin-card-header flex-wrap gap-2">
    <div>
      <h5 class="admin-card-title">Daftar Badge Promo Aktif</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Total {{ $badges->count() }} label badge promo terdaftar</span>
    </div>
    <div class="d-flex align-items-center flex-wrap gap-2">
      <!-- LIVE SEARCH INPUT -->
      <div class="position-relative">
        <input type="text" class="form-control form-control-sm search shadow-none" placeholder="Cari nama badge..." style="width: 200px; border-radius: 20px; padding-left: 36px;">
        <i class="bi bi-search position-absolute top-50 translate-middle-y text-muted small" style="left: 14px; pointer-events: none;"></i>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle">
      <thead>
        <tr>
          <th style="width: 40px;">No</th>
          <th>Pratinjau Badge</th>
          <th class="sort cursor-pointer" data-sort="name">Nama Label <i class="bi bi-arrow-down-up small text-muted"></i></th>
          <th>Warna Latar (Hex)</th>
          <th>Digunakan</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody class="list">
        @forelse($badges as $badge)
        <tr>
          <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
          <td>
            <span class="badge px-3 py-1.5 rounded-pill shadow-sm fw-bold" style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; font-size: 0.78rem;">
              @if($badge->icon)<i class="{{ $badge->icon }} me-1"></i>@endif{{ $badge->name }}
            </span>
          </td>
          <td>
            <div class="fw-bold text-dark name">
              @if($badge->icon)<i class="{{ $badge->icon }} me-1 text-muted"></i>@endif{{ $badge->name }}
            </div>
          </td>
          <td>
            <div class="d-flex align-items-center gap-2">
              <span class="d-inline-block rounded-circle border shadow-sm" style="width: 18px; height: 18px; background-color: {{ $badge->bg_color }};"></span>
              <code>{{ $badge->bg_color }}</code>
            </div>
          </td>
          <td><span class="badge bg-secondary">{{ $badge->products_count }} Item Roti</span></td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Badge" data-bs-toggle="modal" data-bs-target="#modalEditBadge{{ $badge->id }}">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon btn-action-delete" title="Hapus Badge" data-bs-toggle="modal" data-bs-target="#modalDeleteBadge{{ $badge->id }}">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <!-- MODAL DELETE BADGE -->
        <div class="modal fade" id="modalDeleteBadge{{ $badge->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-3">
              <div class="modal-body py-4">
                <div class="mb-3 text-danger">
                  <i class="bi bi-exclamation-triangle-fill display-4"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">Hapus Badge Promo?</h5>
                <p class="text-muted small mb-4">Apakah Anda yakin ingin menghapus badge <strong>"{{ $badge->name }}"</strong>? Produk yang menggunakan badge ini akan kembali ke mode tanpa badge.</p>
                <form action="{{ route('admin.badge.destroy', $badge->id) }}" method="POST">
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

        <!-- MODAL EDIT BADGE -->
        <div class="modal fade" id="modalEditBadge{{ $badge->id }}" tabindex="-1" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
              <div class="modal-header bg-dark text-white py-3">
                <h5 class="modal-title fw-bold fs-6 text-white"><i class="bi bi-pencil-square me-1"></i> Edit Badge Promo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-4">
                <form action="{{ route('admin.badge.update', $badge->id) }}" method="POST">
                  @csrf
                  @method('PUT')

                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Label Badge</label>
                    <input type="text" name="name" class="form-control input-name-edit-{{ $badge->id }}" value="{{ $badge->name }}" required>
                  </div>

                  <!-- PILIH IKON BADGE EDIT -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block">Pilih Ikon Badge</label>
                    <input type="hidden" name="icon" class="input-icon-edit-{{ $badge->id }}" value="{{ $badge->icon }}">
                    <div class="d-flex flex-wrap gap-2">
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-gift-fill' ? 'active' : '' }}" data-icon="bi bi-gift-fill"><i class="bi bi-gift-fill me-1"></i> Hadiah</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-star-fill' ? 'active' : '' }}" data-icon="bi bi-star-fill"><i class="bi bi-star-fill me-1"></i> Bintang</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-fire' ? 'active' : '' }}" data-icon="bi bi-fire"><i class="bi bi-fire me-1"></i> Api</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-heart-fill' ? 'active' : '' }}" data-icon="bi bi-heart-fill"><i class="bi bi-heart-fill me-1"></i> Hati</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-basket' ? 'active' : '' }}" data-icon="bi bi-basket"><i class="bi bi-basket me-1"></i> Keranjang</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-rocket-takeoff-fill' ? 'active' : '' }}" data-icon="bi bi-rocket-takeoff-fill"><i class="bi bi-rocket-takeoff-fill me-1"></i> Roket</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-lightning-fill' ? 'active' : '' }}" data-icon="bi bi-lightning-fill"><i class="bi bi-lightning-fill me-1"></i> Kilat</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-award-fill' ? 'active' : '' }}" data-icon="bi bi-award-fill"><i class="bi bi-award-fill me-1"></i> Medali</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-patch-check-fill' ? 'active' : '' }}" data-icon="bi bi-patch-check-fill"><i class="bi bi-patch-check-fill me-1"></i> Centang</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-tag-fill' ? 'active' : '' }}" data-icon="bi bi-tag-fill"><i class="bi bi-tag-fill me-1"></i> Tag Promo</button>
                      <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ $badge->icon == 'bi bi-percent' ? 'active' : '' }}" data-icon="bi bi-percent"><i class="bi bi-percent me-1"></i> Diskon</button>
                      <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill btn-icon-preset-edit-{{ $badge->id }} {{ empty($badge->icon) ? 'active' : '' }}" data-icon="">(Tanpa Ikon)</button>
                    </div>
                  </div>

                  <!-- PILIHAN WARNA CEPAT (PRESETS) -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block">Pilihan Preset Warna Cepat</label>
                    <div class="d-flex flex-wrap gap-2">
                      <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#B78103" data-text="#FFFFFF" style="background-color: #B78103;">Gold Emas</button>
                      <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#C62828" data-text="#FFFFFF" style="background-color: #C62828;">Merah 99</button>
                      <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#E65100" data-text="#FFFFFF" style="background-color: #E65100;">Oranye</button>
                      <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#2E7D32" data-text="#FFFFFF" style="background-color: #2E7D32;">Hijau Daily</button>
                      <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#6A1B9A" data-text="#FFFFFF" style="background-color: #6A1B9A;">Ungu Spesial</button>
                      <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#1565C0" data-text="#FFFFFF" style="background-color: #1565C0;">Biru New</button>

                      <!-- LIGHT / PASTEL PRESETS -->
                      <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#FFF8E1" data-text="#B78103" style="background-color: #FFF8E1; color: #B78103; border-color: #FFE082 !important;">Light Gold</button>
                      <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#FFEBEE" data-text="#C62828" style="background-color: #FFEBEE; color: #C62828; border-color: #FFCDD2 !important;">Light Merah</button>
                      <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#FFF3E0" data-text="#E65100" style="background-color: #FFF3E0; color: #E65100; border-color: #FFE0B2 !important;">Light Oranye</button>
                      <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#E8F5E9" data-text="#2E7D32" style="background-color: #E8F5E9; color: #2E7D32; border-color: #C8E6C9 !important;">Light Hijau</button>
                      <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#F3E5F5" data-text="#6A1B9A" style="background-color: #F3E5F5; color: #6A1B9A; border-color: #E1BEE7 !important;">Light Ungu</button>
                      <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#E3F2FD" data-text="#1565C0" style="background-color: #E3F2FD; color: #1565C0; border-color: #BBDEFB !important;">Light Biru</button>
                    </div>
                  </div>

                  <div class="row g-2 mb-3">
                    <div class="col-6">
                      <label class="form-label fw-semibold small">Warna Latar (Background)</label>
                      <div class="input-group">
                        <input type="color" class="form-control form-control-color w-25 color-picker-bg-edit-{{ $badge->id }}" value="{{ $badge->bg_color }}" title="Pilih warna">
                        <input type="text" name="bg_color" class="form-control color-text-bg-edit-{{ $badge->id }}" value="{{ $badge->bg_color }}" required>
                      </div>
                    </div>
                    <div class="col-6">
                      <label class="form-label fw-semibold small">Warna Teks (Text Color)</label>
                      <div class="input-group">
                        <input type="color" class="form-control form-control-color w-25 color-picker-text-edit-{{ $badge->id }}" value="{{ $badge->text_color }}" title="Pilih warna">
                        <input type="text" name="text_color" class="form-control color-text-text-edit-{{ $badge->id }}" value="{{ $badge->text_color }}" required>
                      </div>
                    </div>
                  </div>

                  <!-- PRATINJAU LIVE BADGE EDIT -->
                  <div class="mb-3 p-3 bg-light rounded-3 text-center border">
                    <span class="small text-muted d-block mb-2">Pratinjau Tampilan Badge:</span>
                    <span class="badge px-4 py-2 rounded-pill shadow-sm fw-bold preview-badge-target-edit-{{ $badge->id }}" style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; font-size: 0.85rem;">
                      @if($badge->icon)<i class="{{ $badge->icon }} me-1"></i>@endif{{ $badge->name }}
                    </span>
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
          <td colspan="6" class="text-center py-5 text-muted">Belum ada badge promo terdaftar.</td>
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
        Menampilkan <span class="fw-bold text-dark badge-page-start">1</span> - <span class="fw-bold text-dark badge-page-end">10</span> dari <span class="fw-bold text-dark badge-page-total">{{ $badges->count() }}</span> total data
      </div>
    </div>
    <ul class="pagination pagination-sm mb-0"></ul>
  </div>
</div>

<!-- MODAL TAMBAH BADGE BARU -->
<div class="modal fade" id="modalTambahBadge" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-danger text-white py-3">
        <h5 class="modal-title fw-bold fs-6 text-white"><i class="bi bi-plus-circle me-1"></i> Tambah Badge Promo Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('admin.badge.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Label Badge</label>
            <input type="text" name="name" id="inputNameCreate" class="form-control" placeholder="Contoh: Best Seller / Fresh Daily" required>
          </div>

          <!-- PILIH IKON BADGE CREATE -->
          <div class="mb-3">
            <label class="form-label fw-semibold small d-block">Pilih Ikon Badge</label>
            <input type="hidden" name="icon" id="inputIconCreate" value="bi bi-gift-fill">
            <div class="d-flex flex-wrap gap-2">
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create active" data-icon="bi bi-gift-fill"><i class="bi bi-gift-fill me-1"></i> Hadiah</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-star-fill"><i class="bi bi-star-fill me-1"></i> Bintang</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-fire"><i class="bi bi-fire me-1"></i> Api</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-heart-fill"><i class="bi bi-heart-fill me-1"></i> Hati</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-basket"><i class="bi bi-basket me-1"></i> Keranjang</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-rocket-takeoff-fill"><i class="bi bi-rocket-takeoff-fill me-1"></i> Roket</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-lightning-fill"><i class="bi bi-lightning-fill me-1"></i> Kilat</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-award-fill"><i class="bi bi-award-fill me-1"></i> Medali</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-patch-check-fill"><i class="bi bi-patch-check-fill me-1"></i> Centang</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-tag-fill"><i class="bi bi-tag-fill me-1"></i> Tag Promo</button>
              <button type="button" class="btn btn-sm btn-outline-dark rounded-pill btn-icon-preset-create" data-icon="bi bi-percent"><i class="bi bi-percent me-1"></i> Diskon</button>
              <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill btn-icon-preset-create" data-icon="">(Tanpa Ikon)</button>
            </div>
          </div>

          <!-- PILIHAN WARNA CEPAT (PRESETS) -->
          <div class="mb-3">
            <label class="form-label fw-semibold small d-block">Pilihan Preset Warna Cepat</label>
            <div class="d-flex flex-wrap gap-2">
              <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#B78103" data-text="#FFFFFF" style="background-color: #B78103;">Gold Emas</button>
              <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#C62828" data-text="#FFFFFF" style="background-color: #C62828;">Merah 99</button>
              <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#E65100" data-text="#FFFFFF" style="background-color: #E65100;">Oranye</button>
              <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#2E7D32" data-text="#FFFFFF" style="background-color: #2E7D32;">Hijau Daily</button>
              <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#6A1B9A" data-text="#FFFFFF" style="background-color: #6A1B9A;">Ungu Spesial</button>
              <button type="button" class="btn btn-sm text-white px-3 rounded-pill btn-preset-color" data-bg="#1565C0" data-text="#FFFFFF" style="background-color: #1565C0;">Biru New</button>

              <!-- LIGHT / PASTEL PRESETS -->
              <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#FFF8E1" data-text="#B78103" style="background-color: #FFF8E1; color: #B78103; border-color: #FFE082 !important;">Light Gold</button>
              <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#FFEBEE" data-text="#C62828" style="background-color: #FFEBEE; color: #C62828; border-color: #FFCDD2 !important;">Light Merah</button>
              <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#FFF3E0" data-text="#E65100" style="background-color: #FFF3E0; color: #E65100; border-color: #FFE0B2 !important;">Light Oranye</button>
              <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#E8F5E9" data-text="#2E7D32" style="background-color: #E8F5E9; color: #2E7D32; border-color: #C8E6C9 !important;">Light Hijau</button>
              <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#F3E5F5" data-text="#6A1B9A" style="background-color: #F3E5F5; color: #6A1B9A; border-color: #E1BEE7 !important;">Light Ungu</button>
              <button type="button" class="btn btn-sm px-3 rounded-pill border btn-preset-color fw-bold" data-bg="#E3F2FD" data-text="#1565C0" style="background-color: #E3F2FD; color: #1565C0; border-color: #BBDEFB !important;">Light Biru</button>
            </div>
          </div>

          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Warna Latar (Background)</label>
              <div class="input-group">
                <input type="color" class="form-control form-control-color w-25" id="colorPickerBgCreate" value="#B78103" title="Pilih warna">
                <input type="text" name="bg_color" id="colorTextBgCreate" class="form-control" value="#B78103" required>
              </div>
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Warna Teks (Text Color)</label>
              <div class="input-group">
                <input type="color" class="form-control form-control-color w-25" id="colorPickerTextCreate" value="#FFFFFF" title="Pilih warna">
                <input type="text" name="text_color" id="colorTextCreate" class="form-control" value="#FFFFFF" required>
              </div>
            </div>
          </div>

          <!-- PRATINJAU LIVE BADGE TAMBAH -->
          <div class="mb-3 p-3 bg-light rounded-3 text-center border">
            <span class="small text-muted d-block mb-2">Pratinjau Tampilan Badge:</span>
            <span class="badge px-4 py-2 rounded-pill shadow-sm fw-bold" id="previewBadgeTargetCreate" style="background-color: #B78103; color: #FFFFFF; font-size: 0.85rem;">
              <i class="bi bi-gift-fill me-1"></i> Best Seller
            </span>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Badge Promo</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Synchronize Color Pickers and Live Preview for Create Modal
  const inputNameCreate = document.getElementById('inputNameCreate');
  const inputIconCreate = document.getElementById('inputIconCreate');
  const colorPickerBgCreate = document.getElementById('colorPickerBgCreate');
  const colorTextBgCreate = document.getElementById('colorTextBgCreate');
  const colorPickerTextCreate = document.getElementById('colorPickerTextCreate');
  const colorTextCreate = document.getElementById('colorTextCreate');
  const previewBadgeTargetCreate = document.getElementById('previewBadgeTargetCreate');

  function updateCreatePreview() {
    if (!previewBadgeTargetCreate) return;
    const name = inputNameCreate.value || 'Contoh Badge';
    const iconClass = inputIconCreate ? inputIconCreate.value : '';
    const iconHtml = iconClass ? `<i class="${iconClass} me-1"></i>` : '';
    previewBadgeTargetCreate.innerHTML = `${iconHtml}${name}`;
    previewBadgeTargetCreate.style.backgroundColor = colorTextBgCreate.value;
    previewBadgeTargetCreate.style.color = colorTextCreate.value;
  }

  document.querySelectorAll('.btn-icon-preset-create').forEach(function(btn) {
    btn.addEventListener('click', function() {
      document.querySelectorAll('.btn-icon-preset-create').forEach(b => b.classList.remove('active'));
      this.classList.add('active');
      const icon = this.getAttribute('data-icon');
      if (inputIconCreate) inputIconCreate.value = icon;
      updateCreatePreview();
    });
  });

  if (colorPickerBgCreate) {
    colorPickerBgCreate.addEventListener('input', function() {
      colorTextBgCreate.value = this.value;
      updateCreatePreview();
    });
    colorTextBgCreate.addEventListener('input', function() {
      colorPickerBgCreate.value = this.value;
      updateCreatePreview();
    });
    colorPickerTextCreate.addEventListener('input', function() {
      colorTextCreate.value = this.value;
      updateCreatePreview();
    });
    colorTextCreate.addEventListener('input', function() {
      colorPickerTextCreate.value = this.value;
      updateCreatePreview();
    });
    if (inputNameCreate) inputNameCreate.addEventListener('input', updateCreatePreview);
  }

  // Live Preview Event Listeners for Edit Modals
  @foreach($badges as $badge)
  (function() {
    const badgeId = "{{ $badge->id }}";
    const nameInput = document.querySelector('.input-name-edit-' + badgeId);
    const iconInput = document.querySelector('.input-icon-edit-' + badgeId);
    const colorBgPicker = document.querySelector('.color-picker-bg-edit-' + badgeId);
    const colorBgText = document.querySelector('.color-text-bg-edit-' + badgeId);
    const colorTextPicker = document.querySelector('.color-picker-text-edit-' + badgeId);
    const colorTextVal = document.querySelector('.color-text-text-edit-' + badgeId);
    const previewEl = document.querySelector('.preview-badge-target-edit-' + badgeId);

    function updateEditPreview() {
      if (!previewEl) return;
      const name = nameInput ? nameInput.value : '';
      const iconClass = iconInput ? iconInput.value : '';
      const iconHtml = iconClass ? `<i class="${iconClass} me-1"></i>` : '';
      previewEl.innerHTML = `${iconHtml}${name}`;
      if (colorBgText) previewEl.style.backgroundColor = colorBgText.value;
      if (colorTextVal) previewEl.style.color = colorTextVal.value;
    }

    document.querySelectorAll('.btn-icon-preset-edit-' + badgeId).forEach(function(btn) {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.btn-icon-preset-edit-' + badgeId).forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const icon = this.getAttribute('data-icon');
        if (iconInput) iconInput.value = icon;
        updateEditPreview();
      });
    });

    if (colorBgPicker && colorBgText) {
      colorBgPicker.addEventListener('input', function() {
        colorBgText.value = this.value;
        updateEditPreview();
      });
      colorBgText.addEventListener('input', function() {
        colorBgPicker.value = this.value;
        updateEditPreview();
      });
    }
    if (colorTextPicker && colorTextVal) {
      colorTextPicker.addEventListener('input', function() {
        colorTextVal.value = this.value;
        updateEditPreview();
      });
      colorTextVal.addEventListener('input', function() {
        colorTextPicker.value = this.value;
        updateEditPreview();
      });
    }
    if (nameInput) nameInput.addEventListener('input', updateEditPreview);
  })();
  @endforeach

  // Preset Buttons Click Handler (Works for Create & Edit Modals)
  document.querySelectorAll('.btn-preset-color').forEach(function(btn) {
    btn.addEventListener('click', function() {
      const bg = this.getAttribute('data-bg');
      const text = this.getAttribute('data-text');
      const modal = this.closest('.modal');
      if (modal) {
        const bgPicker = modal.querySelector('input[type="color"]');
        const bgText = modal.querySelector('input[name="bg_color"]');
        const textPickers = modal.querySelectorAll('input[type="color"]');
        const textVal = modal.querySelector('input[name="text_color"]');

        if (textPickers && textPickers[0]) textPickers[0].value = bg;
        if (bgText) {
          bgText.value = bg;
          bgText.dispatchEvent(new Event('input'));
        }
        if (textPickers && textPickers[1]) textPickers[1].value = text;
        if (textVal) {
          textVal.value = text;
          textVal.dispatchEvent(new Event('input'));
        }
      }
    });
  });

  // List.js Initialization for Admin Badge Table
  if (document.getElementById('adminBadgeListApp')) {
    const badgeList = new List('adminBadgeListApp', {
      valueNames: ['name'],
      page: 10,
      pagination: {
        innerWindow: 2,
        left: 0,
        right: 0,
        paginationClass: 'pagination'
      }
    });

    const updatePageInfo = () => {
      const total = badgeList.matchingItems.length;
      const page = badgeList.page;
      const i = badgeList.i;
      const start = total === 0 ? 0 : i;
      const end = Math.min(i + page - 1, total);

      document.querySelectorAll('.badge-page-start').forEach(el => el.textContent = start);
      document.querySelectorAll('.badge-page-end').forEach(el => el.textContent = end);
      document.querySelectorAll('.badge-page-total').forEach(el => el.textContent = total);
    };

    badgeList.on('updated', updatePageInfo);
    updatePageInfo();

    document.querySelectorAll('.per-page-select').forEach(select => {
      select.addEventListener('change', function () {
        const val = this.value;
        if (val === 'all') {
          badgeList.page = 10000;
        } else {
          badgeList.page = parseInt(val, 10);
        }
        badgeList.update();
      });
    });
  }
});
</script>
@endpush
@endsection
