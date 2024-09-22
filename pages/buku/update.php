<?php
session_start();
$sessionid = $_SESSION['id'];
include '../../config.php';
$sql = mysqli_query($conn, "select * from v_buku where id = $_POST[id]");
$row = mysqli_fetch_array($sql);
?>
<form class="" id="formBuku" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id" value="<?= $row['id']; ?>">
    <div class="row">
        <input type="hidden" name="user" id="user" value="<?= $sessionid; ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="card border border-primary">
                    <div class="card-header bg-transparent border-primary">
                        <h5 class="my-0 text-primary"><i class="mdi mdi-bullseye-arrow me-3"></i>Cover Buku
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-5">

                            <img id="preview" src="assets/images/books/<?php echo $row['cover'] ?>" alt="avatar-5"
                                class="card-img-top img-fluid" width="100">

                        </div>
                        <h5 class="card-title">Pilih Cover</h5>
                        <div class="input-group">
                            <input type="file" class="form-control" id="foto" name="foto">
                            <input type="hidden" class="form-control" id="cover" name="foto_lama"
                                value="<?php echo $row['cover'] ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul" placeholder="Judul Buku" required="" name="judul"
                        value="<?php echo $row['nama_buku'] ?>">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun" placeholder="Tahun" required=""
                            name="tahun" value="<?php echo $row['tahun'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">Penerbit</label>
                        <select id="penerbit" class="form-select form-control select2" name="penerbit"
                            data-placeholder="Pilih Penerbit">
                            <?php
                            include '../../config.php';
                            //Perintah sql untuk menampilkan semua data pada tabel penerbit
                            $sql = "select * from penerbit";

                            $hasil = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($hasil)):
                                ?>
                                <option value="<?php echo $data['id']; ?>" <?php echo ($row['penerbit_id'] == $data['id']) ? 'selected' : ''; ?>>
                                    <?php echo $data['nama_penerbit']; ?>
                                </option>
                                <?php
                            endwhile;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <select id="penulis" class="form-select form-control select2" name="penulis"
                            data-placeholder="Pilih Penulis">
                            <?php
                            include '../../config.php';
                            //Perintah sql untuk menampilkan semua data pada tabel penerbit
                            $sql = "select * from penulis";

                            $hasil = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($hasil)):
                                ?>
                                <option value="<?php echo $data['id']; ?>" <?php echo ($row['penulis_id'] == $data['id']) ? 'selected' : ''; ?>>
                                    <?php echo $data['nama_penulis']; ?>
                                </option>
                                <?php
                            endwhile;
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <select id="supplier" class="form-select form-control select2" name="supplier"
                            data-placeholder="Pilih Supplier">
                            <?php
                            include '../../config.php';
                            //Perintah sql untuk menampilkan semua data pada tabel penerbit
                            $sql = "select * from supplier";

                            $hasil = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($hasil)):
                                ?>
                                <option value="<?php echo $data['id']; ?>" <?php echo ($row['supplier_id'] == $data['id']) ? 'selected' : ''; ?>>
                                    <?php echo $data['nama_supplier']; ?>
                                </option>
                                <?php
                            endwhile;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="halaman" class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" id="halaman" placeholder="Jumlah Halaman" required=""
                            name="halaman" value="<?php echo $row['halaman'] ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dimensi" class="form-label">Dimensi</label>
                        <input type="text" class="form-control" id="dimensi" placeholder="99cm x 99cm " required=""
                            name="dimensi" value="<?php echo $row['dimensi'] ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select id="kategori" class="form-select form-control select2" name="kategori"
                            data-placeholder="Pilih Kategori">
                            <?php
                            //Perintah sql untuk menampilkan semua data pada tabel penerbit
                            $sql = "select * from kategori";

                            $hasil = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($hasil)):
                                ?>
                                <option data-rak="<?php echo $data['kode_kategori']; ?>" value="<?php echo $data['id']; ?>"
                                    <?php echo ($row['kategori_id'] == $data['id']) ? 'selected' : ''; ?>>
                                    <?php echo $data['nama_kategori']; ?>
                                </option>
                                <?php
                            endwhile;
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rak" class="form-label">Nomor Rak</label>
                        <input type="text" id="rak" class="form-control" placeholder="A001" required="" name="rak"
                            value="<?php echo $row['rak'] ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" id="stok" class="form-control" placeholder="99" required="" name="stok"
                            value="<?php echo $row['stok'] ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <button class="btn btn-primary" type="submit" id="submit">Update</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        // $('#penerbit').select2();
    });
    $("#kategori").change(function () {
        var rak = $(this).find(':selected').data('rak');
        $('#rak').val(rak);
    });
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
    $("#formBuku").submit(function (e) {

        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/buku/proses-buku.php?act=updateBuku",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                location.reload();
                //display the response from the server
                $("#formBuku")[0].reset();
                $('#modal').modal('hide');

            }
        });
    });
</script>