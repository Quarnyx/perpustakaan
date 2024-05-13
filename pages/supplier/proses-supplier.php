<?php


include '../../config.php';

if ($_GET['act'] == "tabelsupplier") {
    $querya = "SELECT * FROM `supplier` ";
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
if ($_GET['act'] == 'tambahSupplier') {
    $kode_supplier = mysqli_real_escape_string($conn, $_POST['kode_supplier']);
    $nama_supplier = mysqli_real_escape_string($conn, $_POST['nama_supplier']);

    $sql = "insert into supplier(kode_supplier, nama_supplier) VALUES ('$kode_supplier', '$nama_supplier')";

    $query = mysqli_query($conn, $sql);
}
if ($_GET['act'] == "hapusSupplier") {
    $id = $_POST['id'];
    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM supplier WHERE id='$id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if ($_GET['act'] == "updateSupplier") {
    $id = $_POST['id'];
    // $kode_penerbit = mysqli_real_escape_string($conn, $_POST['kode_penerbit']);
    $nama_supplier = mysqli_real_escape_string($conn, $_POST['nama_supplier']);
    $sql = "UPDATE supplier SET nama_supplier='$nama_supplier' WHERE id='$id'";
    $query = mysqli_query($conn, $sql);
}
?>