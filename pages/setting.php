<?php
include '../config.php';

$query = mysqli_query($conn, "SELECT * FROM profil_aplikasi WHERE id = 1");
$data = mysqli_fetch_array($query);
?>
<div class="row">
    <form class="" id="formProfil" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Pimpinan</label>
                    <input type="text" class="form-control" name="nama_pimpinan" id="nama_pimpinan"
                        value="<?= $data['nama_pimpinan']; ?>">
                    <input type="hidden" class="form-control" name="id" id="id" value="<?= $data['id']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Alamat Sekolah</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                        required="" value="<?= $data['alamat']; ?>">

                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Telepon Sekolah</label>
                    <input type="number" name="telepon" class="form-control" id="telepon" name="telepon"
                        placeholder="telepon" required="" value="<?= $data['telepon']; ?>">

                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Website Sekolah</label>
                    <input type="text" name="website" class="form-control" id="website" name="website"
                        placeholder="website" required="" value="<?= $data['website']; ?>">

                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit" id="submit">Simpan</button>
        </div>
    </form>
</div>
<script>
    $("#formProfil").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/setting.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                $("#formProfil")[0].reset();
                $('#setting').modal('hide');
            }
        });
    });
</script>
<?php

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // $kode_penerbit = mysqli_real_escape_string($conn, $_POST['kode_penerbit']);
    $nama_pimpinan = mysqli_real_escape_string($conn, $_POST['nama_pimpinan']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $telepon = mysqli_real_escape_string($conn, $_POST['telepon']);
    $website = mysqli_real_escape_string($conn, $_POST['website']);

    $sql = "UPDATE profil_aplikasi SET nama_pimpinan = '$nama_pimpinan', alamat = '$alamat', telepon = '$telepon', website = '$website' WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
}

?>