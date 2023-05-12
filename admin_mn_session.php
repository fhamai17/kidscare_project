<?php include('session.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>KidCare - ปีการศึกษา</title>
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
                            <h6 class="m-0 font-weight-bold text-info">รายการปีการศึกษา</h6>
                            <button class="btn btn-info" data-toggle="modal" data-target="#sessionModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มปีการศึกษา</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="session_table">

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
    <div class="modal fade" id="sessionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sessionModalLabel">เพิ่มข้อมูลปีการศึกษา</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="sessionForm">
                        <input type="hidden" id="session_id">
                        <div class="form-group">
                            <label for="session">ปีการศึกษา<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="session" id="session" placeholder="โปรดระบุปีการศึกษา">
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

    <?php include 'layout/script_foot.php' ?>

    <script>
        $(document).ready(function() {
            showSessionTable();
            showTermList();
        });


        function showSessionTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_basic_info/ajax_session_table.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#session_table').html(data);
                    $('#sessionDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showTermList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_term_list.php',
                success: function(data) {
                    console.log("Term :" + data)
                    $('#term').html(data);
                    $('#term').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        $('#sessionForm').bootstrapValidator({
            fields: {
                session: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุปีการศึกษา'
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
            var id = $('#session_id').val()
            if (id) {
                updateSession(id);
            } else {
                addSession()
            }
        }

        function addSession() {
            Swal.fire({
                title: 'ยืนยันการเพิ่มข้อมูลปีการศึกษา',
                text: "ยืนยันการเพิ่มข้อมูลปีการศึกษา",
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
                        url: 'ajax_basic_info/ajax_session_add.php',
                        data: {
                            session: $('#session').val(),
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
                                    showSessionTable();
                                    $('#sessionModal').modal('hide');
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

        function showSessionModal(id, session) {
            $('#sessionModal').modal('show');
            $('#saveBtn').html('บันทึก')
            $('#sessionModalLabel').html('แก้ไขข้อมูลปีการศึกษา #' + id)
            $('#session_id').val(id);
            $('#session').val(session);
        }

        function updateSession() {

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
                        url: 'ajax_basic_info/ajax_session_update.php',
                        data: {
                            id: $('#session_id').val(),
                            session: $('#session').val(),
                        },
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อัปเดตข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    showSessionTable();
                                    $('#sessionModal').modal('hide');
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

        function delSession(id) {
            console.log("Scool ID : " + id)
            Swal.fire({
                title: 'ลบข้อมูลปีการศึกษา',
                text: "คุณต้องการลบปีการศึกษานี้หรือไม่?",
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
                        url: 'ajax_basic_info/ajax_session_del.php',
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
                                    showSessionTable();
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


        $("#sessionModal").on('hide.bs.modal', function() {
            $("#session_id").val('');
            $("#session").val('');
            $("#sessionForm").data('bootstrapValidator').resetForm();
            $("#sessionModalLabel").html('เพิ่มข้อมูลปีการศึกษา');
        });
    </script>

</body>

</html>