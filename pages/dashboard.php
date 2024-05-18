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
                        <p class="text-truncate font-size-14 mb-2">Total Peminjaman</p>
                        <h4 class="mb-2">
                            <?php
                            $sqla = "SELECT
                                Count(peminjaman.`status`) AS total
                                FROM
                                peminjaman
                                WHERE
                                peminjaman.`status` = 'pinjam'
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
                            <i class="mdi mdi-currency-usd font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Anggota</p>
                        <h4 class="mb-2">
                            <?php
                            $sqlb = "SELECT
                                Count('nama_anggota') AS total
                                FROM
                                anggota
                                ";
                            $resultb = mysqli_query($conn, $sqlb);
                            $rowb = mysqli_fetch_assoc($resultb);
                            ?>
                            <?php if ($rowb['total'] > 0) {
                                echo $rowb['total'];
                            } else {
                                echo "0";
                            } ?>
                        </h4>
                        <p class="text-muted mb-0">Total<br>Anggota</p>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-danger rounded-3">
                            <i class="mdi mdi-currency-usd font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Buku</p>
                        <h4 class="mb-2">
                            <?php
                            $sqlc = "SELECT
                                Count(nama_buku) AS total
                                FROM
                                buku                                
                                ";
                            $resultc = mysqli_query($conn, $sqlc);
                            $rowc = mysqli_fetch_assoc($resultc);
                            ?>
                            <?php if ($rowc['total'] > 0) {
                                echo $rowc['total'];
                            } else {
                                echo "0";
                            } ?>
                        </h4>
                        <p class="text-muted mb-0">Koleksi Judul<br> <strong>Buku</strong></p>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="fas fa-coins font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-truncate font-size-14 mb-2">Total Denda</p>
                        <h4 class="mb-2">
                            <?php
                            $sqld = "SELECT
                                sum(denda) AS total
                                FROM
                                pengembalian
                                ";
                            $resultd = mysqli_query($conn, $sqld);
                            $rowd = mysqli_fetch_assoc($resultd);
                            ?>
                            <?php if ($rowd['total'] > 0) {
                                echo "Rp. " . number_format($rowd['total'], 0, ',', '.');
                            } else {
                                echo "0";
                            } ?>
                        </h4>
                        <p class="text-muted mb-0">Denda<br> yang Belum dibayar
                        </p>
                    </div>
                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="fas fa-coins font-size-24"></i>
                        </span>
                    </div>
                </div>
            </div><!-- end cardbody -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->




<div class="row">
    <div class="col-xl-6">

        <div class="card">
            <div class="card-body pb-0">
                <h4 class="card-title mb-4">Transaksi Tahun <?php echo date("Y"); ?></h4>
            </div>
            <div class="card-body py-0 pb-0">
                <div id="tampil_grafik_transaksi_per_bulan" class="apex-charts">
                    <!-- Garfik transaksi per bulan di load menggunakan AJAX-->
                </div>
            </div>
        </div><!-- end card -->
    </div>
    <!-- end col -->
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Grafik Kategori</h4>
                <div class="mt-4">
                    <div id="tampil_grafik_transaksi_per_kategori" class="apex-charts"></div>
                </div>
            </div>
        </div><!-- end card -->
    </div><!-- end col -->
</div>
<!-- end row -->
<script>

    //Load grafik transaksi menggunakan ajax
    $(document).ready(function () {

        $.ajax({
            url: 'pages/fetch-transaksi.php',
            method: 'POST',
            success: function (data) {
                $('#tampil_grafik_transaksi_per_bulan').html(data);
            }
        });


        $.ajax({
            url: 'pages/fetch-kategori.php',
            method: 'POST',
            success: function (data) {
                $('#tampil_grafik_transaksi_per_kategori').html(data);
            }
        });

    });

</script>