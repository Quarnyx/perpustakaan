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
                                    <th>Nama Anggota</th>
                                    <th>Total Denda</th>
                                    <th>Tanggal Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // include database
                                $kondisi = "";

                                if (!empty($_GET["dari_tanggal"]) && empty($_GET["sampai_tanggal"]))
                                    $kondisi = "where date(tanggal_pengembalian)='" . $_GET['dari_tanggal'] . "' ";
                                if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"]))
                                    $kondisi = "where date(tanggal_pengembalian) between '" . $_GET['dari_tanggal'] . "' and '" . $_GET['sampai_tanggal'] . "'";

                                // perintah sql untuk menampilkan laporan pengembalian jika level admin maka sistem hanya akan menampilkan transaksi yang dilakukan admin tersebut
                                if (isset($_SESSION["level"])) {
                                    $id_pengguna = $_SESSION["id"];
                                    $sql = "SELECT * FROM v_denda $kondisi ORDER BY tanggal_pengembalian asc";
                                } else {
                                    $sql = "SELECT * FROM v_denda $kondisi ORDER BY tanggal_pengembalian asc";
                                }

                                $no = 1;
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $row['nama_anggota'] ?></td>
                                        <td><?= $row['denda'] ?></td>
                                        <td><?= $row['tanggal_pengembalian'] ?></td>
                                    </tr>
                                    <!-- bagian akhir (penutup) while -->
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>