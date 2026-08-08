@extends('layouts.app')

@section('title', '99 Bakery Jember - Spesialis Roti Hajatan, Kue & Snackbox Fresh Every Day')

@section('content')
<!-- HERO SECTION / JUMBOTRON -->
<section id="beranda" class="hero-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="d-inline-flex align-items-center gap-2 bg-white px-3 py-1.5 rounded-pill shadow-sm mb-3">
          <i class="bi bi-heart-fill text-danger small"></i>
          <small class="fw-bold text-danger">Toko Roti Favorit Keluarga & Acara Hajatan</small>
        </div>

        <h1 class="hero-title">
          <span style="color: #FFB300!important">99 Kebahagiaan</span> Untuk Setiap Momen Spesial Anda
        </h1>

        <p class="hero-description">
          Toko roti spesialis roti hajatan, brownies, bolen, kue basah, dessert, dan snackbox berkualitas dengan rasa
          lezat, fresh setiap hari, dan harga terjangkau di Jember.
        </p>

        <div class="d-flex flex-wrap gap-3 mb-4">
          <a href="{{ route('produk') }}" class="btn btn-light text-danger fw-bold btn-lg px-4 shadow-sm">
            <i class="bi bi-grid-fill me-2"></i> Lihat Katalog Produk
          </a>
          <a href="{{ asset('catalog.pdf') }}" target="_blank" download class="btn btn-outline-light btn-lg px-4">
            <i class="bi bi-download me-2"></i> Unduh Katalog (PDF)
          </a>
        </div>
      </div>

      <div class="col-lg-6">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3500">
          <div class="carousel-inner rounded-4 shadow-lg border border-3 border-white overflow-hidden">
            <!-- Slide 1 -->
            <div class="carousel-item active">
              <img src="{{ asset('img/products/Bolu/gulung hias keju.jpg') }}" loading="lazy" class="d-block w-100 lazy-blur"
                alt="Bolu Gulung Keju 99 Bakery" style="height: 380px; object-fit: cover;">
              <div class="position-absolute bottom-0 start-0 m-3 bg-white bg-opacity-95 backdrop-blur px-3 py-2 rounded-pill shadow-sm border border-white z-2">
                <span class="fw-bold text-danger fs-7"><i class="bi bi-star-fill text-warning me-1"></i> Bolu Gulung Topping Keju</span>
              </div>
            </div>
            <!-- Slide 2 -->
            <div class="carousel-item">
              <img src="{{ asset('img/products/Brownies/panggang box.jpg') }}" loading="lazy" class="d-block w-100 lazy-blur"
                alt="Fudgy Brownies 99 Bakery" style="height: 380px; object-fit: cover;">
              <div class="position-absolute bottom-0 start-0 m-3 bg-white bg-opacity-95 backdrop-blur px-3 py-2 rounded-pill shadow-sm border border-white z-2">
                <span class="fw-bold text-danger fs-7"><i class="bi bi-star-fill text-warning me-1"></i> Fudgy Brownies Shiny Crust</span>
              </div>
            </div>
            <!-- Slide 3 -->
            <div class="carousel-item">
              <img src="{{ asset('img/products/Bolen/bolen box.png') }}" loading="lazy" class="d-block w-100 lazy-blur"
                alt="Bolen Pisang Keju 99 Bakery" style="height: 380px; object-fit: cover;">
              <div class="position-absolute bottom-0 start-0 m-3 bg-white bg-opacity-95 backdrop-blur px-3 py-2 rounded-pill shadow-sm border border-white z-2">
                <span class="fw-bold text-danger fs-7"><i class="bi bi-star-fill text-warning me-1"></i> Bolen Pisang Keju Renyah</span>
              </div>
            </div>
            <!-- Slide 4 -->
            <div class="carousel-item">
              <img src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" loading="lazy" class="d-block w-100 lazy-blur"
                alt="Roti Sobek 99 Bakery" style="height: 380px; object-fit: cover;">
              <div class="position-absolute bottom-0 start-0 m-3 bg-white bg-opacity-95 backdrop-blur px-3 py-2 rounded-pill shadow-sm border border-white z-2">
                <span class="fw-bold text-danger fs-7"><i class="bi bi-star-fill text-warning me-1"></i> Roti Sobek Soft & Fresh</span>
              </div>
            </div>
          </div>
          <!-- Indicators -->
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- KATEGORI PRODUK SECTION -->
<section id="kategori" class="py-5 bg-warm-section border-bottom">
  <div class="container">
    <div class="text-center mb-5">
      <div class="section-badge">ANEKA PILIHAN</div>
      <h2 class="section-title">Kategori Produk 99 Bakery</h2>
      <p class="section-subtitle">
        Temukan varian pilihan roti & kue favorit Anda yang siap dipesan untuk sajian harian maupun acara spesial.
      </p>
    </div>

    <div class="row g-3 g-md-4 justify-content-center">
      <!-- 1. Roti Hajatan & Snack Box -->
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('produk') }}?cat=roti%20hajatan" class="category-card-box">
          <div class="category-img-box">
            <img src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" loading="lazy" class="category-img lazy-blur" alt="Roti Hajatan & Snack Box">
          </div>
          <h4 class="category-card-title">Roti Hajatan & Snack Box</h4>
          <p class="category-card-desc">Paket hemat & hantaran acara syukuran, rapat & pernikahan.</p>
          <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
        </a>
      </div>

      <!-- 2. Aneka Roti -->
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('produk') }}?cat=aneka%20roti" class="category-card-box">
          <div class="category-img-box">
            <img src="{{ asset('img/products/roti/sisir mini pandan.jpg') }}" loading="lazy" class="category-img lazy-blur" alt="Aneka Roti">
          </div>
          <h4 class="category-card-title">Aneka Roti</h4>
          <p class="category-card-desc">Roti sisir, roti sobek & roti isi lembut aromatik.</p>
          <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
        </a>
      </div>

      <!-- 3. Brownies & Bolu -->
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('produk') }}?cat=brownies" class="category-card-box">
          <div class="category-img-box">
            <img src="{{ asset('img/products/Brownies/panggang box.jpg') }}" loading="lazy" class="category-img lazy-blur" alt="Brownies & Bolu">
          </div>
          <h4 class="category-card-title">Brownies & Bolu</h4>
          <p class="category-card-desc">Fudgy brownies shiny crust & bolu gulung keju melimpah.</p>
          <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
        </a>
      </div>

      <!-- 4. Aneka Bolen -->
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('produk') }}?cat=bolen" class="category-card-box">
          <div class="category-img-box">
            <img src="{{ asset('img/products/Bolen/bolen box.png') }}" loading="lazy" class="category-img lazy-blur" alt="Aneka Bolen">
          </div>
          <h4 class="category-card-title">Aneka Bolen</h4>
          <p class="category-card-desc">Bolen pisang keju & coklat melted ber-pastry renyah.</p>
          <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
        </a>
      </div>

      <!-- 5. Donat & Dessert -->
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('produk') }}?cat=donat" class="category-card-box">
          <div class="category-img-box">
            <img src="{{ asset('img/products/Donat/donat topping.jpg') }}" loading="lazy" class="category-img lazy-blur" alt="Donat & Dessert">
          </div>
          <h4 class="category-card-title">Donat & Dessert</h4>
          <p class="category-card-desc">Donat kentang glaze assorted & dessert box red velvet.</p>
          <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
        </a>
      </div>

      <!-- 6. Kue Basah -->
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('produk') }}?cat=kue%20basah" class="category-card-box">
          <div class="category-img-box">
            <img src="{{ asset('img/products/Kue Basah/Pie Buah.png') }}" loading="lazy" class="category-img lazy-blur" alt="Kue Basah">
          </div>
          <h4 class="category-card-title">Kue Basah</h4>
          <p class="category-card-desc">Aneka kue tradisional & modern higienis berkualitas.</p>
          <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
        </a>
      </div>

      <!-- 7. Kue Tart -->
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('produk') }}?cat=kue%20tart" class="category-card-box">
          <div class="category-img-box">
            <img src="{{ asset('img/products/tart/378d5ea7-0433-4872-90ed-b7cc7e646d16.jpg') }}" loading="lazy" class="category-img lazy-blur" alt="Kue Tart">
          </div>
          <h4 class="category-card-title">Kue Tart</h4>
          <p class="category-card-desc">Kue tart ulang tahun & spiku lapis hiasan custom cantik.</p>
          <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- KEUNGGULAN SECTION -->
