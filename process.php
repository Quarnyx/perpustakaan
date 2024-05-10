<?php
include "config.php";

if($_GET['act']=="addrole"){
    //get the form data
    $role = $_POST['role_name'];
    $role_desc = $_POST['desc'];

    //validate the form data (again, just to be safe)
    $roleRegex = "/^[a-zA-Z ]+$/";
    $descRegex = "/^[a-zA-Z ]+$/";
    

    $errors = array();

    if (!preg_match($roleRegex, $role)) {
    $errors[] = "Please enter a valid role.";
    }

    if (!preg_match($descRegex, $role_desc)) {
    $errors[] = "Please enter a valid desc address.";
    }

    if (count($errors) > 0) {
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    } else {
    //escape special characters
    $role = mysqli_real_escape_string($conn, $role);
    $role_desc = mysqli_real_escape_string($conn, $role_desc);
    
    //insert the form data into the database
    $sql = "INSERT INTO roles (role_name, role_desc) VALUES ('$role', '$role_desc')";
    
    if ($conn->query($sql));
    }

}
if($_GET['act']=="editrole"){
    //get the form data
    $editrole = $_POST['editrole_name'];
    $editrole_desc = $_POST['editdesc'];
    $role_id = $_POST['role_id'];
    

    //validate the form data (again, just to be safe)
    $editroleRegex = "/^[a-zA-Z ]+$/";
    $editdescRegex = "/^[a-zA-Z ]+$/";
    

    $errors = array();

    if (!preg_match($editroleRegex, $editrole)) {
    $errors[] = "Please enter a valid role.";
    }

    if (!preg_match($editdescRegex, $editrole_desc)) {
    $errors[] = "Please enter a valid desc address.";
    }

    if (count($errors) > 0) {
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    } else {
    //escape special characters
    $editrole = mysqli_real_escape_string($conn, $editrole);
    $editrole_desc = mysqli_real_escape_string($conn, $editrole_desc);
    
    //insert the form data into the database
    $sql = "UPDATE `roles` SET `role_name`='$editrole', `role_desc`='$editrole_desc' WHERE (`role_id`='$role_id')";
    
    if ($conn->query($sql));
    }

}

if($_GET['act']=="del_role"){    
    $role_id = $_POST['role_id'];

    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM roles WHERE role_id = '$role_id'";
    mysqli_query($conn, $sql);
}

