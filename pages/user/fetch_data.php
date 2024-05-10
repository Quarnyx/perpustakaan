<?php
 if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit;
  }
include "../../config.php";

// Assuming you have a MySQL connection established already

// Fetch data from the database
if($_GET['tabledata']=="roleuser"){ 
      $query = "SELECT * FROM `roles` ";
      $roletable = $conn->prepare($query);
      $roletable->execute();
      $result = $roletable->get_result();
      // Prepare the data for DataTables
      $data = array();
      while ($row = mysqli_fetch_assoc($result)) {
          $data[] = $row;
      }

      // Return the JSON-encoded data
      echo json_encode(array('data' => $data));
}
if($_GET['tabledata']=="user"){ 
  $querya = "SELECT * FROM `v_user` ";
  $usertable = $conn->prepare($querya);
  $usertable->execute();
  $resulta = $usertable->get_result();
  // Prepare the data for DataTables
  $data = array();
  while ($rowa = mysqli_fetch_assoc($resulta)) {
      $dataa[] = $rowa;
  }

  // Return the JSON-encoded data
  echo json_encode(array('data' => $dataa));
}
if($_GET['tabledata']=="product"){ 
  $querya = "SELECT * FROM `product` ";
  $usertable = $conn->prepare($querya);
  $usertable->execute();
  $resulta = $usertable->get_result();
  // Prepare the data for DataTables
  $data = array();
  while ($rowa = mysqli_fetch_assoc($resulta)) {
      $rowa['price'] = 'Rp '.number_format($rowa['price'],'0','.','.');
      $dataa[] = $rowa;
  }

  // Return the JSON-encoded data
  echo json_encode(array('data' => $dataa));
}
if($_GET['tabledata']=="banksampah"){ 
  $querya = "SELECT * FROM `v_banksampah` WHERE cust_id='$_GET[custid]' ORDER BY banksampah_id DESC";
  $usertable = $conn->prepare($querya);
  $usertable->execute();
  $resulta = $usertable->get_result();
  // Prepare the data for DataTables
  $data = array();
  while ($rowa = mysqli_fetch_assoc($resulta)) {
      $rowa['total'] = 'Rp '.number_format($rowa['total'],'0','.','.');
      $data[] = $rowa;
  }

  // Return the JSON-encoded data
  echo json_encode(array('data' => $data));
}
?>