<section id="keunggulan" class="bg-warm-section border-bottom">
  <div class="container">
    <div class="text-center">
      <div class="section-badge">WHY 99 BAKERY?</div>
      <h2 class="section-title">Selalu Mengutamakan Kualitas</h2>
      <p class="section-subtitle">
        Alasan mengapa 99 Bakery dipercaya oleh ribuan keluarga dan penyelenggara acara di Jember setiap harinya.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-4">
        <div class="feature-card">
          <div class="feature-icon-wrapper"><i class="bi bi-stars"></i></div>
          <h3 class="feature-title">Bahan Berkualitas</h3>
          <p class="feature-desc">Kami hanya menggunakan bahan-bahan pilihan bermutu tinggi untuk menghasilkan rasa yang konsisten, gurih, dan lezat.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="feature-card">
          <div class="feature-icon-wrapper"><i class="bi bi-clock-history"></i></div>
          <h3 class="feature-title">Fresh Setiap Hari</h3>
          <p class="feature-desc">Seluruh produk diproduksi setiap hari (freshly baked) sehingga selalu segar dan lezat saat sampai ke tangan Anda.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="feature-card">
          <div class="feature-icon-wrapper"><i class="bi bi-wallet2"></i></div>
          <h3 class="feature-title">Harga Bersahabat</h3>
          <p class="feature-desc">Produk berkualitas tinggi dengan cita rasa istimewa yang tetap ramah di kantong untuk semua kalangan.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="feature-card">
          <div class="feature-icon-wrapper"><i class="bi bi-grid-3x3-gap-fill"></i></div>
          <h3 class="feature-title">Banyak Pilihan Varian</h3>
          <p class="feature-desc">Mulai dari roti klasik, brownies, bolen, cake, kue basah, dessert, hingga snack box hajatan terlengkap.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="feature-card">
          <div class="feature-icon-wrapper"><i class="bi bi-shield-check"></i></div>
          <h3 class="feature-title">Higienis & Aman</h3>
          <p class="feature-desc">Diproduksi dengan standar kebersihan yang ketat dan kemasan aman sehingga sangat nyaman untuk dikonsumsi.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-4">
        <div class="feature-card">
          <div class="feature-icon-wrapper"><i class="bi bi-emoji-smile-fill"></i></div>
          <h3 class="feature-title">Pelayanan Ramah</h3>
          <p class="feature-desc">Kepuasan dan kenyamanan Anda dalam memesan menjadi prioritas utama tim customer service dan toko kami.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SHOWCASE PRODUCT SECTION -->
