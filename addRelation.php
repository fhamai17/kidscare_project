<?php
include('session.php');
$type = $_SESSION['type'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - ความสัมพันธ์ของฉัน</title>
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
                 <h1 class="h3 mb-0 text-info font-weight-bold">รายการความสัมพันธ์ของคุณ></h1>
                            <button class="btn btn-info" data-toggle="modal" data-target="#relationModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">ขอเป็นผู้ปกครอง</span>
                            </button>


                    </div>
                    <p><span class="text-danger">*</span>โปรดอัปเดตรูปภาพเพื่อได้รับการอนุมัติที่ไวขึ้น</p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            
                        
                            <div id="relation_table">

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
    <div class="modal fade" id="relationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="leaveLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" id="leaveContent">
                <div class="modal-header">
                    <h5 class="modal-title" id="relationModalLabel">ความสัมพันธ์</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form id="relationForm">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="form-group col-sm-5">
                                <label for="exampleInputEmail1">นักเรียน</label>
                                <select name="student" id="student" class="form-control selectpicker" data-live-search="true">
                                    <option value="" disabled selected>-โปรดเลือกนักเรียน-</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">ผู้ปกครอง<span class="text-danger">*</span></label>
                        </div>

                        <div class="row">

                            <div class="form-group col-sm-5">
                                <input type="text" class="form-control" id="parent_name" placeholder="ชื่อ-สกุลผู้ปกครอง" value="<?= $_SESSION['name'] ?>" readonly>
                            </div>
                            <label for="inputPassword" class="col-sm-2 col-form-label text-center">เกี่ยวข้องเป็น</label>
                            <div class="form-group col-sm-5">
                                <select name="relation" id="relation" class="form-control selectpicker" data-live-search="true" data-size="5" onchange="selectRelation()">
                                    <option value="" disabled selected>-โปรดเลือกความเกี่ยวข้อง-</option>
                                </select>
                                <input type="text" class="form-control mt-1" id="other" name="other" placeholder="อื่นๆ โปรดระบุ" style="display:none">
                            </div>
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
        $(document).ready(function() {
            showRelationTable();
        });


        function showRelationTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_relation/ajax_prelation_table.php',
                success: function(data) {
                    //console.log("Test :" + data)
                    $('#relation_table').html(data);
                    $('#relationDataTable').DataTable({
                        /* responsive: true */
                    });

                    getStudentList();
                    getRelationList();
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function getRelationList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_relation_list.php',
                success: function(data) {
                    console.log("Select Picker " + data)
                    $('#relation').html(data);
                    //$('#std_row'+num).selectpicker('refresh');
                    $('.selectpicker').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function getStudentList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_student_list.php',
                success: function(data) {
                    console.log("Select Picker " + data)
                    $('#student').html(data);
                    //$('#std_row'+num).selectpicker('refresh');
                    $('.selectpicker').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function selectRelation() {
            var relation = $('#relation').val();
            if (relation === "อื่นๆ") {
                $('#other').show();
            } else {
                $('#other').hide();
                $('#other').val('');
            }
        }


        $('#relationForm').bootstrapValidator({
            excluded: [':disabled', ':hidden', ':not(:visible)'],
            fields: {
                student: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกนักเรียน'
                        },
                    }
                },
                relation: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกความสัมพันธ์'
                        }
                    }
                },
                other: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุความสัมพันธ์'
                        }
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            alert("Correct!");
            checkEmptyID();
        });



        function addRelation() {
            Swal.fire({
                title: "กำลังโหลด...",
                html: "โปรดรอสักครู่",
                didOpen: function() {
                    Swal.showLoading()
                }
            })
            $.ajax({
                type: 'POST',
                url: 'ajax_relation/ajax_relation_add.php',
                data: $("#relationForm").serializeArray(),
                success: function(res) {
                    console.log("Res : " + res);
                    if (res.search("Add Successful") != -1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลสำเร็จ!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            $('#relationModal').modal('hide');
                            showRelationTable();
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


        function updateRelation() {
            Swal.fire({
                title: "กำลังโหลด...",
                html: "โปรดรอสักครู่",
                didOpen: function() {
                    Swal.showLoading()
                }
            })
            $.ajax({
                type: 'POST',
                url: 'ajax_relation/ajax_relation_update.php',
                data: $("#relationForm").serializeArray(),
                success: function(res) {
                    console.log("Res : " + res);
                    if (res.search("Successful") != -1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสำเร็จ!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            $('#relationModal').modal('hide');
                            showRelationTable();
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
                updateRelation();
            } else {
                addRelation()
            }
        }

        function delRelation(id) {
            console.log("DELETE " + id)
            Swal.fire({
                title: 'ลบข้อมูลความสัมพันธ์',
                text: "คุณต้องการลบข้อมูลความสัมพันธ์นี้หรือไม่?",
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
                        url: 'ajax_relation/ajax_relation_del.php',
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
                                    showRelationTable();
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


        function showRelationModal(id, parent_id, student_id, relation, option) {
            $('#relationModal').modal('show');
            $('#id').val(id);
            $('#student').val(student_id);
            $('#relation').val(relation);
            $('.selectpicker').selectpicker('refresh');
            if (option === "Edit") {
                $("#relationForm :input").prop("disabled", false);
                $('#relationModalLabel').html('แก้ไขข้อมูลความสัมพันธ์ #' + id)
                $('#saveBtn').show();
            } else {
                $('#relationModalLabel').html('รายละเอียดความสัมพันธ์ #' + id)
                $("#relationForm :input").prop("disabled", true);
                $('#saveBtn').hide();
            }
        }


        $("#relationModal").on('hidden.bs.modal', function() {
            $('#relationForm')[0].reset();
            $("#relationForm input:hidden").val('');
            $("#relationForm :input").prop("disabled", false);
            $(".selectpicker").selectpicker("refresh");
            $('#relationModalLabel').html('ขอเป็นผู้ปกครอง')
            $('#other').hide();
            $('#saveBtn').show();
        });
    </script>

</body>

</html>