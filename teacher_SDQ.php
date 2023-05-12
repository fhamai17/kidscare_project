<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - SDQ</title>
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
                        <h1 class="h3 mb-0 text-info font-weight-bold">การประเมินพฤติกรรมนักเรียน (SDQ)</h1>

                        <?php
                        if ($user_type === "คุณครู") {
                        ?>
                            <button class="d-sm-inline-block btn btn-info" data-toggle="modal" data-target="#sdqModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">สร้างแบบประเมิน</span>
                            </button>
                        <?php

                        }
                        ?>
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
                                    <div class="col-sm-2 mb-3">
                                        <label>ปีการศึกษา</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="session_search" id="session_search" title="ปีการศึกษา" onchange="showTermSearchList()">
                                                <option value="" selected>ทั้งหมด</option>';
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mb-3">
                                        <label>เทอม</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="term_search" id="term_search" title="เทอม" onchange="showGradeSearchList()">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-2 mb-3">
                                        <label>ระดับชั้น</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="grade_search" id="grade_search" title="ระดับชั้น" onchange="showSectionSearchList()">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mb-3">
                                        <label>ห้อง</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="section_search" id="section_search" title="ห้องเรียน">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-2 mb-4 mt-3">
                                        <div class="input-group mt-3">
                                            <button class="btn btn-info" onclick="showAlltable()">
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
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link active" href="#teacher">
                                    <i class="fas fa-chalkboard-teacher"></i> คุณครู
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link" href="#parent"> <i class="fas fa-users"></i> ผู้ปกครอง</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link success" href="#result"><i class="bi bi-journal-text"></i> สรุปผล</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active py-3" id="teacher">
                                    <div id="teacher_sdq_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="parent">
                                    <div id="parent_sdq_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="result">
                                    <div id="result_table">
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


    <!-- Add Modal-->
    <div class="modal fade" id="sdqModal" tabindex="-1" role="dialog" aria-labelledby="classModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="classModalLabel">เลือกห้องเรียนสำหรับสร้างแบบประเมิน</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="sdqForm">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="year">ห้องเรียน<span class="text-danger">*</span></label>
                                    <select class="form-control selectpicker" name="class_id" id="class_id" title="โปรดเลือกห้องเรียน">
                                    </select>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-primary" id="saveBtn" type="submit">เพิ่ม</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>



    <?php include 'layout/script_foot.php' ?>
    <script>
        $(document).ready(function() {
            //showGradeTable();
        });


        var term_cur;
        var session_cur;
        $(document).ready(function() {

            getTermCurrent();
            showClassList();
            showAlltable();
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
                    }

                    showSessionSearchList(session_cur)
                    showTermSearchList(term_cur)
                    showGradeSearchList()
                    showSectionSearchList()
                    //alert("Term : " + term_cur + "\n\nSession : " + session_cur)
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }



        function showSessionSearchList(session) {
            session = session_cur;
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


        function showGradeSearchList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_search_list/ajax_grade_list.php',
                async: false,
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                },
                success: function(data) {
                    //console.log("Grade Search :" + data)
                    $('#grade_search').html(data);
                    $('#grade_search').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showSectionSearchList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_search_list/ajax_section_list.php',
                async: false,
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    grade: $('#grade_search').val()
                },
                success: function(data) {
                    console.log("Section Search :" + data)
                    $('#section_search').html(data);
                    $('#section_search').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showClassList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_class_list.php',
                success: function(data) {
                    console.log("Class :" + data)
                    $('#class_id').html(data);
                    $('#class_id').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        $('#sdqForm').bootstrapValidator({
            fields: {
                classSelect: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกห้องเรียน'
                        },
                    }
                }

            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            addSDQ();
        });


        function addSDQ() {
            Swal.fire({
                title: 'สร้าง SDQ',
                text: "คุณต้องการสร้าง SDQ ใช่หรือไม่?",
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
                        url: 'ajax_sdq/ajax_sdq_add.php',
                        data: $("#sdqForm").serializeArray(),
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Add Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เพิ่มข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    //location.reload();
                                    $('#sdqModal').modal('hide');
                                    showAlltable();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เพิ่มข้อมูลไม่สำเร็จ!',
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


        function showAlltable() {
            showTeacherTable();
            showParentTable();
            showResultTable();
        }

        function showTeacherTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_sdq/ajax_sdq_table.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    grade: $('#grade_search').val(),
                    section: $('#section_search').val(),
                    type: "คุณครู"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#teacher_sdq_table').html(data);
                    $('#teacherDataTable').DataTable({
                        responsive: true,
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showParentTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_sdq/ajax_sdq_table.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    grade: $('#grade_search').val(),
                    section: $('#section_search').val(),
                    type: "ผู้ปกครอง"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#parent_sdq_table').html(data);
                    $('#parentDataTable').DataTable({
                        responsive: true,
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showResultTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_sdq/ajax_sdq_resultTable.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    grade: $('#grade_search').val(),
                    section: $('#section_search').val(),
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#result_table').html(data);
                    $('#resultDataTable').DataTable({
                        responsive: true,
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }
    </script>

</body>

</html>