if($_GET['act']=="addperm"){
    $role_id = $_POST['role_id'];
    $tab_id = $_POST['tab_id'];
    $checkbox1 = isset($_POST['canadd']) ? $_POST['canadd'] : 0;
    $checkbox2 = isset($_POST['canread']) ? $_POST['canread'] : 0;
    $checkbox3 = isset($_POST['canedit']) ? $_POST['canedit'] : 0;
    $checkbox4 = isset($_POST['candelete']) ? $_POST['candelete'] : 0;
    $checkbox5 = isset($_POST['report']) ? $_POST['report'] : 0;

    // Insert data into the database
    $sql = "INSERT INTO `permission` (`role_id`, `tab_id`, `can_add`, `can_read`, `can_update`, `can_delete`, `can_report`) 
    VALUES ('$role_id', '$tab_id', '$checkbox1', '$checkbox2', '$checkbox3', '$checkbox4', '$checkbox5')";

    if ($conn->query($sql) === TRUE) {
    echo "Data submitted successfully";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}
if($_GET['act']=="del_perm"){    
    $role_id = $_POST['role_id'];
    $tab_id = $_POST['tab_id'];

    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM permission WHERE role_id='$role_id' AND tab_id='$tab_id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
        echo "Data submitted successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
}

if($_GET['act']=="adduser"){
    //get the form data
    $alpha = "el1z4";
    $omega = "th0ry";
    $name_user = $_POST['name_user'];
    $username = $_POST['username'];
    $role_id = $_POST['role_id'];
    $password = md5($alpha.$_POST["password"].$omega);
    

    //validate the form data (again, just to be safe)
    $textRegex = "/^[a-zA-Z ]+$/";
    

    $errors = array();

    
    if (!preg_match($textRegex, $name_user)) {
    $errors[] = "Nama hanya bisa mengandung huruf";
    }

    if (!preg_match($textRegex, $username)) {
    $errors[] = "Username hanya bisa mengandung huruf";
    }

    if (count($errors) > 0) {
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    } else {
    //escape special characters
    $name_user = mysqli_real_escape_string($conn, $name_user);
    $username = mysqli_real_escape_string($conn, $username);
    
    //insert the form data into the database
    $sql = "INSERT INTO `user` (`username`, `user_pass`, `name_user`) VALUES ('$username', '$password', '$name_user')";
    
    $conn->query($sql);
    
    $sqla=mysqli_query($conn, "SELECT * FROM `user` WHERE username='$username'");
    $roleres=mysqli_fetch_assoc($sqla);
    $sqlrole = "INSERT INTO `user_role` (`user_id`, `role_id`) VALUES ('$roleres[user_id]', '$role_id')";
    $conn->query($sqlrole);
    }

}
if($_GET['act']=="del_user"){    
    $user_id = $_POST['user_id'];

    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM user WHERE user_id='$user_id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
}
if($_GET['act']=="edit-user"){
    //get the form data
    $alpha = "el1z4";
    $omega = "th0ry";
    $user_id = $_POST['user_id'];
    $password = md5($alpha.$_POST["editpass"].$omega);
  
    //escape special characters
    $user_id = mysqli_real_escape_string($conn, $user_id);
    
    //insert the form data into the database
    $sql = "UPDATE `user` SET `user_pass`='$password' WHERE (`user_id`='$user_id')";
    
    if ($conn->query($sql));
    

}
// produk
if($_GET['act']=="del_product"){    
    $product_id = $_POST['product_id'];

    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM product WHERE product_id='$product_id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
}
if($_GET['act']=="addproduct"){
    //get the form data
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    $stok = $_POST["stok"];

    //validate the form data (again, just to be safe)
    $textRegex = "/^[a-zA-Z ]+$/";
    

    $errors = array();

    
    if (!preg_match($textRegex, $product_name)) {
    $errors[] = "Nama hanya bisa mengandung huruf";
    }

    

    if (count($errors) > 0) {
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    } else {
    //escape special characters
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $price = mysqli_real_escape_string($conn, $price);
    $unit = mysqli_real_escape_string($conn, $unit);
    $stok = mysqli_real_escape_string($conn, $stok);
    
    //insert the form data into the database
    $sql = "INSERT INTO `product` (`product_name`, `price`, `product_qty`, `unit`) VALUES ('$product_name', '$price', '$stok', '$unit')";
    
    $conn->query($sql);
    
    }

}
if($_GET['act']=="editproduct"){
    //get the form data
    $product_name = $_POST['editproduct_name'];
    $price = $_POST['editprice'];
    $unit = $_POST['editunit'];
    $stok = $_POST["editstok"];
    $product_id = $_POST["editproduct_id"];
    

    //validate the form data (again, just to be safe)
    $textRegex = "/^[a-zA-Z ]+$/";
    

    $errors = array();

    
    if (!preg_match($textRegex, $product_name)) {
    $errors[] = "Nama hanya bisa mengandung huruf";
    }

    if (count($errors) > 0) {
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    } else {
    //escape special characters
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $price = mysqli_real_escape_string($conn, $price);
    $unit = mysqli_real_escape_string($conn, $unit);
    $stok = mysqli_real_escape_string($conn, $stok);
    
    //insert the form data into the database
    $sql = "UPDATE `product` SET `product_name`='$product_name', `price`='$price', `product_qty`='$stok', `unit`='$unit' WHERE (`product_id`='$product_id')";
    
    if ($conn->query($sql));
    }

}
if($_GET['act']=="qrcode"){
    include('plugins/phpqrcode/qrlib.php');
    

    // how to save PNG codes to server
    
    $tempDir = "qrcode/";
    
    $codeContents = $_POST['qrcode'];
    $page = $_GET['page'];
    $idb = $_GET['idb'];
    $rtrw_id = $_GET['rtrw_id'];
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = 'pel_sampah_'.$codeContents.'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
        echo 'File generated!';
        echo '<hr />';
    } else {
        echo 'File already generated! We can use this cached file to speed up site on common codes!';
        echo '<hr />';
    }
    
    echo 'Server PNG File: '.$pngAbsoluteFilePath;
    echo '<hr />';
    
    // displaying
    echo '<img src="'.$urlRelativeFilePath.'" />';
    mysqli_query($conn, "UPDATE `customer` SET `qrcode`='$fileName' WHERE (`cust_id`='$codeContents')");
    if (!isset($_GET['rtrw_id'])){
    header("location:banksampah.php?page=$page&idb=$idb");}else{
        header("location:banksampah.php?page=$page&idb=$idb&rtrw_id=$rtrw_id");
    }
}
// customer
if($_GET['act']=="update_cust"){
    $page = $_GET['page'];
    mysqli_query($con, "UPDATE `customer` 
    SET 
    `cust_name`='$_POST[cust_name]', 
    `block_id`='$_POST[block_id]', 
    `rtrw_id`='$_POST[rtrw_id]',
    `banksampah`='$_POST[banksampah]', 
    `contact`='$_POST[contact]' WHERE (`cust_id`='$_POST[cust_id]')");
     header("location:banksampah.php?page=$page");
    }
if ($_GET['act']=="delete_cust"){
    $page = $_GET['page'];
    $idb = $_GET['idb'];
    $rtrw_id = $_GET['rtrw_id'];
    $page = $_GET['page'];
    mysqli_query($conn, "delete from customer where cust_id='$_GET[cust_id]'");
    header("location:banksampah.php?page=$page&idb=$idb&rtrw_id=$rtrw_id");
}
if($_GET['act']=="input_cust"){
    $takenum=mysqli_query($conn, "SELECT * FROM
        v_customer
        WHERE
        v_customer.rtrw_id LIKE '%$_POST[rtrw_id]%'
        ORDER BY
        v_customer.cust_id DESC
        ");
        $rnum=mysqli_fetch_array($takenum);
        $lastnum = substr($rnum['cust_id'],5);
        $newnum = 1 + $lastnum;
        $newid = $_POST['block_id'].$_POST['rtrw_id'].$newnum;
    
        include('plugins/phpqrcode/qrlib.php');
    

        // how to save PNG codes to server
        
        $tempDir = "qrcode/";
        
        $codeContents = $newid;  
        // we need to generate filename somehow, 
        // with md5 or with database ID used to obtains $codeContents...
        $fileName = 'pel_sampah_'.$codeContents.'.png';
        
        $pngAbsoluteFilePath = $tempDir.$fileName;
        $urlRelativeFilePath = $tempDir.$fileName;
        
        // generating
        if (!file_exists($pngAbsoluteFilePath)) {
            QRcode::png($codeContents, $pngAbsoluteFilePath);
            echo 'File generated!';
            echo '<hr />';
        } else {
            echo 'File already generated! We can use this cached file to speed up site on common codes!';
            echo '<hr />';
        }
        
        echo 'Server PNG File: '.$pngAbsoluteFilePath;
        echo '<hr />';
        
        // displaying
        echo '<img src="'.$urlRelativeFilePath.'" />';
    

    $page = $_GET['page'];
    mysqli_query($conn, "INSERT INTO `customer` (
        `cust_id`, 
        `cust_name`, 
        `block_id`, 
        `rtrw_id`, 
        `banksampah`, 
        `contact`, 
        `qrcode`,
        `register_date`) 
    VALUES (
        '$newid', 
        '$_POST[cust_name]', 
        '$_POST[block_id]', 
        '$_POST[rtrw_id]', 
        '$_POST[banksampah]', 
        '$_POST[contact]', 
        '$fileName',
        '$_POST[register_date]')
        ");
    header("location:banksampah.php?page=$page");
}
if($_GET['act']=="update_cust"){
    $page = $_GET['page'];
    mysqli_query($conn, "UPDATE `customer` 
    SET 
    `cust_name`='$_POST[cust_name]', 
    `block_id`='$_POST[block_id]', 
    `rtrw_id`='$_POST[rtrw_id]',
    `banksampah`='$_POST[banksampah]', 
    `contact`='$_POST[contact]' WHERE (`cust_id`='$_POST[cust_id]')");
     header("location:banksampah.php?page=$page");
}
if($_GET['act']=="input_wilayah"){
    $page = $_GET['page'];
    mysqli_query($conn, "INSERT INTO block(block_name) VALUES (
        '$_POST[block_name]'
        )
        ");
    header("location:banksampah.php?page=$page");
}
if ($_GET['act']=="delete_wilayah"){
    $page = $_GET['page'];
    mysqli_query($conn, "delete from block where block_id='$_GET[block_id]'");
    header("location:banksampah.php?page=$page");
}
if($_GET['act']=="update_wilayah"){
    $page = $_GET['page'];
    mysqli_query($conn, "UPDATE `block` SET `block_name`='$_POST[block_name]' WHERE (`block_id`='$_POST[block_id]')
        ");
    header("location:banksampah.php?page=$page");
}
if($_GET['act']=="input_rtrw"){
    $page = $_GET['page'];
    mysqli_query($conn, "INSERT INTO rtrw VALUES (
        '$_POST[rtrw_id]',
        '$_POST[rtrw_name]'
        )
        ");
    header("location:banksampah.php?page=$page");
}
if ($_GET['act']=="delete_rtrw"){
    $page = $_GET['page'];
    mysqli_query($conn, "delete from rtrw where rtrw_id='$_GET[rtrw_id]'");
    header("location:banksampah.php?page=$page");
}
if($_GET['act']=="update_rtrw"){
    $page = $_GET['page'];
    mysqli_query($conn, "UPDATE `rtrw` SET `rtrw_name`='$_POST[rtrw_name]' WHERE (`rtrw_id`='$_POST[rtrw_id]')
        ");
    header("location:banksampah.php?page=$page");
}
if($_GET['act']=="input_bill"){
    $page = $_GET['page'];
    $year = $_POST['year'];
    $product_id = $_POST['product_id'];
    $cust_id = $_POST['cust_id'];
    $invoice = bin2hex(random_bytes(3));
    
    $month1 = $_POST['month1'];
    $month2 = $_POST['month2'];
    $year = $_POST['year'];
    for ($x = $month1; $x <= $month2; $x++) {
        $trans = bin2hex(random_bytes(3));
        $inputbill=mysqli_query($conn, "INSERT INTO `bill_sampah` (`transaction_id`, `cust_id`, `bill_date`, `invoice_no`, `user_id`, `product_id`) 
            VALUES (
                '$trans', 
                '$_POST[cust_id]', 
                '$year-$x-01', 
                '$invoice', 
                '$_POST[user_id]', 
                '$_POST[product_id]')
                ");
      }
      
      header("location:banksampah.php?page=$page&year=$year&product_id=$product_id&cust_id=$cust_id&invoice=$invoice");
    
   
}
if($_GET['act']=="input_banksampah"){
    $invoice = bin2hex(random_bytes(3));
    $page = $_GET['page'];
    mysqli_query($conn, "INSERT INTO `trans_banksampah` (`product_id`, `cust_id`, `bs_payment_date`, `bs_invoice_no`, `user_id`, `qty`, `bs_price`) 
    VALUES (
        '$_POST[product_id]', 
        '$_POST[cust_id]', 
        '$_POST[date]', 
        '$invoice', 
        '$_POST[user_id]', 
        '$_POST[qty]',
        '$_POST[bs_price]')");
    }
if ($_GET['act']=="delete_banksampah"){
    mysqli_query($conn, "delete from trans_banksampah where banksampah_id='$_POST[banksampah_id]'");    
} 
if ($_GET['act']=="delete_bill"){
    $page = $_GET['page'];
    $transaction_id = $_GET['tid'];
    $cust_id = $_GET['cust_id'];
    $product_id = $_GET['product_id'];
    $year = $_GET['year'];
    $page = $_GET['page'];
    mysqli_query($conn, "DELETE FROM `bill_sampah` WHERE (`transaction_id`='$_GET[tid]')");
    header("location:banksampah.php?page=$page&cust_id=$cust_id&product_id=$product_id&year=$year");
}
?>