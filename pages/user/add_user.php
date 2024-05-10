<?php
                $validator = new Validator($conn);
                $userData = $validator->validateUser($userid, 'role_user', 'can_add', '1');
                    if ($userData) {
                        
                ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Tambah Pengguna</h4>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Data Pengguna</h4>
                <div class="table-responsive">

                    <table id="usertable" class="table dt-responsive nowrap w-100">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Hak Akses</th>
                                <th></th>
                            </tr>
                        </thead><!-- end thead -->
                        <tbody>

                            <!-- end -->
                        </tbody><!-- end tbody -->
                    </table> <!-- end table -->
                </div>

                <div style="margin-top:5px">
                    <button type="button" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                        data-bs-target="#addUser">
                        <i class="ri-add-box-line align-middle me-2"></i> Tambah Pengguna
                    </button>
                </div>
                <div id="addUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myRoleLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myRoleLabel">Tambah Pengguna</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="" id="formaddUser">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom01" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="name_user"
                                                    placeholder="Nama Pengguna" name="name_user" required>
                                                <span class="error" id="nameError"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom02" class="form-label">Username</label>
                                                <input type="text" class="form-control" id="username"
                                                    placeholder="Username" name="username" required>
                                                <span class="error" id="userError"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom03" class="form-label">Hak Akses</label>
                                                <select class="form-select" name="role_id" id="role_id">
                                                    <?php
                                                        $sql=mysqli_query($conn, "select * from roles");                                
                                                        while($rs=mysqli_fetch_array($sql)){
                                                    ?>
                                                    <option value="<?php echo"$rs[role_id]";  ?>"><?php echo"$rs[role_name]";  ?>
                                                    </option>
                                                    <?php } ?>
                                                </select>
                                                <span class="error" id="roleError"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label for="validationCustom04" class="form-label">Password</label>
                                                <input type="text" class="form-control" id="password"
                                                    placeholder="Password" name="password" required>
                                                <span class="error" id="passError"></span>
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
                <!-- edit role modal -->
                <div id="editUser" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myRoleLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myRoleLabel">Ganti Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="" id="formeditUser">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="mb-3">
                                                <label class="form-label">Password Baru</label>
                                                <input type="text" class="form-control" id="editpass"
                                                    placeholder="Password" name="editpass" required>
                                                    
                                                <span class="error" id="epassError"></span>
                                                <input type="hidden" class="form-control" id="user_id"
                                                     name="user_id" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <button class="btn btn-primary" type="submit">Ganti</button>
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
<?php
                    }
?>