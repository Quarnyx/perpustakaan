<div class="row">
    <form class="" id="formPetugas" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_petugas" id="nama_petugas"
                        placeholder="Nama Lengkap" required="">
                    <div class="error" id="namaError">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Status</label>
                    <select class="form-select" id="" required="" name="status">
                        <option selected="" value="nonaktif">Non Aktif</option>
                        <option value="aktif">Aktif</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Foto Profil</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                        required="">
                    <div class="error" id="usernameError">

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        required="">
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit" id="submit">Tambah</button>
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

        //send the form data using AJAX
        // var formPetugas = $(this).serialize();

        $.ajax({
            url: "pages/petugas/proses-petugas.php?act=tambahPetugas",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                $("#formPetugas")[0].reset();
                $('#tabelPetugas').DataTable().ajax.reload();
                $('#modal').modal('hide');
            }
        });
    });
</script>