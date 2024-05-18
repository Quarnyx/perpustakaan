<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Data Petugas</h4>
                <div class="table-responsive">

                    <table id="tabelPetugas" class="table dt-responsive nowrap w-100">
                        <thead class="table-light">
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
                        </thead><!-- end thead -->
                        <tbody>
                            <?php

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
                            <!-- end -->
                        </tbody><!-- end tbody -->
                    </table> <!-- end table -->
                </div>
                <div style="margin-top:5px">
                    <a class="btn btn-info waves-effect waves-light" target="_blank"
                        href="pages/laporan/cetak-buku.php"><i class="ri-printer-line align-middle me-2"></i>Cetak</a>
                    <a class="btn btn-danger waves-effect waves-light" target="_blank"
                        href="pages/laporan/cetak-buku-pdf.php"><i class="ri-printer-line align-middle me-2"></i>Cetak
                        PDF</a>
                    <a class="btn btn-success waves-effect waves-light" target="_blank"
                        href="pages/laporan/cetak-buku-excel.php"><i
                            class="ri-printer-line align-middle me-2"></i>Export Excel</a>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="modal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="tampil_data">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger  waves-effect" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $("#tabelPetugas").DataTable();
</script>