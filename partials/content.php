<?php
if ($_GET['page'] == "dashboard") {
    include "./pages/dashboard.php";
}

if ($_GET['page'] == "dashboard-siswa") {
    include "./pages/dashboard-siswa.php";
}
if ($_GET['page'] == "petugas") {
    include "./pages/petugas/index.php";
}
if ($_GET['page'] == "anggota") {
    include "./pages/anggota/index.php";
}
if ($_GET['page'] == "penerbit") {
    include "./pages/penerbit/index.php";
}
if ($_GET['page'] == "supplier") {
    include "./pages/supplier/index.php";
}
if ($_GET['page'] == "penulis") {
    include "./pages/penulis/index.php";
}
if ($_GET['page'] == "kategori") {
    include "./pages/kategori/index.php";
}
if ($_GET['page'] == "buku") {
    include "./pages/buku/index.php";
}
if ($_GET['page'] == "peminjaman") {
    include "./pages/peminjaman/index.php";
}
if ($_GET['page'] == "pengembalian") {
    include "./pages/pengembalian/index.php";
}
if ($_GET['page'] == "lap_peminjaman") {
    include "./pages/laporan/peminjaman.php";
}
if ($_GET['page'] == "lap_buku") {
    include "./pages/laporan/buku.php";
}
if ($_GET['page'] == "lap_pengurus") {
    include "./pages/laporan/pengurus.php";
}
if ($_GET['page'] == "lap_pengembalian") {
    include "./pages/laporan/pengembalian.php";
}
if ($_GET['page'] == "lap_denda") {
    include "./pages/laporan/denda.php";
}
if ($_GET['page'] == "lap_anggota") {
    include "./pages/laporan/anggota.php";
}
if ($_GET['page'] == "buku-siswa") {
    include "./pages/siswa/index.php";
}
?>