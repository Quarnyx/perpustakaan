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
header("Content-Disposition: attachment; filename=LAPORAN PEMINJAMAN Perpustakaan SMANCEP" . $tanggal . ".xls");
?>
<h2>
    <center>LAPORAN PEMINJAMAN Perpustakaan SMANCEP</center>
</h2>
<h4>Tanggal : <?php echo $tanggal; ?></h4>
<table border="1">
    <thead class="text-center">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Kode</th>
            <th rowspan="2">Nama Anggota</th>
            <th rowspan="2">Judul Pustaka</th>
            <th colspan="2">Waktu Peminjaman</th>
            <th rowspan="2">Status</th>
        </tr>
        <tr>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
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

        // perintah sql untuk menampilkan laporan penyewaan jika level admin maka sistem hanya akan menampilkan transaksi yang dilakukan admin tersebut
        if ($_SESSION["level"] == "admin") {
            $id_pengguna = $_SESSION["id_pengguna"];
            $sql = "SELECT * FROM v_pinjambuku $kondisi ORDER BY tanggal_pinjam asc";
        } else {
            $sql = "SELECT * FROM v_pinjambuku $kondisi ORDER BY tanggal_pinjam asc";
        }

        $hasil = mysqli_query($conn, $sql);
        $no = 0;
        $status = '';
        $tanggal_kembali = '';
        //Menampilkan data dengan perulangan while
        while ($data = mysqli_fetch_array($hasil)):
            $no++;


            if ($data['tanggal_pinjam'] == '0000-00-00') {
                $tanggal_pinjam = "";
            } else {
                $tanggal_pinjam = date("d/m/Y", strtotime($data['tanggal_pinjam']));
            }
            if ($data['tanggal_kembali'] == '0000-00-00') {
                $tanggal_kembali = "";
            } else {
                $tanggal_kembali = date("d/m/Y", strtotime($data['tanggal_kembali']));
            }
            ?>
            <tr>
                <td><?php echo $no; ?></td>
                <td><?php echo $data['kode_pinjam']; ?> </td>
                <td><?php echo $data['nama_anggota']; ?> </td>
                <td><?php echo $data['nama_buku']; ?> </td>
                <td class="text-center"><?php echo $tanggal_pinjam; ?></td>
                <td class="text-center"><?php echo $tanggal_kembali; ?></td>
                <td><?php echo $data['status']; ?></td>

            </tr>
            <!-- bagian akhir (penutup) while -->
        <?php endwhile; ?>
    </tbody>
</table>