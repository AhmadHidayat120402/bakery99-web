@extends('admin.layouts.admin')

@section('title', 'Kelola Konten Tentang Toko')

@section('content')

    <!-- Page Header -->
    <div class="page-header-box">
        <div>
            <h1 class="page-title-text">Kelola Konten Tentang Toko</h1>

            <p class="page-subtitle-text">
                Atur narasi profil 99 Bakery, keunggulan utama,
                dan sertifikat jaminan kualitas halal.
            </p>
        </div>
    </div>


    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- Alert Error --}}
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


    <!-- FORM PROFIL -->
    <div class="admin-card mb-4">

        <div class="admin-card-header">
            <h5 class="admin-card-title">
                <i class="bi bi-journal-text text-danger me-2"></i>
                Profil & Deskripsi Cerita Toko
            </h5>
        </div>


        <div class="p-4">

            {{--
            Kalau data sudah ada:
            UPDATE

            Kalau belum ada:
            STORE
        --}}
            <form action="{{ $about ? route('admin.about.update', $about->id) : route('admin.about.store') }}"
                method="POST" enctype="multipart/form-data">

                @csrf

                @if ($about)
                    @method('PUT')
                @endif


                <div class="row g-3">

                    <!-- TITLE -->
                    <div class="col-12 col-md-6">

                        <label class="form-label small fw-bold">
                            Judul Seksi (Subheading)
                        </label>

                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $about->title ?? '') }}" placeholder="Contoh: 99 Bakery" required>

                    </div>


                    <!-- TAGLINE -->
                    <div class="col-12 col-md-6">

                        <label class="form-label small fw-bold">
                            Tagline Singkat
                        </label>

                        <input type="text" name="tagline" class="form-control"
                            value="{{ old('tagline', $about->tagline ?? '') }}"
                            placeholder="Contoh: Roti Fresh Setiap Hari dengan Bahan Pilihan" required>

                    </div>


                    <!-- DESCRIPTION -->
                    <div class="col-12">

                        <label class="form-label small fw-bold">
                            Deskripsi Cerita Toko
                        </label>

                        <textarea name="description" class="form-control" rows="5" placeholder="Tuliskan cerita tentang toko..." required>{{ old('description', $about->description ?? '') }}</textarea>

                    </div>


                    <!-- FOTO TOKO -->
                    <div class="col-12 col-md-6">

                        <label class="form-label small fw-bold">
                            Foto Profil Toko / Outlet
                        </label>

                        <input type="file" name="store_photo" class="form-control img-upload-input" accept="image/*"
                            data-preview-target="previewTokoPhoto">


                        <div class="img-preview-box mt-3">

                            <span class="img-preview-label">
                                Preview Foto Toko:
                            </span>


                            <img id="previewTokoPhoto" class="img-preview-target"
                                src="{{ $about && $about->store_photo ? asset('storage/' . $about->store_photo) : asset('img/outlet.webp') }}"
                                alt="Toko Photo">

                        </div>

                    </div>


                    <!-- LOGO HALAL -->
                    <div class="col-12 col-md-6">

                        <label class="form-label small fw-bold">
                            Logo Sertifikasi Halal
                        </label>

                        <input type="file" name="halal_logo" class="form-control img-upload-input" accept="image/*"
                            data-preview-target="previewHalalLogo">


                        <div class="img-preview-box mt-3">

                            <span class="img-preview-label">
                                Preview Sertifikat Halal:
                            </span>


                            <img id="previewHalalLogo" class="img-preview-target"
                                src="{{ $about && $about->halal_logo ? asset('storage/' . $about->halal_logo) : asset('img/logo-halal.jpeg') }}"
                                alt="Halal Logo">

                        </div>

                    </div>

                </div>


                <!-- BUTTON -->
                <div class="mt-4 text-end">

                    @if ($about)
                        <button type="submit" class="btn-99-primary">
                            <i class="bi bi-save me-1"></i>
                            Update Profil Toko
                        </button>
                    @else
                        <button type="submit" class="btn-99-primary">
                            <i class="bi bi-save me-1"></i>
                            Simpan Profil Toko
                        </button>
                    @endif

                </div>

            </form>

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.img-upload-input').forEach(function(input) {

                input.addEventListener('change', function(event) {

                    const file = event.target.files[0];

                    if (!file) {
                        return;
                    }

                    // Pastikan file adalah gambar
                    if (!file.type.startsWith('image/')) {
                        return;
                    }

                    const previewId = input.dataset.previewTarget;
                    const preview = document.getElementById(previewId);

                    if (!preview) {
                        return;
                    }

                    // Buat preview gambar
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };

                    reader.readAsDataURL(file);

                });

            });

        });
    </script>
@endpush
