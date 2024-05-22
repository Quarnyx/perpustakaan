<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Dashboard</h4>
        </div>
    </div>
</div>
<!-- end page title -->
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Pinjam</p>
                        <h4 class="mb-2">
                            <?php
                            $sqla = "SELECT
                                Count(peminjaman.`status`) AS total
                                FROM
                                peminjaman
                                WHERE
                                peminjaman.`status` = 'pinjam' AND anggota_id = '$sessionid'
                                ";
                            $resulta = mysqli_query($conn, $sqla);
                            $rowa = mysqli_fetch_assoc($resulta);
                            ?>
                            <?php if ($rowa['total'] > 0) {
                                echo $rowa['total'];
                            } else {
                                echo "0";
                            } ?>
                        </h4>
                        <p class="text-muted mb-0">Judul Buku<br>Sampai saat Ini</p>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="ri-hand-coin-line font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Data Peminjaman</h4>
                <div class="table-responsive">
                    <?php
                    $sql = "SELECT * FROM v_pinjambuku WHERE anggota_id = '$sessionid' ORDER BY tanggal_pinjam asc";
                    ?>
                    <table id="tabelPeminjaman" class="table dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Pinjam</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Status</th>
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>
                            <?php
                            $no = 1;
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $row['kode_pinjam'] ?></td>
                                    <td><?= $row['nama_buku'] ?></td>
                                    <td><?= $row['tanggal_pinjam'] ?></td>
                                    <td><?= $row['tanggal_kembali'] ?></td>
                                    <td><?php if ($row['status'] == "pinjam") { ?> <span
                                                class="badge bg-warning">Pinjam</span> <?php } ?>
                                        <?php if ($row['status'] == "kembali") { ?> <span
                                                class="badge bg-success">Kembali</span> <?php } ?>
                                    </td>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                            <!-- end -->
                        </tbody><!-- end tbody -->
                    </table> <!-- end table -->
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    var dataTable = $('#tabelPeminjaman').DataTable()
</script>


</script>