<!-- TOPBAR HEADER -->
<header class="admin-topbar">
    <div class="topbar-left">
        <button class="btn-sidebar-toggle d-lg-none" type="button" data-bs-toggle="offcanvas"
            data-bs-target="#offcanvasAdminSidebar">
            <i class="bi bi-list fs-5"></i>
        </button>
    </div>

    <div class="topbar-right">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle gap-2"
                data-bs-toggle="dropdown">
                <div class="user-avatar" style="width: 34px; height: 34px; font-size: 0.85rem;">
                    {{ strtoupper(substr(auth()->user()?->name ?? 'A', 0, 1)) }}</div>
                <span class="d-none d-md-inline fw-semibold text-dark"
                    style="font-size: 0.88rem;">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                <li><a class="dropdown-item" href="{{ route('admin.outlets.index') }}"><i
                            class="bi bi-gear me-2"></i>Pengaturan Toko</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <button type="button" class="dropdown-item text-danger border-0 bg-transparent w-100 text-start"
                        data-bs-toggle="modal" data-bs-target="#modalLogout">

                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout

                    </button>
                </li>
            </ul>
        </div>
    </div>
</header>

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
