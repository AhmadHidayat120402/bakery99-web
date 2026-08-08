@extends('layouts.admin')

@section('title', 'Kelola Pengguna CMS Admin - 99 Bakery')

@section('content')
<!-- Page Header -->
<div class="page-header-box">
  <div>
    <h1 class="page-title-text">Kelola Pengguna CMS Admin</h1>
    <p class="page-subtitle-text">Atur akun pengelola, hak akses (Super Admin / Content Editor), dan ubah password pengguna.</p>
  </div>
  <div>
    <button class="btn-99-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengguna">
      <i class="bi bi-person-plus-fill"></i> Tambah Pengguna Baru
    </button>
  </div>
</div>

<!-- USER TABLE CARD -->
<div class="admin-card">
  <div class="admin-card-header">
    <div>
      <h5 class="admin-card-title">Daftar Akun Pengguna Admin</h5>
      <span class="text-muted" style="font-size: 0.8rem;">Total 3 akun pengelola terdaftar di sistem</span>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-admin align-middle">
      <thead>
        <tr>
          <th>Pengguna</th>
          <th>Email</th>
          <th>Hak Akses / Peran</th>
          <th>Status</th>
          <th>Tanggal Dibuat</th>
          <th class="text-end">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
            <div class="d-flex align-items-center gap-3">
              <div class="user-avatar" style="width: 42px; height: 42px; font-size: 1rem;">A</div>
              <div>
                <div class="fw-bold text-dark">Admin Utama 99</div>
                <span class="text-muted small">ID: USR-001</span>
              </div>
            </div>
          </td>
          <td class="fw-semibold text-dark">admin@99bakery.com</td>
          <td><span class="badge bg-danger text-white"><i class="bi bi-shield-lock-fill me-1"></i> Super Admin</span></td>
          <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Aktif</span></td>
          <td>01 Jan 2026</td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Pengguna" data-bs-toggle="modal" data-bs-target="#modalEditPengguna">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon me-1 sim-action-btn" data-action="Reset Password Admin Utama" title="Reset Password">
              <i class="bi bi-key-fill text-warning"></i>
            </button>
          </td>
        </tr>

        <tr>
          <td>
            <div class="d-flex align-items-center gap-3">
              <div class="user-avatar bg-primary" style="width: 42px; height: 42px; font-size: 1rem;">R</div>
              <div>
                <div class="fw-bold text-dark">Rina Editor Content</div>
                <span class="text-muted small">ID: USR-002</span>
              </div>
            </div>
          </td>
          <td class="fw-semibold text-dark">rina.editor@99bakery.com</td>
          <td><span class="badge bg-primary text-white"><i class="bi bi-pencil-fill me-1"></i> Content Editor</span></td>
          <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Aktif</span></td>
          <td>15 Feb 2026</td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Pengguna" data-bs-toggle="modal" data-bs-target="#modalEditPengguna">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon me-1 sim-action-btn" data-action="Reset Password Rina Editor" title="Reset Password">
              <i class="bi bi-key-fill text-warning"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Akun Rina" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>

        <tr>
          <td>
            <div class="d-flex align-items-center gap-3">
              <div class="user-avatar bg-secondary" style="width: 42px; height: 42px; font-size: 1rem;">B</div>
              <div>
                <div class="fw-bold text-dark">Budi Outlet Staff</div>
                <span class="text-muted small">ID: USR-003</span>
              </div>
            </div>
          </td>
          <td class="fw-semibold text-dark">budi.staff@99bakery.com</td>
          <td><span class="badge bg-secondary text-white"><i class="bi bi-shop me-1"></i> Staff Outlet</span></td>
          <td><span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Aktif</span></td>
          <td>10 Mar 2026</td>
          <td class="text-end">
            <button class="btn-action-icon me-1" title="Edit Pengguna" data-bs-toggle="modal" data-bs-target="#modalEditPengguna">
              <i class="bi bi-pencil-square"></i>
            </button>
            <button class="btn-action-icon me-1 sim-action-btn" data-action="Reset Password Budi Staff" title="Reset Password">
              <i class="bi bi-key-fill text-warning"></i>
            </button>
            <button class="btn-action-icon btn-action-delete sim-action-btn" data-action="Hapus Akun Budi" title="Hapus">
              <i class="bi bi-trash text-danger"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<!-- MODAL TAMBAH PENGGUNA WITH LIVE PREVIEW -->
<div class="modal fade" id="modalTambahPengguna" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-person-plus-fill me-1"></i> Tambah Pengguna Admin Baru</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Akun pengguna baru berhasil ditambahkan!'); bootstrap.Modal.getInstance(document.getElementById('modalTambahPengguna')).hide();">
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Lengkap</label>
            <input type="text" class="form-control" placeholder="Contoh: Ahmad Subagyo" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Alamat Email (Username Log In)</label>
            <input type="email" class="form-control" placeholder="ahmad@99bakery.com" required>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Kata Sandi (Password)</label>
              <input type="password" class="form-control" placeholder="••••••••" required>
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Hak Akses (Role)</label>
              <select class="form-select" required>
                <option value="superadmin">Super Admin</option>
                <option value="editor" selected>Content Editor</option>
                <option value="staff">Staff Outlet</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Foto Avatar (Opsional)</label>
            <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewUserAvatarTambah">
            <div class="img-preview-box">
              <span class="img-preview-label">Live Preview Avatar:</span>
              <img id="previewUserAvatarTambah" class="img-preview-target" src="{{ asset('img/logo.jpeg') }}" alt="Preview Avatar">
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger btn-sm rounded-pill">Simpan Pengguna</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- MODAL EDIT PENGGUNA WITH LIVE PREVIEW -->
<div class="modal fade" id="modalEditPengguna" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title fw-bold fs-6"><i class="bi bi-pencil-square me-1"></i> Edit Akun Pengguna</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <form onsubmit="event.preventDefault(); alert('[Simulasi] Data pengguna disimpan!'); bootstrap.Modal.getInstance(document.getElementById('modalEditPengguna')).hide();">
          <div class="mb-3">
            <label class="form-label fw-semibold small">Nama Lengkap</label>
            <input type="text" class="form-control" value="Rina Editor Content" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Email</label>
            <input type="email" class="form-control" value="rina.editor@99bakery.com" required>
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label fw-semibold small">Hak Akses (Role)</label>
              <select class="form-select">
                <option value="superadmin">Super Admin</option>
                <option value="editor" selected>Content Editor</option>
                <option value="staff">Staff Outlet</option>
              </select>
            </div>
            <div class="col-6">
              <label class="form-label fw-semibold small">Status Akun</label>
              <select class="form-select">
                <option value="aktif" selected>Aktif</option>
                <option value="nonaktif">Nonaktifkan</option>
              </select>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label fw-semibold small">Ganti Foto Avatar</label>
            <input type="file" class="form-control img-upload-input" accept="image/*" data-preview-target="previewUserAvatarEdit">
            <div class="img-preview-box">
              <span class="img-preview-label">Live Preview Avatar:</span>
              <img id="previewUserAvatarEdit" class="img-preview-target" src="{{ asset('img/logo.jpeg') }}" alt="Preview Avatar">
            </div>
          </div>
          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-dark btn-sm rounded-pill">Update Pengguna</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
