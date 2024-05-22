<?php
include '../../config.php';

if ($_GET['act'] == "cariBuku") {

    $penulis = isset($_POST['penulis']) ? $_POST['penulis'] : [];
    $penerbit = isset($_POST['penerbit']) ? $_POST['penerbit'] : [];
    $supplier = isset($_POST['supplier']) ? $_POST['supplier'] : [];
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : [];

    $query = "SELECT * FROM v_buku WHERE 1=1";
    $params = [];
    $types = '';

    if (!empty($penulis)) {
        $placeholders = implode(',', array_fill(0, count($penulis), '?'));
        $query .= " AND nama_penulis IN ($placeholders)";
        $params = array_merge($params, $penulis);
        $types .= str_repeat('s', count($penulis));
    }

    if (!empty($penerbit)) {
        $placeholders = implode(',', array_fill(0, count($penerbit), '?'));
        $query .= " AND nama_penerbit IN ($placeholders)";
        $params = array_merge($params, $penerbit);
        $types .= str_repeat('s', count($penerbit));
    }

    if (!empty($supplier)) {
        $placeholders = implode(',', array_fill(0, count($supplier), '?'));
        $query .= " AND nama_supplier IN ($placeholders)";
        $params = array_merge($params, $supplier);
        $types .= str_repeat('s', count($supplier));
    }

    if (!empty($kategori)) {
        $placeholders = implode(',', array_fill(0, count($kategori), '?'));
        $query .= " AND nama_kategori IN ($placeholders)";
        $params = array_merge($params, $kategori);
        $types .= str_repeat('s', count($kategori));
    }

    $stmt = $conn->prepare($query);

    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $books = [];

    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }

    $stmt->close();
    $conn->close();

    echo json_encode($books);
}
?>