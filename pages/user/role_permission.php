<?php
                $validator = new Validator($conn);
                    if ($validator->validateUser($userid, 'role_user', 'can_update', '1')) {
                        
                ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Hak Akses Pengguna</h4>

        </div>
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <?php
            $sqla=mysqli_query($conn, "SELECT * FROM `roles` WHERE role_id='$_GET[roleid]' ");
            $row = mysqli_fetch_assoc($sqla);
            
            ?>
            <h1 class="mb-sm-0"><?php echo $row["role_name"];?></h4>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Pengaturan Hak Akses</h4>
                <div class="table-responsive">
                    <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Halaman</th>
                                <th>Lihat Data</th>
                                <th>Tambah Data</th>
                                <th>Ubah Data</th>
                                <th>Hapus Data</th>
                                <th>Laporan</th>
                                <th></th>
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>
                            <?php
                                $no=1;
                                $sqlb=mysqli_query($conn, "SELECT * FROM `v_rp` WHERE role_id = '$_GET[roleid]' ");
                    
                                while($rsb=mysqli_fetch_array($sqlb)){
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td class="icon-demo-content">
                                    <h6 class="mb-0"><?php echo "$rsb[tab_name]"; ?></h6>
                                </td>
                                <td class="icon-demo-content">
                                    <?php
                                    if($rsb["can_read"]=="1"){
                                    ?>
                                    <i class="ri-check-fill" style="color:#00cd00"></i>
                                    <?php
                                    }else{                                                                     
                                    ?>
                                    <i class="ri-close-fill" style="color:red"></i>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="icon-demo-content">
                                    <?php
                                    if($rsb["can_add"]=="1"){
                                    ?>
                                    <i class="ri-check-fill" style="color:#00cd00"></i>
                                    <?php
                                    }else{                                                                     
                                    ?>
                                    <i class="ri-close-fill" style="color:red"></i>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="icon-demo-content">
                                    <?php
                                    if($rsb["can_update"]=="1"){
                                    ?>
                                    <i class="ri-check-fill" style="color:#00cd00"></i>
                                    <?php
                                    }else{                                                                     
                                    ?>
                                    <i class="ri-close-fill" style="color:red"></i>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="icon-demo-content">
                                    <?php
                                    if($rsb["can_delete"]=="1"){
                                    ?>
                                    <i class="ri-check-fill" style="color:#00cd00"></i>
                                    <?php
                                    }else{                                                                     
                                    ?>
                                    <i class="ri-close-fill" style="color:red"></i>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td class="icon-demo-content">
                                    <?php
                                    if($rsb["can_report"]=="1"){
                                    ?>
                                    <i class="ri-check-fill" style="color:#00cd00"></i>
                                    <?php
                                    }else{                                                                     
                                    ?>
                                    <i class="ri-close-fill" style="color:red"></i>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                <button type="button" class="btn btn-danger waves-effect waves-light delete-perm" data-id=<?php echo $rsb['role_id'] ?> data-tab=<?php echo $rsb['tab_id'] ?>>
                                <i class=" ri-delete-bin-line align-middle me-2"></i></button>
                                </td>
                            </tr>
                            <?php
                            $no++;
                                }
                            ?>
                            <!-- end -->
                        </tbody><!-- end tbody -->
                    </table> <!-- end table -->
                </div>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->


</div>
<!-- end row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="" id="addperm">
                    <h4 class="card-title mb-4">Tambah Hak Akses</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $_GET['roleid'] ?>" name="role_id">
                                <label>Halaman</label>
                                <select class="form-control select2bs4" style="width: 100%;" name="tab_id">
                                    <?php
                                        $sql=mysqli_query($conn, "select * from tabs");                                
                                        while($rs=mysqli_fetch_array($sql)){
                                    ?>
                                    <option value="<?php echo"$rs[tab_id]";  ?>"><?php echo"$rs[tab_name]";  ?>
                                    </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-4 mt-lg-0">
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="square-switch">
                                        <p>Lihat Data</p>
                                        <input type="checkbox" id="square-switch1" switch="bool" checked="" name="canread" value="1">
                                        <label for="square-switch1" data-on-label="On" data-off-label="Off"></label>
                                    </div>
                                    <div class="square-switch">
                                        <p>Tambah Data</p>
                                        <input type="checkbox" id="square-switch2" switch="bool" checked="" name="canadd" value="1">
                                        <label for="square-switch2" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                    <div class="square-switch">
                                        <p>Ubah Data</p>
                                        <input type="checkbox" id="square-switch3" switch="bool" checked="" name="canedit" value="1">
                                        <label for="square-switch3" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                    <div class="square-switch">
                                        <p>Hapus Data</p>
                                        <input type="checkbox" id="square-switch4" switch="bool" checked="false" name="candelete" value="1">
                                        <label for="square-switch4" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                    <div class="square-switch">
                                        <p>Laporan</p>
                                        <input type="checkbox" id="square-switch5" switch="bool" checked="" name="report" value="1">
                                        <label for="square-switch5" data-on-label="Yes" data-off-label="No"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top:5px">
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="ri-add-box-line align-middle me-2"></i> Tambah Hak Akses
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- end card -->
    </div> <!-- end col -->


</div>

<!-- end row -->
<?php
                    }
?>