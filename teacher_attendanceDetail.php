<?php
include('session.php');
error_reporting(E_ERROR | E_PARSE);
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - มาเรียนย้อนหลัง</title>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <?php include './layout/head.php' ?>
    <style>
        td.day {
            color: black;
        }

        .datepicker table tr td.disabled,
        .datepicker table tr td.disabled:hover {
            background: 0 0;
            color: #E8E2E2;
            cursor: default;
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
                        <h1 class="h3 mb-0 text-info font-weight-bold">รายการมาเรียนย้อนหลัง</h1>
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
                                            <select class="form-control selectpicker" name="session_search" id="session_search" title="ปีการศึกษา" onchange="showTermSearchList(),getEnabledDay()">
                                                <option value="" selected>ทั้งหมด</option>';
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-2 mb-3">
                                        <label>เทอม</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" name="term_search" id="term_search" title="เทอม" onchange="showGradeSearchList(),getEnabledDay();">
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
                                            <select class="form-control selectpicker" name="section_search" id="section_search" title="ห้องเรียน" >
                                                <option value="" selected>ทั้งหมด</option>;
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-2 mb-3">
                                        <label>วันที่</label>
                                        <div class="datepicker date input-group">
                                            <input type="text" autocomplete="off" placeholder="dd/mm/yyyy" class="form-control " id="date_search" name="date_search">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>

                                        </div>

                                    </div>


                                    <div class="col-sm-2 mb-4 mt-3">
                                        <div class="input-group mt-3">
                                            <button class="btn btn-info" onclick="showAttendanceTable()">
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="attendance_table">

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
        var term_cur;
        var session_cur;
        $(document).ready(function() {

            getTermCurrent();
            showAttendanceTable();
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
                    }

                    showSessionSearchList(session_cur)
                    showTermSearchList(term_cur)
                    showGradeSearchList()
                    showSectionSearchList()
                    getEnabledDay();
                    //alert("Term : " + term_cur + "\n\nSession : " + session_cur)
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function getEnabledDay() {
            $.ajax({
                type: 'POST',
                url: 'ajax_date/ajax_date_enable.php',
                data: {
                    session : $("#session_search").val(),
                    term : $("#term_search").val()
                },
                success: function(data) {
                    var datesEnabled = JSON.parse(data)
                    showdatePicker(datesEnabled)
                    console.log("Date :" + data)
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showdatePicker(datesEnabled){
            $("#back_date").val("");
            $( ".datepicker" ).datepicker("destroy");
            $(".datepicker").datepicker({
                    autoclose: true,
                    //todayBtn: true,
                    format: 'yyyy-mm-dd',
                    // On n'active que les dates possibles
                     beforeShowDay: function(date) {
                        var allDates = date.getFullYear() + "-" + ('0' + (date.getMonth() + 1)).slice(-2) + "-" + ('0' + date.getDate()).slice(-2);
                        if (datesEnabled.indexOf(allDates) != -1) {
                            return {
                                classes: 'date-possible',
                                tooltip: 'วันที่ที่คุณเลือกได้'
                            }
                        } else {
                            return false;
                        }
                    } 

                });

                 $( ".datepicker" ).datepicker("refresh");
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

        function showAttendanceTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_attendance/ajax_attendance_table.php',
                data: {
                    date: $("#date_search").val(),
                    grade: $("#grade_search").val(),
                    section: $("#section_search").val(),
                    detail: "Detail",
                },
                async: false,
                success: function(data) {
                    console.log("BackHome table  :" + data)
                    $('#attendance_table').html(data);
                    $('#attDataTable').DataTable({
                        order: [
                            [2, 'desc']
                        ],
                        pageLength: 10,
                        lengthMenu: [
                            [5, 10, 20, -1],
                            [5, 10, 20, 'Todos']
                        ]
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function updateStatusAtt(id,status){
            Swal.fire({
                    title: 'เปลี่ยนสถานะการมาเรียน',
                    text: 'คุณต้องการเปลี่ยนสถานะการมาเรียนใช่หรือไม่?',
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
                            html: "โปรดรอสักครู่",
                            didOpen: function() {
                                Swal.showLoading()
                            }
                        })

                        $.ajax({
                            type: 'POST',
                            url: 'ajax_attendance/ajax_attendance_update.php',
                            data: {id,
                                status
                            },
                            success: function(res) {
                                console.log("Update Status : " + res);
                                if (res.search("Update Successful") != -1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'อัปเดตสถานะสำเร็จ!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        showAttendanceTable();
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'อัปเดตสถานะไม่สำเร็จ!',
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
                })
        }
    </script>

</body>

</html>