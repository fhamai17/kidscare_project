<?php include('session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - บุคลากร</title>
    <?php include './layout/head.php' ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include './layout/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include './layout/topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <h6 class="m-0 font-weight-bold text-info">รายการบุคลากร</h6>
                            <button class="btn btn-info" onclick="window.open('personnel_info.php')">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มบุคลากร</span>
                            </button>
                        </div>
                        <div class="card-body">

                        <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link info active" href="#all">
                                    <i class="bi bi-list"></i> ทั้งหมด
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link" href="#teacher"><i class="fas fa-chalkboard-teacher"></i> คุณครู</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link success" href="#exclusive"><i class="fas fa-book-reader"></i> ฝ่ายบริหาร</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link danger" href="#admin"><i class="fas fa-user-cog"></i> ผู้ดูแลระบบ</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active py-3" id="all">
                                    <div id="personnel_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="teacher">
                                    <div id="teacher_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="exclusive">
                                    <div id="exclusive_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="admin">
                                    <div id="admin_table">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include './layout/footer.php' ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>



    <?php include 'layout/script_foot.php' ?>
    <script>
        $(document).ready(function() {
            showAllTable();
        });


        function showAllTable(){ 
            showPersonnelTable();
            showTeacherTable();
            showExclusiveTable();
            showAdminTable();
        }

        function showPersonnelTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_per_table.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#personnel_table').html(data);
                    $('#personnelDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showTeacherTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_per_table.php',
                data:{
                    type:"teacher"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#teacher_table').html(data);
                    $('#teacherDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showExclusiveTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_per_table.php',
                data:{
                    type:"exclusive"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#exclusive_table').html(data);
                    $('#exclusiveDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showAdminTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_per_table.php',
                data:{
                    type:"admin"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#admin_table').html(data);
                    $('#adminDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function delPersonnel(id){
            console.log("Per ID : "+id)
            Swal.fire({
                    title: 'ลบข้อมูลบุคลากร',
                    text: "คุณต้องการลบข้อมูลบุคลากรนี้หรือไม่?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก',
                }).then((result) => {
                    if (result.isConfirmed) {

                        Swal.fire({
                            title: "กำลังโหลด...",
                            html: "กรุณารอสักครู่",
                            didOpen: function() {
                                Swal.showLoading()
                            }
                        })

                        $.ajax({
                            type: 'POST',
                            url: 'ajax_person_info/ajax_per_delete.php',
                            data: {
                                id
                            },
                            success: function(res) {
                                console.log("Res : "+res);
                                if (res.search("Successful") != -1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'ลบข้อมูลสำเร็จ!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        showAllTable();
                                    }) 
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'ลบข้อมูลไม่สำเร็จ!',
                                        text: 'กรุณาลองอีกครั้ง',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                };

                            },
                            error: function(err) {
                                alert("Error" + err)

                            }
                        });
                    }
                })
        }

    </script>

</body>

</html>