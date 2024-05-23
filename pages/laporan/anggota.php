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
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>

                            <!-- end -->
                        </tbody><!-- end tbody -->
                    </table> <!-- end table -->
                </div>
                <div style="margin-top:5px">
                    <a class="btn btn-info waves-effect waves-light" target="_blank"
                        href="pages/laporan/cetak-anggota.php"><i
                            class="ri-printer-line align-middle me-2"></i>Cetak</a>
                    <a class="btn btn-danger waves-effect waves-light" target="_blank"
                        href="pages/laporan/cetak-anggota-pdf.php"><i
                            class="ri-printer-line align-middle me-2"></i>Cetak PDF</a>
                    <a class="btn btn-success waves-effect waves-light" target="_blank"
                        href="pages/laporan/cetak-anggota-excel.php"><i
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
        }
        ]
    });
</script>