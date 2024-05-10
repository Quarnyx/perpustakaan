<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Manajemen Peran Pengguna</h4>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Peran Pengguna</h4>
                <div class="table-responsive">
                    <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Jabatan</th>
                                <th>Detail</th>
                                <th></th>
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>
                            <?php
                                $no=1;
                                $sqlk=mysqli_query($conn, "SELECT * FROM `roles` ");
                    
                                while($rsk=mysqli_fetch_array($sqlk)){
                            ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td>
                                    <h6 class="mb-0"><?php echo "$rsk[role_name]"; ?></h6>
                                </td>
                                <td><?php echo "$rsk[role_desc]"; ?></td>
                                <td>
                                    <div class="button-items">
                                        <button type="button" class="btn btn-light waves-effect waves-light">
                                            <i class="ri-shield-keyhole-line align-middle me-2"></i> Hak Akses
                                        </button>
                                        <button type="button" class="btn btn-primary waves-effect waves-light">
                                            <i class="ri-edit-2-line align-middle me-2"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger waves-effect waves-light delete-role" data-id=<?php echo $rsk['role_id'] ?>>
                                            <i class=" ri-delete-bin-line align-middle me-2"></i> Hapus
                                        </button>
                                    </div>
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
                <div style="margin-top:5px">
                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#addRole">
                        <i class="ri-add-box-line align-middle me-2"></i> Tambah Peran
                    </button>
                </div>
                <div id="addRole" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myRoleLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myRoleLabel">Tambah Peran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="" id="formaddRole">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Jabatan</label>
                                                <input type="text" class="form-control" id="role_name"
                                                    placeholder="First name" name="role_name" required>
                                                    <span class="error" id="roleError"></span>                                                
                                            </div>
                                        </div>                                       
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Deskripsi</label>
                                                <textarea required="" name="desc" class="form-control" rows="5" id="desc"></textarea>
                                                <span class="error" id="descError"></span>                                
                                            </div>
                                        </div>                                        
                                    </div>
                                    
                                    <div>
                                        <button class="btn btn-primary" type="submit">Tambah</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div><!-- end card -->
        </div>
        <!-- end card -->
    </div> <!-- end col -->


</div>
<!-- end row -->