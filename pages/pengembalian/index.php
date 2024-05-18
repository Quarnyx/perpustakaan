<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Transaksi Pengembalian</h4>
                <div class="table-responsive">

                    <table id="tabelPinjam" class="table dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Kode Pinjam</th>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>

                            <!-- end -->
                        </tbody><!-- end tbody -->
                    </table> <!-- end table -->
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
            url: './pages/pengembalian/proses-pengembalian.php?act=tabelpengembalian',
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
            data: 'nama_anggota'
        },
        {
            data: 'nama_buku'
        },
        {
            data: 'tanggal_pinjam'
        },
        {
            data: 'status'
        },

        {
            data: null,
            render: function (data, type, row) {
                return '<div class="">' +
                    '<button type="button" class="text-center btn btn-success waves-effect waves-light kembali" data-id="' +
                    row.id +
                    '"><i class="text-center ri-check-double-line align-middle me-2"></i></button>' +
                    '</div>';

            }

        }
        ]
    });
    $('#tabelPinjam').on('click', '.kembali', function () {
        var id = $(this).data("id");
        $.ajax({
            url: 'pages/pengembalian/pengembalian.php',
            method: 'post',
            data: { id: id },
            success: function (data) {
                $('#tampil_data').html(data);
                document.getElementById("judul").innerHTML = 'Pengembalian Buku';
            }
        });
        $('#modal').modal('show');
    });

</script>