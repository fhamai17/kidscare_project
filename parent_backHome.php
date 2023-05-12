<?php
include('session.php');
$type = $_SESSION['type'];
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
} else {
    $student_id = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - รับนักเรียนกลับบ้าน</title>
    <?php include './layout/head.php' ?>
    <style>

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


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold" id="backText">รายการคำร้องรับนักเรียนกลับบ้านของฉัน</h1><button class="btn btn-info" data-toggle="modal" data-target="#backhomeModal">
                            <span class="icon text-white">
                                <i class="fas fa-plus-square"></i>
                            </span>
                            <span class="text">รับนักเรียน</span>
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

<label>วันที่ต้องการมารับ</label>
<div class="datepicker date input-group">
    <input type="text" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control " name="back_date_search" id="back_date_search">
    <div class="input-group-append">
        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
    </div>

</div>
</div>



<div class="col-sm-2 mb-4 mt-3">
<div class="input-group mt-3">
    <button class="btn btn-info" onclick="showBackhomeTable()">
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
                            <div id="backhome_table">

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
    <!-- Modal Edit-->
    <div class="modal fade" id="backhomeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="leaveLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="backhomeModalLabel">รับนักเรียนกลับบ้าน</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="backhomeForm">
                        <input type="hidden" name="id" id="id">
                        <!-- Date Picker -->
                        <div class="row">
                            <div class="form-group col-sm-6 mb-3">
                                <label for="inputPassword" class="">วันที่ต้องการมารับ<span class="text-danger">*</span></label>
                                <div class="datepicker date input-group">
                                    <input type="text" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control" id="back_date" name="back_date">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-sm-6  mb-3">
                                <label for="topic" class="form-label">นักเรียน</label>
                                <div class="input-group">

                                    <select class="form-control selectpicker" name="student_id" id="student_id" title="-โปรดเลือกนักเรียน-" multiple data-live-search="true" onchange="showStudentDetail()">
                                        <option value="" disabled>-โปรดเลือกนักเรียน-</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center" id="std_detail">

                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-primary" id="saveBtn" type="submit">บันทึก</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>
    <?php include 'layout/script_foot.php' ?>


    <script>
        var student_id = "<?= $student_id ?>"
        $(document).ready(function() {
            showBackhomeTable();
            getStudentName();
            $('.datepicker').datepicker({
                todayHighlight: true,
                clearBtn: true,
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

        });


        function showBackhomeTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_backhome/ajax_backhome_table.php',
                data: {
                    student_id,
                    date:$("#back_date_search").val()
                },
                success: function(data) {
                    //console.log("Test :" + data)
                    $('#backhome_table').html(data);
                    $('#backhomeDataTable').DataTable({
                        responsive: true
                    });
                    showStudentOfParent();

                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showStudentOfParent() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_student_parent.php',
                success: function(data) {
                    console.log("IIIII :" + data)
                    $('#student_id').html(data);
                    $('#student_id').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });

        }

        function showStudentDetail() {
            $.ajax({
                type: 'POST',
                url: 'ajax_backhome/ajax_show_student.php',
                data: {
                    student_id: $("#student_id").val()
                },
                success: function(res) {
                    //console.log("Std Detail : " + res);
                    $("#std_detail").html(res)
                },
                error: function(err) {
                    alert("Error" + err)

                }
            });
        }


        $('#backhomeForm').bootstrapValidator({
            fields: {
                back_date: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกวันที่'
                        },
                    }
                },
                student_id: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกนักเรียน'
                        }
                    }
                }
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            alert("Correct!");
            checkEmptyID();
        });



        function addBackhome() {
            Swal.fire({
                title: "กำลังโหลด...",
                html: "โปรดรอสักครู่",
                didOpen: function() {
                    Swal.showLoading()
                }
            })
            $.ajax({
                type: 'POST',
                url: 'ajax_backhome/ajax_backhome_add.php',
                data: {
                    back_date: $("#back_date").val(),
                    student_id: $("#student_id").val()
                },
                success: function(res) {
                    console.log("Res : " + res);
                    if (res.search("Add Successful") != -1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสำเร็จ!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            $('#backhomeModal').modal('hide');
                            showBackhomeTable(student_id);
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'เพิ่มข้อมูลไม่สำเร็จ!',
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
        }


        function updateBackhome() {
            Swal.fire({
                title: "กำลังโหลด...",
                html: "โปรดรอสักครู่",
                didOpen: function() {
                    Swal.showLoading()
                }
            })
            $.ajax({
                type: 'POST',
                url: 'ajax_backhome/ajax_backhome_update.php',
                data: $("#backhomeForm").serializeArray(),
                success: function(res) {
                    console.log("Res : " + res);
                    if (res.search("Successful") != -1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสำเร็จ!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            $('#backhomeModal').modal('hide');
                            showBackhomeTable(student_id);
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'แก้ไขข้อมูลไม่สำเร็จ!',
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
        }

        function checkEmptyID() {
            var id = $('#id').val()
            if (id) {
                updateBackhome();
            } else {
                addBackhome()
            }
        }

        function delBackHome(id) {
            console.log("DELETE " + id)
            Swal.fire({
                title: 'ลบข้อมูลการมารับนักเรียนกลับบ้าน',
                text: "คุณต้องการลบข้อมูลการมารับนักเรียนกลับบ้านนี้หรือไม่?",
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
                        url: 'ajax_backhome/ajax_backhome_del.php',
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
                                    showBackhomeTable(student_id);
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


        function showBackHomeModal(id, backdate, student_id, option) {
            $('#backhomeModal').modal('show');
            $('#id').val(id);
            $('#back_date').val(backdate);
            $('#student_id').val(student_id);
            $('#student_id').selectpicker('refresh');
            showStudentDetail()
            if (option === "Edit") {
                $("#backhomeForm :input").prop("disabled", false);
                $('#backhomeModalLabel').html('แก้ไขข้อมูลการรับนักเรียนกลับบ้าน #' + id)
                $('#saveBtn').show();
                $("#student_id").attr('multiple', false);
                /* Destroy the selectpicker and re-initialize. */
                $('#student_id').selectpicker('destroy');
                $('#student_id').selectpicker();

            } else {
                $('#backhomeModalLabel').html('รายละเอียดการรับนักเรียนกลับบ้าน #' + id)
                $("#backhomeForm :input").prop("disabled", true);
                $('#saveBtn').hide();
            }
        }


        $("#backhomeModal").on('hide.bs.modal', function() {
            $('#back_date').val();
            $("#backhomeForm :input").prop("disabled", false);
            $("#student_id").attr('multiple', true);
            $('#student_id').val('default');
            $("#student_id").selectpicker("refresh");
            $('#backhomeModalLabel').html('รับนักเรียนกลับบ้าน');
            $('#std_detail').children().remove();
            $('#backhomeForm').data('bootstrapValidator').resetForm();
        });


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
                        $("#backText").html("รายการมารับนักเรียนกลับบ้านของ " + obj.student_name);
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