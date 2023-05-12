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
    <title>KidCare - Parent</title>
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
                        <h1 class="h3 mb-0 text-info font-weight-bold" id="attendanceText">รายการมาเรียนย้อนหลัง</h1>
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

                                    <div class="form-group col-sm-3 mb-3">
                                        <label>วันที่</label>
                                        <div class="datepicker date input-group">
                                            <input type="text" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control " id="date_search" name="date_search">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-sm-2 mb-4 mt-3">
                                        <div class="input-group mt-3">
                                            <button class="btn btn-info" onclick="showAttendanceTable()">
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
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="attendance_table">

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
        var student_id = "<?= $student_id ?>"
        $(document).ready(function() {
            $('.datepicker').datepicker({
                todayHighlight: true,
                clearBtn: true,
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            //$('.datepicker').datepicker('setDate', 'today');
            getStudentName();
            showAttendanceTable();
        });


        function showAttendanceTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_attendance/ajax_attendance_ptable.php',
                data: {
                    student_id,
                    date: $("#date_search").val(),
                },
                async: false,
                success: function(data) {
                    console.log("Attendance table  :" + data)
                    $('#attendance_table').html(data);
                    $('#attDataTable').DataTable({
                        order: [
                            [2, 'desc']
                        ],
                        pageLength: 10,
                        lengthMenu: [
                            [5, 10, 20, -1],
                            [5, 10, 20, 'Todos']
                        ]
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
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
                        $("#attendanceText").html("รายการมาเรียนย้อนหลัง " + obj.student_name);
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