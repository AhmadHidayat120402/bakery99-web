@extends('admin.layouts.admin')

@section('title', 'Kelola Konten Tentang Toko')

@section('content')

    <!-- Page Header -->
    <div class="page-header-box">
        <div>
            <h1 class="page-title-text">Kelola Konten Tentang Toko</h1>
            <p class="page-subtitle-text">
                Atur narasi profil 99 Bakery dan komitmen kualitas utama.
            </p>
        </div>
    </div>

    {{-- Alert Success --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
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

    <!-- MAIN CONTENT ROW: FORM (LEFT) & LIVE PREVIEW (RIGHT) -->
    <div class="row g-4 mb-5">

        <!-- LEFT COLUMN: FORM INPUT -->
        <div class="col-lg-6">
            <div class="admin-card">
                <div class="admin-card-header bg-light py-3">
                    <h5 class="admin-card-title mb-0 fs-6 fw-bold">
                        <i class="bi bi-pencil-square text-danger me-2"></i>
                        Form Isian Profil Toko
                    </h5>
                </div>

                <div class="p-4">
                    <form action="{{ $about ? route('admin.about.update', $about->id) : route('admin.about.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($about)
                            @method('PUT')
                        @endif

                        <div class="row g-3">

                            <!-- SUBTITLE HERO -->
                            <div class="col-12">
                                <label class="form-label small fw-bold">
                                    Subtitle Pengantar Hero (Atas Halaman)
                                </label>
                                <textarea name="hero_subtitle" id="inputHeroSubtitle" class="form-control" rows="2"
                                    placeholder="Contoh: Mengenal perjalanan 99 Bakery Jember dalam menghadirkan roti hajatan...">{{ old('hero_subtitle', $about->hero_subtitle ?? '') }}</textarea>
                                <small class="text-muted fs-7">
                                    Teks pendek di bawah judul utama halaman Profil & SONGO.
                                </small>
                            </div>

                            <!-- TITLE -->
                            <div class="col-12 col-md-6">
                                <label class="form-label small fw-bold">
                                    Judul Komitmen <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="title" id="inputTitle" class="form-control"
                                    value="{{ old('title', $about->title ?? '') }}" placeholder="Contoh: Solusi Roti Fresh & Terpercaya" required>
                            </div>

                            <!-- TAGLINE -->
                            <div class="col-12 col-md-6">
                                <label class="form-label small fw-bold">
                                    Tagline Badge <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tagline" id="inputTagline" class="form-control"
                                    value="{{ old('tagline', $about->tagline ?? '') }}"
                                    placeholder="Contoh: Komitmen Kualitas 100% Halal & Fresh Daily" required>
                            </div>

                            <!-- DESCRIPTION -->
                            <div class="col-12">
                                <label class="form-label small fw-bold">
                                    Deskripsi Cerita Toko <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" id="inputDescription" class="form-control" rows="6"
                                    placeholder="Tuliskan cerita tentang toko..." required>{{ old('description', $about->description ?? '') }}</textarea>
                                <div class="form-text text-muted fs-7 mt-1">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Tips Format: Gunakan <code>**teks tebal**</code> untuk menebalkan kata, dan tekan <code>Enter</code> untuk membuat baris baru.
                                </div>
                            </div>

                            <!-- UPLOAD FOTO TOKO (DRAG AND DROP) -->
                            <div class="col-12">
                                <label class="form-label small fw-bold d-block">Foto Profil Toko / Gerai</label>
                                <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
                                    <input type="file" name="store_photo" id="inputStorePhoto" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer img-upload-trigger" accept="image/*" style="z-index: 10;">
                                    <div class="upload-placeholder-content {{ $about && $about->store_photo ? 'd-none' : '' }}">
                                        <i class="bi bi-cloud-arrow-up-fill fs-2 text-danger"></i>
                                        <div class="fw-bold small text-dark mt-1">Klik atau Geser Foto ke Sini</div>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Format JPG, PNG, WEBP (Maks 10MB)</small>
                                    </div>
                                    <div class="upload-preview-container mt-1 {{ $about && $about->store_photo ? '' : 'd-none' }}">
                                        <img id="formPreviewStorePhoto" src="{{ $about && $about->store_photo ? asset('storage/' . $about->store_photo) : asset('img/outlet.webp') }}" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 140px; object-fit: contain;">
                                        <div class="mt-2"><span class="badge bg-danger rounded-pill px-3 py-1">Ganti Foto</span></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- BUTTON -->
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn-99-primary px-4">
                                {{ $about ? 'Update Profil Toko' : 'Simpan Profil Toko' }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <!-- RIGHT COLUMN: LIVE PREVIEW (MIRIP FULL PUBLIK PAGE) -->
        <div class="col-lg-6">
            <div class="admin-card sticky-top" style="top: 20px; z-index: 10;">
                <div class="admin-card-header bg-dark text-white d-flex justify-content-between align-items-center py-2 px-3">
                    <h6 class="admin-card-title mb-0 text-white fs-7">
                        Live Preview Tampilan Publik
                    </h6>
                </div>

                <div class="p-3 bg-white">

                    <!-- 1. BREADCRUMB & HEADER HERO PREVIEW -->
                    <div class="bg-warm-section p-3 rounded-3 border mb-3">
                        <div class="text-muted small fs-8 mb-1">
                            <span class="text-danger fw-semibold">Beranda</span> / Profil & SONGO
                        </div>
                        <h5 class="fw-extrabold mb-1 fs-6">Profil Perusahaan & Nilai <span class="text-danger">SONGO</span></h5>
                        <p id="previewHeroSubtitle" class="text-muted mb-0" style="font-size: 11px; line-height: 1.5;">
                            {{ $about->hero_subtitle ?? 'Mengenal perjalanan 99 Bakery Jember dalam menghadirkan roti hajatan, brownies, bolen, dan kue basah berkualitas tinggi dengan kehangatan rasa keluarga.' }}
                        </p>
                    </div>

                    <!-- 2. KOMITMEN 99 BAKERY SECTION PREVIEW (MIRIP FULL PUBLIK) -->
                    <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                        <div class="row align-items-center g-3">

                            <!-- FOTO TOKO + TAGLINE BADGE -->
                            <div class="col-12">
                                <div class="position-relative overflow-hidden rounded-4 shadow-sm border border-2 border-white">
                                    <img id="previewStorePhoto"
                                        src="{{ $about && $about->store_photo ? asset('storage/' . $about->store_photo) : asset('img/outlet.webp') }}"
                                        class="w-100 rounded-4" style="max-height: 240px; object-fit: cover;" alt="Preview Store Photo">

                                    <!-- Tagline Badge Pill (Bottom-Left) -->
                                    <div class="position-absolute bottom-0 start-0 m-2 bg-white bg-opacity-95 px-3 py-2 rounded-3 shadow-sm border border-white">
                                        <span class="fw-bold text-danger" style="font-size: 11px;">
                                            <i class="bi bi-patch-check-fill text-danger me-1"></i>
                                            <span id="previewTagline">{{ $about->tagline ?? 'Komitmen Kualitas 100% Halal & Fresh Daily' }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- DESKRIPSI & STATISTIK (SEPERTI HASIL PUBLIK) -->
                            <div class="col-12 mt-3">
                                <div class="badge bg-danger bg-opacity-10 text-danger mb-2 fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">KOMITMEN KUALITAS</div>
                                <h5 id="previewTitle" class="fw-bold mb-2 text-dark fs-6" style="font-weight: 800;">
                                    {{ $about->title ?? 'Solusi Roti Fresh & Terpercaya' }}
                                </h5>

                                <div id="previewDescription" class="text-muted mb-3" style="font-size: 11px; line-height: 1.7;">
                                    @if ($about && $about->description)
                                        @php
                                            $formatted = e($about->description);
                                            $formatted = preg_replace('/\*\*(.*?)\*\*/s', '<strong>$1</strong>', $formatted);
                                            $formatted = nl2br($formatted);
                                        @endphp
                                        {!! $formatted !!}
                                    @else
                                        99 Bakery Jember adalah usaha kuliner spesialis toko roti dan kue...
                                    @endif
                                </div>

                                <!-- STAT BOXES -->
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="p-2 bg-warm-section rounded-3 border border-danger border-opacity-25">
                                            <div class="fw-bold text-danger mb-0" style="font-size: 12px;"><i class="bi bi-shop me-1"></i> 2 Outlet</div>
                                            <small class="text-muted fw-semibold d-block" style="font-size: 10px;">Tawang Alun & Kampus Jember</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="p-2 bg-warm-section rounded-3 border border-danger border-opacity-25">
                                            <div class="fw-bold text-danger mb-0" style="font-size: 12px;"><i class="bi bi-fire me-1"></i> 100% Fresh</div>
                                            <small class="text-muted fw-semibold d-block" style="font-size: 10px;">Dioven Setiap Hari</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Elements Input
            const inputHeroSubtitle = document.getElementById('inputHeroSubtitle');
            const inputTitle = document.getElementById('inputTitle');
            const inputTagline = document.getElementById('inputTagline');
            const inputDescription = document.getElementById('inputDescription');
            const inputStorePhoto = document.getElementById('inputStorePhoto');

            // Elements Preview
            const previewHeroSubtitle = document.getElementById('previewHeroSubtitle');
            const previewTitle = document.getElementById('previewTitle');
            const previewTagline = document.getElementById('previewTagline');
            const previewDescription = document.getElementById('previewDescription');
            const previewStorePhoto = document.getElementById('previewStorePhoto');
            const formPreviewStorePhoto = document.getElementById('formPreviewStorePhoto');

            // Realtime Text Listener
            if (inputHeroSubtitle) {
                inputHeroSubtitle.addEventListener('input', function() {
                    previewHeroSubtitle.textContent = this.value.trim() || 'Mengenal perjalanan 99 Bakery Jember dalam menghadirkan roti hajatan...';
                });
            }

            if (inputTitle) {
                inputTitle.addEventListener('input', function() {
                    previewTitle.textContent = this.value.trim() || 'Solusi Roti Fresh & Terpercaya';
                });
            }

            if (inputTagline) {
                inputTagline.addEventListener('input', function() {
                    previewTagline.textContent = this.value.trim() || 'Komitmen Kualitas 100% Halal & Fresh Daily';
                });
            }

            if (inputDescription) {
                inputDescription.addEventListener('input', function() {
                    const val = this.value.trim();
                    if (!val) {
                        previewDescription.innerHTML = '99 Bakery Jember adalah usaha kuliner spesialis toko roti dan kue...';
                        return;
                    }
                    // Escape HTML
                    let safe = val.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
                    // Parse **bold**
                    safe = safe.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
                    // Parse newline to <br>
                    safe = safe.replace(/\n/g, '<br>');
                    previewDescription.innerHTML = safe;
                });
            }

            // Realtime Drag & Drop Image File Reader
            if (inputStorePhoto) {
                inputStorePhoto.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            if (previewStorePhoto) previewStorePhoto.src = evt.target.result;
                            if (formPreviewStorePhoto) formPreviewStorePhoto.src = evt.target.result;

                            const placeholder = inputStorePhoto.parentElement.querySelector('.upload-placeholder-content');
                            const previewContainer = inputStorePhoto.parentElement.querySelector('.upload-preview-container');

                            if (placeholder) placeholder.classList.add('d-none');
                            if (previewContainer) previewContainer.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }

        });
    </script>
@endpush
