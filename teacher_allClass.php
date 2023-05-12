<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>KidCare - การบ้าน</title>
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


                
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold">รายการห้องเรียนของฉัน</h1>
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
                                    <div class="col-sm-3">
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

                                    <div class="col-sm-4">
                                        <label>เทอม</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker mr-4" name="term_search" id="term_search" title="เทอม" onchange="showClassSearchList()">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>

                                            <button class="btn btn-info" onclick="showClassTable()">
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


                    <!-- Begin Card-->
                    <div class="card shadow mt-4 mb-4">
                        <div class="card-body">
                        <div id="class_table">
                        
                    </div>
                        </div>
                    </div>
 <!-- End Card -->

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
    <script>
        var term_cur;
        var session_cur;
        $(document).ready(function() {
            getTermCurrent();
            showYearList();

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
                        showClassTable();
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

        function showClassTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_homework/ajax_homework_class.php',
                data: {
                    session_search: $('#session_search').val(),
                    term_search: $('#term_search').val(),
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#class_table').html(data);
                    $('#classDataTable').DataTable({

                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


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
        
        function showSectionList(section) {
            if(!section){
                section ="";
            }
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_section_list.php',
                data: {
                    grade: $('#grade').val(),
                    section
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#section').html(data);
                    $('#section').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showYearList() {
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

        function showTermList(term) {
            if(!term){
                term ="";
            }
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_term_list.php',
                data: {
                    session: $('#session').val(),
                    term
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#term').html(data);
                    $('#term').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showTeacherList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_teacher_list.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#teacher').html(data);
                    $('#teacher').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function checkEmptyID() {
            var id = $('#class_id').val()
            if (id) {
                updateClass(id);
            } else {
                addClass()
            }
        }

        function addClass() {
            Swal.fire({
                title: 'เพิ่มข้อมูลห้องเรียน',
                text: "คุณต้องการเพิ่มข้อมูลห้องเรียนหรือไม่?",
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
                        url: 'ajax_class/ajax_class_add.php',
                        data: $("#classForm").serializeArray(),
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
                                    $("#classModal").modal("hide");
                                    showClassTable();
                                    
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

        function showClassModal(id, class_name, grade, section, session, term, teacher) {
            $('#classModal').modal('show');
            $('#classModalLabel').html('แก้ไขข้อมูลห้องเรียน #' + id)
            $('#class_id').val(id);
            $('#class_name').val(class_name);
            $('#grade').val(grade);
            $('#session').val(session);

            showSectionList(section);
            showTermList(term);

            $('#section').val(section);
            $('#term').val(term);
            $('#teacher').val(teacher);
            $('.selectpicker').selectpicker('refresh');
        }

        function updateClass() {
            Swal.fire({
                title: 'แก้ไขข้อมูลห้องเรียน',
                text: "คุณต้องการแก้ไขข้อมูลห้องเรียน?",
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
                        url: 'ajax_class/ajax_class_update.php',
                        data: $("#classForm").serializeArray(),

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
                                    $("#classModal").modal("hide");
                                    showClassTable();
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

        function delClass(id) {
            console.log("Scool ID : " + id)
            Swal.fire({
                title: 'ลบข้อมูลห้องเรียน',
                text: "คุณต้องการลบข้อมูลห้องเรียน?",
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
                        url: 'ajax_class/ajax_class_del.php',
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
                                    $("#classModal").modal("hide");
                                    showClassTable();
                                    
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

       $('#classForm').bootstrapValidator({
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
                            message: 'โปรดเลือกเทอม'
                        },
                    }
                },
                class_name: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อห้องเรียน'
                        },
                    }
                },
                grade: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกระดับชั้น'
                        },
                    }
                },
                section: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกห้องเรียน'
                        },
                    }
                },
                teacher: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกคุณครูประจำชั้น'
                        },
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            checkEmptyID();
        });


        $("#classModal").on('hide.bs.modal', function() {
            $("#classForm")[0].reset();
            $("#classForm input:hidden").val('');
            $(".selectpicker").selectpicker("refresh");
            $("#classForm").data('bootstrapValidator').resetForm();
            $("#classModalLabel").html('เพิ่มข้อมูลปีการศึกษา');
        });
    </script>

</body>

</html>