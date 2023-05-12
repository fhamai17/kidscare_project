<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>KidsCare - จัดการข้อมูลการลา</title>
    <?php include './layout/head.php' ?>
    <style>
       .input-group .bootstrap-select.form-control .dropdown-toggle {
     border-radius: 5px; 
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
                <?php
                print_r($_SESSION);
                ?>
                <!-- Topbar -->
                <?php include './layout/topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold">คำร้องขอลาเรียน</h1>
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
                                    <div class="col-sm-2">
                                        <label>ปีการศึกษา</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="session_search" id="session_search" title="ปีการศึกษา" onchange="showTermSearchList()">
                                                <option value="" selected>ทั้งหมด</option>';
                                            </select>
                                            <!--  <div class="input-group-append">
                                                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                </div> -->
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <label>เทอม</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="term_search" id="term_search" title="เทอม" onchange="showClassSearchList()">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                            <!--  <div class="input-group-append">
                                                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                </div> -->
                                        </div>
                                    </div>


                                    <div class="col-sm-2">
                                        <label>ห้อง</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="class_search" id="class_search" title="ห้องเรียน">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                            <!--  <div class="input-group-append">
                                                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                </div> -->
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label>ประเภทการลา</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker mr-4" name="type_search" id="type_search" title="ประเภทการลา" style="border-radius: 10px;">
                                                <option value="" selected>ทั้งหมด</option>;
                                                <option value="ลากิจ">ลากิจ</option>;
                                                <option value="ลาป่วย">ลาป่วย</option>;
                                            </select>
                                            <button class="btn btn-info" onclick="showAllLeaveTable(),showPendingLeaveTable(),showApproveLeaveTable(),showRejectLeaveTable()">
                                                <span class="text">ค้นหา</span>
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </button>
                                            <!--  <div class="input-group-append">
                                                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                </div> -->
                                        </div>
                                    </div>
<!-- 
                                    <div class="col-sm-2">
                                        <label>a</label>
                                        <div class="input-group">
                                            <button class="btn btn-info" onclick="showAllLeaveTable(),showPendingLeaveTable(),showApproveLeaveTable(),showRejectLeaveTable()">
                                                <span class="text">ค้นหา</span>
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-search"></i>
                                                </span>
                                            </button>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- DataTales Example -->
                    <div class="card shadow mt-4 mb-4">
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
                                    <div id="leave_all_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="pending">
                                    <div id="leave_pending_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="approve">
                                    <div id="leave_approve_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="reject">
                                    <div id="leave_reject_table">
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

    <!-- Modal Edit-->
    <div class="modal fade" id="leaveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="leaveLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="leaveContent">

            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>

    <?php include 'layout/script_foot.php' ?>
    <script>
        var term_cur;
        var session_cur;
        $(document).ready(function() {
            getTermCurrent();

        })

        function getTermCurrent() {
            $.ajax({
                type: 'POST',
                url: 'ajax/ajax_term_current.php',
                async: false,
                success: function(data) {
                    console.log("Term Current :" + data)
                    const obj = JSON.parse(data);
                    if (data) {
                        term_cur = obj.term_id;
                        session_cur = obj.session_id;

                        showSessionSearchList(session_cur)
                        showTermSearchList(term_cur)
                        showClassSearchList()
                        showAllLeaveTable()
                        showPendingLeaveTable()
                        showApproveLeaveTable()
                        showRejectLeaveTable()
                    }

                    console.log(term_cur)
                    console.log(session_cur)
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showSessionSearchList(session) {
            if (session) {
                session = session;
            } else {
                session = $('#session_search').val();
            }
            $.ajax({
                type: 'POST',
                url: 'ajax_search_list/ajax_session_list.php',
                async: false,
                data: {
                    session
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#session_search').html(data);
                    $('#session_search').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showTermSearchList(term_cur) {
            $.ajax({
                type: 'POST',
                url: 'ajax_search_list/ajax_term_list.php',
                async: false,
                data: {
                    session: $('#session_search').val(),
                    term_cur
                },
                success: function(data) {
                    console.log("Term Search :" + data)
                    $('#term_search').html(data);
                    $('#term_search').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showClassSearchList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_search_list/ajax_class_list.php',
                async: false,
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val()
                },
                success: function(data) {
                    console.log("Term Search :" + data)
                    $('#class_search').html(data);
                    $('.selectpicker').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showAllLeaveTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_leave/ajax_tleave_table.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    class: $('#class_search').val(),
                    type: $('#type_search').val(),
                    status: 'ALL'
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#leave_all_table').html(data);
                    $('#leaveDataTable').DataTable({
                        responsive: true,
                        columnDefs: [{
                                responsivePriority: 1,
                                targets: 0
                            },
                            {
                                responsivePriority: 2,
                                targets: 1
                            },
                            {
                                responsivePriority: 3,
                                targets: 8
                            },
                            {
                                responsivePriority: 4,
                                targets: 7
                            },
                            {
                                responsivePriority: 5,
                                targets: 2
                            },
                            {
                                responsivePriority: 6,
                                targets: 3
                            },
                            {
                                responsivePriority: 7,
                                targets: 4
                            },
                            {
                                responsivePriority: 8,
                                targets: 5
                            },
                            {
                                responsivePriority: 9,
                                targets: 6
                            }
                        ]
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showPendingLeaveTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_leave/ajax_tleave_table.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    class: $('#class_search').val(),
                    type: $('#type_search').val(),
                    status: "Pending"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#leave_pending_table').html(data);
                    $('#leavePendingDataTable').DataTable({
                        responsive: true,
                        columnDefs: [{
                                responsivePriority: 1,
                                targets: 0
                            },
                            {
                                responsivePriority: 2,
                                targets: 1
                            },
                            {
                                responsivePriority: 3,
                                targets: 8
                            },
                            {
                                responsivePriority: 4,
                                targets: 7
                            },
                            {
                                responsivePriority: 5,
                                targets: 2
                            },
                            {
                                responsivePriority: 6,
                                targets: 3
                            },
                            {
                                responsivePriority: 7,
                                targets: 4
                            },
                            {
                                responsivePriority: 8,
                                targets: 5
                            },
                            {
                                responsivePriority: 9,
                                targets: 6
                            }
                        ]
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showApproveLeaveTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_leave/ajax_tleave_table.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    class: $('#class_search').val(),
                    type: $('#type_search').val(),
                    status: "Approve"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#leave_approve_table').html(data);
                    $('#leaveApproveDataTable').DataTable({
                        responsive: true,
                        columnDefs: [{
                                responsivePriority: 1,
                                targets: 0
                            },
                            {
                                responsivePriority: 2,
                                targets: 1
                            },
                            {
                                responsivePriority: 3,
                                targets: 8
                            },
                            {
                                responsivePriority: 4,
                                targets: 7
                            },
                            {
                                responsivePriority: 5,
                                targets: 2
                            },
                            {
                                responsivePriority: 6,
                                targets: 3
                            },
                            {
                                responsivePriority: 7,
                                targets: 4
                            },
                            {
                                responsivePriority: 8,
                                targets: 5
                            },
                            {
                                responsivePriority: 9,
                                targets: 6
                            }
                        ]
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }



        function showRejectLeaveTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_leave/ajax_tleave_table.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    class: $('#class_search').val(),
                    type: $('#type_search').val(),
                    status: "Reject"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#leave_reject_table').html(data);
                    $('#leaveRejectDataTable').DataTable({
                        responsive: true,
                        columnDefs: [{
                                responsivePriority: 1,
                                targets: 0
                            },
                            {
                                responsivePriority: 2,
                                targets: 1
                            },
                            {
                                responsivePriority: 3,
                                targets: 8
                            },
                            {
                                responsivePriority: 4,
                                targets: 7
                            },
                            {
                                responsivePriority: 5,
                                targets: 2
                            },
                            {
                                responsivePriority: 6,
                                targets: 3
                            },
                            {
                                responsivePriority: 7,
                                targets: 4
                            },
                            {
                                responsivePriority: 8,
                                targets: 5
                            },
                            {
                                responsivePriority: 9,
                                targets: 6
                            }
                        ]
                    });
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


        function viewLeaveModal(id) {
            $.ajax({
                type: 'POST',
                url: 'ajax_leave/ajax_leave_content.php',
                data: {
                    id
                },
                success: function(data) {
                    console.log("Modal Data");
                    $('#leaveContent').html(data);
                    $('#leaveModal').modal('show');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function approveLeave() {

            var leave_id = $('#leave_id').val()
            var status = $('input[name="options"]:checked').val()
            var remark = $('#remark').val()
            //alert(status);
            if (status) {

                $.ajax({
                    type: 'POST',
                    url: 'ajax_leave/ajax_leave_approve.php',
                    data: {
                        leave_id,
                        status,
                        remark
                    },
                    success: function(data) {
                        console.log("Leave Approve : " + data);
                        if (data.search("Update Successful") != -1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'อัปเดตสถานะการลาสำเร็จ!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                $('#leaveModal').modal('hide');
                                showAllLeaveTable();
                                showPendingLeaveTable();
                                showRejectLeaveTable();
                                showApproveLeaveTable(); 
                                //location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'อัปเดตสถานะการลาไม่สำเร็จ!',
                                text: 'โปรดลองอีกครั้ง',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        };
                    },
                    error: function(err) {
                        alert("Error" + err)

                    }
                });

            } else {

                alert("โปรดอนุมัติสถานะการลา");

            }
        }
    </script>

</body>

</html>