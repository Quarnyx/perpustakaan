<?php
include '../../config.php';

$id = $_POST["id"];
$sql = mysqli_query($conn, "SELECT * FROM anggota WHERE id = $id");
$row = mysqli_fetch_array($sql);

?>

<div class="row">
    <form class="" id="formAnggota" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">NIS</label>
                    <input disabled type="text" class="form-control" id="nis" name="nis" placeholder="NIS" required=""
                        value="<?= $row['nis'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        required="">
                </div>
            </div>
            <div>
                <button class="btn btn-primary" type="submit" id="submit">Update</button>
            </div>

        </div>


    </form>
</div>
<script>
    $("#formAnggota").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/anggota/proses-anggota.php?act=updatepass",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                // alert(response);
                $("#formAnggota")[0].reset();
                $('#tabelAnggota').DataTable().ajax.reload();
                $('#modal').modal('hide');
            }
        });
    });
</script>