<section id="produk" class="bg-warm-section">
  <div class="container">
    <div class="text-center">
      <div class="section-badge">KATALOG PRODUK</div>
      <h2 class="section-title">Temukan Favorit Anda</h2>
      <p class="section-subtitle">
        Dari roti klasik hingga aneka cake modern, setiap produk dibuat dari bahan berkualitas untuk memberikan kelezatan istimewa.
      </p>

      <div class="row g-2 g-md-4 mb-5">
        <!-- Item 1: Roti Hajatan -->
        <div class="col-6 col-md-4 col-lg-3">
          <div class="product-card">
            <div class="product-img-box">
              <span class="product-badge badge-hajatan">Best Seller Hajatan</span>
              <img src="{{ asset('img/products/roti/sobek coklat.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Paket Roti Hajatan Spesial">
            </div>
            <div class="product-body">
              <span class="product-category">Roti Hajatan & Snack Box</span>
              <h3 class="product-title">Paket Roti Hajatan Spesial</h3>
              <p class="product-desc">Kombinasi roti lembut pilihan & kue lezat yang dikemas cantik untuk berbagai konsumsi acara syukuran/pernikahan.</p>
              <div class="product-footer">
                <div>
                  <div class="product-price">Rp 8.000</div>
                  <div class="product-price-note">per box / paket</div>
                </div>
                <button type="button" class="btn-sm-detail">Detail</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Item 2: Roti Sisir Premium -->
        <div class="col-6 col-md-4 col-lg-3">
          <div class="product-card">
            <div class="product-img-box">
              <span class="product-badge badge-fresh">Fresh Daily</span>
              <img src="{{ asset('img/products/roti/sisir mini pandan.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Roti Sisir Mentega Premium">
            </div>
            <div class="product-body">
              <span class="product-category">Aneka Roti</span>
              <h3 class="product-title">Roti Sisir Mentega Premium</h3>
              <p class="product-desc">Tekstur sangat lembut beraroma harum mentega asli dengan rasa manis gurih yang memanjakan lidah.</p>
              <div class="product-footer">
                <div>
                  <div class="product-price">Rp 12.000</div>
                  <div class="product-price-note">porsi isi 4</div>
                </div>
                <button type="button" class="btn-sm-detail">Detail</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Item 3: Fudgy Brownies Almond -->
        <div class="col-6 col-md-4 col-lg-3">
          <div class="product-card">
            <div class="product-img-box">
              <span class="product-badge badge-bestseller">Favorit</span>
              <img src="{{ asset('img/products/Brownies/panggang box.jpg') }}" loading="lazy" class="product-img lazy-blur" alt="Fudgy Brownies Shiny Crust">
            </div>
            <div class="product-body">
              <span class="product-category">Brownies & Bolu</span>
              <h3 class="product-title">Fudgy Brownies Shiny Crust</h3>
              <p class="product-desc">Brownies coklat leleh padat dengan tekstur fudgy dan taburan almond gurih renyah di atasnya.</p>
              <div class="product-footer">
                <div>
                  <div class="product-price">Rp 35.000</div>
                  <div class="product-price-note">box medium</div>
                </div>
                <button type="button" class="btn-sm-detail">Detail</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Item 4: Bolen Pisang Keju -->
        <div class="col-6 col-md-4 col-lg-3">
          <div class="product-card">
            <div class="product-img-box">
              <span class="product-badge badge-bestseller">Best Seller</span>
              <img src="{{ asset('img/products/Bolen/bolen box.png') }}" loading="lazy" class="product-img lazy-blur" alt="Bolen Pisang Keju Super">
            </div>
            <div class="product-body">
              <span class="product-category">Aneka Bolen</span>
              <h3 class="product-title">Bolen Pisang Keju Super</h3>
              <p class="product-desc">Pastry berlapis renyah dipadu isian pisang manis raja dan keju gurih melimpah.</p>
              <div class="product-footer">
                <div>
                  <div class="product-price">Rp 32.000</div>
                  <div class="product-price-note">isi 10 pcs</div>
                </div>
                <button type="button" class="btn-sm-detail">Detail</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center mb-5">
        <a href="{{ route('produk') }}" class="btn btn-red btn-lg px-4 py-3 fw-bold rounded-pill shadow-md">
          <i class="bi bi-grid-3x3-gap-fill me-2"></i> Lihat Semua Produk (Halaman Katalog)
        </a>
      </div>

      <!-- Hajatan Callout Banner -->
      <div class="mt-5">
        <div class="hajatan-banner rounded-4 p-4 p-md-5 bg-danger text-white position-relative overflow-hidden shadow-lg">
          <div class="row align-items-center g-4">
            <div class="col-lg-7 position-relative z-2 text-center text-lg-start">
              <span class="badge bg-white text-danger fw-bold mb-3 px-3 py-2 rounded-pill shadow-sm fs-7">
                <i class="bi bi-star-fill text-warning me-1"></i> Spesialis Roti Hajatan & Snack Box
              </span>
              <h3 class="display-6 fw-bold text-white mb-2">Butuh Roti Hajatan & Snack Box Banyak?</h3>
              <p class="text-white-50 fs-6 mb-4">
                Dapatkan konsultasi gratis menu paket hajatan, harga khusus pemesanan banyak, dan jaminan roti dikirim fresh saat acara Anda.
              </p>
              <a href="https://wa.me/6285257220335?text=Halo%2099%20Bakery,%20saya%20mau%20konsultasi%20pesanan%20Roti%20Hajatan%20/%20Snackbox%20dalam%20jumlah%20banyak."
                target="_blank" class="btn-outlet-wa-pill px-4 text-nowrap shadow-md d-inline-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-whatsapp fs-5"></i> Chat WA Admin Hajatan
              </a>
            </div>
            <div class="col-lg-5 text-center position-relative">
              <div class="banner-tilted-photo-box position-relative d-inline-block">
                <img src="{{ asset('img/products/roti/Sobek pisang.jpg') }}" loading="lazy"
                  class="img-fluid rounded-4 shadow-lg border border-4 border-white lazy-blur banner-tilted-img"
                  alt="Sajian Roti Hajatan 99 Bakery">
                <div class="position-absolute top-0 end-0 bg-white text-danger fw-bold px-3 py-1 rounded-pill shadow-sm fs-7 m-2">
                  <i class="bi bi-patch-check-fill text-danger me-1"></i> Fresh Baked
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- 3 LANGKAH MUDAH PEMESANAN -->
<section id="cara-pesan" class="py-5 bg-white border-bottom">
  <div class="container">
    <div class="text-center mb-5">
      <div class="section-badge-gold">ALUR PEMESANAN</div>
      <h2 class="section-title">3 Langkah Mudah Pesan Roti Hajatan</h2>
      <p class="section-subtitle">
        Proses pemesanan sangat praktis, bisa konsultasi budget lebih dulu tanpa perlu repot keluar rumah.
      </p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="step-card">
          <div class="step-number-badge">1</div>
          <h3 class="step-title">Pilih Produk & Jumlah</h3>
          <p class="step-desc">Tentukan varian roti hajatan, snackbox, bolen, atau kue pilihan Anda sesuai kebutuhan acara.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="step-card">
          <div class="step-number-badge">2</div>
          <h3 class="step-title">Chat & Konsultasi WA</h3>
          <p class="step-desc">Hubungi admin WA kami untuk info stok, tanggal acara, serta penyesuaian anggaran/paket hajatan.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="step-card">
          <div class="step-number-badge">3</div>
          <h3 class="step-title">Roti Siap Diterima / Diambil</h3>
          <p class="step-desc">Pesanan dioven fresh pada hari H dan siap diambil di outlet terdekat atau dikirim langsung ke lokasi.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIAL & ULASAN PELANGGAN -->
