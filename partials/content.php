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
?>