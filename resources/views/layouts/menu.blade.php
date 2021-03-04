@if (Auth::check())
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="/home"><i class="mdi mdi-home"></i>Home</a>
                </li>
                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-newspaper"></i>Informasi</a>
                    <ul class="submenu">
                        <li><a href="/informasi/berita">Berita</a></li>
                        <li><a href="/informasi/kategori">Kategori</a></li>
                        <li><a href="/informasi/slider">Slider</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#"><i class="fas fa-align-justify"></i>Data Master</a>
                    <ul class="submenu">
                        <li><a href="/data/kelompok">Kelompok Bahan</a></li>
                        <li><a href="/data/bahan">Bahan Pokok</a></li>
                        <li><a href="/data/satuan">Satuan</a></li>
                        <li><a href="/data/pasar">Pasar</a></li>
                        <li><a href="/data/pengguna">Pengguna</a></li>
                    </ul>
                </li>
                <li class="has-submenu">
                    <a href="#"><i class="fas fa-database"></i>Input Data</a>
                    <ul class="submenu">
                        <li><a href="/input/harga">Harga</a></li>
                        <li><a href="/input/stok">Stok</a></li>
                    </ul>
                </li>
            </ul>
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> 
@else
<div class="navbar-custom">
    <div class="container-fluid">
        <div id="navigation">
            <!-- Navigation Menu-->
            <ul class="navigation-menu">

                <li class="has-submenu">
                    <a href="/"><i class="mdi mdi-home"></i>Beranda</a>
                </li>
                <li class="has-submenu">
                    <a href="/info-harga"><i class="fas fa-money-bill-wave"></i>Info Harga</a>
                </li>
                <li class="has-submenu">
                    <a href="/info-stok"><i class="fas fa-archive"></i>Info Stok</a>
                </li>
                <li class="has-submenu">
                    <a href="#"><i class="mdi mdi-finance"></i>Grafik</a>
                    <ul class="submenu">
                        <li><a href="/grafik/harga">Grafik Harga</a></li>
                        <li><a href="/grafik/stok">Grafik Stok</a></li>
                    </ul>
                
                </li>
                <li class="has-submenu">
                    <a href="/login"><i class="mdi mdi-key"></i>Login</a>
                </li>
                
            </ul>
            <!-- End navigation menu -->
        </div> <!-- end #navigation -->
    </div> <!-- end container -->
</div> 
@endif
