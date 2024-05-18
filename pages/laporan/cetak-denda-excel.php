<?php
session_start();
//Koneksi database
include '../../config.php';
//Mengambil nama aplikasi
$query = mysqli_query($conn, "select * from profil_aplikasi");
$row = mysqli_fetch_array($query);
//Mengambil tanggal
$tanggal = '';
if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"]))
    $tanggal = date("d/m/Y", strtotime($_GET["dari_tanggal"]));
if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"]))
    $tanggal = "" . date("d/m/Y", strtotime($_GET["dari_tanggal"])) . " - " . date("d/m/Y", strtotime($_GET["sampai_tanggal"])) . "";

//Membuat file format excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=LAPORAN DENDA Perpustakaan SMANCEP" . $tanggal . ".xls");
?>
<h2>
    <center>LAPORAN DENDA Perpustakaan SMANCEP</center>
</h2>
<h4>Tanggal : <?php echo $tanggal; ?></h4>
<table border="1">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Nama Anggota</th>
            <th>Total Denda</th>
            <th>Tanggal Pembayaran</th>
        </tr>
    </thead>

    <tbody>
        <?php
        // include database
        $kondisi = "";

        if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"]))
            $kondisi = "where date(tanggal_pengembalian)='" . $_GET['dari_tanggal'] . "' ";
        if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"]))
            $kondisi = "where date(tanggal_pengembalian) between '" . $_GET['dari_tanggal'] . "' and '" . $_GET['sampai_tanggal'] . "'";

        // perintah sql untuk menampilkan laporan pengembalian jika level admin maka sistem hanya akan menampilkan transaksi yang dilakukan admin tersebut
        if (isset($_SESSION["level"])) {
            $id_pengguna = $_SESSION["id"];
            $sql = "SELECT * FROM v_denda $kondisi ORDER BY tanggal_pengembalian asc";
        } else {
            $sql = "SELECT * FROM v_denda $kondisi ORDER BY tanggal_pengembalian asc";
        }

        $no = 1;
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $row['nama_anggota'] ?></td>
                <td><?= $row['denda'] ?></td>
                <td><?= $row['tanggal_pengembalian'] ?></td>
            </tr>
            <!-- bagian akhir (penutup) while -->
        <?php } ?>
    </tbody>
</table>