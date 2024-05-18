<?php
session_start();
//Koneksi database
include '../../config.php';
//Mengambil nama aplikasi
$query = mysqli_query($conn, "select * from profil_aplikasi");
$row = mysqli_fetch_array($query);
//Mengambil tanggal
$tanggal = '';
//Membuat file format excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=LAPORAN KATALOG BUKU Perpustakaan SMANCEP" . $tanggal . ".xls");
?>
<h2>
    <center>LAPORAN KATALOG BUKU Perpustakaan SMANCEP</center>
</h2>
<h4>Tanggal : <?php echo $tanggal; ?></h4>
<table border="1">
    <thead class="text-center">
        <tr>
            <th>No</th>
            <th>Nama Buku</th>
            <th>Penulis</th>
            <th>Penerbit</th>
            <th>Supplier</th>
            <th>Tahun</th>
            <th>Jumlah</th>
            <th>Rak</th>
        </tr>
    </thead>

    <tbody>
        <?php
        // include database
        $no = 1;

        $sql = mysqli_query($conn, "SELECT * FROM v_buku");
        while ($data = mysqli_fetch_array($sql)) {
            ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['nama_buku'] ?></td>
                <td><?= $data['nama_penulis'] ?></td>
                <td><?= $data['nama_penerbit'] ?></td>
                <td><?= $data['nama_supplier'] ?></td>
                <td><?= $data['tahun'] ?></td>
                <td><?= $data['stok'] ?></td>
                <td><?= $data['rak'] ?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>