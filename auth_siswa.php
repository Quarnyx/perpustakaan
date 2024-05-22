<?php
session_start();
if (isset($_POST['login'])) {
    require_once ('config.php');
    $nis = $_POST['nis'];
    $password = md5($_POST["password"]);
    // cek nis, jika benar akan cara kecocokan password
    $stmt = $conn->prepare("SELECT * FROM anggota WHERE nis = ?");
    $stmt->bind_param("i", $nis);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            $_SESSION['nama_anggota'] = $row['nama_anggota'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['nis'] = $nis;
            $_SESSION['foto'] = $row['foto'];
            header('Location: app-siswa.php?page=dashboard-siswa');
        } else {
            header("location:login_siswa.php?pass=invalid");
        }
    } else {
        header("location:login_siswa.php?username=invalid");
    }
    $stmt->close();
}