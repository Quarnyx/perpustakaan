<?php
include '../../config.php';

$id = $_POST["id"];
$sql = mysqli_query($conn, "SELECT * FROM anggota WHERE id = $id");
$row = mysqli_fetch_array($sql);

?>
<form class="" id="formAnggota" enctype="multipart/form-data">
    <div class="row">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>Foto
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-5">

                            <img id="preview" src="assets/images/users/<?php echo $row["foto"]; ?>" alt="avatar-5"
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
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama_anggota" placeholder="Nama Lengkap" required=""
                        name="nama_anggota" value="<?= $row['nama_anggota'] ?>">
                    <div class="error" id="namaError">

                    </div>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">NIS</label>
                    <input type="number" class="form-control" id="nis" placeholder="Nomor Induk Siswa" required=""
                        name="nis" value="<?= $row['nis'] ?>">
                    <div class="error" id="nisError">

                    </div>
                </div>
                <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                    <i class="mdi mdi-alert-circle-outline me-2"></i>
                    Disarankan menggunakan foto resolusi 300x300px (1:1)
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="tempat_lahir" placeholder="Tempat Lahir" required=""
                    name="tempat_lahir" value="<?= $row['tempat_lahir'] ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tanggal_lahir" placeholder="Tanggal Lahir" required=""
                    name="tanggal_lahir" value="<?= $row['tanggal_lahir'] ?>">
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label for="" class="form-label">Jenis Kelamin</label>
                <select class="form-select" id="jenis_kelamin" required="" name="jenis_kelamin">
                    <?php
                    if ($row['jenis_kelamin'] == 'Laki-laki') {
                        echo '<option selected="" value="Laki-laki">Laki-laki</option>';
                        echo '<option value="Perempuan">Perempuan</option>';
                    } else {
                        echo '<option value="Laki-laki">Laki-laki</option>';
                        echo '<option selected="" value="Perempuan">Perempuan</option>';
                    }
                    ?>
                </select>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="" class="form-label">No. Telepon</label>
                <input type="number" class="form-control" id="no_telp" placeholder="08xxxxxxx" required=""
                    name="no_telp" value="<?= $row['no_telp'] ?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input value="<?= $row['email'] ?>" type="email" class="form-control" id="email" placeholder="Email"
                    required="" name="email">
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-3">
                <label for="" class="form-label">Status Akun</label>
                <select class="form-select" id="" required="" name="status">
                    <?php
                    if ($row['status'] == 'aktif') {
                        echo '<option selected="" value="aktif">Aktif</option>';
                        echo '<option value="nonaktif">Nonaktif</option>';
                    } else {
                        echo '<option value="aktif">Aktif</option>';
                        echo '<option selected="" value="nonaktif">Nonaktif</option>';
                    }

                    ?>
                </select>

            </div>
        </div>
    </div>
    <div>
        <button class="btn btn-primary" type="submit" id="submit">Update</button>
    </div>
</form>
<script>
    $("#nis").bind('keyup', function () {
        var nis = $('#nis').val();
        $.ajax({
            url: 'pages/anggota/proses-anggota.php?act=cekNIS',
            method: 'POST',
            data: { nis: nis },
            success: function (data) {
                $('#nisError').show();
                $('#nisError').html(data);
            }
        });
    });
    $(document).on("click", "#pilih_foto", function () {
        var file = $(this).parents().find(".file");
        file.trigger("click");
    });

    $("#foto").change(function (e) {
        var fileName = e.target.files[0].name;
        $("#foto").val();

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
    $("#nama_anggota").bind('keyup', function () {
        var nama_petugas = $('#nama_anggota').val();
        var textRegex = /^[a-zA-Z ]+$/;
        if (!textRegex.test(nama_petugas)) {
            $("#namaError").text("Nama hanya bisa mengandung huruf");
        } else {
            $("#namaError").text("");
        }
    });
    $("#formAnggota").submit(function (e) {

        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/anggota/proses-anggota.php?act=updateAnggota",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                $("#formAnggota")[0].reset();
                $('#tabelAnggota').DataTable().ajax.reload();
                $('#modal').modal('hide');
            }
        });
    });
</script>