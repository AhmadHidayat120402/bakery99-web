<!-- SIDEBAR -->
<aside class="admin-sidebar">
  <div class="sidebar-header">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
      <img src="{{ asset('img/logo.jpeg') }}" alt="99 Bakery Logo">
      <div>
        <span class="sidebar-brand-text">99 BAKERY</span>
        <span class="sidebar-brand-sub">CMS Landing Page</span>
      </div>
    </a>
  </div>

  <div class="sidebar-menu">
    <div class="menu-category">Ringkasan</div>
    <a href="{{ route('admin.dashboard') }}" class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-grid-1x2-fill"></i>
      <span>Ikhtisar CMS</span>
    </a>

    <div class="menu-category">Pengelola Konten</div>
    <a href="{{ route('admin.banner') }}" class="nav-link-admin {{ request()->routeIs('admin.banner') ? 'active' : '' }}">
      <i class="bi bi-images"></i>
      <span>Banner & Carousel Hero</span>
    </a>
    <a href="{{ route('admin.tentang') }}" class="nav-link-admin {{ request()->routeIs('admin.tentang') ? 'active' : '' }}">
      <i class="bi bi-card-heading"></i>
      <span>Konten Tentang Toko</span>
    </a>
    <a href="{{ route('admin.kategori') }}" class="nav-link-admin {{ request()->routeIs('admin.kategori') ? 'active' : '' }}">
      <i class="bi bi-tags-fill"></i>
      <span>Kelola Kategori</span>
    </a>
    <a href="{{ route('admin.produk') }}" class="nav-link-admin {{ request()->routeIs('admin.produk') ? 'active' : '' }}">
      <i class="bi bi-box-seam-fill"></i>
      <span>Kelola Produk</span>
    </a>
    <a href="{{ route('admin.outlet') }}" class="nav-link-admin {{ request()->routeIs('admin.outlet') ? 'active' : '' }}">
      <i class="bi bi-shop"></i>
      <span>Outlet & Kontak WA</span>
    </a>

    <div class="menu-category">Pengaturan Sistem</div>
    <a href="{{ route('admin.pengguna') }}" class="nav-link-admin {{ request()->routeIs('admin.pengguna') ? 'active' : '' }}">
      <i class="bi bi-people-fill"></i>
      <span>Kelola Pengguna</span>
    </a>

    <div class="menu-category">Pratinjau</div>
    <a href="{{ route('home') }}" target="_blank" class="nav-link-admin">
      <i class="bi bi-globe"></i>
      <span>Lihat Website Publik</span>
      <i class="bi bi-box-arrow-up-right ms-auto opacity-50" style="font-size: 0.8rem;"></i>
    </a>
    <a href="{{ route('admin.login') }}" class="nav-link-admin text-danger">
      <i class="bi bi-box-arrow-right text-danger"></i>
      <span>Keluar (Logout)</span>
    </a>
  </div>

  <div class="sidebar-footer">
    <div class="user-profile-summary">
      <div class="user-avatar">A</div>
      <div class="overflow-hidden">
        <h6 class="mb-0 fw-bold text-dark text-truncate" style="font-size: 0.88rem;">Admin 99 Bakery</h6>
        <span class="text-muted text-truncate d-block" style="font-size: 0.75rem;">admin@99bakery.com</span>
      </div>
    </div>
  </div>
</aside>

<!-- OFFCANVAS SIDEBAR MOBILE -->
<div class="offcanvas offcanvas-start offcanvas-admin" tabindex="-1" id="offcanvasAdminSidebar">
  <div class="offcanvas-header">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
      <img src="{{ asset('img/logo.jpeg') }}" alt="99 Bakery Logo">
      <div>
        <span class="sidebar-brand-text">99 BAKERY</span>
        <span class="sidebar-brand-sub">CMS Landing Page</span>
      </div>
    </a>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0 d-flex flex-column justify-content-between">
    <div class="sidebar-menu">
      <div class="menu-category">Ringkasan</div>
      <a href="{{ route('admin.dashboard') }}" class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2-fill"></i>
        <span>Ikhtisar CMS</span>
      </a>

      <div class="menu-category">Pengelola Konten</div>
      <a href="{{ route('admin.banner') }}" class="nav-link-admin {{ request()->routeIs('admin.banner') ? 'active' : '' }}">
        <i class="bi bi-images"></i>
        <span>Banner & Carousel Hero</span>
      </a>
      <a href="{{ route('admin.tentang') }}" class="nav-link-admin {{ request()->routeIs('admin.tentang') ? 'active' : '' }}">
        <i class="bi bi-card-heading"></i>
        <span>Konten Tentang Toko</span>
      </a>
      <a href="{{ route('admin.kategori') }}" class="nav-link-admin {{ request()->routeIs('admin.kategori') ? 'active' : '' }}">
        <i class="bi bi-tags-fill"></i>
        <span>Kelola Kategori</span>
      </a>
      <a href="{{ route('admin.produk') }}" class="nav-link-admin {{ request()->routeIs('admin.produk') ? 'active' : '' }}">
        <i class="bi bi-box-seam-fill"></i>
        <span>Kelola Produk</span>
      </a>
      <a href="{{ route('admin.outlet') }}" class="nav-link-admin {{ request()->routeIs('admin.outlet') ? 'active' : '' }}">
        <i class="bi bi-shop"></i>
        <span>Outlet & Kontak WA</span>
      </a>

      <div class="menu-category">Pengaturan Sistem</div>
      <a href="{{ route('admin.pengguna') }}" class="nav-link-admin {{ request()->routeIs('admin.pengguna') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i>
        <span>Kelola Pengguna</span>
      </a>

      <div class="menu-category">Pratinjau</div>
      <a href="{{ route('home') }}" target="_blank" class="nav-link-admin">
        <i class="bi bi-globe"></i>
        <span>Lihat Website Publik</span>
        <i class="bi bi-box-arrow-up-right ms-auto opacity-50" style="font-size: 0.8rem;"></i>
      </a>
      <a href="{{ route('admin.login') }}" class="nav-link-admin text-danger">
        <i class="bi bi-box-arrow-right text-danger"></i>
        <span>Keluar (Logout)</span>
      </a>
    </div>
  </div>
</div>
