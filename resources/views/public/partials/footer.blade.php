<!-- FOOTER & KONTAK -->
<footer id="kontak">
  <div class="container">
    <div class="row g-4 mb-5">

      <div class="col-lg-4">
        <div class="mb-3 d-flex align-items-center gap-3">
          <img src="{{ asset('img/logo.jpeg') }}" alt="Logo 99 Bakery Jember - Spesialis Roti Hajatan & Snack Box" class="footer-logo mb-0"
            style="height: 52px; border-radius: 10px;">
          <img src="{{ asset('img/logo-halal.png') }}" alt="Sertifikat Halal Indonesia - 99 Bakery Jember" class="footer-logo mb-0"
            style="height: 52px; border-radius: 10px; object-fit: contain;">
        </div>
        <p class="small text-white-75 mb-0">
          Toko roti spesialis roti hajatan, brownies, bolen, kue basah, dessert, dan snackbox berkualitas dengan rasa
          lezat, fresh setiap hari, dan harga terjangkau di Jember.
        </p>
      </div>

      <div class="col-6 col-sm-6 col-lg-2">
        <h5>Navigasi</h5>
        <ul class="list-unstyled small mb-0">
          <li class="mb-2"><a href="{{ route('home') }}">Beranda</a></li>
          <li class="mb-2"><a href="{{ route('home') }}#keunggulan">Keunggulan</a></li>
          <li class="mb-2"><a href="{{ route('tentang') }}">Profil & SONGO</a></li>
          <li class="mb-2"><a href="{{ route('produk') }}">Katalog Produk</a></li>
          <li class="mb-2"><a href="{{ route('outlet') }}">Outlet Kami</a></li>
          <li class="mb-2"><a href="{{ route('home') }}#faq">FAQ</a></li>
        </ul>
      </div>

      <div class="col-12 col-sm-6 col-lg-3">
        <h5>Kontak Utama</h5>
        <ul class="list-unstyled small mb-0">
          <li class="mb-2"><i class="bi bi-geo-alt-fill text-warning me-2"></i> Jl. Dharmawangsa No.64, Jubung, Tawang
            Alun, Jember</li>
          <li class="mb-2"><i class="bi bi-telephone-fill text-warning me-2"></i> 0852-5722-0335</li>
          <li class="mb-2 text-break"><i class="bi bi-envelope-fill text-warning me-2"></i> 99bakeryjember@gmail.com
          </li>
          <li class="mb-2"><i class="bi bi-clock-fill text-warning me-2"></i> Setiap Hari (07.00 - 21.00 WIB)</li>
        </ul>
      </div>

      <div class="col-lg-3">
        <h5>Media Sosial</h5>
        <p class="small text-white-75 mb-3">Ikuti kabar promo terbaru & varian roti hangat setiap hari di media sosial
          kami:</p>
        <div class="d-flex flex-column gap-2">
          <a href="https://www.instagram.com/99bakeryjember/" target="_blank" class="footer-social-btn">
            <span class="social-icon-btn"><i class="bi bi-instagram"></i></span>
            <span>@99bakeryjember</span>
          </a>
          <a href="https://www.tiktok.com/@99bakeryjember" target="_blank" class="footer-social-btn">
            <span class="social-icon-btn"><i class="bi bi-tiktok"></i></span>
            <span>@99bakeryjember</span>
          </a>
        </div>
      </div>

    </div>

    <hr class="border-white border-opacity-25 my-4">

    <div class="row align-items-center small text-white-75">
      <div class="col-md-6 text-center text-md-start">
        &copy; {{ date('Y') }} <strong>99Bakery</strong>. All Rights Reserved.
      </div>
      <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
        Dibuat dengan rasa cinta & kesegaran setiap hari.
      </div>
    </div>
  </div>
</footer>
