<?php


include '../../config.php';

if ($_GET['act'] == "tabelkategori") {
    $querya = "SELECT * FROM `kategori` ";
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
if ($_GET['act'] == 'tambahKategori') {
    $kode_kategori = mysqli_real_escape_string($conn, $_POST['kode_kategori']);
    $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);

    $sql = "insert into kategori(kode_kategori, nama_kategori) VALUES ('$kode_kategori', '$nama_kategori')";

    $query = mysqli_query($conn, $sql);
}
if ($_GET['act'] == "hapusKategori") {
    $id = $_POST['id'];
    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM kategori WHERE id='$id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if ($_GET['act'] == "updateKategori") {
    $id = $_POST['id'];
    // $kode_penerbit = mysqli_real_escape_string($conn, $_POST['kode_penerbit']);
    $nama_kategori = mysqli_real_escape_string($conn, $_POST['nama_kategori']);
    $sql = "UPDATE kategori SET nama_kategori='$nama_kategori' WHERE id='$id'";
    $query = mysqli_query($conn, $sql);
}
?>