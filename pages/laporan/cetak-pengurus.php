<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Custom styles for this template -->
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
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Level</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // include database
                                $sql = "SELECT * FROM petugas";
                                $hasil = mysqli_query($conn, $sql);
                                $no = 0;
                                //Menampilkan data dengan perulangan while
                                while ($data = mysqli_fetch_array($hasil)):
                                    $no++;
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $data['nama_petugas']; ?> </td>
                                        <td><?php echo $data['username']; ?> </td>
                                        <td><?php echo $data['level']; ?> </td>
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
</body>

</html>