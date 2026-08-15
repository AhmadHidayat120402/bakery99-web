@extends('admin.layouts.admin')

@section('title', 'Kelola Outlet & Kontak Landing Page')

@section('content')

    <!-- PAGE HEADER -->
    <div class="page-header-box">
        <div>
            <h1 class="page-title-text">Kelola Outlet & Gerai</h1>
            <p class="page-subtitle-text">Atur informasi lokasi gerai, foto outlet, jam operasional, fasilitas pisah koma, dan kontak WhatsApp.</p>
        </div>
        <div>
            <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createOutletModal">
                <i class="bi bi-plus-lg"></i> Tambah Outlet
            </button>
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
            <strong>Data belum dapat disimpan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- OUTLETS LIST -->
    <div class="row g-4 mb-4 mt-1">
        @forelse ($outlets as $outlet)
            <div class="col-12 col-lg-6">
                <div class="admin-card h-100 mb-0">

                    <!-- HEADER -->
                    <div class="admin-card-header bg-light d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
                            <h5 class="admin-card-title mb-0">{{ $outlet->name }}</h5>
                        </div>

                        <div class="d-flex gap-1">
                            @if ($outlet->is_main)
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-star-fill me-1"></i> Utama
                                </span>
                            @endif

                            @if ($outlet->is_active)
                                <span class="badge bg-success text-white">Tampil</span>
                            @else
                                <span class="badge bg-secondary text-white">Nonaktif</span>
                            @endif
                        </div>
                    </div>

                    <!-- BODY FORM EDIT -->
                    <div class="p-4">
                        <form action="{{ route('admin.outlets.update', $outlet) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <!-- NAMA -->
                                <div class="col-12 col-md-6">
                                    <label class="small text-muted fw-bold">NAMA OUTLET <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" value="{{ $outlet->name }}" required>
                                </div>

                                <!-- WHATSAPP -->
                                <div class="col-12 col-md-6">
                                    <label class="small text-muted fw-bold">NO. WHATSAPP OUTLET</label>
                                    <input type="text" name="phone_whatsapp" class="form-control" value="{{ $outlet->phone_whatsapp }}" placeholder="0852-xxxx-xxxx">
                                </div>

                                <!-- ALAMAT -->
                                <div class="col-12">
                                    <label class="small text-muted fw-bold">ALAMAT CABANG <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control" rows="2" required>{{ $outlet->address }}</textarea>
                                </div>

                                <!-- JAM OPERASIONAL -->
                                <div class="col-12 col-md-6">
                                    <label class="small text-muted fw-bold">JAM OPERASIONAL <span class="text-danger">*</span></label>
                                    <input type="text" name="operating_hours" class="form-control" value="{{ $outlet->operating_hours }}" required>
                                    <small class="text-muted fs-8 d-block mt-1">Format contoh: 07.00 - 21.00 WIB</small>
                                </div>

                                <!-- GOOGLE MAPS -->
                                <div class="col-12 col-md-6">
                                    <label class="small text-muted fw-bold">LINK GOOGLE MAPS</label>
                                    <input type="url" name="google_maps_url" class="form-control" value="{{ $outlet->google_maps_url }}" placeholder="https://maps.google.com/...">
                                </div>

                                <!-- FASILITAS / FEATURES -->
                                <div class="col-12">
                                    <label class="small text-muted fw-bold">FASILITAS / KEY FEATURES (PISAHKAN DENGAN KOMA)</label>
                                    <textarea name="features" class="form-control" rows="2" placeholder="Contoh: Dapur Utama, Parkir Luas, Takeaway, Roti Fresh Harian">{{ $outlet->features }}</textarea>
                                    <small class="text-muted fs-8 d-block mt-1">Setiap kata yang dipisah koma akan dijadikan badge chip di tampilan publik.</small>
                                </div>

                                <!-- FOTO OUTLET FILE UPLOAD (DRAG & DROP) -->
                                <div class="col-12">
                                    <label class="small text-muted fw-bold d-block">FOTO FISIK GERAI / OUTLET (OPSIONAL)</label>
                                    <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
                                        <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer outlet-upload-trigger" accept="image/*" style="z-index: 10;">

                                        <div class="upload-placeholder-content {{ $outlet->image ? 'd-none' : '' }}">
                                            <i class="bi bi-cloud-arrow-up-fill fs-2 text-danger"></i>
                                            <div class="fw-bold small text-dark mt-1">Klik atau Geser Foto ke Sini</div>
                                            <small class="text-muted d-block" style="font-size: 0.75rem;">Format JPG, PNG, WEBP (Maks 10MB)</small>
                                        </div>

                                        <div class="upload-preview-container mt-1 {{ $outlet->image ? '' : 'd-none' }}">
                                            <img src="{{ $outlet->image ? asset('storage/' . $outlet->image) : '' }}" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 140px; object-fit: contain;">
                                            <div class="mt-2"><span class="badge bg-danger rounded-pill px-3 py-1">Ganti Foto</span></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- STATUS SWITCHES -->
                                <div class="col-12 d-flex gap-4 my-2">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="active{{ $outlet->id }}" {{ $outlet->is_active ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="active{{ $outlet->id }}">Tampilkan di Halaman Publik</label>
                                    </div>

                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_main" value="1" id="main{{ $outlet->id }}" {{ $outlet->is_main ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="main{{ $outlet->id }}">Outlet Utama (Pusat)</label>
                                    </div>
                                </div>
                            </div>

                            <!-- SAVE BUTTON -->
                            <button type="submit" class="btn btn-danger btn-sm rounded-pill w-100 mt-3">
                                <i class="bi bi-save me-1"></i> Simpan Perubahan
                            </button>
                        </form>

                        <!-- DELETE FORM -->
                        <form action="{{ route('admin.outlets.destroy', $outlet) }}" method="POST" class="mt-2" onsubmit="return confirm('Yakin ingin menghapus outlet {{ $outlet->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-secondary btn-sm rounded-pill w-100">
                                <i class="bi bi-trash me-1"></i> Hapus Outlet
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="admin-card text-center py-5">
                    <i class="bi bi-shop display-4 text-muted"></i>
                    <h5 class="mt-3">Belum Ada Data Outlet</h5>
                    <p class="text-muted">Klik tombol di bawah untuk menambahkan outlet pertama Anda.</p>
                    <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#createOutletModal">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Outlet
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    <!-- MODAL TAMBAH OUTLET -->
    <div class="modal fade" id="createOutletModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <div>
                        <h5 class="modal-title text-white">
                            <i class="bi bi-shop me-2"></i>
                            Tambah Outlet Baru
                        </h5>
                        <small class="text-white-50">Isi formulir informasi outlet di bawah ini.</small>
                    </div>
                    <button type="button" class="btn-close text-white" style="color: #fff!important" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('admin.outlets.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small">Nama Outlet <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Contoh: Outlet Tawang Alun (Pusat)" required>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small">No. WhatsApp</label>
                                <input type="text" name="phone_whatsapp" class="form-control" placeholder="0852-xxxx-xxxx">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small">Alamat Cabang <span class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" rows="2" placeholder="Alamat lengkap outlet..." required></textarea>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small">Jam Operasional <span class="text-danger">*</span></label>
                                <input type="text" name="operating_hours" class="form-control" placeholder="Setiap Hari (07.00 - 21.00 WIB)" required>
                                <small class="text-muted fs-8">Contoh: 07.00 - 21.00 WIB</small>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="form-label fw-bold small">Link Google Maps</label>
                                <input type="url" name="google_maps_url" class="form-control" placeholder="https://maps.google.com/...">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small">Fasilitas / Key Features (Pisahkan dengan koma)</label>
                                <textarea name="features" class="form-control" rows="2" placeholder="Dapur Utama, Parkir Luas, Takeaway, Roti Fresh Harian"></textarea>
                                <small class="text-muted fs-8">Setiap kata yang dipisah koma akan otomatis jadi chip badge hijau.</small>
                            </div>

                            <!-- FOTO OUTLET UPLOAD BOX -->
                            <div class="col-12">
                                <label class="form-label fw-bold small d-block">Foto Fisik Outlet (Opsional)</label>
                                <div class="product-upload-box text-center p-3 border border-2 border-dashed rounded-3 bg-light position-relative" style="border-color: #d1d5db;">
                                    <input type="file" name="image" class="form-control position-absolute top-0 start-0 w-100 h-100 opacity-0 cursor-pointer outlet-upload-trigger" accept="image/*" style="z-index: 10;">

                                    <div class="upload-placeholder-content">
                                        <i class="bi bi-cloud-arrow-up-fill fs-2 text-danger"></i>
                                        <div class="fw-bold small text-dark mt-1">Klik atau Geser Foto ke Sini</div>
                                        <small class="text-muted d-block" style="font-size: 0.75rem;">Format JPG, PNG, WEBP (Maks 10MB)</small>
                                    </div>

                                    <div class="upload-preview-container mt-1 d-none">
                                        <img src="" class="img-fluid rounded-3 shadow-sm preview-image-target" style="max-height: 140px; object-fit: contain;">
                                        <div class="mt-2"><span class="badge bg-danger rounded-pill px-3 py-1">Ganti Foto</span></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex gap-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" id="createActive" checked>
                                    <label class="form-check-label small" for="createActive">Tampilkan di Landing Page</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_main" value="1" id="createMain">
                                    <label class="form-check-label small" for="createMain">Jadikan Outlet Utama</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4">
                            <i class="bi bi-save me-1"></i> Simpan Outlet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.outlet-upload-trigger').forEach(function(input) {
                input.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const box = input.closest('.product-upload-box');
                        const placeholder = box.querySelector('.upload-placeholder-content');
                        const previewContainer = box.querySelector('.upload-preview-container');
                        const imgTarget = box.querySelector('.preview-image-target');

                        const reader = new FileReader();
                        reader.onload = function(evt) {
                            imgTarget.src = evt.target.result;
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
