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
            <div class="col-lg-4">
                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>Foto
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-5">

                            <img src="assets/images/users/<?php echo $row['foto'] ?>" alt="avatar-5"
                                class="rounded-circle avatar-xl">

                        </div>
                        <h5 class="card-title">Ganti Foto</h5>
                        <div class="input-group">
                            <input type="hidden" name="foto_lama" value="<?= $row['foto'] ?>">
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas"
                                placeholder="Nama Lengkap" required="" value="<?= $row['nama_petugas'] ?>">
                            <div class="error" id="namaError">

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <select class="form-select" id="" required="" name="status">
                                <?php
                                if ($row['status'] === 'aktif') {
                                    ?>
                                    <option value="nonaktif">Non Aktif</option>
                                    <option selected="" value="aktif">Aktif</option>
                                    <?php
                                } else {
                                    ?>
                                    <option selected="" value="nonaktif">Non Aktif</option>
                                    <option value="aktif">Aktif</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                                required="" value="<?= $row['username'] ?>">
                            <div class="error" id="usernameError">

                            </div>
                        </div>
                    </div>

                </div>
                <div>
                    <button class="btn btn-primary" type="submit" id="submit">Update</button>
                </div>
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
            url: "pages/petugas/proses-petugas.php?act=updatePetugas",
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