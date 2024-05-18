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
                                    <th>Nama Buku</th>
                                    <th>Penulis</th>
                                    <th>Penerbit</th>
                                    <th>Supplier</th>
                                    <th>Tahun</th>
                                    <th>Jumlah</th>
                                    <th>Rak</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // include database
                                $no = 1;

                                $sql = mysqli_query($conn, "SELECT * FROM v_buku");
                                while ($data = mysqli_fetch_array($sql)) {
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama_buku'] ?></td>
                                        <td><?= $data['nama_penulis'] ?></td>
                                        <td><?= $data['nama_penerbit'] ?></td>
                                        <td><?= $data['nama_supplier'] ?></td>
                                        <td><?= $data['tahun'] ?></td>
                                        <td><?= $data['stok'] ?></td>
                                        <td><?= $data['rak'] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>