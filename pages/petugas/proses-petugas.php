<?php
include '../../config.php';

if ($_GET['act'] == 'cekUsername') {
    $username = $_POST['username'];

    if (empty($username)) {
        echo "<p class='text-warning'>Username tidak boleh kosong</p>";
        echo "<script>   document.getElementById('submit').disabled = true; </script>";
    } else {
        $query = mysqli_query($conn, "SELECT username FROM petugas where username='$username'");
        $jumlah = mysqli_num_rows($query);

        if ($jumlah > 0) {
            echo "<p class='text-danger'>Username sudah digunakan</p>";
            echo "<script>   document.getElementById('submit').disabled = true; </script>";

        } else {
            echo "<p class='text-success'>Username tersedia</p>";
            echo "<script>   document.getElementById('submit').disabled = false; </script>";

        }
    }
}
if ($_GET['act'] == 'tambahPetugas') {
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    $status = $_POST['status'];
    $foto = $_FILES['foto']['name'];

    $username = mysqli_real_escape_string($conn, $username);
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
            $sql = "insert into petugas(nama_petugas, username, password, level, status, foto) VALUES ('$nama_petugas', '$username', '$password', '$level', '$status', '$foto')";
        }
    } else {
        //Sql jika tidak menggunakan foto, maka akan memakai gambar foto_default.png
        $sql = "insert into petugas(nama_petugas, username, password, level, status, foto) VALUES ('$nama_petugas', '$username', '$password', '$level', '$status', 'default.png')";
    }
    $query = mysqli_query($conn, $sql);



}
if ($_GET['act'] == 'updatePetugas') {
    $id = $_POST['id'];
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $level = $_POST['level'];
    $status = $_POST['status'];
    $foto_baru = $_FILES['foto']['name'];
    $foto = $_POST['foto_lama'];

    $username = mysqli_real_escape_string($conn, $username);
    // foto
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    if (!empty($foto_baru)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            //Mengupload gambar
            move_uploaded_file($file_tmp, '../../assets/images/users/' . $foto_baru);
            if ($foto != 'default.png') {
                unlink("foto/" . $foto);
            }
            //Sql jika menggunakan foto
            $sql = "UPDATE petugas SET nama_petugas = '$nama_petugas', username = '$username', level = '$level', status = '$status', foto = '$foto_baru' WHERE id = '$id'";
        }
    } else {
        //Sql jika tidak menggunakan foto, maka akan memakai gambar foto_default.png
        $sql = "UPDATE petugas SET nama_petugas = '$nama_petugas', username = '$username', level = '$level', status = '$status', WHERE id = '$id'";
    }
    $query = mysqli_query($conn, $sql);
}
if ($_GET['act'] == 'updatepass') {
    $id = $_POST['id'];
    $password = md5($_POST["password"]);

    //Sql jika tidak menggunakan foto, maka akan memakai gambar foto_default.png
    $sql = "UPDATE petugas SET password = '$password' WHERE id = '$id'";

    $query = mysqli_query($conn, $sql);
}

if ($_GET['act'] == "tabelpetugas") {
    $querya = "SELECT * FROM `petugas` ";
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
if ($_GET['act'] == "hapusPetugas") {
    $id = $_POST['id'];
    // Execute the SQL DELETE query to remove the row from the MySQL database
    $sql = "DELETE FROM petugas WHERE id='$id'";
    mysqli_query($conn, $sql);
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>