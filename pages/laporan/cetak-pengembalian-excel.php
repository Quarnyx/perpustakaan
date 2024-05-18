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
header("Content-Disposition: attachment; filename=LAPORAN PENGEMBALIAN Perpustakaan SMANCEP" . $tanggal . ".xls");
?>
<h2>
    <center>LAPORAN PENGEMBALIAN Perpustakaan SMANCEP</center>
</h2>
<h4>Tanggal : <?php echo $tanggal; ?></h4>
<table border="1">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Kode Pinjam</th>
            <th>Nama Anggota</th>
            <th>Judul Buku</th>
            <th>Tanggal Pengembalian</th>
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

        // perintah sql untuk menampilkan laporan peminjaman jika level admin maka sistem hanya akan menampilkan transaksi yang dilakukan admin tersebut
        if (isset($_SESSION["level"])) {
            $id_pengguna = $_SESSION["id"];
            $sql = "SELECT * FROM v_pengembalian $kondisi ORDER BY tanggal_pengembalian asc";
        } else {
            $sql = "SELECT * FROM v_pengembalian $kondisi ORDER BY tanggal_pengembalian asc";
        }

        $hasil = mysqli_query($conn, $sql);
        $no = 0;
        $status = '';
        $tanggal_kembali = '';
        //Menampilkan data dengan perulangan while
        while ($data = mysqli_fetch_array($hasil)):
            $no++;
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['kode_pinjam']; ?> </td>
                <td><?php echo $data['nama_anggota']; ?> </td>
                <td><?php echo $data['nama_buku']; ?> </td>
                <td class="text-center"><?php echo $data['tanggal_pengembalian']; ?></td>
            </tr>
            <!-- bagian akhir (penutup) while -->
        <?php endwhile; ?>
    </tbody>
</table>