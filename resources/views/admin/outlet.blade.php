@extends('admin.layouts.admin')

@section('title', 'Kelola Outlet & Kontak Landing Page')

@section('content')

    <!-- PAGE HEADER -->

    <div class="page-header-box">
        <div class="d-flex justify-content-between align-items-center gap-3">


            <div>
                <h1 class="page-title-text">
                    Kelola Outlet & Kontak Landing Page
                </h1>

                <p class="page-subtitle-text mb-0">
                    Atur informasi alamat cabang, jam operasional,
                    link Google Maps, dan tombol pemesanan WhatsApp.
                </p>
            </div>

            <!-- TAMBAH OUTLET -->
            @if ($outlets->isNotEmpty())
                <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal"
                    data-bs-target="#createOutletModal">
                    <i class="bi bi-plus-lg me-1"></i>
                    Tambah Outlet
                </button>
            @endif

        </div>


    </div>

    <!-- SUCCESS MESSAGE -->

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- VALIDATION ERROR -->

    @if ($errors->any())


        <div class="alert alert-danger mt-4">

            <strong>
                Data belum dapat disimpan.
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>


    @endif

    <!-- OUTLETS -->

    <div class="row g-4 mb-4 mt-1">


        @forelse ($outlets as $outlet)
            <div class="col-12 col-md-6">

                <div class="admin-card h-100 mb-0">

                    <!-- HEADER -->
                    <div class="admin-card-header bg-light">

                        <div class="d-flex align-items-center gap-2">

                            <i class="bi bi-geo-alt-fill text-danger fs-5"></i>

                            <h5 class="admin-card-title mb-0">
                                {{ $outlet->name }}
                            </h5>

                        </div>


                        <div class="d-flex gap-1">

                            @if ($outlet->is_main)
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-star-fill me-1"></i>
                                    Outlet Utama
                                </span>
                            @endif


                            @if ($outlet->is_active)
                                <span class="badge bg-success text-white">
                                    Tampil di Landing Page
                                </span>
                            @else
                                <span class="badge bg-secondary text-white">
                                    Tidak Ditampilkan
                                </span>
                            @endif

                        </div>

                    </div>


                    <!-- BODY -->
                    <div class="p-4">

                        <form action="{{ route('admin.outlets.update', $outlet) }}" method="POST">

                            @csrf
                            @method('PUT')


                            <!-- NAMA -->
                            <div class="mb-3">

                                <label class="small text-muted fw-bold">
                                    NAMA OUTLET
                                </label>

                                <input type="text" name="name" class="form-control" value="{{ $outlet->name }}"
                                    required>

                            </div>


                            <!-- ALAMAT -->
                            <div class="mb-3">

                                <label class="small text-muted fw-bold">
                                    ALAMAT CABANG
                                </label>

                                <textarea name="address" class="form-control" rows="2" required>{{ $outlet->address }}</textarea>

                            </div>


                            <!-- JAM -->
                            <div class="mb-3">

                                <label class="small text-muted fw-bold">
                                    JAM OPERASIONAL
                                </label>

                                <input type="text" name="operating_hours" class="form-control"
                                    value="{{ $outlet->operating_hours }}" required>

                            </div>


                            <!-- WHATSAPP -->
                            <div class="mb-3">

                                <label class="small text-muted fw-bold">
                                    NO. WHATSAPP OUTLET
                                </label>

                                <input type="text" name="phone_whatsapp" class="form-control"
                                    value="{{ $outlet->phone_whatsapp }}" placeholder="0852-xxxx-xxxx">

                            </div>


                            <!-- GOOGLE MAPS -->
                            <div class="mb-3">

                                <label class="small text-muted fw-bold">
                                    LINK GOOGLE MAPS
                                </label>

                                <input type="url" name="google_maps_url" class="form-control form-control-sm"
                                    value="{{ $outlet->google_maps_url }}" placeholder="https://maps.google.com/...">

                            </div>


                            <!-- IMAGE -->
                            <div class="mb-3">

                                <label class="small text-muted fw-bold">
                                    PATH / URL GAMBAR OUTLET
                                </label>

                                <input type="text" name="image" class="form-control form-control-sm"
                                    value="{{ $outlet->image }}" placeholder="img/outlet.webp">

                            </div>


                            <!-- STATUS -->
                            <div class="d-flex gap-4 mb-3">

                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        id="active{{ $outlet->id }}" {{ $outlet->is_active ? 'checked' : '' }}>

                                    <label class="form-check-label" for="active{{ $outlet->id }}">
                                        Tampilkan di Landing Page
                                    </label>

                                </div>


                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" name="is_main" value="1"
                                        id="main{{ $outlet->id }}" {{ $outlet->is_main ? 'checked' : '' }}>

                                    <label class="form-check-label" for="main{{ $outlet->id }}">
                                        Outlet Utama
                                    </label>

                                </div>

                            </div>


                            <!-- SAVE -->
                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill w-100 mt-2">
                                <i class="bi bi-save me-1"></i>

                                Simpan Perubahan

                            </button>

                        </form>


                        <!-- DELETE -->
                        <form action="{{ route('admin.outlets.destroy', $outlet) }}" method="POST" class="mt-2"
                            onsubmit="return confirm('Yakin ingin menghapus outlet {{ $outlet->name }}?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill w-100">
                                <i class="bi bi-trash me-1"></i>
                                Hapus Outlet
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            <!-- EMPTY -->
            <div class="col-12">

                <div class="admin-card text-center py-5">

                    <i class="bi bi-shop display-4 text-muted"></i>

                    <h5 class="mt-3">
                        Belum Ada Outlet
                    </h5>

                    <p class="text-muted">
                        Belum ada data outlet.
                    </p>

                    <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal"
                        data-bs-target="#createOutletModal">
                        <i class="bi bi-plus-lg me-1"></i>
                        Tambah Outlet
                    </button>

                </div>

            </div>
        @endforelse


    </div>

    <!-- ===================================================== -->

    <!-- MODAL TAMBAH OUTLET -->

    <!-- ===================================================== -->

    <div class="modal fade" id="createOutletModal" tabindex="-1" aria-hidden="true">


        <div class="modal-dialog modal-lg modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <div>

                        <h5 class="modal-title">
                            <i class="bi bi-shop me-2 text-danger"></i>
                            Tambah Outlet
                        </h5>

                        <small class="text-muted">
                            Tambahkan outlet baru ke landing page.
                        </small>

                    </div>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                </div>


                <form action="{{ route('admin.outlets.store') }}" method="POST">

                    @csrf

                    <div class="modal-body">


                        <!-- NAMA -->
                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Nama Outlet
                            </label>

                            <input type="text" name="name" class="form-control"
                                placeholder="Contoh: Outlet Tawang Alun (Pusat)" required>

                        </div>


                        <!-- ALAMAT -->
                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Alamat Cabang
                            </label>

                            <textarea name="address" class="form-control" rows="2" placeholder="Alamat lengkap outlet" required></textarea>

                        </div>


                        <!-- JAM -->
                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Jam Operasional
                            </label>

                            <input type="text" name="operating_hours" class="form-control"
                                placeholder="Contoh: Setiap Hari (07.00 - 21.00 WIB)" required>

                        </div>


                        <!-- WHATSAPP -->
                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                No. WhatsApp
                            </label>

                            <input type="text" name="phone_whatsapp" class="form-control"
                                placeholder="0852-5722-0335">

                        </div>


                        <!-- GOOGLE MAPS -->
                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Link Google Maps
                            </label>

                            <input type="url" name="google_maps_url" class="form-control"
                                placeholder="https://maps.google.com/...">

                        </div>


                        <!-- IMAGE -->
                        <div class="mb-3">

                            <label class="form-label fw-bold">
                                Path / URL Gambar
                            </label>

                            <input type="text" name="image" class="form-control" value="img/outlet.webp"
                                placeholder="img/outlet.webp">

                        </div>


                        <!-- OPTIONS -->
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                        id="createActive" checked>

                                    <label class="form-check-label" for="createActive">
                                        Tampilkan di Landing Page
                                    </label>

                                </div>

                            </div>


                            <div class="col-md-6">

                                <div class="form-check form-switch">

                                    <input class="form-check-input" type="checkbox" name="is_main" value="1"
                                        id="createMain">

                                    <label class="form-check-label" for="createMain">
                                        Jadikan Outlet Utama
                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="modal-footer">

                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="bi bi-save me-1"></i>
                            Simpan Outlet
                        </button>

                    </div>

                </form>

            </div>

        </div>


    </div>

@endsection
