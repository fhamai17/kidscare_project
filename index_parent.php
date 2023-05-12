<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>KidCare - แดชบอร์ดผู้ปกครอง</title>
    <?php include './layout/head.php' ?>
    <link rel="stylesheet" type="text/css" media="all" href="daterangepicker.css" />

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

<script type="text/javascript" src="daterangepicker.js"></script>
    <style>
        #pie_chart, #column_chart {
            width: 500px;
            margin: 2px auto;
            padding: 0;
        }

        .dash-primary{
  color: #008FFB !important;
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

                <!-- Topbar -->
                <?php include './layout/topbar.php' ?>
                <!-- End of Topbar -->




                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info">แดชบอร์ด</h1>
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
                                            <select class="form-control selectpicker" name="session_search" id="session_search" title="ปีการศึกษา" onchange="showTermSearchList(),showGradeSearchList(),showSectionSearchList()">
                                                <option value="" selected>ทั้งหมด</option>';
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mb-3">
                                        <label>เทอม</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="term_search" id="term_search" title="เทอม" onchange="showGradeSearchList(),showSectionSearchList()">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-2 mb-3">
                                        <label>ระดับชั้น</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="grade_search" id="grade_search" title="ระดับชั้น" onchange="showSectionSearchList()">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mb-3">
                                        <label>ห้อง</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="section_search" id="section_search" title="ห้องเรียน">
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-sm-2 mb-4 mt-3">
                                        <div class="input-group mt-3">
                                            <button class="btn btn-info" onclick="showAllTab()">
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
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link active" href="#attendance">
                                    <i class='fas fa-school'></i> มาเรียน
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link" href="#leave"><i class="bi bi-pin-map-fill"></i> ลาเรียน</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link" href="#sdq"><i class="bi bi-pin-map-fill"></i> SDQ</a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link" href="#home"><i class="bi bi-pin-map-fill"></i> เยี่ยมบ้าน</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">

                                <div class="tab-pane active py-3" id="attendance">
เข้าเรียน

                                </div>

                                <div class="tab-pane fade py-3" id="leave">
                                   ลาเรียน
                                </div>

                                <div class="tab-pane fade py-3" id="sdq">
                               SDQ    
                                </div>


                                <div class="tab-pane fade py-3" id="home">
                                   เยี่ยมบ้าน
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


<!-- Include Date Range Picker -->
<script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <script>
        var term_cur;
        var session_cur;
        var class_id;
        $(document).ready(function() {
            
            getTermCurrent();
            showClassList();
            showAllTab();
        })


        function showAllTab(){
            showAttendance();
            showLeave();
            showSDQ();
            showHome();
        }

        function showAttendance(){
            $.ajax({
                type: 'POST',
                url: 'ajax_dashboard/ajax_attendance.php',
                success: function(data) {
                    $("#attendance").html(data);
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showLeave(){
            $.ajax({
                type: 'POST',
                url: 'ajax_dashboard/ajax_leave.php',
                success: function(data) {
                    $("#leave").html(data);
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showSDQ(){
            $.ajax({
                type: 'POST',
                url: 'ajax_dashboard/ajax_sdq.php',
                success: function(data) {
                    $("#sdq").html(data);
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showHome(){
            $.ajax({
                type: 'POST',
                url: 'ajax_dashboard/ajax_home.php',
                success: function(data) {
                    $("#home").html(data);
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
                    showGradeSearchList()
                    showSectionSearchList()
                    getClassID();
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


        function showGradeSearchList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_search_list/ajax_grade_list.php',
                async: false,
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                },
                success: function(data) {
                    console.log("Grade Search :" + data)
                    $('#grade_search').html(data);
                    $('#grade_search').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showSectionSearchList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_search_list/ajax_section_list.php',
                async: false,
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    grade: $('#grade_search').val()
                },
                success: function(data) {
                    console.log("Section Search :" + data)
                    $('#section_search').html(data);
                    $('#section_search').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showClassList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_class_list.php',
                success: function(data) {
                    console.log("Class :" + data)
                    $('#class_id').html(data);
                    $('#class_id').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function getClassID() {
            $.ajax({
                type: 'POST',
                url: 'ajax_get_info/ajax_get_class.php',
                async: false,
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    grade: $('#grade_search').val(),
                    section: $('#section_search').val()
                },
                success: function(data) {

                    console.log("Class ID Search :" + data)
                    const obj = JSON.parse(data);
                    if (data) {

                        class_id = obj.class_id;
                        //alert("Class ID" + class_id);
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
