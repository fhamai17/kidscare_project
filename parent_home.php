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
    <title>KidsCare - เยี่ยมบ้าน</title>
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
                        <h1 class="h3 mb-0 text-info font-weight-bold" id="homeText">เยี่ยมบ้าน</h1>
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
                                            <button class="btn btn-info" onclick="showHomeTable()">
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
                            <div id="home_table">

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
        var term_cur;
        var session_cur;
        var student_id = "<?= $student_id ?>"
        $(document).ready(function() {
            getTermCurrent();
            showHomeTable();
            getStudentName();
           

        });


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

        function showHomeTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_home/ajax_home_table.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    student_id,
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#home_table').html(data);
                    $('#homeDatatable').DataTable({
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
                        $("#homeText").html("เยี่ยมบ้าน " + obj.student_name);
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