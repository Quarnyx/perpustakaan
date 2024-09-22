<?php
session_start();
//Koneksi database
include '../../config.php';
//Mengambil nama aplikasi
$query = mysqli_query($conn, "select * from profil_aplikasi");
$data = mysqli_fetch_array($query);
//Mengambil tanggal
$tanggal = '';
if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"]))
    $tanggal = date("d/m/Y", strtotime($_GET["dari_tanggal"]));
if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"]))
    $tanggal = "" . date("d/m/Y", strtotime($_GET["dari_tanggal"])) . " - " . date("d/m/Y", strtotime($_GET["sampai_tanggal"])) . "";

//Membuat file format excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=LAPORAN BUKU KELUAR Perpustakaan SMANCEP" . $tanggal . ".xls");
?>
<h2>
    <center>LAPORAN BUKU KELUAR Perpustakaan SMANCEP</center>
</h2>
<h4>Tanggal : <?php echo $tanggal; ?></h4>
<table border="1">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Kode Buku</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Supplier</th>
            <th>Jumlah</th>
        </tr>
    </thead>

    <tbody>
        <?php
        // include database
        $kondisi = "";


        if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"]))
            $kondisi = "where date(tanggal_pinjam)='" . $_GET['dari_tanggal'] . "' ";
        if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"]))
            $kondisi = "where date(tanggal_pinjam) between '" . $_GET['dari_tanggal'] . "' and '" . $_GET['sampai_tanggal'] . "'";

        // perintah sql untuk menampilkan laporan peminjaman jika level admin maka sistem hanya akan menampilkan transaksi yang dilakukan admin tersebut
        if (isset($_SESSION["level"])) {
            $id_pengguna = $_SESSION["id"];
            $sql = "SELECT COUNT(kode_buku) AS jml, kode_buku, nama_buku, nama_penulis, nama_penerbit, nama_supplier FROM v_bukukeluar $kondisi GROUP BY kode_buku ORDER BY tanggal_pinjam asc";
        } else {
            $sql = "SELECT COUNT(kode_buku) AS jml, kode_buku, nama_buku, nama_penulis, nama_penerbit, nama_supplier FROM v_bukukeluar $kondisi GROUP BY kode_buku ORDER BY tanggal_pinjam asc";
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
                <td><?= $data['kode_buku'] ?></td>
                <td><?= $data['nama_buku'] ?></td>
                <td><?= $data['nama_penulis'] ?></td>
                <td><?= $data['nama_penerbit'] ?></td>
                <td><?= $data['nama_supplier'] ?></td>
                <td class="text-center"><?php echo $data['jml']; ?></td>
            </tr>
            <!-- bagian akhir (penutup) while -->
        <?php endwhile; ?>
    </tbody>
</table>