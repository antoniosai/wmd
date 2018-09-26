<ul>
    @can('dashboard')
    <li @if(Request::segment(2) == 'dashboard') class="active" @endif>
        <a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a>
    </li>
    @endcan

    @can('kasir')
    <li @if(Request::segment(2) == 'kasir') class="active" @endif>
        <a href="{{ route('kasir.index') }}"><i class="fa fa-money"></i> Kasir</a>
    </li>
    @endcan

    @can('dapur')
    <li @if(Request::segment(2) == 'dapur') class="active" @endif>
        <a href="{{ route('dapur.index') }}"><i class="fa fa-fire"></i> Dapur</a>
    </li>
    @endcan

    @can('info-restaurant')
    <li @if(Request::segment(2) == 'informasi_restaurant') class="active" @endif>
        <a href="{{ route('admin.info.index') }}"><i class="fa fa-home"></i> Informasi Restaurant</a>
    </li>
    @endcan

    <li class="menu-title">Master Data</li>
    @can('menu')
    <li @if(Request::segment(2) == 'menu') class="active" @endif>
        <a href="{{ route('admin.menu.index') }}"><i class="fa fa-cutlery" aria-hidden="true"></i> Manajemen Menu</a>
    </li>
    @endcan

    @can('bahan-baku')
    <li @if(Request::segment(2) == 'bahan_baku') class="active" @endif>
        <a href="{{ route('admin.bahan_baku.index') }}"><i class="fa fa-lemon-o" aria-hidden="true"></i> Bahan Baku</a>
    </li>
    @endcan

    @can('kepegawaian')
    <li @if(Request::segment(2) == 'kepegawaian') class="active" @endif>
        <a href="{{ route('admin.kepegawaian.index') }}"><i class="fa fa-address-card" aria-hidden="true"></i> Kepegawaian</a>
    </li>
    @endcan

    @can('pengunjung')
    <li @if(Request::segment(2) == 'pengunjung') class="active" @endif>
        <a href="tasks.html"><i class="fa fa-tasks" aria-hidden="true"></i> Pengunjung</a>
    </li>
    @endcan

    @can('laporan')
    <li class="menu-title">Laporan</li>
    <li class="submenu">
        <a href="#"><i class="fa fa-circle-o" aria-hidden="true"></i> <span> Bahan Baku</span> <span class="menu-arrow"></span></a>
        <ul class="list-unstyled" style="display: none;">
            <li><a href="uikit.html">Laporan Masuk</a></li>
            <li><a href="typography.html">Laporan Keluar</a></li>
        </ul>
    </li>
    <li>
        <a href="widgets.html"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Penjualan</a>
    </li>
    <li>
        <a href="widgets.html"><i class="fa fa-book" aria-hidden="true"></i> Laba Rugi</a>
    </li>
    @endcan

    
</ul>