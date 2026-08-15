@extends('public.layouts.app')

@section('title', 'Outlet & Lokasi Gerai - 99 Bakery Jember')

@section('meta_description', 'Lokasi outlet resmi 99 Bakery Jember. Temukan outlet terdekat untuk pembelian roti,
    brownies, bolen, snackbox, dan berbagai produk fresh setiap hari.')

@section('content')

    <!-- BREADCRUMB & HEADER HERO -->
    <section class="bg-warm-section py-4 border-bottom">
        <div class="container">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-2 small">

                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-danger fw-semibold">
                            Beranda
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">
                        Outlet Kami
                    </li>

                </ol>
            </nav>

            <div>

                <h1 class="h2 fw-extrabold mb-1">
                    Outlet
                    <span class="text-danger">
                        99 Bakery
                    </span>
                </h1>

                <p class="text-muted mb-0 small">
                    Temukan lokasi outlet resmi 99 Bakery Jember
                    untuk pembelian roti hajatan, brownies, bolen,
                    dan snackbox berkualitas dengan rasa lezat
                    dan fresh setiap hari.
                </p>

            </div>

        </div>
    </section>


    <!-- OUTLET LIST SECTION -->
    <section class="py-5 bg-warm-section">

        <div class="container">

            <div class="text-center mb-5">

                <div class="section-badge">
                    GERAI TERDEKAT
                </div>

                <h2 class="section-title">
                    Outlet Resmi 99 Bakery
                </h2>

                <p class="section-subtitle">
                    Pilih lokasi outlet terdekat dari tempat tinggal
                    Anda untuk belanja roti fresh atau ambil pesanan.
                </p>

            </div>


            <div class="row g-4 justify-content-center">

                @forelse ($outlets as $outlet)
                    <div class="col-lg-6">

                        <div class="outlet-card">

                            <!-- ========================= -->
                            <!-- HEADER -->
                            <!-- ========================= -->

                            <div class="outlet-header-hero position-relative overflow-hidden" @if($outlet->image) style="background: linear-gradient(180deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.85) 100%), url('{{ asset('storage/' . $outlet->image) }}') center/cover no-repeat; min-height: 200px;" @endif>

                                <!-- STATUS -->
                                <span class="status-badge-pill outlet-status" data-hours="{{ $outlet->operating_hours }}">
                                    <span class="status-pulse"></span>
                                    Memuat Status...
                                </span>

                                <!-- ICON -->
                                <div class="outlet-icon-badge">
                                    @if ($outlet->is_main)
                                        <i class="bi bi-building"></i>
                                    @else
                                        <i class="bi bi-shop"></i>
                                    @endif
                                </div>

                                <!-- NAMA -->
                                <h3 class="outlet-hero-title">
                                    {{ $outlet->name }}
                                </h3>

                                <!-- TAG -->
                                <div class="outlet-hero-tag">
                                    @if ($outlet->is_main)
                                        <i class="bi bi-star-fill text-warning me-1"></i>
                                        Dapur Utama & Penjualan Pusat
                                    @else
                                        <i class="bi bi-geo-fill me-1"></i>
                                        Gerai 99 Bakery
                                    @endif
                                </div>

                            </div>


                            <!-- ========================= -->
                            <!-- BODY -->
                            <!-- ========================= -->

                            <div class="outlet-body-content">

                                <!-- ALAMAT -->
                                <div class="outlet-info-row">
                                    <div class="outlet-info-icon">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div>
                                        <div class="outlet-info-label">
                                            Alamat Gerai
                                        </div>
                                        <div class="outlet-info-text">
                                            {{ $outlet->address }}
                                        </div>
                                    </div>
                                </div>

                                <!-- JAM OPERASIONAL -->
                                <div class="outlet-info-row">
                                    <div class="outlet-info-icon">
                                        <i class="bi bi-clock-fill"></i>
                                    </div>
                                    <div>
                                        <div class="outlet-info-label">
                                            Jam Operasional
                                        </div>
                                        <div class="outlet-info-text">
                                            {{ $outlet->operating_hours }}
                                        </div>
                                    </div>
                                </div>

                                <!-- WHATSAPP -->
                                <div class="outlet-info-row">
                                    <div class="outlet-info-icon">
                                        <i class="bi bi-whatsapp"></i>
                                    </div>
                                    <div>
                                        <div class="outlet-info-label">
                                            Kontak Direct WA
                                        </div>
                                        <div class="outlet-info-text">
                                            {{ $outlet->phone_whatsapp }}
                                        </div>
                                    </div>
                                </div>

                                <!-- BENEFITS / FEATURES -->
                                <div class="outlet-chip-group">
                                    @if (!empty($outlet->features))
                                        @foreach (explode(',', $outlet->features) as $featureItem)
                                            @if (trim($featureItem))
                                                <span class="outlet-chip">
                                                    <i class="bi bi-check-circle-fill text-success"></i>
                                                    {{ trim($featureItem) }}
                                                </span>
                                            @endif
                                        @endforeach
                                    @else
                                        @if ($outlet->is_main)
                                            <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Dapur Produksi Utama</span>
                                            <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Pesanan Syukuran</span>
                                            <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Takeaway & Retail</span>
                                            <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Parkir Luas</span>
                                        @else
                                            <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Roti Fresh Harian</span>
                                            <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Snack Box Rapat</span>
                                            <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Dessert Box</span>
                                            <span class="outlet-chip"><i class="bi bi-check-circle-fill text-success"></i> Akses Mudah</span>
                                        @endif
                                    @endif
                                </div>


                                <!-- ACTION -->
                                <div class="outlet-actions-flex">


                                    <!-- WHATSAPP -->
                                    @if ($outlet->phone_whatsapp)
                                        @php
                                            $waNumber = preg_replace('/[^0-9]/', '', $outlet->phone_whatsapp);

                                            if (str_starts_with($waNumber, '0')) {
                                                $waNumber = '62' . substr($waNumber, 1);
                                            }

                                            $waMessage = "Halo 99 Bakery {$outlet->name}, saya mau tanya stok dan pemesanan";

                                            $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($waMessage);
                                        @endphp

                                        <a href="{{ $waUrl }}" target="_blank" class="btn-outlet-wa-pill">
                                            <i class="bi bi-whatsapp fs-5"></i>
                                            Chat WhatsApp
                                        </a>
                                    @endif


                                    <!-- GOOGLE MAPS -->
                                    @if ($outlet->google_maps_url)
                                        <a href="{{ $outlet->google_maps_url }}" target="_blank"
                                            class="btn-outlet-maps-pill" title="Petunjuk Arah Google Maps">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </a>
                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <!-- BELUM ADA OUTLET -->

                    <div class="col-12">

                        <div class="text-center py-5">

                            <i class="bi bi-shop display-4 text-muted"></i>

                            <h4 class="mt-3">
                                Outlet Belum Tersedia
                            </h4>

                            <p class="text-muted mb-0">
                                Informasi outlet 99 Bakery
                                sedang dipersiapkan.
                            </p>

                        </div>

                    </div>
                @endforelse

            </div>

        </div>

    </section>


    <!-- CTA BANNER -->
    <section class="py-5 bg-warm-section">

        <div class="container text-center">

            <div class="hajatan-banner max-w-900 mx-auto">

                <h3 class="mb-3 text-white">
                    Mau Konsultasi / Pesan Roti Sebelum Berkunjung?
                </h3>

                <p class="text-white-50 mb-4 fs-5">
                    Hubungi admin WhatsApp kami untuk cek
                    ketersediaan stok roti kesukaan Anda
                    atau konsultasi paket hajatan.
                </p>

                @php

                    $mainOutlet = $outlets->firstWhere('is_main', true);

                    $adminWhatsapp = $mainOutlet?->phone_whatsapp;

                    if ($adminWhatsapp) {
                        $adminWhatsapp = preg_replace('/[^0-9]/', '', $adminWhatsapp);

                        if (str_starts_with($adminWhatsapp, '0')) {
                            $adminWhatsapp = '62' . substr($adminWhatsapp, 1);
                        }

                        $adminMessage = urlencode('Halo 99 Bakery, saya ingin tanya stok dan pemesanan');

                        $adminWhatsappUrl = "https://wa.me/{$adminWhatsapp}?text={$adminMessage}";
                    }

                @endphp


                @if (!empty($adminWhatsappUrl))
                    <a href="{{ $adminWhatsappUrl }}" target="_blank"
                        class="btn btn-light text-danger fw-bold btn-lg px-5 shadow-sm">
                        <i class="bi bi-whatsapp me-2 fs-5"></i>
                        Hubungi WhatsApp Admin
                    </a>
                @endif

            </div>

        </div>

    </section>


    <!-- STATUS OUTLET SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.outlet-status').forEach(function(badge) {

                const hours = badge.dataset.hours || '';

                const pulse = badge.querySelector('.status-pulse');


                /*
                |--------------------------------------------------------------------------
                | Ambil format jam dari operating_hours
                |
                | Contoh:
                | "Setiap Hari (07.00 - 21.00 WIB)"
                |--------------------------------------------------------------------------
                */

                const match = hours.match(
                    /(\d{1,2})[.:](\d{2})\s*[-–]\s*(\d{1,2})[.:](\d{2})/
                );


                if (!match) {

                    badge.innerHTML =
                        '<span class="status-pulse"></span> Jam Operasional';

                    return;

                }


                const openHour = parseInt(match[1]);
                const openMinute = parseInt(match[2]);

                const closeHour = parseInt(match[3]);
                const closeMinute = parseInt(match[4]);


                const now = new Date();

                const currentMinutes =
                    now.getHours() * 60 +
                    now.getMinutes();


                const openMinutes =
                    openHour * 60 +
                    openMinute;


                const closeMinutes =
                    closeHour * 60 +
                    closeMinute;


                const isOpen =
                    currentMinutes >= openMinutes &&
                    currentMinutes <= closeMinutes;


                if (isOpen) {

                    badge.innerHTML =
                        '<span class="status-pulse"></span> Buka Sekarang';

                    badge.classList.remove('closed');
                    badge.classList.add('open');

                } else {

                    badge.innerHTML =
                        '<span class="status-pulse"></span> Tutup Sekarang';

                    badge.classList.remove('open');
                    badge.classList.add('closed');

                }

            });

        });
    </script>

@endsection
