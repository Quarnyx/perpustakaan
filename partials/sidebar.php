<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="assets/images/users/<?php echo $_SESSION['foto'] ?>" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1"><?php echo $_SESSION['nama_petugas'] ?></h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    <?php echo $_SESSION['level'] ?></span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Data</li>

                <li>
                    <a href="?page=dashboard" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-group-line"></i>
                        <span>Data Master</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="?page=buku">Katalog Buku</a></li>
                        <li><a href="?page=penerbit">Penerbit</a></li>
                        <li><a href="?page=supplier">Supplier</a></li>
                        <li><a href="?page=penulis">Penulis</a></li>
                        <li><a href="?page=kategori">Kategori</a></li>
                        <li><a href="?page=anggota">Anggota</a></li>
                        <li><a href="?page=petugas">Pengurus</a></li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-group-line"></i>
                        <span>Transaksi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="?page=peminjaman">Peminjaman</a></li>
                        <li><a href="?page=pengembalian">Pengembalian</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-group-line"></i>
                        <span>Laporan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="?page=lap_peminjaman">Laporan Peminjaman</a></li>
                        <li><a href="?page=lap_pengurus">Laporan Pengurus</a></li>
                        <li><a href="?page=lap_anggota">Laporan Anggota</a></li>
                        <li><a href="?page=lap_pengembalian">Laporan Pengembalian</a></li>
                        <li><a href="?page=lap_buku">Laporan Katalog Buku</a></li>
                        <li><a href="?page=lap_denda">Laporan Denda</a></li>

                    </ul>
                </li>




            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>