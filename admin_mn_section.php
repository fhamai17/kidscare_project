<?php include('session.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>KidsCare - ห้อง</title>
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
                            <h6 class="m-0 font-weight-bold text-info">รายการห้อง</h6>
                            <button class="btn btn-info" data-toggle="modal" data-target="#sectionModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มห้อง</span>
                            </button>
                        </div>
                        <div class="card-body">

                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <ul class="nav nav-pills flex-column" id="classTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="stdinfo-tab" data-toggle="tab" href="#stdinfo" role="tab" aria-controls="home" aria-selected="true">ข้อมูลส่วนตัว</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="parentinfo-tab" data-toggle="tab" href="#parentinfo" role="tab" aria-controls="profile" aria-selected="false">ข้อมูลผู้ปกครอง</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-md-10">
                                        <div class="tab-content" id="classTabContent">
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
    <div class="modal fade" id="sectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sectionModalLabel">เพิ่มข้อมูลห้อง</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="sectionForm" autocomplete="off">
                        <input type="hidden" name="section_id" id="section_id">
                        <div class="form-group">
                            <label for="session">ระดับชั้น<span class="text-danger">*</span></label>
                            <select class="form-control selectpicker" name="grade" id="grade" title="โปรดระบุระดับชั้น">
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="sectionName">ห้อง<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sectionName" id="sectionName" placeholder="โปรดระบุห้อง">
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
        var grade_active;
        $(document).ready(function() {
            showGradeList();
            showClassTab();
        });


        function showGradeList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_grade_list.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#grade').html(data);
                    $('#grade').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showClassTab(){
            $.ajax({
                type: 'POST',
                url: 'ajax_tab/ajax_nav_tab.php',
                success: function(data) {
                    console.log("ClassTab :" + data)
                    $('#classTab').html(data);


                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showClassTabContent(gradeID){
            grade_active = gradeID;
            $.ajax({
                type: 'POST',
                url: 'ajax_tab/ajax_nav_content.php',
                data:{gradeID},
                success: function(data) {
                    console.log("ContentTab :" + data)
                    $('#classTabContent').html(data);
                    $('#contentDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }
        

        $('#sectionForm').bootstrapValidator({
            fields: {
                grade: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกระดับชั้น'
                        },
                    }
                },
                sectionName: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุห้อง'
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
            var id = $('#section_id').val()
            if (id) {
                updateSection(id);
            } else {
                addSection()
            }
        }

        function addSection() {
            Swal.fire({
                title: 'ยืนยันการเพิ่มห้อง',
                text: "คุณต้องการยืนยันการเพิ่มห้อง",
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
                        url: 'ajax_basic_info/ajax_section_add.php',
                        data: $("#sectionForm").serializeArray(),
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
                                    showClassTabContent(grade_active);
                                    $("#sectionModal").modal("hide");
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

        function showSectionModal(id, sectionName, gradeID) {
            $('#sectionModal').modal('show');
            $('#saveBtn').html('บันทึก')
            $('#sectionModalLabel').html('แก้ไขข้อมูลห้อง #' + id)
            $('#section_id').val(id);
            $('#sectionName').val(sectionName);
            $('#grade').val(gradeID);
            $('#grade').selectpicker('refresh');
        }

        function updateSection() {

            Swal.fire({
                title: 'แก้ไขข้อมูลห้อง',
                text: "คุณต้องการแก้ไขข้อมูลห้องหรือไม่?",
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
                        url: 'ajax_basic_info/ajax_section_update.php',
                        data:$("#sectionForm").serializeArray(),
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อัปเดตข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    //location.reload();
                                    showClassTabContent(grade_active);
                                    $("#sectionModal").modal("hide");
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

        function delSection(id) {
            console.log("Scool ID : " + id)
            Swal.fire({
                title: 'ลบข้อมูลห้อง',
                text: "คุณต้องการลบห้องนี้หรือไม่?",
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
                        url: 'ajax_basic_info/ajax_section_del.php',
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
                                    //location.reload();
                                    showClassTabContent(grade_active);
                                    $("#sectionModal").modal("hide");
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

        $("#sectionModal").on('hide.bs.modal', function() {
            $("#sectionForm")[0].reset();
            $("#sectionForm input:hidden").val('');
            $(".selectpicker").selectpicker("refresh");
            $("#sectionForm").data('bootstrapValidator').resetForm();
            $("#sectionModalLabel").html('เพิ่มข้อมูลห้อง');
        });
    </script>

</body>

</html>