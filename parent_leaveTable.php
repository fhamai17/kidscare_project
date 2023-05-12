<?php
include('session.php');
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
} else {
    $student_id = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>KidCare - ลาเรียน</title>
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold" id="leaveText">รายการคำร้องการลาของฉัน</h1>
                        <button class="d-sm-inline-block btn btn-info" onclick="window.open('parent_leaveForm.php')">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus-square"></i>
                            </span>
                            <span class="text">ส่งคำร้องลาเรียน</span>
                        </button>

                    </div>


                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Header - Accordion -->
                        <a href="#collapseCardExample" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h6 class="m-0 font-weight-bold text-info">ตัวกรอง</h6>
                        </a>
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">
                                <div class="row">


                                    <div class="col-sm-4">

                                        <label>วันที่ลา</label>
                                        <div class="datepicker date input-group">
                                            <input type="text" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control " name="leave_date" id="leave_date">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>

                                        </div>
                                    </div>



                                    <div class="col-sm-2 mb-4 mt-3">
                                        <div class="input-group mt-3">
                                            <button class="btn btn-info" onclick="showPLeaveTable()">
                                                <span class="text">ค้นหา</span>
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- DataTales Example -->
                    <div class="card shadow mt-4 mb-4">
                        <div class="card-body">
                            <div id="leave_table">

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

    <!-- Modal Edit-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>

    <?php include 'layout/script_foot.php' ?>
    <script>
        var student_id = "<?= $student_id ?>";
        $(document).ready(function() {
            showPLeaveTable();
            getStudentName();
            $('.datepicker').datepicker({
                todayHighlight: true,
                clearBtn: true,
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        })

        function showPLeaveTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_leave/ajax_pleave_table.php',
                data: {
                    student_id,
                    date:$("#leave_date").val()
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#leave_table').html(data);
                    $('#leaveDataTable').DataTable({});
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }



        function delLeave(id) {
            //alert("DELETE " + id)
            Swal.fire({
                title: 'ลบข้อมูลการลา',
                text: "คุณต้องการลบแบบฟอร์มการลานี้หรือไม่?",
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
                        url: 'ajax_leave/ajax_leave_del.php',
                        data: {
                            id
                        },
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
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


        function editOrViewLeave(id) {
            alert("EDIT " + id)
            location.href = 'parent_leaveForm.php?leave_id=' + id;
        }


        function getStudentName() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_student_name.php',
                data: {
                    student_id
                },
                async: false,
                success: function(data) {
                    console.log("Student Name :" + data)
                    const obj = JSON.parse(data);
                    if (data) {
                        $("#leaveText").html("คำร้องลาเรียนของ " + obj.student_name);
                    }

                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }
    </script>

</body>

</html>