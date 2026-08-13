@extends('admin.layouts.admin')

@section('title', 'Kelola Pengguna')

@section('content')

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- VALIDATION ERROR --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- PAGE HEADER -->
    <div class="page-header-box">
        <div>
            <h1 class="page-title-text">Kelola Pengguna Admin</h1>
            <p class="page-subtitle-text">Atur akun pengelola</p>
        </div>

        <div>
            <button class="btn-99-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPengguna">

                <i class="bi bi-person-plus-fill"></i>
                Tambah Pengguna Baru
            </button>
        </div>
    </div>


    <!-- USER TABLE -->
    <div class="admin-card">

        <div class="admin-card-header">
            <div>
                <h5 class="admin-card-title">
                    Daftar Akun Pengguna Admin
                </h5>
            </div>
        </div>

        <div class="table-responsive">

            <table class="table table-admin align-middle">

                <thead>
                    <tr>
                        <th>Pengguna</th>
                        <th>Email</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($users as $user)
                        <tr>
                            {{-- USER --}}
                            <td>
                                <div class="d-flex align-items-center gap-3">

                                    <div class="user-avatar" style="width:42px;height:42px;font-size:1rem;">

                                        {{ strtoupper(substr($user->name, 0, 1)) }}

                                    </div>

                                    <div>

                                        <div class="fw-bold text-dark">
                                            {{ $user->name }}
                                        </div>

                                    </div>

                                </div>
                            </td>


                            {{-- EMAIL --}}
                            <td class="fw-semibold text-dark">
                                {{ $user->email }}
                            </td>
                            {{-- ACTION --}}
                            <td class="text-end">

                                {{-- EDIT --}}
                                <button class="btn-action-icon me-1" title="Edit Pengguna" data-bs-toggle="modal"
                                    data-bs-target="#modalEditPengguna{{ $user->id }}">

                                    <i class="bi bi-pencil-square"></i>

                                </button>


                                {{-- DELETE --}}
                                @if (auth()->id() !== $user->id)
                                    <button type="button" class="btn-action-icon text-danger" title="Hapus Pengguna"
                                        data-bs-toggle="modal" data-bs-target="#modalHapusPengguna"
                                        data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                        data-user-email="{{ $user->email }}">

                                        <i class="bi bi-trash"></i>

                                    </button>
                                @endif

                            </td>

                        </tr>

                        {{-- ====================================================== --}}
                        {{-- MODAL HAPUS PENGGUNA --}}
                        {{-- ====================================================== --}}

                        <div class="modal fade" id="modalHapusPengguna" tabindex="-1"
                            aria-labelledby="modalHapusPenggunaLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content border-0 shadow">

                                    {{-- HEADER --}}
                                    <div class="modal-header border-0">

                                        <h5 class="modal-title fw-bold" id="modalHapusPenggunaLabel">

                                            <i class="bi bi-trash3-fill text-danger me-2"></i>

                                            Hapus Pengguna

                                        </h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>

                                    </div>


                                    {{-- BODY --}}
                                    <div class="modal-body text-center px-4 pb-4">

                                        <div class="d-flex align-items-center justify-content-center mx-auto mb-3"
                                            style="
                        width: 64px;
                        height: 64px;
                        border-radius: 50%;
                        background: #fdecec;
                    ">

                                            <i class="bi bi-person-x-fill text-danger" style="font-size: 1.7rem;">
                                            </i>

                                        </div>


                                        <h5 class="fw-bold mb-2">
                                            Yakin ingin menghapus pengguna?
                                        </h5>


                                        <p class="text-muted mb-3">
                                            Akun berikut akan dihapus secara permanen:
                                        </p>


                                        {{-- USER YANG AKAN DIHAPUS --}}
                                        <div class="bg-light rounded-3 p-3 text-start mb-3">

                                            <div class="d-flex align-items-center gap-3">

                                                <div id="hapusUserAvatar" class="user-avatar"
                                                    style="
                                width: 45px;
                                height: 45px;
                                font-size: 1rem;
                            ">
                                                    A
                                                </div>

                                                <div>

                                                    <div id="hapusUserName" class="fw-bold text-dark">
                                                        Nama Pengguna
                                                    </div>

                                                    <div id="hapusUserEmail" class="small text-muted">
                                                        email@example.com
                                                    </div>

                                                </div>

                                            </div>

                                        </div>


                                        <div class="alert alert-warning text-start small mb-0">

                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>

                                            Data pengguna yang sudah dihapus tidak dapat dikembalikan.

                                        </div>

                                    </div>


                                    {{-- FOOTER --}}
                                    <div class="modal-footer border-0 pt-0 px-4 pb-4">

                                        <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4"
                                            data-bs-dismiss="modal">

                                            Batal

                                        </button>


                                        <form id="formHapusPengguna" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4">

                                                <i class="bi bi-trash3-fill me-1"></i>

                                                Ya, Hapus Pengguna

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>
                        {{-- MODAL EDIT --}}
                        <div class="modal fade" id="modalEditPengguna{{ $user->id }}" tabindex="-1">

                            <div class="modal-dialog modal-dialog-centered">

                                <div class="modal-content border-0 shadow">

                                    <div class="modal-header bg-dark text-white">

                                        <h5 class="modal-title fw-bold fs-6">

                                            <i class="bi bi-pencil-square me-1"></i>

                                            Edit Akun Pengguna

                                        </h5>

                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                                        </button>

                                    </div>


                                    <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST">

                                        @csrf
                                        @method('PUT')


                                        <div class="modal-body p-4">

                                            {{-- NAME --}}
                                            <div class="mb-3">

                                                <label class="form-label fw-semibold small">
                                                    Nama Lengkap
                                                </label>

                                                <input type="text" name="name" class="form-control"
                                                    value="{{ $user->name }}" required>

                                            </div>


                                            {{-- EMAIL --}}
                                            <div class="mb-3">

                                                <label class="form-label fw-semibold small">
                                                    Email
                                                </label>

                                                <input type="email" name="email" class="form-control"
                                                    value="{{ $user->email }}" required>

                                            </div>
                                        </div>


                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary btn-sm rounded-pill"
                                                data-bs-dismiss="modal">

                                                Batal

                                            </button>

                                            <button type="submit" class="btn btn-dark btn-sm rounded-pill">

                                                Update Pengguna

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    @empty

                        <tr>

                            <td colspan="6" class="text-center py-5 text-muted">

                                <i class="bi bi-people fs-1 d-block mb-2"></i>

                                Belum ada pengguna.

                            </td>

                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>
    {{-- MODAL TAMBAH PENGGUNA --}}

    <div class="modal fade" id="modalTambahPengguna" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content border-0 shadow">

                <div class="modal-header bg-danger text-white">

                    <h5 class="modal-title fw-bold fs-6">

                        <i class="bi bi-person-plus-fill me-1"></i>

                        Tambah Pengguna Admin Baru

                    </h5>

                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>

                </div>


                <form action="{{ route('admin.pengguna.store') }}" method="POST">

                    @csrf

                    <div class="modal-body p-4">

                        {{-- NAME --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold small">
                                Nama Lengkap
                            </label>

                            <input type="text" name="name" class="form-control"
                                placeholder="Contoh: Ahmad Subagyo" required>

                        </div>


                        {{-- EMAIL --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold small">
                                Alamat Email
                            </label>

                            <input type="email" name="email" class="form-control" placeholder="ahmad@99bakery.com"
                                required>

                        </div>


                        {{-- PASSWORD --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold small">
                                Kata Sandi (Password)
                            </label>

                            <div class="input-group">

                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="••••••••" required>

                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="togglePassword('password', 'eyeIcon')">

                                    <i class="bi bi-eye" id="eyeIcon">
                                    </i>

                                </button>

                            </div>

                        </div>
                    </div>


                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary btn-sm rounded-pill" data-bs-dismiss="modal">

                            Batal

                        </button>

                        <button type="submit" class="btn btn-danger btn-sm rounded-pill">

                            Simpan Pengguna

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        function togglePassword(inputId, iconId) {
            const password = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (password.type === 'password') {

                password.type = 'text';

                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');

            } else {

                password.type = 'password';

                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');

            }
        }

        // hapus pengguna

        const modalHapusPengguna =
            document.getElementById('modalHapusPengguna');

        if (modalHapusPengguna) {

            modalHapusPengguna.addEventListener(
                'show.bs.modal',
                function(event) {

                    const button = event.relatedTarget;

                    const userId =
                        button.getAttribute('data-user-id');

                    const userName =
                        button.getAttribute('data-user-name');

                    const userEmail =
                        button.getAttribute('data-user-email');


                    // Nama
                    document.getElementById('hapusUserName')
                        .textContent = userName;


                    // Email
                    document.getElementById('hapusUserEmail')
                        .textContent = userEmail;


                    // Avatar
                    document.getElementById('hapusUserAvatar')
                        .textContent =
                        userName.charAt(0).toUpperCase();


                    // Action form delete
                    document.getElementById('formHapusPengguna')
                        .action =
                        `/admin/pengguna/${userId}`;

                }
            );

        }
    </script>
@endpush
