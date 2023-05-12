<?php
include ('session.php');
error_reporting(E_ERROR | E_PARSE);
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - เช็คชื่อ</title>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
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
                            <h6 class="m-0 font-weight-bold text-info">เช็คชื่อมาเรียน</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <video id="preview" width="100%"></video>
                                    <div id="alert_insert" role="alert">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="scnner">
                                        <label>SCAN QR CODE</label>
                                        <input type="text" class="form-control" name="studentID" id="studentID" readonly placeholder="Scan QR Code">
                                    </div>
                                    <div class="mt-5" id="attendance_table">

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
        var scanner = new Instascan.Scanner({
            video: document.getElementById('preview'),
            scanPeriod: 5,
            mirror: false
        });


        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
                $('[name="options"]').on('change', function() {
                    if ($(this).val() == 1) {
                        if (cameras[0] != "") {
                            scanner.start(cameras[0]);
                        } else {
                            alert('No Front camera found!');
                        }
                    } else if ($(this).val() == 2) {
                        if (cameras[1] != "") {
                            scanner.start(cameras[1]);
                        } else {
                            alert('No Back camera found!');
                        }
                    }
                });
            } else {
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
            alert(e);
        });


        scanner.addListener('scan', function(content) {
            //document.getElementById('text').value = c;
            $('#studentID').val(content);

            $.ajax({
                type: 'POST',
                url: 'ajax_attendance/ajax_attendance_add.php',
                data: {
                    stdID: $('#studentID').val()
                },
                success: function(data) {

                    if (data.search("Add Successful") != -1) {
                        $('#alert_insert').html('<div class="alert alert-success" role="alert">Add Data Successful!</div>')
                        Swal.fire({
                            icon: 'success',
                            title: 'เช็คชื่อนักเรียนสำเร็จ!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            showAttendanceTable();
                        })
                    } else {
                        $('#alert_insert').html('<div class="alert alert-danger" role="alert">This is a warning alert—check it out!</div>')
                        Swal.fire({
                            icon: 'error',
                            title: 'เช็คชื่อนักเรียนไม่สำเร็จ!',
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



            //window.location.href=content;
        });
        /*  let scanner = new Instascan.Scanner({
             video: document.getElementById('preview')
         });
         Instascan.Camera.getCameras().then(function(cameras) {
             if (cameras.length > 0) {
                 scanner.start(cameras[0]);
             } else {}
             alert('No cameras found');
         }).catch(function(e) {});
         console.error(e);
         scanner.addListener('scan', function(c) {});
         document.getElementById('text').value = c; */
    </script>

    <script>
        $(document).ready(function() {
            showAttendanceTable();
        });

        function showAttendanceTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_attendance/ajax_attendance_table.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#attendance_table').html(data);
                    $('#attDataTable').DataTable({
                        order: [
                            [2, 'desc']
                        ],
                        pageLength: 5,
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


        function addAttendanceStd() {
            $.ajax({
                type: 'POST',
                url: 'ajax_attendance/ajax_attendance_add.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#attendance_table').html(data);
                    $('#attendanceDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }
    </script>

</body>

</html>