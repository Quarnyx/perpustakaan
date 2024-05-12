<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Data Angggota Perpustakaan</h4>
                <div class="table-responsive">

                    <table id="tabelAnggota" class="table dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th></th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kontak</th>
                                <th>Email</th>
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
    var dataTable = $('#tabelAnggota').DataTable({
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
            url: './pages/anggota/proses-anggota.php?act=tabelanggota',
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
            data: null,
            render: function (data, type, row) {
                return '<img src="assets/images/users/' + row.foto + '" alt="avatar-3" class="rounded-circle avatar-sm">'
            }
        },
        {
            data: 'nis',
            className: 'mb-0 h6'
        },
        {
            data: 'nama_anggota'
        },
        {
            data: 'no_telp'
        },
        {
            data: 'email'
        },
        {
            data: null,
            render: function (data, type, row) {
                return '<div class="button-items">' +
                    '<button type="button" class="btn btn-light waves-effect waves-light editanggota" data-bs-toggle="modal" data-bs-target="" data-id="' +
                    row.id +
                    '"><i class="ri-user-2-line align-middle me-2"></i> Edit Profil</button>'
                    +
                    '<button type="button" class="btn btn-danger waves-effect waves-light hapus-anggota" data-id="' +
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
            url: 'pages/anggota/tambah.php',
            method: 'post',
            data: { level: level },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Tambah Anggota';
            }
        });
        $('#modal').modal('show');
    });
    $('#tabelAnggota').on('click', '.editanggota', function () {
        var id = $(this).data("id");
        $.ajax({
            url: 'pages/anggota/update.php',
            method: 'post',
            data: { id: id },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Edit Profil';
            }
        });
        $('#modal').modal('show');
    });
    $('#tabelAnggota').on('click', '.hapus-anggota', function () {
        var id = $(this).data('id');
        Swal.fire({
            icon: 'warning',
            title: 'Yakin ingin menghapus akun ini?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Ya'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: 'pages/anggota/proses-anggota.php?act=hapusAnggota',
                    data: {
                        id: id
                    }, //set data
                    beforeSend: function () {
                    },
                    success: function (
                        response) {
                        $('#tabelAnggota').DataTable().ajax.reload();

                        Swal.fire('Akun Terhapus', response, 'success')
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Aksi batal', '', 'info')
            }
        });
    });

</script>