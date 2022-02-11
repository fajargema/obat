<!--**********************************
            Sidebar start
***********************************-->
<div class="deznav">
    <div class="deznav-scroll">
        <ul class="metismenu" id="menu">
            @if (Auth::user()->roles == 2)
            <li>
                <a href="{{ route('admin-page.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin-page.category.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-price-tag"></i>
                    <span class="nav-text">Kategori</span>
                </a>
            </li>

            <li>
                <a href="{{ route('admin-page.medicine.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-plus"></i>
                    <span class="nav-text">Obat</span>
                </a>
            </li>

            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-notepad-1"></i>
                    <span class="nav-text">Transaksi</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin-page.transaction.create') }}">Jual</a></li>
                    <li><a href="{{ route('admin-page.transaction.index') }}">Data Transaksi</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('admin-page.transaction.cari') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-notepad"></i>
                    <span class="nav-text">Laporan Transaksi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin-page.user.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-user-8"></i>
                    <span class="nav-text">User Pengguna</span>
                </a>
            </li>
            @elseif (Auth::user()->roles == 1)
            <li>
                <a href="{{ route('pegawai.index') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-networking"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('pegawai.obat.stok') }}" class="ai-icon" aria-expanded="false">
                    <i class="flaticon-381-plus"></i>
                    <span class="nav-text">Stok Obat</span>
                </a>
            </li>
            <li>
                <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-381-notepad-1"></i>
                    <span class="nav-text">Transaksi</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('pegawai.transaction.create') }}">Penjualan</a></li>
                    <li><a href="{{ route('pegawai.transaction.index') }}">Data Transaksi</a></li>
                </ul>
            </li>
            @endif

        </ul>

    </div>
</div>
<!--**********************************
            Sidebar end
***********************************-->
