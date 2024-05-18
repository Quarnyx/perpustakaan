<div class="row">
    <div class="col-12">
        <!-- filter per tanggal -->
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Filter</h4>
                <form method="get" id="form-filter">
                    <input type="hidden" name="page" value="lap_peminjaman">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Dari Tanggal</label>
                                <input type="date" class="form-control" id="dari_tgl" name="dari_tanggal" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label">Sampai Tanggal</label>
                                <input type="date" class="form-control" id="sampai_tgl" name="sampai_tanggal" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="validationCustom01" class="form-label"></label>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end filter per tanggal -->

    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Data Peminjaman</h4>
                <div class="table-responsive">
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
                    ?>
                    <table id="tabelPeminjaman" class="table dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Pinjam</th>
                                <th>Nama Anggota</th>
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
                                    <td><?= $row['nama_anggota'] ?></td>
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
                <a class="btn btn-info waves-effect waves-light" target="_blank"
                    href="pages/laporan/cetak-peminjaman.php<?php if (isset($_GET['dari_tanggal'])) { ?>?dari_tanggal=<?= $_GET['dari_tanggal'] ?>&sampai_tanggal=<?= $_GET['sampai_tanggal'] ?><?php } ?>"><i
                        class="ri-printer-line align-middle me-2"></i>Cetak</a>
                <a class="btn btn-danger waves-effect waves-light" target="_blank"
                    href="pages/laporan/cetak-peminjaman-pdf.php<?php if (isset($_GET['dari_tanggal'])) { ?>?dari_tanggal=<?= $_GET['dari_tanggal'] ?>&sampai_tanggal=<?= $_GET['sampai_tanggal'] ?><?php } ?>"><i
                        class="ri-printer-line align-middle me-2"></i>Cetak PDF</a>
                <a class="btn btn-success waves-effect waves-light" target="_blank"
                    href="pages/laporan/cetak-peminjaman-excel.php<?php if (isset($_GET['dari_tanggal'])) { ?> ?dari_tanggal=<?= $_GET['dari_tanggal'] ?>&sampai_tanggal=<?= $_GET['sampai_tanggal'] ?><?php } ?>"><i
                        class="ri-printer-line align-middle me-2"></i>Export Excel</a>
            </div>

        </div>
    </div>
</div>

<script>
    var dataTable = $('#tabelPeminjaman').DataTable()
</script>