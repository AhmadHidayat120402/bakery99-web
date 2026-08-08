<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html"
                style="display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 10px">
                <img src="{{ asset('img/Logo_99bakery.jpeg') }}" width="120px">
                {{-- <span>99 Bakery </span> --}}
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">
                <img src="{{ asset('img/Logo_99bakery.jpeg') }}" width="30px">
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin') }}"><i class="fas fa-chart-line"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('admin/pegawai') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/kategori') }}"><i class="fas fa-box"></i>
                    <span>Kelola Kategori</span></a>
            </li>
            </li>
            <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/produk') }}"><i class="fas fa-layer-group"></i>
                    <span>Kelola Produk</span></a>
            </li>
        </ul>
    </aside>
</div>