<section id="ulasan" class="py-5 bg-warm-section border-bottom overflow-hidden">
  <div class="container">
    <div class="text-center mb-5">
      <div class="section-badge">ULASAN PELANGGAN</div>
      <h2 class="section-title">Apa Kata Keluarga & Panitia Acara di Jember?</h2>
      <p class="section-subtitle">
        Kepercayaan dan senyum kepuasan ribuan pelanggan adalah kebanggaan dan komitmen utama 99 Bakery.
      </p>
    </div>

    <div class="testimonial-slider-wrapper position-relative px-2 px-md-4">
      <div class="testimonial-slider-overflow">
        <div class="testimonial-slider-track" id="testimonialTrack">
          
          <div class="testimonial-slide-item">
            <div class="testimonial-card">
              <div class="testimonial-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
              <p class="testimonial-quote">"Pesan 150 kotak snackbox roti hajatan untuk acara syukuran pernikahan putri kami. Rotinya super empuk, harum, dan pengemasan sangat rapi. Tamu-tamu banyak yang tanya belinya di mana!"</p>
              <div class="testimonial-author">
                <div class="author-avatar-circle">BR</div>
                <div>
                  <div class="author-name">Bu Rahmawati</div>
                  <div class="author-role">Pelanggan Syukuran - Sumbersari</div>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-slide-item">
            <div class="testimonial-card">
              <div class="testimonial-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
              <p class="testimonial-quote">"Bolen pisang keju dan fudgy brownies-nya langganan kantor tiap ada rapat. Admin WA fast respon dan ramah banget pas diajak konsultasi budget. Sangat direkomendasikan!"</p>
              <div class="testimonial-author">
                <div class="author-avatar-circle">AD</div>
                <div>
                  <div class="author-name">Pak Agung Dwi</div>
                  <div class="author-role">Panitia Rapat Kantor - Tawang Alun</div>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-slide-item">
            <div class="testimonial-card">
              <div class="testimonial-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
              <p class="testimonial-quote">"Harganya sangat terjangkau tapi rasanya tidak kalah dengan toko roti ternama. Tiap sore anak-anak selalu minta dibelikan roti sisir dan donat kentang khas 99 Bakery."</p>
              <div class="testimonial-author">
                <div class="author-avatar-circle">IS</div>
                <div>
                  <div class="author-name">Ibu Setyowati</div>
                  <div class="author-role">Ibu Rumah Tangga - Patrang</div>
                </div>
              </div>
            </div>
          </div>

          <div class="testimonial-slide-item">
            <div class="testimonial-card">
              <div class="testimonial-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
              <p class="testimonial-quote">"Roti sobek dan brownies panggang box untuk konsumsi event kampus selalu order di 99 Bakery. Pengiriman selalu jam 7 pagi tepat waktu, roti hangat fresh dari oven!"</p>
              <div class="testimonial-author">
                <div class="author-avatar-circle">RP</div>
                <div>
                  <div class="author-name">Mas Rizky Pratama</div>
                  <div class="author-role">Panitia Event - UNEJ Sumbersari</div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <div class="testimonial-dots" id="testimonialDots"></div>
    </div>
  </div>
