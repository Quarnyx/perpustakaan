<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Pilih Anggota</h4>
                <p class="card-title-desc">Pilih anggota yang ingin dipinjamkan</p>
                <form action="" id="form-anggota" method="GET">
                    <input type="text" name="page" value="peminjaman" hidden>
                    <select id="anggota" class="select2 form-control" data-placeholder="Pilih ..." name="anggota_id">
                        <?php
                        //Perintah sql untuk menampilkan semua data pada tabel penulis
                        $sql = "select * from anggota";

                        $hasil = mysqli_query($conn, $sql);
                        $no = 0;
                        while ($data = mysqli_fetch_array($hasil)):
                            $no++;
                            ?>
                            <option value="<?php echo $data['id']; ?>">
                                <?php echo $data['nis'] ?> - <?php echo $data['nama_anggota']; ?>
                            </option>
                            <?php
                        endwhile;
                        ?>
                    </select>
                    <button id="pilih_anggota" class="btn btn-primary mt-3"><i class="ri-search-2-line"></i>
                        Pilih</button>
                </form>

            </div>
        </div>
    </div>
    <?php
    if (isset($_GET['anggota_id'])) {
        $sql = mysqli_query($conn, "SELECT * FROM anggota WHERE id = '$_GET[anggota_id]' ");
        $data = mysqli_fetch_array($sql);
        ?>
        <!-- end col -->
        <div class="col-lg-6" id="cekakun">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Akun Anggota</h4>
                    <div class="row">
                        <div class="col-6 col-md-3 d-flex align-items-center justify-content-center">
                            <img src="assets/images/users/<?php echo $data['foto']; ?>" alt=""
                                class="text-center rounded-circle avatar-lg" style="margin: auto;">
                        </div>
                        <div class="col-6 col-md-8">
                            <div class="mt-4 mt-md-0">
                                <p class="mb-1">NIS</p>
                                <h5 id="nis"><?php echo $data['nis']; ?></h5>
                                <p class="mb-1">Nama</p>
                                <h5 id="nama_anggota"><?php echo $data['nama_anggota']; ?></h5>
                            </div>
                        </div>

                    </div>
                    <?php
                    $sqla = mysqli_query($conn, "SELECT * FROM peminjaman WHERE anggota_id = '$_GET[anggota_id]' AND status = 'pinjam' ");
                    $anggota = mysqli_num_rows($sqla);
                    if ($anggota > 0) {
                        ?>
                        <div class="alert alert-warning mt-3" role="alert">
                            Anggota ini sedang pinjam <?php echo $anggota; ?>
                        </div>
                        <?php
                    } elseif ($anggota == 0) {
                        ?>
                        <div class="alert alert-success mt-3" role="alert">
                            Anggota ini tidak sedang pinjam buku
                        </div>
                        <?php
                    } elseif ($anggota > 2) { ?>
                        <div class="alert alert-danger mt-3" role="alert">
                            Anggota ini sedang pinjam <?php echo $anggota; ?>
                        </div>
                        <?php
                    }
                    ?>
                </div><!-- end cardbody -->
            </div><!-- end card -->
        </div>
    </div>
    <?php
    if ($anggota < 2) {
        ?>
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Scan QR Code Buku</h4>
                        <div class="row">
                            <div class="mb-3">
                                <a id="btn-scan-qr">
                                    <img src="assets/images/qrcode/qricon.svg" style="display:block; margin:auto;">
                                </a>
                                <canvas hidden="" id="qr-canvas" style="display:block; margin:auto;"></canvas>

                            </div>
                            <form id="form-buku" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <input name="anggota_id" value="<?php echo $_GET['anggota_id']; ?>" hidden>
                                    <input name="petugas_id" value="<?php echo $_SESSION['id']; ?>" hidden>
                                    <div class="col-12">
                                        <input type="hidden" class="form-control" placeholder="Kode Buku" name="kode_buku"
                                            id="outputData" required value="0" required>
                                        <div id="judul-buku"></div>
                                    </div>
                                    <?php
                                    $waktu_pinjam = 7;
                                    $tgl = date('d-m-Y H:i');
                                    $tanggal_pinjam = date("d/m/Y", strtotime($tgl));
                                    $tanggal_kembali = date("d/m/Y", strtotime("+" . $waktu_pinjam . " day", strtotime($tgl)));
                                    ?>
                                    <div class="col-6">
                                        <div class="text-center alert alert-success" role="alert">Tanggal
                                            Pinjam<br><b><?php echo $tanggal_pinjam; ?></b></div>
                                        <input type="hidden" name="tanggal_pinjam" id="tanggal_pinjam"
                                            value="<?php echo $tanggal_pinjam; ?>">
                                    </div>
                                    <div class="col-6">
                                        <div class="text-center alert alert-warning" role="alert">Tanggal
                                            Kembali<br><b><?php echo $tanggal_kembali; ?></b></div>
                                        <input type="hidden" name="tanggal_kembali" id="tanggal_kembali"
                                            value="<?php echo $tanggal_kembali; ?>">
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit" id="submit">Pilih</button>

                            </form>

                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div>
            <div class="col-7">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Buku</h4>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table id="tabelPinjam" class="table dt-responsive nowrap w-100">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Pinjam</th>
                                            <th>Judul Buku</th>
                                            <th></th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>

                                        <!-- end -->
                                    </tbody><!-- end tbody -->
                                </table> <!-- end table -->
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div>
        </div>
    <?php } ?>
<?php } ?>
<script src="././plugins/qrCodeScanner.js"></script>
<script>
    var dataTable = $('#tabelPinjam').DataTable({
        serverMethod: 'post',
        select: {
            style: "multi"
        },
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback: function () {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        },
        ajax: {
            url: './pages/peminjaman/proses-pinjam.php?act=tabelPinjam&id=' + <?php echo $_GET['anggota_id']; ?>,
            type: 'POST',
            dataType: 'json'
        },
        columns: [{
            data: null,
            render: function (data, type, row, meta) {
                return meta.row + 1;
            }
        },
        {
            data: 'kode_pinjam',
            className: 'mb-0 h6'
        },
        {
            data: 'nama_buku',
        },
        {
            data: null,
            render: function (data, type, row) {
                return '<div class="button-items">' +
                    '<button type="button" class="btn btn-danger waves-effect waves-light hapus-pinjam" data-id="' +
                    row.id +
                    '"><i class=" ri-delete-bin-line align-middle me-2"></i></button>' +
                    '</div>';

            }

        }
        ]
    });


    var hidden = $("#canvas").attr("hidden");
    // Select the qr-canvas element
    const qrCanvas = document.getElementById('qr-canvas');

    // Create a MutationObserver to observe changes in the 'hidden' attribute
    const observer = new MutationObserver((mutationsList) => {
        for (let mutation of mutationsList) {
            if (mutation.attributeName === 'hidden') {
                if (qrCanvas.hidden) {
                    var outputData = document.getElementById("outputData");
                    console.log(outputData.value);
                    var kode_buku = outputData.value;
                    $.ajax({
                        url: 'pages/peminjaman/proses-pinjam.php?act=judulBuku',
                        type: 'POST',
                        data: { kode_buku: kode_buku },
                        success: function (data) {
                            console.log(data);
                            $('#judul-buku').html(data);

                        }
                    });
                }
            }
        }
    });

    // Start observing the 'hidden' attribute of qr-canvas
    observer.observe(qrCanvas, { attributes: true });
    // observer.disconnect();

    $("#form-buku").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/peminjaman/proses-pinjam.php?act=tambahSimpan",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                $('#pinjamError').show();
                $('#pinjamError').html(data);
                $('#tabelPinjam').DataTable().ajax.reload();
            }
        });

    })
    $('#tabelPinjam').on('click', '.hapus-pinjam', function () {
        var id = $(this).data('id');
        Swal.fire({
            icon: 'warning',
            title: 'Yakin ingin menghapus data ini?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: 'pages/peminjaman/proses-pinjam.php?act=hapusPinjam',
                    data: {
                        id: id
                    }, //set data
                    beforeSend: function () {
                    },
                    success: function (
                        response) {
                        $('#tabelPinjam').DataTable().ajax.reload();

                        Swal.fire('Data Terhapus', response, 'success')
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Aksi batal', '', 'info')
            }
        });
    });
</script>