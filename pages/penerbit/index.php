<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Data Penerbit</h4>
                <div class="table-responsive">

                    <table id="tabelPenerbit" class="table dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Penerbit</th>
                                <th>Nama Penerbit</th>
                                <th>Aksi</th>

                            </tr>
                        </thead><!-- end thead -->
                        <tbody>

                            <!-- end -->
                        </tbody><!-- end tbody -->
                    </table> <!-- end table -->
                </div>
                <div style="margin-top:5px">
                    <button type="button" class="btn btn-tambah btn-success waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#addUser">
                        <i class="ri-add-box-line align-middle me-2"></i> Tambah
                    </button>
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
    var dataTable = $('#tabelPenerbit').DataTable({
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
            url: './pages/penerbit/proses-penerbit.php?act=tabelpenerbit',
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
            data: 'kode_penerbit',
            className: 'mb-0 h6'
        },
        {
            data: 'nama_penerbit'
        },
        {
            data: null,
            render: function (data, type, row) {
                return '<div class="button-items">' +
                    '<button type="button" class="btn btn-light waves-effect waves-light edit-penerbit" data-bs-toggle="modal" data-bs-target="" data-id="' +
                    row.id +
                    '"><i class="ri-edit-2-line align-middle me-2"></i> Edit </button>'
                    +
                    '<button type="button" class="btn btn-danger waves-effect waves-light hapus-penerbit" data-id="' +
                    row.id +
                    '"><i class=" ri-delete-bin-line align-middle me-2"></i> Hapus</button>' +
                    '</div>';

            }

        }
        ]
    });

    // hapus petugas
    $('.btn-tambah').on('click', function () {
        var level = $(this).attr("level");
        $.ajax({
            url: 'pages/penerbit/tambah.php',
            method: 'post',
            data: { level: level },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Tambah Penerbit';
            }
        });
        $('#modal').modal('show');
    });
    $('#tabelPenerbit').on('click', '.edit-penerbit', function () {
        var id = $(this).data("id");
        $.ajax({
            url: 'pages/penerbit/update.php',
            method: 'post',
            data: { id: id },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Edit Penerbit';
            }
        });
        $('#modal').modal('show');
    });
    $('#tabelPenerbit').on('click', '.hapus-penerbit', function () {
        var id = $(this).data('id');
        Swal.fire({
            icon: 'warning',
            title: 'Yakin ingin menghapus penerbit ini?, pastikan tidak ada buku yang menggunakan penerbit ini',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: 'pages/penerbit/proses-penerbit.php?act=hapusPenerbit',
                    data: {
                        id: id
                    }, //set data
                    beforeSend: function () {
                    },
                    success: function (
                        response) {
                        $('#tabelPenerbit').DataTable().ajax.reload();

                        Swal.fire('Penerbit Terhapus', response, 'success')
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Aksi batal', '', 'info')
            }
        });
    });

</script>