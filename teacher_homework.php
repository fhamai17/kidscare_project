<?php
include('session.php');
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
} else {
    $class_id = "";
}

if (isset($_GET['class_name'])) {
    $class_name = $_GET['class_name'];
} else {
    $class_name = "";
}

if (isset($_GET['term_id'])) {
    $term_id = $_GET['term_id'];
} else {
    $term_id = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - แจ้งการบ้าน</title>
    <?php include './layout/head.php' ?>
    <style>
        td.day {
            color: black;
        }

        .datepicker table tr td.disabled,
        .datepicker table tr td.disabled:hover {
            background: 0 0;
            color: #E8E2E2;
            cursor: default;
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
                <?php print_r($_SESSION) ?>
                <!-- Topbar -->
                <?php include './layout/topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold" id="term_text">ปีการศึกษา </h1>

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
                                        <label>วันที่ส่ง</label>
                                        <div class="datepicker date input-group">
                                            <input type="text" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control " id="date_search" name="date_search">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="col-sm-2 mb-4 mt-3">
                                        <div class="input-group mt-3">
                                            <button class="btn btn-info" onclick="showHomeworkTable(<?=$class_id?>)">
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
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <h6 class="m-0 font-weight-bold text-info"> <?= $class_name ?></h6>

                            <?php
                        if ($user_type === "คุณครู") {
                        ?>
                            <button class="btn btn-info" data-toggle="modal" data-target="#homeworkModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มการบ้าน</span>
                            </button>
                        <?php

                        }
                        ?>

                        </div>
                        <div class="card-body">
                            <div id="homework_table"></div>
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
    <div class="modal fade" id="homeworkModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="leaveLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="homeworkModalLabel">เพิ่มการบ้าน</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="homeworkForm">
                        <input type="hidden" name="homework_id" id="homework_id">
                        <input type="hidden" name="class_id" id="class_id" value="<?= $class_id ?>">
                        <div class="form-group">
                            <label for="session">หัวข้อ<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="topic" id="topic" placeholder="โปรดระบุหัวเรื่อง">
                        </div>
                        <div class="form-group">
                            <label for="session">รายละเอียด</label>
                            <textarea class="form-control" rows="3" name="description" id="description" placeholder="รายละเอียดการบ้าน"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="session">วันที่สั่ง<span class="text-danger">*</span></label>
                            <div class="datepicker date input-group" id="today">
                                <input type="text" autocomplete="off" name="start_date" id="start_date" placeholder="วันที่สั่ง" class="form-control" data-bv-trigger="change keyup">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="session">วันที่ส่ง<span class="text-danger">*</span></label>
                            <div class="datepicker date input-group">
                                <input type="text" autocomplete="off"  name="end_date" id="end_date" placeholder="วันที่ส่ง" class="form-control" data-bv-trigger="change keyup">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="lineNotify" id="lineNotify">
                            <label class="form-check-label" for="lineNotify">
                                แจ้งเตือนผ่าน LINE
                            </label>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-primary" id="saveBtn" type="submit">เพิ่ม</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>

    <?php include 'layout/script_foot.php' ?>

    <script>
        var term_cur;
        var session_cur;
        var class_id = "<?= $class_id ?>"
        var term_id = "<?= $term_id ?>"
        
        $(document).ready(function() {
            getTermCurrent();
        })

        function getTermCurrent() {
            $.ajax({
                type: 'POST',
                url: 'ajax/ajax_term_current.php',
                data:{term_id},
                async: false,
                success: function(data) {
                    console.log("Term Current :" + data)
                    const obj = JSON.parse(data);
                    if (data) {
                        term_cur = obj.term_id;
                        session_cur = obj.session_id;
                        if(term_cur != term_id){
                            console.log("Not Term");
                        }
                        showSessionSearchList(session_cur)
                        showTermSearchList(term_cur)
                        showClassSearchList()
                        showHomeworkTable(class_id)
                        getEnabledDay();
                        $('#term_text').html('ปีการศึกษา ' + obj.session_name + " เทอม " + obj.term_name)
                    }

                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function getEnabledDay() {
            $.ajax({
                type: 'POST',
                url: 'ajax_date/ajax_date_enable.php',
                data: {
                    term: term_id
                },
                success: function(data) {
                    var datesEnabled = JSON.parse(data)
                    showdatePicker(datesEnabled)
                    console.log("Date :" + data)
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showdatePicker(datesEnabled) {
            console.log("get Date");
            $("#back_date").val("");
            $(".datepicker").datepicker("destroy");
            $(".datepicker").datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                clearBtn:true,
                // On n'active que les dates possibles
                beforeShowDay: function(date) {
                    var allDates = date.getFullYear() + "-" + ('0' + (date.getMonth() + 1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);
                    if (datesEnabled.indexOf(allDates) != -1) {
                        return {
                            classes: 'date-possible',
                            tooltip: 'วันที่ที่คุณเลือกได้'
                        }
                    } else {
                        return false;
                    }
                }

            });
            $('#today').datepicker('setDate', 'today');
            $(".datepicker").datepicker("refresh");

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

        function showHomeworkTable(class_id) {
            $.ajax({
                type: 'POST',
                url: 'ajax_homework/ajax_homework_table.php',
                data: {
                    class_id,
                    end_date : $("#date_search").val(),
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#homework_table').html(data);
                    $('#homeworkDataTable').DataTable({});
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }



        $('#homeworkForm').bootstrapValidator({
            fields: {
                topic: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อเรื่อง'
                        },
                    }
                },
                start_date: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุวันที่สั่ง'
                        },
                    }
                },
                end_date: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุวันที่ส่ง'
                        },
                    }
                },

            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            checkEmptyID();
        });

        function checkEmptyID() {
            var id = $('#homework_id').val()
            if (id) {
                updateHomework(id);
            } else {
                addHomework()
            }
        }

        function addHomework() {
            Swal.fire({
                title: 'ยืนยันการเพิ่มการบ้าน',
                text: "คุณต้องการเพิ่มการบ้านใช่หรือไม่?",
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
                        url: 'ajax_homework/ajax_homework_add.php',
                        data: $("#homeworkForm").serializeArray(),
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
                                    $('#homeworkModal').modal('hide');
                                    showHomeworkTable(class_id);
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

        function showHomeworkModal(id, topic, desc, start_date, end_date) {
            $('#homeworkModal').modal('show');
            $('#saveBtn').html('บันทึก')
            $('#homeworkModalLabel').html('แก้ไขข้อมูลการบ้าน #' + id)
            $('#homework_id').val(id);
            $('#topic').val(topic);
            $('#description').val(desc);
            $('#start_date').val(start_date);
            $('#end_date').val(end_date);
        }

        function updateHomework() {
            Swal.fire({
                title: 'แก้ไขข้อมูลการบ้าน',
                text: "คุณต้องการแก้ไขข้อมูลการบ้านหรือไม่?",
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
                        url: 'ajax_homework/ajax_homework_update.php',
                        data: $("#homeworkForm").serializeArray(),
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อัปเดตข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    $('#homeworkModal').modal('hide');
                                    showHomeworkTable(class_id);
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'อัปเดตข้อมูลไม่สำเร็จ!',
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



        function delHomework(id) {
            console.log("Homework ID : " + id)
            Swal.fire({
                title: 'ลบข้อมูลการบ้าน',
                text: "คุณต้องการลบข้อมูลการบ้านนี้หรือไม่?",
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
                        url: 'ajax_homework/ajax_homework_del.php',
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
                                    showHomeworkTable(class_id);
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

        $("#homeworkModal").on('hidden.bs.modal', function() {
            $("#homeworkForm #homework_id").val('');
            $("#homeworkForm #topic").val('');
            $("#homeworkForm textarea").val('');
            $("#homeworkForm #end_date").val('');
            $("#homeworkForm #lineNotify").prop('checked', false);
            $("#homeworkForm").data('bootstrapValidator').resetForm();
            $("#homeworkModalLabel").html('เพิ่มการบ้าน');
        });
    </script>

</body>

</html>