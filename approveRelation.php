<?php
include('session.php');
$type = $_SESSION['type'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - ความสัมพันธ์ผู้ปกครอง</title>
    <?php include './layout/head.php' ?>
    <style>
        .img-preview2 {
            width: 200px !important;
            height: 250px !important;
            object-fit: cover !important;
            background-color: #dfdfdf;
        }


        hr.vertical {
            width: 0px;
            height: 100%;
            /* or height in PX */
        }
    </style>
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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold">รายการคำร้องขอเป็นผู้ปกครอง</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                        <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link info active" href="#all">
                                    <i class="bi bi-list"></i> ทั้งหมด
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link" href="#pending"><i class="bi bi-hourglass-bottom"></i> อยู่ระหว่างรอ</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link success" href="#approve"><i class="bi bi-hand-thumbs-up"></i> อนุมัติ</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link danger" href="#reject"><i class="bi bi-hand-thumbs-down"></i> ไม่อนุมัติ</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active py-3" id="all">
                                    <div id="relation_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="pending">
                                    <div id="relation_pending_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="approve">
                                    <div id="relation_approve_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="reject">
                                    <div id="relation_reject_table">
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


    <!-- Modal Parent-->
    <div class="modal fade" id="parentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="leaveLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" id="modal_content">

        </div>
    </div>

    <!-- Modal Student-->
    <div class="modal fade" id="studentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="leaveLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" id="modal_stdContent">

        </div>
    </div>
    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>



    <?php include 'layout/script_foot.php' ?>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(document).ready(function() {
            showRelationTable();
            showPendingTable();
            showRejectTable();
            showApproveTable();
        });


        function showRelationTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_relation/ajax_relation_table.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#relation_table').html(data);
                    $('#relationDataTable').DataTable({
                        order:[1,"desc"]
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showPendingTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_relation/ajax_relation_table.php',
                data:{
                    status:"Pending"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#relation_pending_table').html(data);
                    $('#pendingDataTable').DataTable({
                        order:[1,"desc"]
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showApproveTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_relation/ajax_relation_table.php',
                data:{
                    status:"Approve"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#relation_approve_table').html(data);
                    $('#approveDataTable').DataTable({
                        order:[1,"desc"]
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        
        function showRejectTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_relation/ajax_relation_table.php',
                data:{
                    status:"Reject"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#relation_reject_table').html(data);
                    $('#rejectDataTable').DataTable({
                        order:[1,"desc"]
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showParentModal(parent_id) {
            $.ajax({
                type: 'POST',
                url: 'ajax_relation/ajax_parent_modal.php',
                data:{ parent_id },
                success: function(data) {
                    $("#modal_content").html(data);
                    $("#parentModal").modal('show');
                    //alert("Parent Info :" + data);
                    /* var obj = JSON.parse(data);
                    $("#p_career").html(obj.career);
                    $("#p_salary").html(obj.salary);
                    $("#p_email").html(obj.email);
                    $("#p_phone").html(obj.phone);
                    $("#p_line").html(obj.line_id);
                    $("#p_address").html(obj.address+" ตำบล"+obj.sub_district+" อำเภอ"+
                    obj.district+" จังหวัด"+obj.province+" รหัสไปรษณีย์ "+obj.zipcode);
                    $("#p_name").html(obj.pname+" "+obj.fname+" "+obj.lname);
                    if (obj.pic != null && obj.pic != "") {
                        $("#p_pic").attr('src', 'uploads/parent_pics/' + obj.pic);
                    } else {
                        $("#p_pic").attr('src', 'images/anonymous.jpg');
                    } */
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });

            

        }


        function showStudentModal(student_id) {
            $.ajax({
                type: 'POST',
                url: 'ajax_relation/ajax_student_modal.php',
                data:{ student_id },
                success: function(data) {
                    $("#modal_stdContent").html(data);
                    $("#studentModal").modal('show');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });

            

        }
    </script>

</body>

</html>