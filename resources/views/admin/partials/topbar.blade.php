<!-- TOPBAR HEADER -->
<header class="admin-topbar">
  <div class="topbar-left">
    <button class="btn-sidebar-toggle d-lg-none" type="button" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasAdminSidebar">
      <i class="bi bi-list fs-5"></i>
    </button>
    <div class="topbar-search d-none d-sm-block">
      <i class="bi bi-search"></i>
      <input type="text" placeholder="Cari bagian landing page...">
    </div>
  </div>

  <div class="topbar-right">
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle gap-2" data-bs-toggle="dropdown">
        <div class="user-avatar" style="width: 34px; height: 34px; font-size: 0.85rem;">A</div>
        <span class="d-none d-md-inline fw-semibold text-dark" style="font-size: 0.88rem;">Admin 99</span>
      </a>
      <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
        <li><a class="dropdown-item" href="{{ route('admin.outlet') }}"><i class="bi bi-gear me-2"></i>Pengaturan Toko</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger sim-action-btn" data-action="Logout" href="{{ route('admin.login') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
      </ul>
    </div>
  </div>
</header>
