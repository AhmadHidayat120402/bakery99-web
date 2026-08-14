<!-- Top Mini Announcement Bar -->
<div class="top-bar text-center">
  <div class="container">
    <span><i class="bi bi-gift-fill me-1"></i> Spesialis Roti Hajatan & Snack Box Jember • Fresh Setiap Hari • Pesan
      via WA: <a href="https://wa.me/6285257220335" target="_blank" class="fw-bold">0852-5722-0335</a></span>
  </div>
</div>

<!-- Sticky Navbar -->
<nav class="navbar navbar-expand-lg navbar-99 sticky-top">
  <div class="container">
    <a class="navbar-brand py-0" href="{{ route('home') }}">
      <img src="{{ asset('img/logo-new-white.png') }}" alt="Logo 99 Bakery Jember - Spesialis Roti Hajatan & Snack Box" class="d-inline-block align-text-top"
        style="height: 48px; border-radius: 10px;">
    </a>

    <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbar99Menu" aria-controls="navbar99Menu" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar99Menu">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-lg-3 align-items-lg-center">
        <li class="nav-item"><a class="nav-link nav-link-99 {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
        <li class="nav-item"><a class="nav-link nav-link-99" href="{{ route('home') }}#keunggulan">Keunggulan</a></li>
        <li class="nav-item"><a class="nav-link nav-link-99 {{ request()->routeIs('tentang') ? 'active' : '' }}" href="{{ route('tentang') }}">Profil & SONGO</a></li>
        <li class="nav-item"><a class="nav-link nav-link-99 {{ request()->routeIs('produk') ? 'active' : '' }}" href="{{ route('produk') }}">Katalog Produk</a></li>
        <li class="nav-item"><a class="nav-link nav-link-99 {{ request()->routeIs('outlet') ? 'active' : '' }}" href="{{ route('outlet') }}">Outlet Kami</a></li>
        <li class="nav-item"><a class="nav-link nav-link-99" href="{{ route('home') }}#faq">FAQ</a></li>
        <li class="nav-item"><a class="nav-link nav-link-99" href="{{ route('home') }}#kontak">Kontak</a></li>
      </ul>
      <a href="https://wa.me/6285257220335?text=Halo%2099%20Bakery,%20saya%20ingin%20tanya%20produk%20dan%20pemesanan"
        target="_blank" class="btn btn-red btn-sm d-inline-flex align-items-center gap-2">
        <i class="bi bi-whatsapp"></i> Pesan WA
      </a>
    </div>
  </div>
</nav>
