<?php
include '../../config.php';
session_start();

$query = mysqli_query($conn, "SELECT * FROM v_pinjambuku WHERE id = '$_POST[id]'");
$data = mysqli_fetch_array($query);
$tanggal_kembali = $data['tanggal_kembali'];
$tanggal_pengembalian = date('Y-m-d');
$selisiha = strtotime($tanggal_pengembalian) - strtotime($tanggal_kembali);
$selisih = $selisiha / (60 * 60 * 24);
$denda = 0;
if ($selisih > 0) {
    $denda = $selisih * 500;
}
?>
<div class="row">
    <form class="" id="formPengembalian" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode Peminjaman</label>
                    <input type="text" class="form-control" name="peminjaman_id" id="peminjaman_id" disabled
                        value="<?= $data['kode_pinjam']; ?>">
                    <input type="hidden" class="form-control" name="peminjaman_id" id="peminjaman_id"
                        value="<?= $_POST['id']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" name="nama_buku" id="nama_buku" disabled
                        value="<?= $data['nama_buku']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Kembali</label>
                    <input type="text" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                        placeholder="tanggal_kembali" required="" value="<?= $data['tanggal_kembali']; ?>" disabled>
                    <input type="hidden" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                        placeholder="tanggal_kembali" required="" value="<?= $data['tanggal_kembali']; ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Pengembalian</label>
                    <input type="text" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian"
                        required="" value="<?= date('Y-m-d'); ?>" disabled>
                    <input type="hidden" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian"
                        required="" value="<?= date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="" class="form-label">Denda</label>
                    <input type="text" class="form-control" id="denda" name="denda" placeholder="Denda" required=""
                        value="<?= $denda; ?>">
                </div>
            </div>
            <input type="hidden" name="petugas_id" id="petugas_id" value="<?php echo $_SESSION['id']; ?>">
        </div>
        <?php if ($denda > 0) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="mdi mdi-block-helper me-2"></i>
                Telat pengembalian buku selama <?= $selisih; ?> hari, terkena denda sebesar Rp. <?= $denda; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>
        <div>
            <button class="btn btn-primary" type="submit" id="submit">Simpan</button>
        </div>
    </form>
</div>
<script>
    $("#formPengembalian").submit(function (e) {
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            url: "pages/pengembalian/proses-pengembalian.php?act=simpanPengembalian",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                //display the response from the server
                console.log(response);

                $("#formPengembalian")[0].reset();
                $('#tabelPinjam').DataTable().ajax.reload();
                $('#modal').modal('hide');
            }
        });
    });
</script>