<aside id="sidebar">
    <div class="d-flex">
        <button class="toggle-btn" type="button">
            <span class="material-icons bg-white">dashboard</span>
        </button>
        <div class="sidebar-logo">
            <a href="#">Alveen Clothing</a>
        </div>
    </div>
    <ul class="sidebar-nav">
        <li class="sidebar-item {{ Request::path() == '/' ? 'active' : '' }}">
            <a href="/" class="sidebar-link collapsed has-dropdown" 
                data-bs-target="#dashboard" aria-expanded="false" aria-controls="dashboard">
                <i class="lni lni-grid-alt"></i>
                <span>Dashboard</span>
            </a>
            <ul id="dashboard" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="/" class="sidebar-link">Dashboard</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item {{ Request::path() == 'pelanggan' ? 'active' : '' }}">
            <a href="{{ route('pelanggan') }}" class="sidebar-link collapsed has-dropdown" 
                data-bs-target="#pelanggan" aria-expanded="false" aria-controls="pelanggan">
                <i class="lni lni lni-users"></i>
                <span style="margin-left: 3px;">Pelanggan</span>
            </a>
            <ul id="pelanggan" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('pelanggan') }}" class="sidebar-link">Pelanggan</a>
                </li>
            </ul>
        </li>
        {{-- <li class="sidebar-item {{ Request::path() == '/' ? 'active' : '' }}">
            <a href="/" class="sidebar-link">
                <i class="lni lni-grid-alt"></i>
                <span>Dashboard</span>
            </a>
        </li> --}}
        {{-- <li class="sidebar-item {{ Request::path() == 'pelanggan' ? 'active' : '' }}">
            <a href="pelanggan" class="sidebar-link">
                <i class="lni lni-users"></i>
                <span>Pelanggan</span>
            </a>
        </li> --}}
        <li class="sidebar-item">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                data-bs-target="#produk" aria-expanded="false" aria-controls="produk">
                <i class="lni lni-shopping-basket"></i>
                <span style="margin-left: 3.5px;">Produk</span>
            </a>
            <ul id="produk" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item {{ Request::path() == 'konveksi' ? 'active' : '' }}">
                    <a href="{{ route('konveksi') }}" class="sidebar-link"> <span class="fw-bold mx-2">-</span>Konveksi</a>
                </li>
                <li class="sidebar-item {{ Request::path() == 'tokobaju' ? 'active' : '' }}">
                    <a href="{{ route('tokobaju') }}" class="sidebar-link"><span class="fw-bold mx-2">-</span>Toko Baju</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item {{ Request::path() == 'transaksi' ? 'active' : '' }}">
            <a href="{{ route('transaksi') }}" class="sidebar-link collapsed has-dropdown" 
                data-bs-target="#transaksi" aria-expanded="false" aria-controls="transaksi">
                <i class="fas fa-credit-card"></i>
                <span>Transaksi</span>
            </a>
            <ul id="transaksi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('transaksi') }}" class="sidebar-link">Transaksi</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item {{ Request::path() == 'history' ? 'active' : '' }}">
            <a href="{{ route('history') }}" class="sidebar-link collapsed has-dropdown" 
                data-bs-target="#history" aria-expanded="false" aria-controls="history">
                <i class="fas fa-history"></i>
                <span style="margin-left: 3.5px;">History</span>
            </a>
            <ul id="history" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('history') }}" class="sidebar-link">History</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item {{ Request::path() == 'notifikasi' ? 'active' : '' }}">
            <a href="{{ route('notifikasi') }}" class="sidebar-link collapsed has-dropdown" 
                data-bs-target="#notifikasi" aria-expanded="false" aria-controls="notifikasi">
                <i class="lni lni-popup"></i>
                <span style="margin-left: 3px;">Notifikasi</span>
            </a>
            <ul id="notifikasi" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('notifikasi') }}" class="sidebar-link">Notifikasi</a>
                </li>
            </ul>
        </li>
        <li class="sidebar-item {{ Request::path() == 'setting' ? 'active' : '' }}">
            <a href="{{ route('setting') }}" class="sidebar-link collapsed has-dropdown" 
                data-bs-target="#setting" aria-expanded="false" aria-controls="setting">
                <i class="lni lni-cog"></i>
                <span style="margin-left: 3px;">Setting</span>
            </a>
            <ul id="setting" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                <li class="sidebar-item">
                    <a href="{{ route('setting') }}" class="sidebar-link">Setting</a>
                </li>
            </ul>
        </li>
        {{-- <li class="sidebar-item {{ Request::path() == 'transaksi' ? 'active' : '' }}">
            <a href="transaksi" class="sidebar-link">
                <i class="fas fa-credit-card"></i>
                <span>Transaksi</span>
            </a>
        </li> --}}
        {{-- <li class="sidebar-item {{ Request::path() == 'history' ? 'active' : '' }}">
            <a href="history" class="sidebar-link">
                <i class="fas fa-history"></i>
                <span>Histori</span>
            </a>
        </li> --}}
        {{-- <li class="sidebar-item {{ Request::path() == 'notifikasi' ? 'active' : '' }}">
            <a href="notifikasi" class="sidebar-link">
                <i class="lni lni-popup"></i>
                <span>Notification</span>
            </a>
        </li> --}}
        {{-- <li class="sidebar-item {{ Request::path() == 'setting' ? 'active' : '' }}">
            <a href="setting" class="sidebar-link">
                <i class="lni lni-cog"></i>
                <span>Setting</span>
            </a>
        </li> --}}
    </ul>
    <div class="sidebar-footer">
        <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
        </a>
    </div>
</aside>