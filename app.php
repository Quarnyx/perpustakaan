<?php
session_start();
$level = $_SESSION['level'];
$sessionid = $_SESSION['id'];

if (!isset($_SESSION['username'])) {
    header("location:login.php?pass=invalid");
}
include "config.php";
$pager = $_GET['page'];

?>
<!doctype html>
<html lang="en">

<?php include "partials/head.php"; ?>

<body data-topbar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php include "partials/header.php"; ?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include "partials/sidebar.php"; ?>
        <!-- Left Sidebar End -->
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <script src="assets/libs/jquery/jquery.min.js"></script>
                    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <!-- Required datatable js -->
                    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
                    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
                    <!-- Buttons examples -->
                    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
                    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
                    <script src="assets/libs/jszip/jszip.min.js"></script>
                    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
                    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
                    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
                    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
                    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

                    <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
                    <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
                    <!-- apexcharts -->
                    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
                    <!-- Main Content Start Here -->
                    <?php include "partials/content.php"; ?>
                    <!-- Content End -->
                </div>
            </div>
            <!-- End Page-content -->
            <!-- Footer -->
            <?php include "partials/footer.php"; ?>
            <!-- End Footer -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <!-- Right Sidebar -->
    <div class="right-bar">
        <div data-simplebar class="h-100">
            <div class="rightbar-title d-flex align-items-center px-3 py-4">
                <h5 class="m-0 me-2">Pengaturan</h5>
                <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                    <i class="mdi mdi-close noti-icon"></i>
                </a>
            </div>
            <!-- Settings -->
            <hr class="mt-0" />

            <div class="p-4 mb-2">
                <button type="button" class="btn btn-setting btn-success waves-effect waves-light"
                    data-bs-toggle="modal">
                    <i class="ri-add-box-line align-middle me-2"></i> Setting Profil
                </button>
            </div>
            <h6 class="text-center mb-0">Pilih Tema</h6>
            <div class="p-4">

                <div class="mb-2">
                    <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                    <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                </div>
                <div class="mb-2">
                    <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch"
                        data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
                    <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                </div>
            </div>
        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <div id="setting" class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="judul"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="setting-app">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger  waves-effect" data-bs-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- JAVASCRIPT -->

    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/select2/js/select2.min.js"></script>


    <!-- Chart JS -->
    <script src="assets/libs/chart.js/Chart.bundle.min.js"></script>
    <script src="assets/js/pages/chartjs.init.js"></script>


    <!-- jquery.vectormap map -->
    <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>



    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->

    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- <script src="assets/js/pages/dashboard.init.js"></script> -->
    <script src="assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="assets/js/pages/form-validation.init.js"></script>

    <!-- Sweet Alerts js -->
    <script src="assets/libs/sweetalert2/sweetalert2.min.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
        $('.btn-setting').on('click', function () {
            $.ajax({
                url: 'pages/setting.php',
                method: 'post',
                success: function (data) {
                    $('#setting-app').html(data);
                    document.getElementById("judul").innerHTML = 'Setting';
                }
            });
            $('#setting').modal('show');
        });
    </script>



</body>

</html>