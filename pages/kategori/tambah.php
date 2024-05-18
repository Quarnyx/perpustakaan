<?php
include '../../config.php';

$query = mysqli_query($conn, "SELECT max(id) as kodeTerbesar FROM kategori");
$data = mysqli_fetch_array($query);
$kode_kategori = $data['kodeTerbesar'];
$kode_kategori++;
$huruf = "R";
$kodekategori = $huruf . sprintf("%03s", $kode_kategori);
?>
<div class="row">
    <form class="" id="formKategori" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Kategori</label>
                    <input type="text" class="form-control" name="kode_kategori" id="kode_kategori" disabled
                        value="<?= $kodekategori; ?>">
                    <input type="hidden" class="form-control" name="kode_kategori" id="kode_kategori"
                        value="<?= $kodekategori; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Kategori</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori"
                        placeholder="Nama Kategori" required="">
                    <div class="error" id="kategoriError">

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
    $("#nama_kategori").bind('keyup', function () {
        var nama_petugas = $('#nama_kategori').val();
        var textRegex = /^[a-zA-Z ]+$/;
        if (!textRegex.test(nama_petugas)) {
            $("#kategoriError").text("Nama hanya bisa mengandung huruf");
        } else {
            $("#kategoriError").text("");
        }
    });
    $("#formKategori").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/kategori/proses-kategori.php?act=tambahKategori",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                $("#formKategori")[0].reset();
                $('#tabelKategori').DataTable().ajax.reload();
                $('#modal').modal('hide');
            }
        });
    });
</script>