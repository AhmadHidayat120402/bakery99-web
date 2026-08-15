<!-- SIDEBAR -->
<aside class="admin-sidebar">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
            <img src="{{ asset('img/logo.jpeg') }}" alt="99 Bakery Logo">
            <div>
                <span class="sidebar-brand-text">99 BAKERY</span>
                <span class="sidebar-brand-sub">Kelola Landing Page</span>
            </div>
        </a>
    </div>

    <div class="sidebar-menu">
        <div class="menu-category">Ringkasan</div>
        <a href="{{ route('admin.dashboard') }}"
            class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill"></i>
            <span>Dashboard</span>
        </a>

        <div class="menu-category">Pengelola Konten</div>
        <a href="{{ route('admin.banner') }}"
            class="nav-link-admin {{ request()->routeIs('admin.banner') ? 'active' : '' }}">
            <i class="bi bi-images"></i>
            <span>Banner & Carousel Hero</span>
        </a>
        <a href="{{ route('admin.kategori') }}"
            class="nav-link-admin {{ request()->routeIs('admin.kategori') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i>
            <span>Kategori Produk</span>
        </a>
        <a href="{{ route('admin.produk') }}"
            class="nav-link-admin {{ request()->routeIs('admin.produk') ? 'active' : '' }}">
            <i class="bi bi-box-seam-fill"></i>
            <span>Produk</span>
        </a>
        <a href="{{ route('admin.badge') }}"
            class="nav-link-admin {{ request()->routeIs('admin.badge') ? 'active' : '' }}">
            <i class="bi bi-patch-check-fill"></i>
            <span>Badge Promo</span>
        </a>
        <a href="{{ route('admin.about.index') }}"
            class="nav-link-admin {{ request()->routeIs('admin.about.index') ? 'active' : '' }}">
            <i class="bi bi-card-heading"></i>
            <span>Konten Tentang Toko</span>
        </a>
        <a href="{{ route('admin.outlet') }}"
            class="nav-link-admin {{ request()->routeIs('admin.outlet') ? 'active' : '' }}">
            <i class="bi bi-shop"></i>
            <span>Outlet & Kontak WA</span>
        </a>

        <div class="menu-category">Pengaturan Sistem</div>
        <a href="{{ route('admin.pengguna') }}"
            class="nav-link-admin {{ request()->routeIs('admin.pengguna') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i>
            <span>Kelola Pengguna</span>
        </a>

        <div class="menu-category">Pratinjau</div>
        <a href="{{ route('home') }}" target="_blank" class="nav-link-admin">
            <i class="bi bi-globe"></i>
            <span>Lihat Website Publik</span>
            <i class="bi bi-box-arrow-up-right ms-auto opacity-50" style="font-size: 0.8rem;"></i>
        </a>
        {{-- <a href="{{ route('admin.login') }}" class="nav-link-admin text-danger">
            <i class="bi bi-box-arrow-right text-danger"></i>
            <span>Keluar (Logout)</span>
        </a> --}}
        <button type="button" class="nav-link-admin text-danger border-0 bg-transparent w-100 text-start"
            data-bs-toggle="modal" data-bs-target="#modalLogout">

            <i class="bi bi-box-arrow-right me-2"></i>
            Logout

        </button>
    </div>

    {{-- <div class="sidebar-footer">
        <div class="user-profile-summary">
            <div class="user-avatar">A</div>
            <div class="overflow-hidden">
                <h6 class="mb-0 fw-bold text-dark text-truncate" style="font-size: 0.88rem;">Admin 99 Bakery</h6>
                <span class="text-muted text-truncate d-block" style="font-size: 0.75rem;">admin@99bakery.com</span>
            </div>
        </div>
    </div> --}}
</aside>

