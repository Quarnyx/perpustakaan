<?php

include '../../config.php';


if ($_GET['act'] == "tabelanggota") {
    $querya = "SELECT * FROM `anggota` ";
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

if ($_GET['act'] == 'cekNIS') {
    $nis = $_POST['nis'];

    if (empty($nis)) {
        echo "<p class='text-warning'>NIS tidak boleh kosong</p>";
        echo "<script>   document.getElementById('submit').disabled = true; </script>";
    } else {
        $query = mysqli_query($conn, "SELECT nis FROM anggota where nis='$nis'");
        $jumlah = mysqli_num_rows($query);

        if ($jumlah > 0) {
            echo "<p class='text-danger'>NIS sudah ada</p>";
            echo "<script>   document.getElementById('submit').disabled = true; </script>";

        } else {
            echo "<p class='text-success'>NIS tersedia</p>";
            echo "<script>   document.getElementById('submit').disabled = false; </script>";

        }
    }
}

if ($_GET['act'] == 'tambahAnggota') {
    $nama_anggota = mysqli_real_escape_string($conn, $_POST['nama_anggota']);
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $foto = $_FILES['foto']['name'];
    // foto
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    if (!empty($foto)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            //Mengupload gambar
            move_uploaded_file($file_tmp, '../../assets/images/users/' . $foto);
            //Sql jika menggunakan foto
            $sql = "INSERT INTO `anggota` (`nis`, `nama_anggota`, `no_telp`, `email`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `status`, `foto`, `password`) VALUES ('$nis', '$nama_anggota', '$no_telp', '$email', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$status', '$foto', '$password')";
        }
    } else {
        //Sql jika tidak menggunakan foto, maka akan memakai gambar foto_default.png
        $sql = "INSERT INTO `anggota` (`nis`, `nama_anggota`, `no_telp`, `email`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `status`, `foto`, `password`) VALUES ('$nis', '$nama_anggota', '$no_telp', '$email', '$tempat_lahir', '$tanggal_lahir', '$jenis_kelamin', '$status', 'default.png', '$password')";
    }
    $query = mysqli_query($conn, $sql);



}
if ($_GET['act'] == "hapusAnggota") {
    $id = $_POST['id'];
    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM anggota WHERE id='$id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
if ($_GET['act'] == 'updateAnggota') {
    $id = $_POST['id'];
    $nama_anggota = mysqli_real_escape_string($conn, $_POST['nama_anggota']);
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $tempat_lahir = mysqli_real_escape_string($conn, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $foto_baru = $_FILES['foto']['name'];
    $foto = $_POST['foto_lama'];
    // foto
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));


    if (!empty($foto_baru)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            //Mengupload gambar
            move_uploaded_file($file_tmp, '../../assets/images/users/' . $foto_baru);
            if ($foto != 'default.png') {
                unlink("foto/" . $foto);
            }
            //Sql jika menggunakan foto
            $sql = "UPDATE anggota SET 
            `nama_anggota` = '$nama_anggota',
            `nis` = '$nis',
            `tempat_lahir` = '$tempat_lahir',
            `tanggal_lahir` = '$tanggal_lahir',
            `jenis_kelamin` = '$jenis_kelamin',
            `no_telp` = '$no_telp',
            `email` = '$email',
            `status` = '$status',
            `foto` = '$foto_baru',
            `password` = '$password'
            WHERE id = '$id'";
        }
    } else {
        //Sql jika tidak menggunakan foto
        $sql = "UPDATE anggota SET 
        `nama_anggota` = '$nama_anggota',
        `nis` = '$nis',
        `tempat_lahir` = '$tempat_lahir',
        `tanggal_lahir` = '$tanggal_lahir',
        `jenis_kelamin` = '$jenis_kelamin',
        `no_telp` = '$no_telp',
        `email` = '$email',
        `status` = '$status',
        `password` = '$password'
        WHERE id = '$id'";
    }
    $query = mysqli_query($conn, $sql);



}
if ($_GET['act'] == 'updatepass') {
    $id = $_POST['id'];
    $password = md5($_POST["password"]);
    $sql = "UPDATE anggota SET password = '$password' WHERE id = '$id'";

    $query = mysqli_query($conn, $sql);
}



?>