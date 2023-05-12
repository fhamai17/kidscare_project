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
    <title>KidsCare - SDQ</title>
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
                        <h1 class="h3 mb-0 text-info font-weight-bold" id="sdqText">รายการประเมินพฤติกรรมนักเรียน(SDQ)</h1>
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
                                    <div class="col-sm-2 mb-3">
                                        <label>ปีการศึกษา</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="session_search" id="session_search" title="ปีการศึกษา" onchange="showTermSearchList()">
                                                <option value="" selected>ทั้งหมด</option>';
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mb-3">
                                        <label>เทอม</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="term_search" id="term_search" title="เทอม">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-2 mb-4 mt-3">
                                        <div class="input-group mt-3">
                                            <button class="btn btn-info" onclick="showAllTable()">
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
                        <ul class="nav nav-tabs">
                                <li class="nav-item ">
                                    <a data-toggle="tab" class="nav-link active" href="#parent"><i class="fa fa-hand-o-up"></i> ผู้ปกครอง</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link success" href="#result"><i class="fa fa-thumbs-o-up"></i> สรุปผล</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active py-3" id="parent">
                                    <div id="parent_sdq_table">
                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="result">
                                    <div id="result_table">
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
    <?php include 'layout/script_foot.php' ?>


    <script>
        var student_id = "<?= $student_id ?>"
        $(document).ready(function() {
            getTermCurrent();
            showAlltable();
            getStudentName();
        });


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
                    }

                    showSessionSearchList(session_cur)
                    showTermSearchList(term_cur)
                    //alert("Term : " + term_cur + "\n\nSession : " + session_cur)
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        
        function showSessionSearchList(session) {
            session = session_cur;
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

        function showAlltable(){
            showParentTable();
            showResultTable();
        }


        function showParentTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_sdq/ajax_sdq_table.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    student_id,
                    type: "ผู้ปกครอง"
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#parent_sdq_table').html(data);
                    $('#parentDataTable').DataTable({
                        responsive: true,
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showResultTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_sdq/ajax_sdq_resultTable.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    student_id,
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#result_table').html(data);
                    $('#resultDataTable').DataTable({
                        responsive: true,
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

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
                        $("#sdqText").html("รายการประเมินพฤติกรรมนักเรียน " + obj.student_name);
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