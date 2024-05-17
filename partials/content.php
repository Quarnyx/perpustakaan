<?php
if ($_GET['page'] == "dashboard") {
    include "./pages/dashboard.php";
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
?>