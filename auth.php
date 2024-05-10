<?php
session_start();
if (isset($_POST['login'])) {
    require_once ('config.php');
    $username = $_POST['username'];
    $password = md5($_POST["password"]);
    // cek username, jika benar akan cara kecocokan password
    $stmt = $conn->prepare("SELECT * FROM petugas WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($password === $row['password']) {
            $_SESSION['nama_petugas'] = $row['nama_petugas'];
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $row['level'];
            header('Location: app.php?page=dashboard');
        } else {
            header("location:login.php?pass=invalid");
        }
    } else {
        header("location:login.php?username=invalid");
    }
    $stmt->close();
}