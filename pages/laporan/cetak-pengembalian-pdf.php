<?php
session_start();
require ('../../plugins/fpdf/fpdf.php');
$pdf = new FPDF('L', 'mm', 'Letter');

//Membuat Koneksi ke database akademik
include '../../config.php';


$query = mysqli_query($conn, "select * from profil_aplikasi");
$row = mysqli_fetch_array($query);

$pimpinan = $row['nama_pimpinan'];

$pdf->AddPage();
$pdf->Image('../../assets/images/' . $row['logo'], 15, 5, 30, 30);
$pdf->SetFont('Arial', 'B', 21);
$pdf->Cell(0, 7, strtoupper('Perpustakaan SMANCEP'), 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 7, $row['alamat'] . ', Telp ' . $row['telepon'], 0, 1, 'C');
$pdf->Cell(0, 7, $row['website'], 0, 1, 'C');
$pdf->Cell(10, 7, '', 0, 1);

//Membuat line (garis)
$pdf->SetLineWidth(1);
$pdf->Line(10, 31, 270, 31);
$pdf->SetLineWidth(0);
$pdf->Line(10, 32, 270, 32);

$pdf->SetFont('Arial', 'B', 14);

$pdf->Cell(0, 7, 'LAPORAN PENGEMBALIAN', 0, 1, 'C');

$tanggal = '';
if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"])) {
    $tanggal = date("d/m/Y", strtotime($_GET["dari_tanggal"]));
}
if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"])) {
    $tanggal = date("d/m/Y", strtotime($_GET["dari_tanggal"])) . " - " . date("d/m/Y", strtotime($_GET["sampai_tanggal"]));
}

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(17, 6, 'Tanggal :  ', 0, 0);
$pdf->Cell(30, 6, $tanggal, 0, 1);

$pdf->Cell(10, 2, '', 0, 1);

$pdf->SetFont('Arial', 'B', 10);

$pdf->Cell(10, 6, 'No', 1, 0, 'C');
$pdf->Cell(40, 6, 'Kode Pinjam', 1, 0, 'C');
$pdf->Cell(50, 6, 'Anggota', 1, 0, 'C');
$pdf->Cell(100, 6, 'Judul', 1, 0, 'C');
$pdf->Cell(50, 6, 'Tgl Pengembalian', 1, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$kondisi = "";

if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"]))
    $kondisi = "where date(tanggal_pengembalian)='" . $_GET['dari_tanggal'] . "' ";
if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"]))
    $kondisi = "where date(tanggal_pengembalian) between '" . $_GET['dari_tanggal'] . "' and '" . $_GET['sampai_tanggal'] . "'";

// perintah sql untuk menampilkan laporan pengembalian jika level admin maka sistem hanya akan menampilkan transaksi yang dilakukan admin tersebut
if ($_SESSION["level"] == "admin") {
    $id_pengguna = $_SESSION["id_pengguna"];
    $sql = "SELECT * FROM v_pengembalian $kondisi ORDER BY tanggal_pengembalian asc";
} else {
    $sql = "SELECT * FROM v_pengembalian $kondisi ORDER BY tanggal_pengembalian asc";
}

$hasil = mysqli_query($conn, $sql);
$no = 1;
$status = '';
$tanggal_kembali = '';
//Menampilkan data dengan perulangan while
while ($data = mysqli_fetch_array($hasil)):
    if ($data['tanggal_pengembalian'] == '0000-00-00') {
        $tanggal_pinjam = "";
    } else {
        $tanggal_pinjam = date("d/m/Y", strtotime($data['tanggal_pengembalian']));
    }

    $pdf->Cell(10, 6, $no, 1, 0);
    $pdf->Cell(40, 6, $data['kode_pinjam'], 1, 0);
    $pdf->Cell(50, 6, substr($data['nama_anggota'], 0, 17), 1, 0);
    $pdf->Cell(100, 6, substr($data['nama_buku'], 0, 89), 1, 0);
    $pdf->Cell(50, 6, $data['tanggal_pengembalian'], 1, 1);
    $no++;
endwhile;

//Membuat format peulisan tanggal
function tanggal($tanggal)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
}

//Menampilkan keterangan tambahan
$tanggal = date('Y-m-d');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(460, 15, '', 0, 1, 'C');
$pdf->Cell(460, 12, tanggal($tanggal), 0, 1, 'C');
$pdf->Cell(460, 0, 'Mengetahui Ketua', 0, 1, 'C');
$pdf->Cell(460, 7, '', 0, 1, 'C');
$pdf->Cell(460, 50, $pimpinan, 0, 1, 'C');

$pdf->Output();
?>