</section>

<!-- FAQ SECTION -->
<section id="faq" class="py-5 bg-warm-section">
  <div class="container">
    <div class="text-center">
      <div class="section-badge">FAQ</div>
      <h2 class="section-title">Pertanyaan Sering Diajukan</h2>
      <p class="section-subtitle">
        Informasi seputar cara pemesanan roti hajatan, daya tahan produk, dan layanan 99 Bakery.
      </p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="accordion" id="accordionFaq">

          <div class="accordion-item">
            <h3 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="bi bi-question-circle-fill text-danger me-2"></i> Bagaimana cara pesan Roti Hajatan & Snackbox?
              </button>
            </h3>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionFaq">
              <div class="accordion-body">
                Anda bisa langsung memilih paket di katalog produk atau mengklik tombol WhatsApp. Pilih outlet terdekat (Tawang Alun / Kampus), tentukan jumlah box yang dibutuhkan, dan tim admin kami akan memproses pesanan serta mengonfirmasi jadwal pengantaran.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <i class="bi bi-question-circle-fill text-danger me-2"></i> Berapa hari sebelum acara pemesanan sebaiknya dilakukan?
              </button>
            </h3>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionFaq">
              <div class="accordion-body">
                Untuk pemesanan roti hajatan / snack box jumlah besar (di atas 50 box), kami menyarankan untuk melakukan pemesanan H-2 atau H-1 sebelum acara agar tim produksi kami dapat menyiapkan produk yang paling segar (fresh out of the oven) saat waktu acara.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <i class="bi bi-question-circle-fill text-danger me-2"></i> Apakah seluruh roti diproduksi fresh setiap hari?
              </button>
            </h3>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionFaq">
              <div class="accordion-body">
                Ya! Seluruh varian roti, brownies, bolen, kue basah, dan donat di 99 Bakery dibuat dan dioven setiap hari untuk menjamin kelezatan, rasa lembut, dan higienitas saat Anda mengonsumsinya.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <i class="bi bi-question-circle-fill text-danger me-2"></i> Berapa daya tahan / ketahanan simpan produk roti 99 Bakery?
              </button>
            </h3>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionFaq">
              <div class="accordion-body">
                Karena kami menggunakan bahan alami tanpa pengawet berbahaya: Roti manis bertahan 3-4 hari di suhu ruang, Bolen & Brownies bertahan 4-6 hari, sedangkan kue basah disarankan dikonsumsi pada hari yang sama.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h3 class="accordion-header" id="headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <i class="bi bi-question-circle-fill text-danger me-2"></i> Apakah ada layanan pengiriman ke alamat lokasi acara?
              </button>
            </h3>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionFaq">
              <div class="accordion-body">
                Tentu! Kami melayani pengiriman gratis / dengan kurir lokal untuk area Jember dan sekitarnya untuk pemesanan paket hajatan sesuai ketentuan jarak outlet.
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection
