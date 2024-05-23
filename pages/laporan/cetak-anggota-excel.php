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
header("Content-Disposition: attachment; filename=LAPORAN ANGGOTA Perpustakaan SMANCEP" . $tanggal . ".xls");
?>
<h2>
    <center>LAPORAN ANGGOTA Perpustakaan SMANCEP</center>
</h2>
<h4>Tanggal : <?php echo $tanggal; ?></h4>
<table border="1">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Kontak</th>
            <th>Email</th>
        </tr>
    </thead>

    <tbody>
        <?php
        // include database
        $kondisi = "";

        $sql = "SELECT * FROM anggota";

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
                <td><?php echo $data['nis']; ?> </td>
                <td><?php echo $data['nama_anggota']; ?> </td>
                <td><?php echo $data['no_telp']; ?> </td>
                <td><?php echo $data['email']; ?></td>

            </tr>
            <!-- bagian akhir (penutup) while -->
        <?php endwhile; ?>
    </tbody>
</table>