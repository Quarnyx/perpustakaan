<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Custom styles for this template -->
    <link href="../../../src/templates/css/styles.css" rel="stylesheet">
    <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
</head>

<body onload="window.print();">
    <?php
    include '../../config.php';

    $query = mysqli_query($conn, "select * from profil_aplikasi");
    $row = mysqli_fetch_array($query);
    ?>
    <div class="container-fluid">
        <div class="">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-sm-2 float-left">
                        <img src="../../assets/images/<?php echo $row['logo']; ?>" width="95px" alt="brand" />
                    </div>
                    <div class="col-sm-10 float-left">
                        <h3>Perpustakaan SMANCEP</h3>
                        <h6><?php echo $row['alamat'] . ', Telp ' . $row['telepon']; ?></h6>
                        <h6><?php echo $row['website']; ?></h6>
                    </div>
                </div>
            </div>
            <div class="">
                <!--rows -->
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Peminjaman</th>
                                    <th>Nama <br> Anggota</th>
                                    <th>Judul <br> Pustaka</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // include database
                                $kondisi = "";

                                if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"]))
                                    $kondisi = "where date(tanggal_pinjam)='" . $_GET['dari_tanggal'] . "' ";
                                if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"]))
                                    $kondisi = "where date(tanggal_pinjam) between '" . $_GET['dari_tanggal'] . "' and '" . $_GET['sampai_tanggal'] . "'";

                                // perintah sql untuk menampilkan laporan peminjaman jika level admin maka sistem hanya akan menampilkan transaksi yang dilakukan admin tersebut
                                if (isset($_SESSION["level"])) {
                                    $id_pengguna = $_SESSION["id"];
                                    $sql = "SELECT * FROM v_pinjambuku $kondisi ORDER BY tanggal_pinjam asc";
                                } else {
                                    $sql = "SELECT * FROM v_pinjambuku $kondisi ORDER BY tanggal_pinjam asc";
                                }

                                $hasil = mysqli_query($conn, $sql);
                                $no = 0;
                                $status = '';
                                $tanggal_kembali = "";
                                //Menampilkan data dengan perulangan while
                                while ($data = mysqli_fetch_array($hasil)):
                                    $no++;
                                    if ($data['tanggal_pinjam'] == '0000-00-00') {
                                        $tanggal_pinjam = "";
                                    } else {
                                        $tanggal_pinjam = date("d/m/Y", strtotime($data['tanggal_pinjam']));
                                    }
                                    if ($data['tanggal_kembali'] == '0000-00-00') {
                                        $tanggal_kembali = "";
                                    } else {
                                        $tanggal_kembali = date("d/m/Y", strtotime($data['tanggal_kembali']));
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $data['kode_pinjam']; ?> </td>
                                        <td><?php echo $data['nama_anggota']; ?> </td>
                                        <td><?php echo $data['nama_buku']; ?> </td>
                                        <td class="text-center"><?php echo $tanggal_pinjam; ?></td>
                                        <td class="text-center"><?php echo $tanggal_kembali; ?></td>
                                        <td><?php echo $data['status']; ?></td>
                                    </tr>
                                    <!-- bagian akhir (penutup) while -->
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
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
    ?>

    <div class="mt-3" style="text-align:end;">
        <hr>
        <p class="font-weight-bold">Kendal, <?= tanggal(date('Y-m-d')) ?><br>Mengetahui,</p>
        <div class="mt-5">
            <p class="font-weight-bold"><?php echo $row['nama_pimpinan'] ?><br>Kepala SMAN 1 Cepiring</p>
        </div>
    </div>
</body>

</html>