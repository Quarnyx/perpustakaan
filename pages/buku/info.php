<?php
session_start();
$sessionid = $_SESSION['id'];
include '../../config.php';
$sql = mysqli_query($conn, "select * from v_buku where id = $_POST[id]");
$row = mysqli_fetch_array($sql);
?>
<form class="" id="formBuku" enctype="multipart/form-data">
    <div class="row">
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

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul" placeholder="Judul Buku" required="" name="judul"
                        value="<?php echo $row['nama_buku'] ?>" disabled>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahun" placeholder="Tahun" required=""
                            name="tahun" value="<?php echo $row['tahun'] ?>" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="" class="form-label">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" placeholder="Penerbit" required=""
                            value="<?php echo $row['nama_penerbit'] ?>" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="text" class="form-control" id="penulis" placeholder="Penulis" required=""
                            value="<?php echo $row['nama_penulis'] ?>" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" class="form-control" id="supplier" placeholder="Supplier" required=""
                            value="<?php echo $row['nama_supplier'] ?>" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="halaman" class="form-label">Jumlah Halaman</label>
                        <input type="number" class="form-control" id="halaman" placeholder="Jumlah Halaman" required=""
                            name="halaman" value="<?php echo $row['halaman'] ?>" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dimensi" class="form-label">Dimensi</label>
                        <input type="text" class="form-control" id="dimensi" placeholder="99cm x 99cm " required=""
                            name="dimensi" value="<?php echo $row['dimensi'] ?>" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <input type="text" class="form-control" id="kategori" placeholder="Kategori" required=""
                            value="<?php echo $row['nama_kategori'] ?>" disabled>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="rak" class="form-label">Nomor Rak</label>
                        <input type="text" id="rak" class="form-control" placeholder="A001" required="" name="rak"
                            value="<?php echo $row['rak'] ?>" disabled>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" id="stok" class="form-control" placeholder="99" required="" name="stok"
                            value="<?php echo $row['stok'] ?>" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                QR Code
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img class="rounded me-2" width="150"
                                            src="assets/images/qrcode/buku-<?php echo $row['kode_buku'] ?>.png"
                                            alt="Card image cap">
                                    </div>
                                    <div class="col-md-6" style="align-content:center">

                                        <p>Buku ini milik Perpustakaan SMANCEP</p>
                                        <a class="btn btn-primary" target="_blank"
                                            href="pages/buku/cetak.php?id=<?php echo $row['id'] ?>&count=<?php echo $row['stok'] ?>">Print
                                            QR
                                            Code</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>