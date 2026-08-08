<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', '99 Bakery Jember - Spesialis Roti Hajatan, Kue & Snackbox Fresh Every Day')</title>
  <meta name="description" content="@yield('meta_description', '99 Bakery Jember menghadirkan roti hajatan, brownies, bolen, kue basah, donat, dan snackbox berkualitas dari bahan pilihan, fresh setiap hari dengan harga bersahabat.')">
  <meta name="keywords" content="99 bakery, roti hajatan jember, toko roti jember, snackbox jember, brownies jember, bolen pisang, 99 bakery tawang alun, 99 bakery kampus">

  <!-- Favicon / Logo -->
  <link rel="icon" type="image/jpeg" href="{{ asset('img/logo.jpeg') }}">

  <!-- Google Fonts: Outfit (Heading) & Plus Jakarta Sans (Body) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@500;600;700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap 5.3 CSS -->
  <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.min.css') }}">

  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  @stack('styles')
</head>

<body>

  <!-- Top Mini Announcement Bar & Navbar -->
  @include('public.partials.navbar')

  <!-- Main Content -->
  @yield('content')

  <!-- Footer -->
  @include('public.partials.footer')

  <!-- QUICK VIEW PRODUCT MODAL -->
  <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="modalProductTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
        <div class="modal-header bg-warm-section border-0 pb-0">
          <span class="badge bg-danger-subtle text-danger fw-bold me-2" id="modalProductCategory">Kategori</span>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="placeholder-box mb-3 py-4">
            <i class="bi bi-cake2-fill placeholder-icon"></i>
            <small class="fw-bold text-dark">Slot Foto Detail Produk</small>
          </div>

          <h4 class="fw-bold text-dark mb-1" id="modalProductTitle">Nama Produk</h4>
          <div class="fs-4 fw-extrabold text-danger mb-3" id="modalProductPrice">Rp 0</div>

          <p class="text-muted small mb-4" id="modalProductDesc">
            Deskripsi lengkap produk.
          </p>

          <div class="bg-light p-3 rounded-3 mb-4">
            <label for="modalOutletSelect" class="form-label fw-bold text-dark small mb-1"><i class="bi bi-shop me-1 text-danger"></i> Pilih Outlet Tujuan:</label>
            <select class="form-select form-select-sm mb-3" id="modalOutletSelect">
              <option value="tawangalun" selected>Outlet Tawang Alun (Pusat) - 085257220335</option>
              <option value="kampus">Outlet Kampus (Sumbersari) - 085284911654</option>
            </select>

            <label for="modalProductQty" class="form-label fw-bold text-dark small mb-1"><i class="bi bi-box-seam me-1 text-danger"></i> Jumlah Pesanan (Box / Pcs):</label>
            <input type="number" class="form-control form-control-sm" id="modalProductQty" value="1" min="1" max="1000">
          </div>

          <div class="d-grid">
            <a href="#" id="btnSendModalWa" target="_blank" class="btn btn-sm-wa justify-content-center py-2 fs-6">
              <i class="bi bi-whatsapp me-2 fs-5"></i> Kirim Pesan Pemesanan WA
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- FLOATING WHATSAPP BUTTON (Desktop Only) -->
  <div class="floating-wa-wrapper d-none d-md-block">
    <div class="floating-wa-tooltip">
      <i class="bi bi-chat-dots-fill text-success"></i> Tanya / Pesan WA
    </div>
    <a href="https://wa.me/6285257220335?text=Halo%2099%20Bakery,%20saya%20ingin%20bertanya%20mengenai%20pemesanan%20roti"
      target="_blank" class="floating-wa-btn" title="Chat WhatsApp 99 Bakery">
      <i class="bi bi-whatsapp"></i>
    </a>
  </div>

  <!-- SCROLL TO TOP FLOATING BUTTON (Mobile Only) -->
  <a href="#" id="scrollTopBtn" class="scroll-top-btn d-md-none" title="Kembali ke Atas" aria-label="Scroll ke Atas">
    <i class="bi bi-chevron-up"></i>
  </a>

  <!-- MOBILE BOTTOM NAVIGATION BAR -->
  <div class="mobile-bottom-nav">
    <a href="{{ route('home') }}" class="mobile-nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
      <div class="mobile-nav-icon-badge">
        <i class="bi bi-house-door-fill"></i>
      </div>
      <span>Beranda</span>
    </a>
    <a href="{{ route('produk') }}" class="mobile-nav-item {{ request()->routeIs('produk') ? 'active' : '' }}">
      <div class="mobile-nav-icon-badge">
        <i class="bi bi-grid-fill"></i>
      </div>
      <span>Katalog</span>
    </a>
    <a href="{{ route('outlet') }}" class="mobile-nav-item {{ request()->routeIs('outlet') ? 'active' : '' }}">
      <div class="mobile-nav-icon-badge">
        <i class="bi bi-geo-alt-fill"></i>
      </div>
      <span>Outlet</span>
    </a>
    <a href="https://wa.me/6285257220335?text=Halo%2099%20Bakery,%20saya%20mau%20pesan" target="_blank" class="mobile-nav-item nav-wa">
      <div class="mobile-nav-icon-badge">
        <i class="bi bi-whatsapp"></i>
      </div>
      <span>Pesan WA</span>
    </a>
  </div>

  <!-- JQUERY & BOOTSTRAP SCRIPT -->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Main Script -->
  <script src="{{ asset('js/main.js') }}"></script>
  @stack('scripts')
</body>

</html>
