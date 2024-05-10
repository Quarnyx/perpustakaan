<?php
include '../../config.php';

$id = $_POST["id"];
$sql = mysqli_query($conn, "SELECT * FROM petugas WHERE id = $id");
$row = mysqli_fetch_array($sql);

?>

<div class="row">
    <form class="" id="formPetugas" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input disabled type="text" class="form-control" id="username" name="username"
                        placeholder="Username" required="" value="<?= $row['username'] ?>">
                    <div class="error" id="namaError">

                    </div>
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
    $("#username").bind('keyup', function () {
        var username = $('#username').val();
        $.ajax({
            url: 'pages/petugas/proses-petugas.php?act=cekUsername',
            method: 'POST',
            data: { username: username },
            success: function (data) {
                $('#usernameError').show();
                $('#usernameError').html(data);
            }
        });
    });
    $("#nama_petugas").bind('keyup', function () {
        var nama_petugas = $('#nama_petugas').val();
        var textRegex = /^[a-zA-Z ]+$/;
        if (!textRegex.test(nama_petugas)) {
            $("#namaError").text("Nama hanya bisa mengandung huruf");
        }
    });
    $("#formPetugas").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/petugas/proses-petugas.php?act=updatepass",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                // alert(response);
                $("#formPetugas")[0].reset();
                $('#tabelPetugas').DataTable().ajax.reload();
                $('#modal').modal('hide');
            }
        });
    });
</script>