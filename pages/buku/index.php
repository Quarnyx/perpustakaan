<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Katalog Buku</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div style="margin-top:5px; margin-bottom:35px   ">
            <button type="button" class="btn btn-tambah btn-success waves-effect waves-light" data-bs-toggle="modal"
                data-bs-target="#addUser">
                <i class="ri-add-box-line align-middle me-2"></i> Tambah
            </button>
        </div>
    </div>
</div>
<div id="modal" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
    aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Filter Kategori Buku</h4>

                <form>
                    <div class="row">
                        <div class="col-lg-3">

                            <div>
                                <label for="penulis" class="form-label">Penulis</label>
                                <select id="penulis" class="select2 form-control select2-multiple" multiple="multiple"
                                    data-placeholder="Pilih">
                                    <?php
                                    //Perintah sql untuk menampilkan semua data pada tabel penulis
                                    $sql = "select * from penulis";

                                    $hasil = mysqli_query($conn, $sql);
                                    $no = 0;
                                    while ($data = mysqli_fetch_array($hasil)):
                                        $no++;
                                        ?>
                                        <option value="<?php echo $data['nama_penulis']; ?>">
                                            <?php echo $data['nama_penulis']; ?>
                                        </option>
                                        <?php
                                    endwhile;
                                    ?>
                                </select>

                            </div>


                        </div>
                        <div class="col-lg-3">

                            <div>
                                <label for="penerbt" class="form-label">Penerbit</label>
                                <select id="penerbit" class="select2 form-control select2-multiple" multiple="multiple"
                                    data-placeholder="Choose ...">
                                    <?php
                                    //Perintah sql untuk menampilkan semua data pada tabel penulis
                                    $sql = "select * from penerbit";

                                    $hasil = mysqli_query($conn, $sql);
                                    $no = 0;
                                    while ($data = mysqli_fetch_array($hasil)):
                                        $no++;
                                        ?>
                                        <option value="<?php echo $data['nama_penerbit']; ?>">
                                            <?php echo $data['nama_penerbit']; ?>
                                        </option>
                                        <?php
                                    endwhile;
                                    ?>
                                </select>

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <label for="supplier" class="form-label">Supplier</label>
                                <select id="supplier" class="select2 form-control select2-multiple" multiple="multiple"
                                    data-placeholder="Choose ...">
                                    <?php
                                    //Perintah sql untuk menampilkan semua data pada tabel penulis
                                    $sql = "select * from supplier";

                                    $hasil = mysqli_query($conn, $sql);
                                    $no = 0;
                                    while ($data = mysqli_fetch_array($hasil)):
                                        $no++;
                                        ?>
                                        <option value="<?php echo $data['nama_supplier']; ?>">
                                            <?php echo $data['nama_supplier']; ?>
                                        </option>
                                        <?php
                                    endwhile;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div>
                                <label for="kategori" class="form-label">Kategori</label>
                                <select id="kategori" class="select2 form-control select2-multiple" multiple="multiple"
                                    data-placeholder="Choose ...">
                                    <?php
                                    //Perintah sql untuk menampilkan semua data pada tabel penulis
                                    $sql = "select * from kategori";

                                    $hasil = mysqli_query($conn, $sql);
                                    $no = 0;
                                    while ($data = mysqli_fetch_array($hasil)):
                                        $no++;
                                        ?>
                                        <option value="<?php echo $data['nama_kategori']; ?>">
                                            <?php echo $data['nama_kategori']; ?>
                                        </option>
                                        <?php
                                    endwhile;
                                    ?>
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button id="filterButton" type="button"
                                class="btn btn-primary waves-effect waves-light mt-4">
                                Filter <i class="ri-arrow-right-line align-middle ms-2"></i>
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>


</div>

</button>
<div id="bookList" class="row"></div>
<script>
    $(document).ready(function () {
        function fetchBooks(filters = {}) {

            $.ajax({
                url: 'pages/buku/proses-buku.php?act=cariBuku',
                type: 'POST',
                data: filters,
                success: function (data) {
                    let books = JSON.parse(data);
                    $('#bookList').empty();
                    books.forEach(function (book) {
                        $('#bookList').append(
                            '<div class="col-md-6 col-xl-3">' +
                            '<div class="card">' +
                            '<img class="card-img-top img-fluid" src="assets/images/books/' + book.cover + '" alt="' + book.nama_buku + '">' +
                            '<div class="card-body">' +
                            '<h4 class="card-title text-center">' + book.nama_buku + '</h4>' +
                            '<div class="text-center">' +
                            '<button type="button"  data-bs-toggle="modal" data-bs-target="#addUser" data-id="' + book.id + '" class="info-buku m-2 btn btn-primary waves-effect waves-light"><i class="ri-information-line align-middle"></i>' +
                            '<button type="button" class="edit-buku m-2 btn btn-light waves-effect waves-light" data-id="' + book.id + '"><i class="ri-edit-2-line align-middle"></i>' +
                            '<button type="button" class="hapus-buku m-2 btn btn-danger waves-effect waves-light"  data-id="' + book.id + '"><i class="ri-delete-bin-3-line align-middle"></i>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    });
                }
            });
        }
        fetchBooks();
        $('#filterButton').on('click', function () {
            let selectedPenulis = $('#penulis').val();
            let selectedPenerbit = $('#penerbit').val();
            let selectedSupplier = $('#supplier').val();
            let selectedKategori = $('#kategori').val();

            let filters = {
                penulis: selectedPenulis,
                penerbit: selectedPenerbit,
                supplier: selectedSupplier,
                kategori: selectedKategori
            };

            fetchBooks(filters);
        });
        $('#bookList').on('click', '.hapus-buku', function () {
            var id = $(this).data('id');
            Swal.fire({
                icon: 'warning',
                title: 'Yakin ingin menghapus buku ini?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: 'pages/buku/proses-buku.php?act=hapusBuku',
                        data: {
                            id: id
                        }, //set data
                        beforeSend: function () {
                        },
                        success: function (
                            response) {
                            fetchBooks();
                            Swal.fire('Buku Terhapus', response, 'success')
                        }
                    });
                } else if (result.isDenied) {
                    Swal.fire('Aksi batal', '', 'info')
                }
            });
        });
    });
    $('.btn-tambah').on('click', function () {
        var level = $(this).attr("level");
        $.ajax({
            url: 'pages/buku/tambah.php',
            method: 'post',
            data: { level: level },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Tambah Buku';
            }
        });
        $('#modal').modal('show');
    });
    $('#bookList').on('click', '.info-buku', function () {
        var id = $(this).data("id");
        $.ajax({
            url: 'pages/buku/info.php',
            method: 'post',
            data: { id: id },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Lihat Informasi Buku';
            }
        });
        $('#modal').modal('show');
    });
    $('#bookList').on('click', '.edit-buku', function () {
        var id = $(this).data("id");
        $.ajax({
            url: 'pages/buku/update.php',
            method: 'post',
            data: { id: id },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Lihat Informasi Buku';
            }
        });
        $('#modal').modal('show');
    });

</script>