<?php
include '../../config.php';

$query = mysqli_query($conn, "SELECT max(id) as kodeTerbesar FROM supplier");
$data = mysqli_fetch_array($query);
$kode_supplier = $data['kodeTerbesar'];
$kode_supplier++;
$huruf = "SUP";
$kodesupplier = $huruf . sprintf("%03s", $kode_supplier);
?>
<div class="row">
    <form class="" id="formSupplier" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Supplier</label>
                    <input type="text" class="form-control" name="kode_supplier" id="kode_supplier" disabled
                        value="<?= $kodesupplier; ?>">
                    <input type="hidden" class="form-control" name="kode_supplier" id="kode_supplier"
                        value="<?= $kodesupplier; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Supplier</label>
                    <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                        placeholder="Nama Supplier" required="">
                    <div class="error" id="supplierError">

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
    $("#nama_supplier").bind('keyup', function () {
        var nama_petugas = $('#nama_supplier').val();
        var textRegex = /^[a-zA-Z ]+$/;
        if (!textRegex.test(nama_petugas)) {
            $("#supplierError").text("Nama hanya bisa mengandung huruf");
        } else {
            $("#supplierError").text("");
        }
    });
    $("#formSupplier").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/supplier/proses-supplier.php?act=tambahSupplier",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                $("#formSupplier")[0].reset();
                $('#tabelSupplier').DataTable().ajax.reload();
                $('#modal').modal('hide');
            }
        });
    });
</script>