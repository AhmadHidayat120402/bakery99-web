@extends('public.layouts.app')

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
          <span style="color: #FFB300!important">99 Bakery -</span> Rajanya Hajatan
        </h1>

        <p class="hero-description">
          Spesialis roti hajatan dengan banyak pilihan, rasa lezat, kemasan menarik, dan harga bersahabat.
Selain roti hajatan, kami juga menyediakan brownies, bolen, kue basah, dessert, dan snack box yang dibuat fresh setiap hari dengan bahan berkualitas. <br>
Cocok untuk hajatan, pengajian, syukuran, rapat, acara keluarga, dan berbagai momen spesial anda.
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
            @forelse($banners ?? [] as $index => $banner)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
              <img src="{{ asset($banner->image) }}" loading="lazy" class="d-block w-100 lazy-blur"
                alt="{{ $banner->title }}" style="height: 380px; object-fit: cover;">
              <div class="position-absolute bottom-0 start-0 m-3 bg-white bg-opacity-95 backdrop-blur px-3 py-2 rounded-pill shadow-sm border border-white z-2">
                <span class="fw-bold text-danger fs-7"><i class="bi bi-star-fill text-warning me-1"></i> {{ $banner->badge_text ?? $banner->title }}</span>
              </div>
            </div>
            @empty
            <div class="carousel-item active">
              <img src="{{ asset('img/products/Bolu/gulung hias keju.jpg') }}" loading="lazy" class="d-block w-100 lazy-blur"
                alt="Bolu Gulung Keju 99 Bakery" style="height: 380px; object-fit: cover;">
              <div class="position-absolute bottom-0 start-0 m-3 bg-white bg-opacity-95 backdrop-blur px-3 py-2 rounded-pill shadow-sm border border-white z-2">
                <span class="fw-bold text-danger fs-7"><i class="bi bi-star-fill text-warning me-1"></i> Bolu Gulung Topping Keju</span>
              </div>
            </div>
            @endforelse
          </div>
          <!-- Indicators -->
          @if(isset($banners) && count($banners) > 1)
          <div class="carousel-indicators">
            @foreach($banners as $index => $banner)
              <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
          </div>
          @endif
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
      @forelse($categories ?? [] as $category)
      <div class="col-6 col-md-4 col-lg-3">
        <a href="{{ route('produk') }}" class="category-card-box">
          <div class="category-img-box">
            <img src="{{ asset($category->image ?? 'img/products/roti/Sobek pisang.jpg') }}" loading="lazy" class="category-img lazy-blur" alt="{{ $category->name }}">
          </div>
          <h4 class="category-card-title">{{ $category->name }}</h4>
          <p class="category-card-desc">{{ $category->description }}</p>
          <span class="category-card-link">Lihat Produk <i class="bi bi-arrow-right"></i></span>
        </a>
      </div>
      @empty
      <div class="col-12 text-center text-muted py-4">Belum ada kategori produk.</div>
      @endforelse
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
      <div class="section-badge">PRODUK UNGGULAN</div>
      <h2 class="section-title">Pilihan Terfavorit Pelanggan</h2>
      <p class="section-subtitle">
        Produk unggulan racikan terbaik 99 Bakery yang paling diminati untuk menyempurnakan setiap momen istimewa Anda.
      </p>

      <div class="row g-2 g-md-4 mb-5 d-flex align-items-center justify-content-center">
        @forelse($popularProducts ?? [] as $product)
        <div class="col-6 col-md-4 col-lg-3 d-flex align-items-stretch">
          <div class="product-card w-100">
            <div class="product-img-box">
              @if($product->badge)
                <span class="product-badge shadow-sm" style="background-color: {{ $product->badge->bg_color }}; color: {{ $product->badge->text_color }};">
                  {{ $product->badge->name }}
                </span>
              @endif
              <img src="{{ asset($product->image) }}" loading="lazy" class="product-img lazy-blur" alt="{{ $product->name }}">
            </div>
            <div class="product-body">
              <span class="product-category category">{{ $product->category->name ?? 'Aneka Roti' }}</span>
              <h3 class="product-title name">{{ $product->name }}</h3>
              <p class="product-desc desc">{{ $product->description }}</p>
              <div class="product-footer">
                <div>
                  <div class="product-price price-display">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                  <div class="product-price-note">per {{ $product->unit }}</div>
                </div>
                <button type="button" class="btn-sm-detail"
                  data-title="{{ $product->name }}"
                  data-price="Rp {{ number_format($product->price, 0, ',', '.') }}"
                  data-category="{{ $product->category->name ?? 'Roti' }}"
                  data-desc="{{ $product->description }}"
                  data-img="{{ asset($product->image) }}">Detail</button>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-4">Belum ada produk favorit.</div>
        @endforelse
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
          <p class="step-desc"> Pesanan dioven fresh pada hari H dan siap diambil di outlet pilihan Anda.</p>
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
                Anda bisa langsung memilih paket di katalog produk atau mengklik tombol WhatsApp. Pilih outlet terdekat (Tawang Alun / Kampus), tentukan jumlah box yang dibutuhkan, dan tim CS kami akan memproses pesanan serta mengonfirmasi pesanan Anda.
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
                Untuk pemesanan roti hajatan / snack box dalam jumlah banyak, kami menyarankan melakukan pemesanan jauh-jauh hari agar kuota produksi masih tersedia. Pemesanan paling lambat dilakukan H-2 sebelum waktu pengambilan, sehingga tim produksi dapat menyiapkan pesanan dengan optimal dan tetap fresh.
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
                Saat ini, 99 Bakery belum menyediakan layanan pengiriman secara langsung. Namun, pelanggan dapat menggunakan jasa kurir online pilihan sendiri, dengan biaya ongkir ditanggung oleh pelanggan sesuai tarif yang tertera pada aplikasi.
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection
