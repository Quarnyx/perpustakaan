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
if ($_GET['act'] == "tambahBuku") {
    $foto = $_FILES['foto']['name'];
    $rak = $_POST['rak'];
    $kodebuku = 'BB';
    // $getnumber = mysqli_query($conn, "SELECT COUNT(`kode_kategori`) AS num FROM kategori");
    // $number = mysqli_fetch_array($getnumber);
    // $newnumber = $number['num'] + 1;
    // $newid = $rak . '-' . $newnumber;
    $newid = $kodebuku . '-' . rand(1000, 9999);
    include ('../../plugins/phpqrcode/qrlib.php');
    $tempDir = "../../assets/images/qrcode/";

    $codeContents = $newid;
    // generate filename, 
    $fileName = 'buku-' . $codeContents . '.png';

    $pngAbsoluteFilePath = $tempDir . $fileName;
    $urlRelativeFilePath = $tempDir . $fileName;

    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_H, 4);
    } else {
        echo 'Error';
        echo '<hr />';
    }
    // foto
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($file_tmp, '../../assets/images/books/' . $foto);

    $sql = "INSERT INTO `buku`(
        `kode_buku`, 
        `halaman`, 
        `nama_buku`, 
        `stok`, 
        `cover`, 
        `rak`, 
        `dimensi`, 
        `penerbit_id`, 
        `penulis_id`, 
        `supplier_id`, 
        `tahun`, 
        `kategori_id`, 
        `petugas_id`) VALUES (
            '$newid',
            '$_POST[halaman]',
            '$_POST[judul]',
            '$_POST[stok]',
            '$foto',
            '$_POST[rak]',
            '$_POST[dimensi]',
            '$_POST[penerbit]',
            '$_POST[penulis]',
            '$_POST[supplier]',
            '$_POST[tahun]',
            '$_POST[kategori]',
            '$_POST[user]')";

    $query = mysqli_query($conn, $sql);


}
if ($_GET['act'] == "updateBuku") {

    $id = $_POST['id'];
    $halaman = $_POST['halaman'];
    $judul = $_POST['judul'];
    $stok = $_POST['stok'];
    $foto = $_POST['foto_lama'];
    $foto_baru = $_FILES['foto']['name'];
    $rak = $_POST['rak'];
    $dimensi = $_POST['dimensi'];
    $penerbit = $_POST['penerbit'];
    $penulis = $_POST['penulis'];
    $supplier = $_POST['supplier'];
    $tahun = $_POST['tahun'];
    $kategori = $_POST['kategori'];
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    if (!empty($foto_baru)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            //Mengupload gambar
            move_uploaded_file($file_tmp, '../../assets/images/books/' . $foto_baru);
            if ($foto != 'default.png') {
                unlink("../../assets/images/books/" . $foto);
            }
            //Sql jika menggunakan foto
            $sql = "UPDATE buku SET
            `halaman` = '$halaman',
            `nama_buku` = '$judul',
            `stok` = '$stok',
            `cover` = '$foto_baru',
            `rak` = '$rak',
            `dimensi` = '$dimensi',
            `penerbit_id` = '$penerbit',
            `penulis_id` = '$penulis',
            `supplier_id` = '$supplier',
            `tahun` = '$tahun',
            `kategori_id` = '$kategori',
            `petugas_id` = '$_POST[user]'
            WHERE id = '$id'";
        }
    } else {
        //Sql jika tidak menggunakan foto
        $sql = "UPDATE buku SET
        `halaman` = '$halaman',
        `nama_buku` = '$judul',
        `stok` = '$stok',
        `rak` = '$rak',
        `dimensi` = '$dimensi',
        `penerbit_id` = '$penerbit',
        `penulis_id` = '$penulis',
        `supplier_id` = '$supplier',
        `tahun` = '$tahun',
        `kategori_id` = '$kategori',
        `petugas_id` = '$_POST[user]' where id = '$id'";
    }
    $query = mysqli_query($conn, $sql);

}
if ($_GET['act'] == "hapusBuku") {

    $id = $_POST['id'];

    $sql = "DELETE FROM buku WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

}
?>