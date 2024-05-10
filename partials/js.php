<?php
if($_GET['page']=="dashboard" OR $_GET['page']=="reportsampah_sum" OR $_GET['page']=="reportbanksampah"){
?>
    <script>
        var totalrt_data = <?php echo $json_totalrt_data; ?> ;
        var ctxz = document.getElementById("sampahRTRW").getContext("2d");
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: true,
            datasetFill: false,
            scales: {
            xAxes: [{
                ticks: {
                    display: false
                }
            }]
        }
        }
        var totalCharta = new Chart(ctxz, {
            type: 'bar',
            data: {
                labels: totalrt_data.map(function (item) {
                    return item.rtrw_name;
                }),
                datasets: [{
                    label: 'Total',
                    data: totalrt_data.map(function (item) {
                        return item.totalperrt;
                    }),
                    backgroundColor: "rgba(58, 255, 200, 0.47)",
                    borderColor: "rgba(19, 187, 140, 0.8)",
                    borderWidth: 1,
                    hoverBackgroundColor: "rgba(255, 167, 58, 0.47)",
                    hoverBorderColor: "rgba(255, 167, 58, 1)"
                }]
            },
            options: barChartOptions
        });
    </script>
    <script>
        var totalbank_data = <?php echo $json_totalbank_data; ?> ;
        var ctxz = document.getElementById("banksampahchart").getContext("2d");
        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: true,
            datasetFill: false,
            scales: {
            xAxes: [{
                ticks: {
                    display: false
                }
            }]
        }
        }
        var totalCharta = new Chart(ctxz, {
            type: 'bar',
            data: {
                labels: totalbank_data.map(function (item) {
                    return item.product_name;
                }),
                datasets: [{
                    label: 'Total',
                    data: totalbank_data.map(function (item) {
                        return item.total_price;
                    }),
                    backgroundColor: "rgba(28, 187, 140, 0.8)",
                    borderColor: "rgba(28, 187, 140, 0.8)",
                    borderWidth: 1,
                    hoverBackgroundColor: "rgba(28, 187, 140, 0.9)",
                    hoverBorderColor: "rgba(28, 187, 140, 0.9)"
                }]
            },
            options: barChartOptions
        });
    </script>
