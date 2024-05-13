<?php


include '../../config.php';

if ($_GET['act'] == "tabelpenerbit") {
    $querya = "SELECT * FROM `penerbit` ";
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
if ($_GET['act'] == 'tambahPenerbit') {
    $kode_penerbit = mysqli_real_escape_string($conn, $_POST['kode_penerbit']);
    $nama_penerbit = mysqli_real_escape_string($conn, $_POST['nama_penerbit']);

    $sql = "insert into penerbit(kode_penerbit, nama_penerbit) VALUES ('$kode_penerbit', '$nama_penerbit')";

    $query = mysqli_query($conn, $sql);
}
if ($_GET['act'] == "hapusPenerbit") {
    $id = $_POST['id'];
    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM penerbit WHERE id='$id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if ($_GET['act'] == "updatePenerbit") {
    $id = $_POST['id'];
    // $kode_penerbit = mysqli_real_escape_string($conn, $_POST['kode_penerbit']);
    $nama_penerbit = mysqli_real_escape_string($conn, $_POST['nama_penerbit']);
    $sql = "UPDATE penerbit SET nama_penerbit='$nama_penerbit' WHERE id='$id'";
    $query = mysqli_query($conn, $sql);
}
?>