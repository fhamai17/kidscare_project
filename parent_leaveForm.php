<?php
include('session.php');
if (isset($_GET['leave_id'])) {
    $leave_id = $_GET['leave_id'];
} else {
    $leave_id = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - ลาเรียน</title>
    <style>
        .center {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .form-input {
            width: 350px;
            padding: 20px;
        }

        .form-input input {
            display: none;

        }

        .form-input label {
            display: block;
            width: 45%;
            height: 45px;
            margin-left: 25%;
            line-height: 50px;
            text-align: center;
            background: #F5DEAB;

            color: #000;
            font-size: 15px;
            text-transform: Uppercase;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-input img {
            width: 90%;
            display: none;

            margin-bottom: 30px;
        }


        .img-preview {
            width: 200px !important;
            height: 200px !important;
            object-fit: cover !important;
            background-color: #dfdfdf;
        }
    </style>

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

                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-center align-items-center py-3">
                            <h3 class="m-0 font-weight-bold text-info">แบบฟอร์มการลาเรียน</h3>

                        </div>
                        <div class="card-body pb-5">
                            <!-- Nested Row within Card Body -->
                            <div class="col-lg-12">
                                <div class="parent_info" id="parent_info">
                                    <div class="row">

                                        <div class="col-lg-12">
                                            <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลผู้ยื่นคำร้อง</h1>
                                        </div>
                                        <div class="form-group col-sm-4  mb-3">
                                            <label for="topic" class="form-label">ชื่อ-นามสกุล</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="pa_fullname" id="pa_fullname" readonly placeholder="ชื่อ-นามสกุลผู้ปกครอง">
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-4 mb-3">
                                            <label for="topic" class="form-label">ความเกี่ยวข้อง</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="relation" id="relation" readonly placeholder="ความเกี่ยวข้อง">
                                            </div>
                                        </div>



                                        <div class="form-group col-sm-4  mb-3">
                                            <label for="topic" class="form-label">วันที่ร้องขอ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-mortarboard-fill"></i></span>
                                                </div>
                                                <input type="text" name="create_time" id="create_time" class="form-control" readonly placeholder="วันที่">

                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12  mb-3">
                                            <hr>
                                        </div>
                                    </div>

                                </div>
                                <form class="user" id="leaveForm" autocomplete="off">

                                    <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลส่วนตัวนักเรียน</h1>
                                    <div class="row">
                                        <input type="hidden" name="leave_id" id="leave_id" value="<?php echo $leave_id ?>">
                                        <div class="form-group col-sm-4  mb-3">
                                            <label for="topic" class="form-label">รหัสประจำตัวนักเรียน</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                </div>
                                                <select class="form-control selectpicker" name="student_id" id="student_id" placeholder="โปรดระบุรหัสประจำตัวนักเรียน" onchange="getStdInfo()">
                                                    <option value="" disabled selected>-โปรดเลือกนักเรียน-</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group col-sm-4 mb-3">
                                            <label for="topic" class="form-label">ชื่อ-นามสกุล</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="fullname" id="fullname" readonly placeholder="กรอกอัตโนมัติ">
                                            </div>
                                        </div>



                                        <div class="form-group col-sm-4  mb-3">
                                            <label for="topic" class="form-label">ระดับชั้น</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-mortarboard-fill"></i></span>
                                                </div>
                                                <input type="text" name="grade" id="grade" class="form-control" readonly>

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12  mb-3">
                                            <hr>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h1 class="h6 text-gray-900 mb-4 font-weight-bold">รายละเอียด</h1>
                                        </div>

                                        <div class="form-group col-sm-6  mb-3">
                                            <label for="topic" class="form-label">ประเภท</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                                                </div>
                                                <select name="leave_type" id="leave_type" class="form-control selectpicker">
                                                    <option value="" disabled selected>โปรดเลือกประเภทการลา</option>
                                                    <option value="ลากิจ">ลากิจ</option>
                                                    <option value="ลาป่วย">ลาป่วย</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group col-sm-6  mb-3"></div>
                                        <div class="form-group col-sm-4  mb-3">
                                            <label for="topic" class="form-label">ลาตั้งแต่</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-calendar-event-fill"></i></span>
                                                </div>
                                                <input type="date" class="form-control" name="start_date" id="start_date" onchange="diffDate()">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-4  mb-3">
                                            <label for="topic" class="form-label">ถีง</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-calendar-event-fill"></i></span>
                                                </div>
                                                <input type="date" class="form-control " name="end_date" id="end_date" onchange="diffDate()">
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-4  mb-3">
                                            <label for="topic" class="form-label">จำนวนวันที่ลา</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-calendar-fill"></i></span>
                                                </div>
                                                <input type="number" class="form-control " name="days" id="days" placeholder="โปรดระบุจำนวนวันที่ลา" min=1 max=99 readonly>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-12 mb-3">
                                            <label for="topic" class="form-label">เหตุผลการลา</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                                                </div>
                                                <textarea class="form-control " name="reason" id="reason" rows="3" placeholder="โปรดระบุเหตุผล"></textarea>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="row" id="approve_info">

                                        <div class="form-group col-sm-12  mb-3">
                                            <hr>
                                        </div>

                                        <div class="col-sm-12">
                                            <h1 class="h6 text-gray-900 mb-4 font-weight-bold">สถานะการลา</h1>
                                        </div>


                                        <div class="col-sm-6  form-inline mb-3" id="status">
                                            <label for="topic" class="form-label mr-3">สถานะ : </label>
                                        </div>


                                        <div class="col-sm-6  form-inline mb-3">
                                            <label for="topic" class="form-label mr-3">หมายเหตุ : </label>
                                            <div class="text-wrap" id="remark">

                                            </div>
                                        </div>


                                        <div class="col-sm-6  mb-3" id="teacher_detail1">
                                            <label for="topic" class="form-label">ชื่อ-นามสกุลผู้อนุมัติ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-mortarboard-fill"></i></span>
                                                </div>
                                                <input type="text" name="teacher" id="teacher" class="form-control" readonly placeholder="ชื่อ-นามสกุลผู้อนุมัติ">

                                            </div>
                                        </div>


                                        <div class="col-sm-6  mb-3" id="teacher_detail2">
                                            <label for="topic" class="form-label">วันที่อนุมัติ</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-mortarboard-fill"></i></span>
                                                </div>
                                                <input type="text" name="approve_time" id="approve_time" class="form-control" readonly placeholder="วันที่">

                                            </div>
                                        </div>
                                        <div class="form-group col-sm-12  mb-3">
                                            <hr>
                                        </div>
                                    </div>




                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-sky" type="submit" id="saveBtn">บันทึกการการลา </button>
                                    </div>

                            </div>


                            <!-- /.container -->



                        </div>
                    </div>
                    </form>


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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment-with-locales.min.js"></script>
    <script>
        var id = "<?= $leave_id ?>"
        $(document).ready(function() {

            showStudentOfParent();
            if (!id) {
                $("#approve_info").hide();
                $("#parent_info").hide();
            }

        })

        async function showStudentOfParent() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_student_parent.php',
                success: function(data) {
                    console.log("IIIII :" + data)
                    $('#student_id').html(data);
                    $('#student_id').selectpicker('refresh');

                    if (id) {
                        showLeaveInfo();
                    }

                },
                error: function(err) {
                    alert("Error" + err)
                }
            });

        }

        $('#leaveForm').bootstrapValidator({
            fields: {
                student_id: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรหัสประจำตัวนักเรียน'
                        },
                    }
                },
                start_date: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกวันเริ่มต้น'
                        },
                    }
                },
                end_date: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกวันสิ้นสุด'
                        },
                    }
                },
                reason: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเหตุผลการลา'
                        },
                    }
                },
                leave_type: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุประเภทการลา'
                        },
                    }
                },
            },
            live: 'enabled',
            trigger: null
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            //var id = $('#parent_id').val();
            if (id) {

                Swal.fire({
                    title: 'แก้ไขข้อมูลการลา',
                    text: "คุณต้องการแก้ไขข้อมูลการลาหรือไม่?",
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
                            html: "โปรดรอสักครู่",
                            didOpen: function() {
                                Swal.showLoading()
                            }
                        })

                        $.ajax({
                            type: 'POST',
                            url: 'ajax_leave/ajax_leave_update.php',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(res) {
                                console.log("Res : " + res);
                                if (res.search("Update Successful") != -1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'แก้ไขข้อมูลสำเร็จ!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        location.reload();
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
                })


            } else {

                Swal.fire({
                    title: 'ยืนยันการเพิ่มข้อมูลการลา',
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
                            html: "โปรดรอสักครู่",
                            didOpen: function() {
                                Swal.showLoading()
                            }
                        })

                        $.ajax({
                            type: 'POST',
                            url: 'ajax_leave/ajax_leave_add.php',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(res) {
                                console.log("Res : " + res);
                                const obj = JSON.parse(res);
                                if (obj.status == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'เพิ่มข้อมูลสำเร็จ!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        window.location = window.location.href + "?leave_id=" + obj.last_id;
                                        //location.reload();


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
                })

            }

            $('#saveBtn').attr('disabled', false);

        });


        function diffDate() {
            var start_date = moment($('#start_date').val());
            var end_date = moment($('#end_date').val());

            if (start_date && end_date) {
                var d = end_date.diff(start_date, 'days'); // 9
                $('#days').val(d + 1);
            }
        }


        function getStdInfo() {

            var student_id = $('#student_id').val();
            $.ajax({
                type: 'POST',
                url: 'ajax_leave/ajax_student_info.php',
                data: {
                    student_id
                },
                success: function(data) {
                    console.log(data)
                    const obj = JSON.parse(data);
                    if (data) {
                        $('#grade').val(obj.grade);
                        $('#fullname').val(obj.fullname);
                    }
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });

        }




        function showLeaveInfo() {

            $.ajax({
                type: 'POST',
                url: 'ajax_leave/ajax_leave_detail.php',
                data: {
                    id
                },
                success: function(data) {
                    console.log(data);
                    const obj = JSON.parse(data);
                    if (obj.id) {

                    }
                    if (obj.isApprove) {

                        if (obj.isApprove == 1) {
                            $("#leaveForm :input").prop("disabled", true);
                            $("#saveBtn").hide();
                            $("#status").append(' <a class="badge badge-success">ได้รับการอนุมัติ</a>');
                        } else if (obj.isApprove == 0) {
                            $("#status").append(' <a class="badge badge-danger" style="width:85px">ไม่ได้รับการอนุมัติ</a>');
                        } else {
                            $("#leaveForm :input").prop("disabled", true);
                            $("#saveBtn").hide();
                            $("#status").append(' <a class="badge badge-dark" >N/A</a>');
                        }

                        //alert("isApprove");
                    } else {
                        $("#leaveForm :input").prop("disabled", false);
                        $("#saveBtn").show();
                        $("#status").append(' <a class="badge badge-default">อยู่ระหว่างรอ</a>');
                        $("#teacher_detail1").hide();
                        $("#teacher_detail2").hide();
                        //alert("notApprove");
                    }
                    $('#student_id').val(obj.student_id);
                    $('#fullname').val(obj.student_name);
                    $('#grade').val(obj.grade_name);
                    $('#leave_type').val(obj.type);
                    $('#start_date').val(obj.start_date);
                    $('#end_date').val(obj.end_date);
                    $('#days').val(obj.days);
                    $('#reason').val(obj.reason);
                    $('#remark').html(obj.remark);
                    $('#pa_fullname').val(obj.parent_name);
                    $('#relation').val(obj.relation);
                    $('#create_time').val(obj.create_time);
                    $('#teacher').val(obj.teacher_name);
                    $('#approve_time').val(obj.approve_time);
                    alert(obj.create_time)
                    $('.selectpicker').selectpicker('refresh');


                },
                error: function(err) {
                    alert("Error" + err)
                }
            });


            /*  $.ajax({
                type: 'POST',
                url: 'ajax_leave/ajax_leave_detail.php',
                data: {
                    id
                },
                success: function(data) {
                    console.log(data);
                    const obj = JSON.parse(data);
                    $('#student_id').val(obj.student_id);
                    $('#fullname').val(obj.fullname);
                    $('#grade').val(obj.grade);
                    $('#leave_type').val(obj.type);
                    $('#start_date').val(obj.start_date);
                    $('#end_date').val(obj.end_date);
                    $('#days').val(obj.days);
                    $('#reason').val(obj.reason);
                    $('.selectpicker').selectpicker('refresh');


                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
 */
        }
    </script>
</body>

</html>