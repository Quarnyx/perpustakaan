<?php
include '../../config.php';
if ($_GET['act'] == "tabelpeminjaman") {
    $querya = "SELECT * FROM `v_pinjambuku`";
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
?>