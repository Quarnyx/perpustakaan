<?php
include '../../config.php';

$query = mysqli_query($conn, "SELECT max(kode_penerbit) as kodeTerbesar FROM penerbit");
$data = mysqli_fetch_array($query);
$kode_penerbit = $data['kodeTerbesar'];
$kode_penerbit++;
$huruf = "PNB";
$kodepenerbit = sprintf("%03s", $kode_penerbit);
?>
<div class="row">
    <form class="" id="formPenerbit" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Penerbit</label>
                    <input type="text" class="form-control" name="kode_penerbit" id="kode_penerbit" disabled
                        value="<?= $kodepenerbit; ?>">
                    <input type="hidden" class="form-control" name="kode_penerbit" id="kode_penerbit"
                        value="<?= $kodepenerbit; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Penerbit</label>
                    <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit"
                        placeholder="Nama Penerbit" required="">
                    <div class="error" id="penerbitError">

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
    $("#nama_penerbit").bind('keyup', function () {
        var nama_petugas = $('#nama_penerbit').val();
        var textRegex = /^[a-zA-Z ]+$/;
        if (!textRegex.test(nama_petugas)) {
            $("#penerbitError").text("Nama hanya bisa mengandung huruf");
        } else {
            $("#penerbitError").text("");
        }
    });
    $("#formPenerbit").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/penerbit/proses-penerbit.php?act=tambahPenerbit",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                $("#formPenerbit")[0].reset();
                $('#tabelPenerbit').DataTable().ajax.reload();
                $('#modal').modal('hide');
            }
        });
    });
</script>