<?php
}
if($_GET['page']=="role_user"){
?>
    <script>
        $(document).ready(function () {
            var currentPage = "<?php  echo $userData["tab_alias"];?>";
            var currentUpdate = <?php  echo $userData["can_update"];?>;
            var currentDelete = <?php  echo $userData["can_delete"];?>;
            var currentAdd = <?php  echo $userData["can_add"];?>;
            var dataTable = $('#roletable').DataTable({            
                serverMethod: 'post',
                select: {
                    style: "multi"
                },
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
                ajax: {
                    url: './pages/user/fetch_data.php?tabledata=roleuser',
                    type: 'POST',
                    dataType: 'json'
                },
                columns: [{
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'role_name',
                        className: 'mb-0 h6'
                    },
                    {
                        data: 'role_desc'
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            if (currentPage === "role_user" && currentUpdate === 1) {
                            return '<div class="button-items">' +
                                '<a href="?page=role_permission&roleid=' + row.role_id +'" type="button" class="btn btn-light waves-effect waves-light"><i class="ri-shield-keyhole-line align-middle me-2"></i> Hak Akses</a>' +
                                '<button type="button" class="btn btn-primary waves-effect waves-light edit-role" data-bs-toggle="modal" data-bs-target="#editRole" data-id="' + row.role_id + '" data-rolename="' + row.role_name + '"data-roledesc="' + row.role_desc +'"><i class="ri-edit-2-line align-middle me-2"></i> Edit</button>' +
                                '<button type="button" class="btn btn-danger waves-effect waves-light delete-role" data-id="' + row.role_id + '"><i class=" ri-delete-bin-line align-middle me-2"></i> Hapus</button>' +'</div>';
                        }else{
                            return "";
                        }}
                    }
                ]
            });

            // Edit button click event
            $('#roletable').on('click', '.delete-role', function () {
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Yakin ingin menghapus peran ini?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {                    
                        // Ajax config
                        $.ajax({
                            type: "POST", //we are using GET method to get data from server side
                            url: 'process.php?act=del_role', // get the route value
                            data: {
                                role_id: id
                            }, //set data
                            beforeSend: function () { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                            },
                            success: function (
                            response) { //once the request successfully process to the server side it will return result here
                                // Reload lists of employees
                                Swal.fire('Peran Terhapus', response, 'success');
                                $('#roletable').DataTable().ajax.reload();
                            }
                        });


                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });

                // Perform the edit action, e.g., open a modal or redirect to an edit page
                
            });

            // Delete button click event
            $('#roletable').on('click', '.edit-role', function () {
                var id = $(this).data('id');
                var rolename = $(this).data('rolename');
                var roledesc = $(this).data('roledesc');
                $("#editrole_name").val(rolename);
                $("#editdesc").val(roledesc);
                $("#role_id").val(id);
                // Perform the delete action, e.g., show a confirmation dialog and delete the record
                
            });
            $('#refreshBtn').click(function () {
                dataTable.ajax.reload();
            });
            $("#formaddRole").submit(function (e) {
                e.preventDefault(); //prevent the form from submitting normally

                //validate the form data
                var role = $("#role_name").val();
                var desc = $("#desc").val();

                var roleRegex = /^[a-zA-Z ]+$/;
                var descRegex = /^[a-zA-Z ]+$/;


                var errors = false;

                if (!roleRegex.test(role)) {
                    $("#roleError").text("Jabatan hanya bisa mengandung huruf");
                    errors = true;
                } else {
                    $("#roleError").html("");
                }

                if (!descRegex.test(desc)) {
                    $("#descError").text("Deskripsi hanya bisa mengandung huruf");
                    errors = true;
                } else {
                    $("#descError").html("");
                }

                //if there are errors, don't submit the form
                if (errors) {
                    return false;
                }

                //send the form data using AJAX
                var formData = $(this).serialize();

                $.ajax({
                    url: "process.php?act=addrole",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        //display the response from the server

                        $("#formaddRole")[0].reset();
                        $('#roletable').DataTable().ajax.reload();
                        $('#addRole').modal('hide');
                    }
                });
            });
            $("#formeditRole").submit(function (e) {
                e.preventDefault(); //prevent the form from submitting normally

                //validate the form data
                var roleid = $("#role_id").val();
                var editrole = $("#editrole_name").val();
                var editdesc = $("#editdesc").val();

                var editroleRegex = /^[a-zA-Z ]+$/;
                var editdescRegex = /^[a-zA-Z ]+$/;


                var errors = false;

                if (!editroleRegex.test(editrole)) {
                    $("#roleError").text("Jabatan hanya bisa mengandung huruf");
                    errors = true;
                } else {
                    $("#roleError").html("");
                }

                if (!editdescRegex.test(editdesc)) {
                    $("#descError").text("Deskripsi hanya bisa mengandung huruf");
                    errors = true;
                } else {
                    $("#descError").html("");
                }

                //if there are errors, don't submit the form
                if (errors) {
                    return false;
                }

                //send the form data using AJAX
                var formeditData = $(this).serialize();

                $.ajax({
                    url: "process.php?act=editrole",
                    type: "POST",
                    data: formeditData,
                    success: function (response) {
                        //display the response from the server

                        $("#formeditRole")[0].reset();
                        dataTable.ajax.reload();
                        $('#editRole').modal('hide');
                    }
                });
            });
        });
    </script>
