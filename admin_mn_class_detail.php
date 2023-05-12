<?php include('session.php') ?>
<?php
$id = $_GET['class_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <title>KidCare - จัดการห้องเรียน</title>
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
                            <h6 class="m-0 font-weight-bold text-info" id="classroom">รายการข้อมูลนักเรียน </h6>
                            <button class="btn btn-info" data-toggle="modal" data-target="#addStudentModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มนักเรียนเข้าชั้นเรียน</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="container">
                            <h6 class="pb-3" id="detail">รายการข้อมูลนักเรียน </h6>
                                <div id="studentContent">

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


    <!-- Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="addStudentModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalCenterTitle">รายชื่อนักเรียน</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="student_list">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
                    <button type="button" class="btn btn-primary" onclick="addStudent()">บันทึก</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>

    <?php include 'layout/script_foot.php' ?>

    <script>
        var session;
        var class_id = "<?= $id ?>";
        $(document).ready(function() {
            showClassroomDetail();
            showStudentTable();
            showStudentClassTable();

        });


        function showClassroomDetail() {
            $.ajax({
                type: 'POST',
                url: 'ajax_classroom/ajax_classroom_detail.php',
                data: {
                    id: "<?= $id ?>"
                },
                success: function(data) {
                    console.log("Classroom :" + data)
                    const obj = JSON.parse(data);
                    if (data) {
                        $('#classroom').html('รายการข้อมูลนักเรียนห้อง ' + obj.class_name);
                        $('#detail').html('ระดับชั้น' + obj.grade + ' ห้อง ' + obj.section + '<br>ปีการศึกษา ' + obj.session_name+' เทอม ' + obj.term_name);
                        session = obj.session_id;
                        term = obj.term_id;
                    }
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

       
        function showStudentClassTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_classroom/ajax_classroom_content.php',
                data: {
                    class_id
                },
                success: function(data) {
                    console.log("ContentTab :" + data)
                    $('#studentContent').html(data);
                    $('#studentDatatable').DataTable({
                        responsive: true,
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showStudentTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_classroom/ajax_student_list.php',
                data:{class_id},
                success: function(data) {
                    console.log("Test :" + data)
                    $('#student_list').html(data);
                    $('#studentListDataTable').DataTable({

                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function addStudent() {

            var studentArray = new Array();
            $('input[type=checkbox]').each(function() {
                if (this.checked) {
                    studentArray.push($(this).val());
                };
            });

            if (studentArray.length === 0) {
                alert("โปรดเลือกนักเรียน");
            } else {
                $.ajax({
                    type: 'POST',
                    url: 'ajax_classroom/ajax_classroom_add.php',
                    data: {
                        studentArray,
                        class_id
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.search("Add Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เพิ่มข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    $("#addStudentModal").modal('hide');
                                    $('.stdCheck').prop('checked', false);
                                    showStudentClassTable();
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
        }


        function delStudentFromTerm(id) {
            console.log("Student ID : " + id)
            Swal.fire({
                title: 'ลบข้อมูลนักเรียนออกจากห้อง',
                text: "คุณต้องการลบข้อมูลนักเรียนออกจากห้องหรือไม่?",
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
                        url: 'ajax_classroom/ajax_classroom_delStudent.php',
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
                                    showStudentClassTable();
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
    </script>

</body>

</html>