<?php
include '../../config.php';

if ($_GET['act'] == "tabelpengembalian") {
    $querya = "SELECT * FROM `v_pinjambuku` WHERE status = 'pinjam'";
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
if ($_GET['act'] == "simpanPengembalian") {
    // insert data ke tabel pengembalian
    echo "success";
    $peminjaman_id = $_POST['peminjaman_id'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $denda = $_POST['denda'];
    $petugas_id = $_POST['petugas_id'];
    echo $peminjaman_id;
    $idbuku = mysqli_query($conn, "SELECT buku_id FROM peminjaman WHERE id = '$peminjaman_id'");
    $buku_id = mysqli_fetch_array($idbuku)['buku_id'];
    $sqlupdatebuku = "UPDATE buku SET stok = stok + 1 WHERE id = '$buku_id'";
    mysqli_query($conn, $sqlupdatebuku);
    $sql = "INSERT INTO `pengembalian` (`peminjaman_id`, `tanggal_pengembalian`, `denda`, `petugas_id`) VALUES ('$peminjaman_id', '$tanggal_pengembalian', '$denda', '$petugas_id')";
    mysqli_query($conn, $sql);
    $sqla = "UPDATE `peminjaman` SET `status` = 'kembali' WHERE (`id` = '$peminjaman_id')";
    mysqli_query($conn, $sqla);

}

?>