<?php
}
if($_GET['page']=="role_permission"){
?>
    <script>
        $(document).ready(function () {
        
        $('#addperm').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        var formpermData = $(this).serialize(); // Serialize form data

        $.ajax({
          type: 'POST',
          url: 'process.php?act=addperm',
          data: formpermData,
          success: function(response) {
            // Handle success response
            location.reload();
          },
          error: function(xhr, status, error) {
            // Handle error response
            alert('Error: ' + error);
          }
        });
        });

        $('.delete-perm').on('click', function () {
            var id = $(this).data('id');
            var tab = $(this).data('tab');
            Swal.fire({
                icon: 'warning',
                title: 'Yakin ingin menghapus peran ini?',
                showDenyButton: false,
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {                    
                    // Ajax config
                    $.ajax({
                        type: "POST", //we are using GET method to get data from server side
                        url: 'process.php?act=del_perm', // get the route value
                        data: {
                            role_id: id,
                            tab_id: tab
                        }, //set data
                        beforeSend: function () { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                        },
                        success: function (
                        response) { //once the request successfully process to the server side it will return result here
                            // Reload lists of employees

                            Swal.fire('Peran Terhapus', response, 'success');
                            location.reload();
                        }
                    });


                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            });

            // Perform the edit action, e.g., open a modal or redirect to an edit page
            
        });
    });

    </script>
<?php
}
if($_GET['page']=="add_user"){
?>
    <script>
        $(document).ready(function () {       
            var currentPage = "<?php  echo $userData["tab_alias"];?>";
            var currentUpdate = <?php  echo $userData["can_update"];?>;
            var currentDelete = <?php  echo $userData["can_delete"];?>;
            var currentAdd = <?php  echo $userData["can_add"];?>;
            //human
            var dataTable = $('#usertable').DataTable({            
                serverMethod: 'post',
                select: {
                    style: "multi"
                },
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
                ajax: {
                    url: './pages/user/fetch_data.php?tabledata=user',
                    type: 'POST',
                    dataType: 'json'
                },
                columns: [{
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'name_user',
                        className: 'mb-0 h6'
                    },
                    {
                        data: 'username'
                    },
                    {
                        data: 'role_name'
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            if (currentPage === "role_user" && currentAdd === 1) {
                            return '<div class="button-items">' +
                                '<button type="button" class="btn btn-light waves-effect waves-light edituserpass" data-bs-toggle="modal" data-bs-target="#editUser" data-id="' +
                                row.user_id +
                                '"><i class="ri-key-2-line align-middle me-2"></i> Ganti Password</button>' +
                                '<button type="button" class="btn btn-danger waves-effect waves-light delete-user" data-id="' +
                                row.user_id +
                                '"><i class=" ri-delete-bin-line align-middle me-2"></i> Hapus</button>' +
                                '</div>';
                            }else{
                                return "";
                            }
                        }
                    }
                ]
            });
            // plushuman
            $("#formaddUser").submit(function (e) {
                e.preventDefault(); //prevent the form from submitting normally

                //validate the form data
                var name_user = $("#name_user").val();
                var username = $("#username").val();
                var role_id = $("#role_id").val();
                var password = $("#password").val();

                var textRegex = /^[a-zA-Z ]+$/;
                var passRegex = /^[A-Za-z]\w{7,14}$/;


                var errors = false;

                if (!textRegex.test(name_user)) {
                    $("#nameError").text("Nama hanya bisa mengandung huruf");
                    errors = true;
                } else {
                    $("#nameError").html("");
                }
                if (!textRegex.test(username)) {
                    $("#userError").text("Username hanya bisa mengandung huruf");
                    errors = true;
                } else {
                    $("#userError").html("");
                }                     

                if (!passRegex.test(password)) {
                    $("#passError").text("Minimal 7 karakter tanpa karakter spesial");
                    errors = true;
                } else {
                    $("#passError").html("");
                }

                //if there are errors, don't submit the form
                if (errors) {
                    return false;
                }

                //send the form data using AJAX
                var formuserData = $(this).serialize();

                $.ajax({
                    url: "process.php?act=adduser",
                    type: "POST",
                    data: formuserData,
                    success: function (response) {
                        //display the response from the server

                        $("#formaddUser")[0].reset();
                        $('#usertable').DataTable().ajax.reload();
                        $('#addUser').modal('hide');
                    }
                });
            });
            $('#usertable').on('click', '.delete-user', function () {
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Yakin ingin menghapus akun ini?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {                    
                        // Ajax config
                        $.ajax({
                            type: "POST", //we are using GET method to get data from server side
                            url: 'process.php?act=del_user', // get the route value
                            data: {
                                user_id: id
                            }, //set data
                            beforeSend: function () { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                            },
                            success: function (
                            response) { //once the request successfully process to the server side it will return result here
                                // Reload lists of employees
                                $('#usertable').DataTable().ajax.reload();

                                Swal.fire('Akun Terhapus', response, 'success')
                            }
                        });


                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });

                // Perform the edit action, e.g., open a modal or redirect to an edit page
                
            });
            $('#usertable').on('click', '.edituserpass', function () {
                var id = $(this).data('id');
                $("#user_id").val(id);
                // Perform the delete action, e.g., show a confirmation dialog and delete the record
                
            });
            $("#formeditUser").submit(function (e) {
                e.preventDefault(); //prevent the form from submitting normally
                console.log("asasa");
                //validate the form data
                var userid = $("#user_id").val();
                var editpassword = $("#editpass").val();
                var editpassRegex = /^[A-Za-z]\w{7,14}$/;


                var errors = false;

            
                if (!editpassRegex.test(editpassword)) {
                    $("#epassError").text("Minimal 7 karakter tanpa karakter spesial");
                    errors = true;
                } else {
                    $("#epassError").html("");
                }

                //if there are errors, don't submit the form
                if (errors) {
                    return false;
                }

                //send the form data using AJAX
                var formuserData = $(this).serialize();

                $.ajax({
                    url: "process.php?act=edit-user",
                    type: "POST",
                    data: formuserData,
                    success: function (response) {
                        //display the response from the server

                        $("#formeditUser")[0].reset();
                        dataTable.ajax.reload();
                        $('#editUser').modal('hide');
                    }
                });
            });

        });
    </script>
