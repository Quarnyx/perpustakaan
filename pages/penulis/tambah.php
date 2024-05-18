<?php
include '../../config.php';

$query = mysqli_query($conn, "SELECT max(id) as kodeTerbesar FROM penulis");
$data = mysqli_fetch_array($query);
$kode_penulis = $data['kodeTerbesar'];
$kode_penulis++;
$huruf = "PNL";
$kodepenulis = $huruf . sprintf("%03s", $kode_penulis);
?>
<div class="row">
    <form class="" id="formPenulis" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Penulis</label>
                    <input type="text" class="form-control" name="kode_penulis" id="kode_penulis" disabled
                        value="<?= $kodepenulis; ?>">
                    <input type="hidden" class="form-control" name="kode_penulis" id="kode_penulis"
                        value="<?= $kodepenulis; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Penulis</label>
                    <input type="text" class="form-control" id="nama_penulis" name="nama_penulis"
                        placeholder="Nama Penulis" required="">
                    <div class="error" id="penulisError">

                    </div>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit" id="submit">Tambah</button>
        </div>
    </form>
</div>
<script>
    $("#nama_penulis").bind('keyup', function () {
        var nama_petugas = $('#nama_penulis').val();
        var textRegex = /^[a-zA-Z ]+$/;
        if (!textRegex.test(nama_petugas)) {
            $("#penulisError").text("Nama hanya bisa mengandung huruf");
        } else {
            $("#penulisError").text("");
        }
    });
    $("#formPenulis").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/penulis/proses-penulis.php?act=tambahPenulis",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                $("#formPenulis")[0].reset();
                $('#tabelPenulis').DataTable().ajax.reload();
                $('#modal').modal('hide');
            }
        });
    });
</script>