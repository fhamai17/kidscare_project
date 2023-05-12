<?php include('session.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - นักเรียน</title>
    <?php include './layout/head.php' ?>
</head>

<body id="page-top" class="bg">

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
                            <h6 class="m-0 font-weight-bold text-info">รายการข้อมูลนักเรียน</h6>
                            <button class="btn btn-info" onclick="window.open('student_add_info.php')">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มข้อมูลนักเรียน</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="student_table">

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
            showStudentTable();
        });


        function showStudentTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_std_table2.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#student_table').html(data);
                    $('#studentDataTable').DataTable({
                        
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }
        
        function delStudent(id){
            console.log("School ID : "+id)
            Swal.fire({
                    title: 'ลบข้อมูลนักเรียน',
                    text: "คุณต้องการลบข้อมูลนักเรียนคนนี้หรือไม่?",
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
                            url: 'ajax_person_info/ajax_std_del.php',
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
                                        showStudentTable();
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