<?php
}
if($_GET['page']=="product_data"){
?>
    <script>
        $(document).ready(function () {       
            var currentPage = "<?php  echo $userData["tab_alias"];?>";
            var currentUpdate = <?php  echo $userData["can_update"];?>;
            var currentDelete = <?php  echo $userData["can_delete"];?>;
            var currentAdd = <?php  echo $userData["can_add"];?>;
            //human
            var dataTable = $('#producttable').DataTable({            
                serverMethod: 'post',
                select: {
                    style: "multi"
                },
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
                ajax: {
                    url: './pages/user/fetch_data.php?tabledata=product',
                    type: 'POST',
                    dataType: 'json'
                },
                columns: [{
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'product_name',
                        className: 'mb-0 h6'
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'product_qty'
                    },
                    {
                        data: 'unit'
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            if (currentPage === "product_data" && currentUpdate === 1) {
                            return '<div class="button-items">' +
                            '<button type="button" class="btn btn-primary waves-effect waves-light edit-product" data-bs-toggle="modal" data-bs-target="#editProduct" data-id="' + row.product_id + '" data-productname="' + row.product_name + '"data-price="' + row.price +'"data-stok="' + row.product_qty +'"><i class="ri-edit-2-line align-middle me-2"></i> Edit</button>' +
                                '<button type="button" class="btn btn-danger waves-effect waves-light delete-product" data-id="' +
                                row.product_id +
                                '"><i class=" ri-delete-bin-line align-middle me-2"></i> Hapus</button>' +
                                '</div>';
                        }else{
                            return "";
                        }}
                    }
                ]
            });
            $('#producttable').on('click', '.edit-product', function () {
                var product_name = $(this).data('productname');
                var id = $(this).data('id');
                var price = $(this).data('price');
                var stok = $(this).data('stok');
                $("#editproduct_id").val(id);
                $("#editproduct_name").val(product_name);
                $("#editprice").val(price);
                $("#editstok").val(stok);
                // Perform the delete action, e.g., show a confirmation dialog and delete the record
                
            });
            $("#formeditproduct").submit(function (e) {
                e.preventDefault(); //prevent the form from submitting normally

                //validate the form data
                var product_name = $("#editproduct_name").val();
                var price = $("#editprice").val();
                var unit = $("#editunit").val();
                var stok = $("#editstok").val();
                var id = $("#editproduct_id").val();

                var textRegex = /^[a-zA-Z ]+$/;
                


                var errors = false;

                if (!textRegex.test(product_name)) {
                    $("#editnameError").text("Nama hanya bisa mengandung huruf");
                    errors = true;
                } else {
                    $("#nameError").html("");
                }
              

                //if there are errors, don't submit the form
                if (errors) {
                    return false;
                }

                //send the form data using AJAX
                var formproductData = $(this).serialize();

                $.ajax({
                    url: "process.php?act=editproduct",
                    type: "POST",
                    data: formproductData,
                    success: function (response) {
                        //display the response from the server

                        $("#formeditproduct")[0].reset();
                        $('#producttable').DataTable().ajax.reload();
                        $('#editProduct').modal('hide');
                    }
                });
            });
            $('#producttable').on('click', '.delete-product', function () {
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Yakin ingin menghapus produk ini?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {                    
                        // Ajax config
                        $.ajax({
                            type: "POST", //we are using GET method to get data from server side
                            url: 'process.php?act=del_product', // get the route value
                            data: {
                                product_id: id
                            }, //set data
                            beforeSend: function () { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                            },
                            success: function (
                            response) { //once the request successfully process to the server side it will return result here
                                // Reload lists of employees
                                $('#producttable').DataTable().ajax.reload();

                                Swal.fire('Produk Terhapus', response, 'success')
                            }
                        });


                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });

                // Perform the edit action, e.g., open a modal or redirect to an edit page
                
            });
            $("#formaddproduct").submit(function (e) {
                e.preventDefault(); //prevent the form from submitting normally

                //validate the form data
                var product_name = $("#product_name").val();
                var price = $("#price").val();
                var unit = $("#unit").val();
                var stok = $("#stok").val();

                var textRegex = /^[a-zA-Z ]+$/;
                


                var errors = false;

                if (!textRegex.test(product_name)) {
                    $("#nameError").text("Nama hanya bisa mengandung huruf");
                    errors = true;
                } else {
                    $("#nameError").html("");
                }
              

                //if there are errors, don't submit the form
                if (errors) {
                    return false;
                }

                //send the form data using AJAX
                var formuserData = $(this).serialize();

                $.ajax({
                    url: "process.php?act=addproduct",
                    type: "POST",
                    data: formuserData,
                    success: function (response) {
                        //display the response from the server

                        $("#formaddproduct")[0].reset();
                        $('#producttable').DataTable().ajax.reload();
                        $('#addProduct').modal('hide');
                    }
                });
            });
        });
    </script>

