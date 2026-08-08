<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html" style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                <img src="{{ asset('img/Logo_99bakery.jpeg') }}" width="24px">
                <span>Holand Test </span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">
                <img src="{{ asset('img/Logo_99bakery.jpeg') }}" width="30px">
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="{{ Request::is('admin/pegawai') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/pegawai') }}"><i class="fas fa-user"></i>
                    <span>Kelola Peserta</span></a>
            </li>
            </li>
            <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/settings') }}"><i class="fas fa-cog"></i>
                    <span>Pengaturan Waktu Tes</span></a>
            </li>
            <li class="{{ Request::is('admin/hasil-tes') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('admin/hasilTes') }}"><i class="fas fa-square-poll-vertical"></i>
                    <span>Hasil Tes</span></a>
            </li>
        </ul>
    </aside>
</div>
