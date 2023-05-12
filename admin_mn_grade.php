<?php include('session.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>KidsCare - ระดับชั้น</title>
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
                            <h6 class="m-0 font-weight-bold text-info">รายการระดับชั้น</h6>
                            <button class="btn btn-info" data-toggle="modal" data-target="#gradeModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มระดับชั้น</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="grade_table">

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



    <!-- Add Modal-->
    <div class="modal fade" id="gradeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gradeModalLabel">เพิ่มข้อมูลระดับชั้น</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="gradeForm">
                    <input type="hidden" id="grade_id">
                    <div class="form-group">
                        <label for="grade">ระดับชั้น<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="grade" id="grade" placeholder="ระบุระดับชั้น">
                    </div>
                    <div class="form-group">
                        <label for="desc">คำอธิบายเพิ่มเติม</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3" placeholder="กรุณาระบุ หากมีข้อความเพิ่มเติม"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
                    <button class="btn btn-primary" id="saveBtn">เพิ่ม</button>
                </div>
</form>
            </div>
        </div>
    </div>

    <?php include 'layout/script_foot.php' ?>
    <script>
        $(document).ready(function() {
            showGradeTable();
        });


        function showGradeTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_basic_info/ajax_grade_table.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#grade_table').html(data);
                    $('#gradeDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        $('#gradeForm').bootstrapValidator({
            fields: {
                grade: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุระดับชั้น'
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
            var id = $('#grade_id').val()
            if (id) {
                updateGrade(id);
            } else {
                addGrade()
            }
        }

        function addGrade() {
            Swal.fire({
                title: 'เพิ่มข้อมูลระดับชั้น',
                text: "คุณต้องการเพิ่มข้อมูลระดับชั้นหรือไม่?",
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
                        url: 'ajax_basic_info/ajax_grade_add.php',
                        data: {
                            grade: $('#grade').val(),
                            desc: $('#desc').val(),
                        },
                        success: function(data) {
                            console.log("Res : " + data);
                            if (data.search("Add Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เพิ่มข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    //location.reload();
                                    showGradeTable();
                                    $('#gradeModal').modal('hide');
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

        function showGradeModal(id, grade, desc) {
            $('#gradeModal').modal('show');
            $('#saveBtn').html('บันทึก')
            $('#gradeModalLabel').html('แก้ไขข้อมูลปีการศึกษา #' + id)
            $('#grade_id').val(id);
            $('#grade').val(grade);
            $('#desc').val(desc);
        }

        function updateGrade() {
            Swal.fire({
                title: 'แก้ไขข้อมูลปีการศึกษา',
                text: "คุณต้องการแก้ไขข้อมูลปีการศึกษาหรือไม่?",
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
                        url: 'ajax_basic_info/ajax_grade_update.php',
                        data: {
                            id: $('#grade_id').val(),
                            grade: $('#grade').val(),
                            desc: $('#desc').val(),
                        },
                        success: function(data) {
                            console.log("Res : " + data);
                            if (data.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อัปเดตข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    //location.reload();
                                    showGradeTable();
                                    $('#gradeModal').modal('hide');
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

        function delGrade(id) {
            console.log("Scool ID : " + id)
            Swal.fire({
                title: 'ลบข้อมูลระดับชั้น',
                text: "คุณต้องการลบระดับนี้หรือไม่?",
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
                        url: 'ajax_basic_info/ajax_grade_del.php',
                        data: {
                            id
                        },
                        success: function(data) {
                            console.log("Res : " + data);
                            if (data.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลบข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    //location.reload();
                                    showGradeTable();
                                    $('#gradeModal').modal('hide');
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


        $("#gradeModal").on('hide.bs.modal', function() {
            $("#gradeForm")[0].reset();
            $("#gradeForm input:hidden").val('');
            $("#gradeForm").data('bootstrapValidator').resetForm();
            $("#gradeModalLabel").html('เพิ่มข้อมูลระดับชั้น');
        });
    </script>

</body>

</html>