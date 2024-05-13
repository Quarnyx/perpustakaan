<?php
include '../../config.php';

$sql = "SELECT * FROM penerbit WHERE id = '$_POST[id]'";
$result = $conn->query($sql);
$row = $result->fetch_array();
?>
<div class="row">
    <form class="" id="formPenerbit" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $row['id']; ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Penerbit</label>
                    <input type="text" class="form-control" name="kode_penerbit" id="kode_penerbit" disabled
                        value="<?= $row['kode_penerbit']; ?>">
                    <input type="hidden" class="form-control" name="kode_penerbit" id="kode_penerbit"
                        value="<?= $row['kode_penerbit']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Penerbit</label>
                    <input type="text" class="form-control" id="nama_penerbit" name="nama_penerbit"
                        placeholder="Nama Penerbit" required="" value="<?= $row['nama_penerbit']; ?>">
                    <div class="error" id="penerbitError">

                    </div>
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit" id="submit">Update</button>
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
            url: "pages/penerbit/proses-penerbit.php?act=updatePenerbit",
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