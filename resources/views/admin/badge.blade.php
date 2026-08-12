@extends('admin.layouts.admin')

@section('title', 'Kelola Badge Promo Produk - CMS 99 Bakery')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Badge Promo Produk</h1>
    <p class="page-subtitle-text">Atur label promosi (contoh: *Best Seller, Terlaris, Favorit, Diskon 20%*) beserta skema warna kustom untuk katalog roti.</p>
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

<!-- BADGES TABLE CARD -->
<div class="admin-card">
  <div class="admin-card-header">
    <div>
      <h5 class="admin-card-title">Daftar Badge Promo Aktif</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Total {{ $badges->count() }} label badge promo terdaftar</span>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle">
      <thead>
        <tr>
          <th style="width: 40px;">No</th>
          <th>Pratinjau Badge</th>
          <th>Nama Label</th>
          <th>Warna Latar (Hex)</th>
          <th>Digunakan</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($badges as $badge)
        <tr>
          <td class="fw-bold text-muted">{{ $loop->iteration }}</td>
          <td>
            <span class="badge px-3 py-1.5 rounded-pill shadow-sm fw-bold" style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; font-size: 0.78rem;">
              {{ $badge->name }}
            </span>
          </td>
          <td>
            <div class="fw-bold text-dark">{{ $badge->name }}</div>
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
                <h5 class="modal-title fw-bold fs-6"><i class="bi bi-pencil-square me-1"></i> Edit Badge Promo</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-4">
                <form action="{{ route('admin.badge.update', $badge->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label class="form-label fw-semibold small">Nama Badge Promo</label>
                    <input type="text" name="name" class="form-control edit-badge-name" value="{{ $badge->name }}" required>
                  </div>

                  <!-- PALETTE PRESETS EDIT -->
                  <div class="mb-3">
                    <label class="form-label fw-semibold small d-block">Pilihan Preset Warna</label>
                    <div class="d-flex flex-wrap gap-2 mb-2">
                      <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #B78103;" data-bg="#B78103" data-text="#FFFFFF">Emas / Gold</button>
                      <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #C62828;" data-bg="#C62828" data-text="#FFFFFF">Merah 99</button>
                      <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #E65100;" data-bg="#E65100" data-text="#FFFFFF">Oranye</button>
                      <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #2E7D32;" data-bg="#2E7D32" data-text="#FFFFFF">Hijau</button>
                      <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #6A1B9A;" data-bg="#6A1B9A" data-text="#FFFFFF">Ungu</button>
                      <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #1565C0;" data-bg="#1565C0" data-text="#FFFFFF">Biru</button>
                    </div>
                  </div>

                  <div class="row g-2 mb-3">
                    <div class="col-6">
                      <label class="form-label fw-semibold small">Warna Latar (Background)</label>
                      <div class="input-group">
                        <input type="color" class="form-control form-control-color border-end-0 color-picker-bg" value="{{ $badge->bg_color }}">
                        <input type="text" name="bg_color" class="form-control color-text-bg" value="{{ $badge->bg_color }}" required>
                      </div>
                    </div>
                    <div class="col-6">
                      <label class="form-label fw-semibold small">Warna Teks</label>
                      <div class="input-group">
                        <input type="color" class="form-control form-control-color border-end-0 color-picker-text" value="{{ $badge->text_color }}">
                        <input type="text" name="text_color" class="form-control color-text-text" value="{{ $badge->text_color }}" required>
                      </div>
                    </div>
                  </div>

                  <!-- LIVE PREVIEW BADGE EDIT -->
                  <div class="bg-light p-3 rounded-3 text-center mb-4">
                    <label class="form-label fw-semibold small d-block text-muted mb-2">Pratinjau Tampilan Badge:</label>
                    <span class="badge px-4 py-2 rounded-pill shadow-sm fw-bold badge-live-preview" style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; font-size: 0.85rem;">
                      {{ $badge->name }}
                    </span>
                  </div>

                  <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-dark btn-sm rounded-pill">Update Badge</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        @empty
        <tr>
          <td colspan="6" class="text-center py-4 text-muted">Belum ada badge promo terdaftar.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH BADGE -->
