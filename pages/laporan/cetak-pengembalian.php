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
                                    <th>Kode Pinjam</th>
                                    <th>Nama Anggota</th>
                                    <th>Judul Buku</th>
                                    <th>Tanggal Pengembalian</th>
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

                                // perintah sql untuk menampilkan laporan peminjaman jika level admin maka sistem hanya akan menampilkan transaksi yang dilakukan admin tersebut
                                if (isset($_SESSION["level"])) {
                                    $id_pengguna = $_SESSION["id"];
                                    $sql = "SELECT * FROM v_pengembalian $kondisi ORDER BY tanggal_pengembalian asc";
                                } else {
                                    $sql = "SELECT * FROM v_pengembalian $kondisi ORDER BY tanggal_pengembalian asc";
                                }

                                $hasil = mysqli_query($conn, $sql);
                                $no = 0;
                                $status = '';
                                //Menampilkan data dengan perulangan while
                                while ($data = mysqli_fetch_array($hasil)):
                                    $no++;
                                    if ($data['tanggal_pengembalian'] == '0000-00-00') {
                                        $tanggal_pengembalian = "";
                                    } else {
                                        $tanggal_pengembalian = date("d/m/Y", strtotime($data['tanggal_pengembalian']));
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $data['kode_pinjam']; ?> </td>
                                        <td><?php echo $data['nama_anggota']; ?> </td>
                                        <td><?php echo $data['nama_buku']; ?> </td>
                                        <td class="text-center"><?php echo $data['tanggal_pengembalian']; ?></td>
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
</body>

</html>