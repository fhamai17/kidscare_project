<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - เทอม</title>
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
                            <h6 class="m-0 font-weight-bold text-info">รายการเทอม</h6>
                            <button class="btn btn-info" data-toggle="modal" data-target="#termModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มเทอมการศึกษา</span>
                            </button>
                        </div>
                        <div class="card-body">

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <div class="text-center font-weight-bold">ปีการศึกษา</div>
                                        <ul class="nav nav-pills flex-column" id="sessionTab" role="tablist">
                                        </ul>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="tab-content" id="sessionTabContent">
                                        </div>
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



    <!-- Add Modal-->
    <div class="modal fade" id="termModal" tabindex="-1" role="dialog" aria-labelledby="termModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termModalLabel">เพิ่มข้อมูลเทอม</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="termForm">
                        <input type="hidden" name="term_id" id="term_id">
                        <div class="form-group">
                            <label for="session">ปีการศึกษา<span class="text-danger">*</span></label>
                            <select class="form-control selectpicker" name="session" id="session" title="โปรดเลือกปีการศึกษา" data-live-search="true">
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sectionName">เทอม<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="term" id="term" placeholder="โปรดระบุเทอม" min=1>
                        </div>
                        <div class="form-group">
                            <label for="sectionName">วันที่เริ่ม<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="start_date" id="start_date" placeholder="โปรดระบุวันเริ่มต้น">
                        </div>
                        <div class="form-group">
                            <label for="sectionName">วันสิ้นสุด<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="end_date" id="end_date" placeholder="โปรดระบุวันที่สิ้นสุด">
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
        var session_active;
        $(document).ready(function() {
            showSessionList();
            showSessionTab();
        });


        function showSessionList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_session_list.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#session').html(data);
                    $('#session').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showSessionTab() {
            $.ajax({
                type: 'POST',
                url: 'ajax_term/ajax_session_tab.php',
                success: function(data) {
                    console.log("sessionTab :" + data)
                    $('#sessionTab').html(data);

                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showSessionTabContent(session_id) {
            session_active = session_id;
            $.ajax({
                type: 'POST',
                url: 'ajax_term/ajax_session_content.php',
                data: {
                    session_id
                },
                success: function(data) {
                    //console.log("ContentTab :" + data)
                    $('#sessionTabContent').html(data);
                    $('#contentDataTable').DataTable({
                        responsive: true,
                        "bPaginate": false,
                        "bFilter": false,
                        "bInfo": false
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        $('#termForm').bootstrapValidator({
            fields: {
                session: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกปีการศึกษา'
                        },
                    }
                },
                term: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเทอม'
                        },
                    }
                },
                start_date: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุวันเริ่มต้นเทอม'
                        },
                    }
                },
                end_date: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุวันสิ้นสุดเทอม'
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
            var id = $('#term_id').val()
            if (id) {
                updateTerm(id);
            } else {
                addTerm()
            }
        }

        function addTerm() {
            Swal.fire({
                title: 'ยืนยันการเพิ่มเทอม',
                text: "คุณต้องการยืนยันการเพิ่มเทอม",
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
                        url: 'ajax_term/ajax_term_add.php',
                        data: $("#termForm").serializeArray(),
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
                                    showSessionTabContent(session_active);
                                    $("#termModal").modal('hide');
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

        function showTermModal(id, session_id, term_name, start_date, end_date) {
            $('#termModal').modal('show');
            $('#saveBtn').html('บันทึก')
            $('#termModalLabel').html('แก้ไขข้อมูลเทอม #' + start_date)
            $('#term_id').val(id);
            $('#session').val(session_id);
            $('#term').val(term_name);
            $('#start_date').val(start_date);
            $('#end_date').val(end_date);
            $('#session').selectpicker('refresh');
        }

        function updateTerm() {

            Swal.fire({
                title: 'แก้ไขข้อมูลเทอม',
                text: "คุณต้องการแก้ไขข้อมูลเทอมหรือไม่?",
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
                        url: 'ajax_term/ajax_term_update.php',
                        data: $("#termForm").serializeArray(),
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อัปเดตข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    showSessionTabContent(session_active);
                                    $("#termModal").modal('hide');
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

        function delTerm(id) {
            console.log("Scool ID : " + id)
            Swal.fire({
                title: 'ลบข้อมูลเทอม',
                text: "คุณต้องการลบเทอมนี้หรือไม่?",
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
                        url: 'ajax_term/ajax_term_del.php',
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
                                    showSessionTabContent(session_active);
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


        $("#termModal").on('hide.bs.modal', function() {
            $("#termForm")[0].reset();
            $("#termForm input:hidden").val('');
            $(".selectpicker").selectpicker('refresh');
            $("#termForm").data('bootstrapValidator').resetForm();
            $("#termModalLabel").html('เพิ่มข้อมูลเทอม');
        });
    </script>

</body>

</html>