<div class="modal fade" id="modalTambahBadge" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-danger text-white py-3">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-plus-circle me-1"></i> Tambah Badge Promo Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form action="{{ route('admin.badge.store') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Badge Promo <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control edit-badge-name" placeholder="Contoh: Diskon 20% / Spesial Hajatan" required>
          </div>

          <!-- PALETTE PRESETS TAMBAH -->
          <div class="mb-3">
            <label class="form-label fw-semibold small d-block">Pilihan Preset Warna</label>
            <div class="d-flex flex-wrap gap-2 mb-2">
              <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #B78103;" data-bg="#B78103" data-text="#FFFFFF">Emas / Gold</button>
              <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #C62828;" data-bg="#C62828" data-text="#FFFFFF">Merah 99</button>
              <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #E65100;" data-bg="#E65100" data-text="#FFFFFF">Oranye</button>
              <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #2E7D32;" data-bg="#2E7D32" data-text="#FFFFFF">Hijau</button>
              <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #6A1B9A;" data-bg="#6A1B9A" data-text="#FFFFFF">Ungu</button>
              <button type="button" class="btn btn-sm rounded-pill color-preset-btn text-white fw-bold" style="background-color: #1565C0;" data-bg="#1565C0" data-text="#FFFFFF">Biru</button>
            </div>
          </div>

          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Warna Latar (Background)</label>
              <div class="input-group">
                <input type="color" class="form-control form-control-color border-end-0 color-picker-bg" value="#C62828">
                <input type="text" name="bg_color" class="form-control color-text-bg" value="#C62828" required>
              </div>
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Warna Teks</label>
              <div class="input-group">
                <input type="color" class="form-control form-control-color border-end-0 color-picker-text" value="#FFFFFF">
                <input type="text" name="text_color" class="form-control color-text-text" value="#FFFFFF" required>
              </div>
            </div>
          </div>

          <!-- LIVE PREVIEW BADGE TAMBAH -->
          <div class="bg-light p-3 rounded-3 text-center mb-4">
            <label class="form-label fw-semibold small d-block text-muted mb-2">Pratinjau Tampilan Badge:</label>
            <span class="badge px-4 py-2 rounded-pill shadow-sm fw-bold badge-live-preview" style="background-color: #C62828; color: #FFFFFF; font-size: 0.85rem;">
              Contoh Badge Promo
            </span>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Badge</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // Sync live badge preview across modals
  document.querySelectorAll('.modal').forEach(function(modal) {
    const nameInput = modal.querySelector('.edit-badge-name');
    const colorBgPicker = modal.querySelector('.color-picker-bg');
    const colorBgText = modal.querySelector('.color-text-bg');
    const colorTextPicker = modal.querySelector('.color-picker-text');
    const colorTextText = modal.querySelector('.color-text-text');
    const badgePreview = modal.querySelector('.badge-live-preview');
    const presetBtns = modal.querySelectorAll('.color-preset-btn');

    function updatePreview() {
      if (!badgePreview) return;
      if (nameInput && nameInput.value.trim() !== '') {
        badgePreview.textContent = nameInput.value.trim();
      } else {
        badgePreview.textContent = 'Contoh Badge';
      }
      if (colorBgText) badgePreview.style.backgroundColor = colorBgText.value;
      if (colorTextText) badgePreview.style.color = colorTextText.value;
    }

    if (nameInput) nameInput.addEventListener('input', updatePreview);

    if (colorBgPicker && colorBgText) {
      colorBgPicker.addEventListener('input', function() {
        colorBgText.value = this.value;
        updatePreview();
      });
      colorBgText.addEventListener('input', function() {
        colorBgPicker.value = this.value;
        updatePreview();
      });
    }

    if (colorTextPicker && colorTextText) {
      colorTextPicker.addEventListener('input', function() {
        colorTextText.value = this.value;
        updatePreview();
      });
      colorTextText.addEventListener('input', function() {
        colorTextPicker.value = this.value;
        updatePreview();
      });
    }

    presetBtns.forEach(function(btn) {
      btn.addEventListener('click', function() {
        const bg = this.getAttribute('data-bg');
        const text = this.getAttribute('data-text');
        if (colorBgPicker) colorBgPicker.value = bg;
        if (colorBgText) colorBgText.value = bg;
        if (colorTextPicker) colorTextPicker.value = text;
        if (colorTextText) colorTextText.value = text;
        updatePreview();
      });
    });
  });
});
</script>
@endpush
@endsection