<!-- MODAL KONFIRMASI LOGOUT -->
<div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-sm">

        <div class="modal-content border-0 shadow">

            <!-- HEADER -->
            <div class="modal-header border-0">

                <h5 class="modal-title fw-bold" id="modalLogoutLabel">

                    <i class="bi bi-box-arrow-right text-danger me-2"></i>
                    Konfirmasi Logout

                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>

            </div>


            <!-- BODY -->
            <div class="modal-body text-center pt-0">

                <div class="mx-auto mb-3 d-flex align-items-center justify-content-center"
                    style="
                        width: 60px;
                        height: 60px;
                        background: rgba(220, 53, 69, 0.1);
                        border-radius: 50%;
                    ">

                    <i class="bi bi-box-arrow-right text-danger" style="font-size: 1.6rem;">
                    </i>

                </div>

                <h6 class="fw-bold mb-2">
                    Yakin ingin keluar?
                </h6>

                <p class="text-muted small mb-0">
                    Anda akan keluar dari halaman admin.
                </p>

            </div>


            <!-- FOOTER -->
            <div class="modal-footer border-0 justify-content-center gap-2">

                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4" data-bs-dismiss="modal">

                    Batal

                </button>


                <form action="{{ route('logout') }}" method="POST" class="d-inline">

                    @csrf

                    <button type="submit" class="btn btn-danger btn-sm rounded-pill px-4">

                        <i class="bi bi-box-arrow-right me-1"></i>
                        Ya, Logout

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

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
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Ikhtisar CMS</span>
            </a>

            <div class="menu-category">Pengelola Konten</div>
            <a href="{{ route('admin.banner') }}"
                class="nav-link-admin {{ request()->routeIs('admin.banner') ? 'active' : '' }}">
                <i class="bi bi-images"></i>
                <span>Banner & Carousel Hero</span>
            </a>
            <a href="{{ route('admin.about.index') }}"
                class="nav-link-admin {{ request()->routeIs('admin.about.index') ? 'active' : '' }}">
                <i class="bi bi-card-heading"></i>
                <span>Konten Tentang Toko</span>
            </a>
            <a href="{{ route('admin.kategori') }}"
                class="nav-link-admin {{ request()->routeIs('admin.kategori') ? 'active' : '' }}">
                <i class="bi bi-tags-fill"></i>
                <span>Kelola Kategori</span>
            </a>
            <a href="{{ route('admin.produk') }}"
                class="nav-link-admin {{ request()->routeIs('admin.produk') ? 'active' : '' }}">
                <i class="bi bi-box-seam-fill"></i>
                <span>Kelola Produk</span>
            </a>
            <a href="{{ route('admin.badge') }}"
                class="nav-link-admin {{ request()->routeIs('admin.badge') ? 'active' : '' }}">
                <i class="bi bi-patch-check-fill"></i>
                <span>Badge Promo</span>
            </a>
            <a href="{{ route('admin.outlet') }}"
                class="nav-link-admin {{ request()->routeIs('admin.outlet') ? 'active' : '' }}">
                <i class="bi bi-shop"></i>
                <span>Outlet & Kontak WA</span>
            </a>

            <div class="menu-category">Pengaturan Sistem</div>
            <a href="{{ route('admin.pengguna') }}"
                class="nav-link-admin {{ request()->routeIs('admin.pengguna') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i>
                <span>Kelola Pengguna</span>
            </a>

            <div class="menu-category">Pratinjau</div>
            <a href="{{ route('home') }}" target="_blank" class="nav-link-admin">
                <i class="bi bi-globe"></i>
                <span>Lihat Website Publik</span>
                <i class="bi bi-box-arrow-up-right ms-auto opacity-50" style="font-size: 0.8rem;"></i>
            </a>
            {{-- <a href="{{ route('admin.login') }}" class="nav-link-admin text-danger">
                <i class="bi bi-box-arrow-right text-danger"></i>
                <span>Keluar (Logout)</span>
            </a> --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">

                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout

                </button>
            </form>
        </div>
    </div>
</div>
