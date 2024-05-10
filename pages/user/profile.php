<?php
                
                        
                ?>
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Profile</h4>

        </div>
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <?php
            $sqla=mysqli_query($conn, "SELECT * FROM `user` WHERE user_id='$_SESSION[user_id]' ");
            $row = mysqli_fetch_assoc($sqla);
            
            ?>
            <h1 class="mb-sm-0"><?php echo $row["name_user"];?></h4>

        </div>
    </div>
</div>
<!-- end page title -->

<!-- end row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form class="" id="formeditUser">
                    <h4 class="card-title mb-4">Ganti Password</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="hidden" value="<?php echo $_SESSION['user_id'] ?>" id="user_id" name="user_id">
                                <label>Password Baru</label>
                                <input type="text" class="form-control" id="editpass" placeholder="Password" name="editpass" required>
                                <span class="error" id="epassError"></span>
                            </div>
                        </div>
                        
                    </div>
                    <div style="margin-top:5px">
                        <button type="submit" class="btn btn-success waves-effect waves-light">
                            <i class="ri-key-2-line align-middle me-2"></i> Ganti Password
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
                    
?>