<?php
}
if($_GET['page']=="datapel_sampah" OR $_GET['page']=="reportsampah_sum"){
?>
<script>
var totalcust_data = <?php echo $json_totalcust_data; ?>;
  var ctxz = document.getElementById("totalcust").getContext("2d");
  var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : true,
      datasetFill             : false,
      scales: {
            xAxes: [{
                ticks: {
                    display: false
                }
            }]
        }
    };
  var totalChart = new Chart(ctxz, {
        type: 'bar',
        data: {
            labels: totalcust_data.map(function(item) {
                return item.rtrw_name;
            }),
            datasets: [{
                label: 'Total',
                data: totalcust_data.map(function(item) {
                    return item.total;
                }),
                backgroundColor: 'rgba(58, 216, 255, 0.51)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
                hoverBackgroundColor: "rgba(255, 167, 58, 0.47)",
                    hoverBorderColor: "rgba(255, 167, 58, 1)"
            }]
        },
        options: barChartOptions
    });
</script>

<?php
}
if($_GET['page']=="data_wilayah"){
?>
<script>
    $('.edit-wilayah').on('click', function () {
                var blockname = $(this).data('blockname');
                var blockid = $(this).data('blockid');
                $(".block_name").val(blockname);
                $(".block_id").val(blockid);
                
            });
    $('.edit-rtrw').on('click', function () {
                var rtrw_name = $(this).data('rtrwname');
                var rtrw_id = $(this).data('rtrwid');
                $(".rtrw_name").val(rtrw_name);
                $(".rtrw_id").val(rtrw_id);               
                
            });
</script>

<?php
}
if($_GET['page']=="bank_sampah"){
?>
<script>
    $(document).ready(function () {
        var currentPage = "<?php  echo $userData["tab_alias"];?>";
        var currentUpdate = <?php  echo $userData["can_update"];?>;
        var currentDelete = <?php  echo $userData["can_delete"];?>;
        var currentAdd = <?php  echo $userData["can_add"];?>;
        
        var custid = "<?php  echo $_POST['cust_id']?>";
        var dataTable = $('#banksampah').DataTable({            
                serverMethod: 'post',
                select: {
                    style: "multi"
                },
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                },
                ajax: {
                    url: './pages/user/fetch_data.php?tabledata=banksampah&custid=' + custid,
                    type: 'POST',
                    dataType: 'json'
                },
                columns: [{
                        data: null,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'bs_payment_date',
                        className: 'mb-0 h6'
                    },
                    {
                        data: 'product_name'
                    },
                    {
                        data: 'qty'
                    },
                    {
                        data: 'unit'
                    },
                    {
                        data: 'total'
                    },
                    {
                        data: null,
                        render: function (data, type, row) {
                            if (currentPage === "bank_sampah" && currentDelete === 1) {
                            
                            return '<div class="button-items">' + 
                                '<button type="button" class="btn btn-danger waves-effect waves-light delete-trxprod" data-id="' +
                                row.banksampah_id +
                                '"><i class=" ri-delete-bin-line align-middle me-2"></i> Hapus</button>' +
                                '</div>';}else{
                                    return "";
                                }
                        }
                    }
                ]
            
            
            
        });
        $("#trxprod").submit(function (e) {
                e.preventDefault(); //prevent the form from submitting normally
                var currentPage = "<?php  echo $_GET["page"];?>";
                //validate the form data
                var product_id = $("#produk").val();
                var price = $("#price").val();
                var qty = $("#qty").val();
                var cust_id = $("#cust_id").val();
                var user_id = $("#user_id").val();

                
                //send the form data using AJAX
                var formuserData = $(this).serialize();

                $.ajax({
                    url: "process.php?act=input_banksampah&page=" + currentPage,
                    type: "POST",
                    data: formuserData,
                    success: function (response) {
                        //display the response from the serve                        
                        $('#banksampah').DataTable().ajax.reload();
                        
                    }
                });
            });
            $('#banksampah').on('click', '.delete-trxprod', function () {
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'warning',
                    title: 'Yakin ingin menghapus transaksi ini?',
                    showDenyButton: false,
                    showCancelButton: true,
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {                    
                        // Ajax config
                        $.ajax({
                            type: "POST", //we are using GET method to get data from server side
                            url: 'process.php?act=delete_banksampah', // get the route value
                            data: {
                                banksampah_id: id
                            }, //set data
                            beforeSend: function () { //We add this before send to disable the button once we submit it so that we prevent the multiple click

                            },
                            success: function (
                            response) { //once the request successfully process to the server side it will return result here
                                // Reload lists of employees
                                $('#banksampah').DataTable().ajax.reload();

                                Swal.fire('Transaksi Terhapus', response, 'success')
                            }
                        });


                    } else if (result.isDenied) {
                        Swal.fire('Changes are not saved', '', 'info')
                    }
                });

                // Perform the edit action, e.g., open a modal or redirect to an edit page
                
            });

        
    });
</script>

<?php
}
if($_GET['page']=="profile"){
?>
<script>
    $("#formeditUser").submit(function (e) {
                e.preventDefault(); //prevent the form from submitting normally
                
                //validate the form data
                var userid = $("#user_id").val();
                var editpassword = $("#editpass").val();
                var editpassRegex = /^[A-Za-z]\w{7,14}$/;


                var errors = false;

            
                if (!editpassRegex.test(editpassword)) {
                    $("#epassError").text("Minimal 7 karakter tanpa karakter spesial");
                    errors = true;
                } else {
                    $("#epassError").html("");
                }

                //if there are errors, don't submit the form
                if (errors) {
                    return false;
                }

                //send the form data using AJAX
                var formuserData = $(this).serialize();

                $.ajax({
                    url: "process.php?act=edit-user",
                    type: "POST",
                    data: formuserData,
                    success: function (response) {
                        //display the response from the server

                        $("#formeditUser")[0].reset();
                    }
                });
            });
</script>

<?php
}
?>