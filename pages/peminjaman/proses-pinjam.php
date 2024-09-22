<?php
include '../../config.php';
if ($_GET['act'] == "judulBuku") {
    $barcode = $_POST['barcode'];
    $query = mysqli_query($conn, "SELECT nama_buku, stok, id FROM buku where barcode='$barcode'");
    $row = mysqli_fetch_array($query);

    // hitung stok-(pengembalian-peminjaman)
    if ($row > 0) {
        $stokasli = $row['stok'];
        $id = $row['id'];
        $sqla = mysqli_query($conn, "SELECT * FROM peminjaman WHERE buku_id = '$id' AND status = 'pinjam' ");
        $pinjam = mysqli_num_rows($sqla);

        $sqlb = mysqli_query($conn, "SELECT * FROM v_pengembalian WHERE buku_id = '$id'");
        $pengembalian = mysqli_num_rows($sqlb);
        if ($pinjam > 0) {
            $stok = $stokasli - ($pinjam - $pengembalian);
        } else {
            $stok = $stokasli;
        }
        // echo $pinjam . " | " . $pengembalian . " | " . $stokasli;
        echo "<p class='h5 text-center'>" . $row['nama_buku'] . "</p>";
        echo "<p class='text-center'>Stok Tersedia : " . $stok . "</p>";
    } else {
        echo "<p class='text-danger'>Buku tidak ditemukan</p>";
    }

}
if ($_GET['act'] == "tabelPinjam") {
    $anggota_id = $_GET['id'];
    $querya = "SELECT * FROM `v_pinjambuku` WHERE status = 'pinjam' AND anggota_id = '$anggota_id'";
    $usertable = $conn->prepare($querya);
    $usertable->execute();
    $resulta = $usertable->get_result();
    // Prepare the data for DataTables
    $data = array();
    while ($rowa = mysqli_fetch_assoc($resulta)) {
        $data[] = $rowa;
    }
    // Return the JSON-encoded data
    echo json_encode(array('data' => $data));
}
if ($_GET['act'] == "tambahSimpan") {
    $barcode = $_POST['barcode'];
    //cari buku
    $query = mysqli_query($conn, "SELECT * FROM buku where barcode='$barcode'");
    $row = mysqli_fetch_array($query);
    $buku_id = $row['id'];
    $anggota_id = $_POST['anggota_id'];
    $petugas_id = $_POST['petugas_id'];
    // $buku_id = $_POST['buku_id'];
    $tgl_pinjam = $_POST['tanggal_pinjam'];
    $tgl_kembali = $_POST['tanggal_kembali'];
    $date = DateTime::createFromFormat('d/m/Y', $tgl_pinjam);
    $tgl_pinjam = $date->format('Y-m-d');
    $dateb = DateTime::createFromFormat('d/m/Y', $tgl_kembali);
    $tgl_kembali = $dateb->format('Y-m-d');
    $status = 'pinjam';
    //cari urutan pinjam
    $query = mysqli_query($conn, "SELECT max(kode_pinjam) as kodeTerbesar FROM peminjaman");
    $data = mysqli_fetch_array($query);
    $kode_kategori = $data['kodeTerbesar'];
    $kode_kategori++;
    $huruf = "PJ";
    $pinjam_id = $huruf . rand(100, 999);
    $sql = "INSERT INTO `peminjaman` (
        `tanggal_pinjam`, 
        `tanggal_kembali`, 
        `kode_pinjam`, 
        `anggota_id`, 
        `petugas_id`, 
        `buku_id`, 
        `status`) VALUES (
            '$tgl_pinjam', 
            '$tgl_kembali', 
            '$pinjam_id', 
            '$anggota_id', 
            '$petugas_id', 
            '$buku_id', 
            'pinjam')";
    $query = mysqli_query($conn, $sql);
    $sqla = mysqli_query($conn, "SELECT * FROM peminjaman WHERE anggota_id = '$anggota_id' AND status = 'pinjam' ");
    $jumlah = mysqli_num_rows($sqla);
    if ($jumlah >= 2) {
        echo "<p class='text-danger'>Anggota ini sudah pinjam 2 buku</p>";
        echo "<script>   document.getElementById('submit').disabled = true; </script>";

    } else {
        echo "<script>   document.getElementById('submit').disabled = false; </script>";

    }
    // $sqlupdatebuku = "UPDATE buku SET stok = stok - 1 WHERE id = '$buku_id'";
    mysqli_query($conn, $sqlupdatebuku);
}
if ($_GET['act'] == "hapusPinjam") {
    $id = $_POST['id'];
    $idbuku = mysqli_query($conn, "SELECT buku_id FROM peminjaman WHERE id = '$id'");
    $buku_id = mysqli_fetch_array($idbuku)['buku_id'];
    // $sqlupdatebuku = "UPDATE buku SET stok = stok + 1 WHERE id = '$buku_id'";
    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM peminjaman WHERE id='$id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    mysqli_query($conn, $sqlupdatebuku);
}

?>