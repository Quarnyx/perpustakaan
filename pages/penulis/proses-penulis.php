<?php


include '../../config.php';

if ($_GET['act'] == "tabelpenulis") {
    $querya = "SELECT * FROM `penulis` ";
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
if ($_GET['act'] == 'tambahPenulis') {
    $kode_penulis = mysqli_real_escape_string($conn, $_POST['kode_penulis']);
    $nama_penulis = mysqli_real_escape_string($conn, $_POST['nama_penulis']);

    $sql = "insert into penulis(kode_penulis, nama_penulis) VALUES ('$kode_penulis', '$nama_penulis')";

    $query = mysqli_query($conn, $sql);
}
if ($_GET['act'] == "hapusPenulis") {
    $id = $_POST['id'];
    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM penulis WHERE id='$id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if ($_GET['act'] == "updatePenulis") {
    $id = $_POST['id'];
    // $kode_penerbit = mysqli_real_escape_string($conn, $_POST['kode_penerbit']);
    $nama_penulis = mysqli_real_escape_string($conn, $_POST['nama_penulis']);
    $sql = "UPDATE penulis SET nama_penulis='$nama_penulis' WHERE id='$id'";
    $query = mysqli_query($conn, $sql);
}
?>