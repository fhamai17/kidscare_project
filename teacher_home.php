<?php
include('session.php');

$user_type = $_SESSION['type'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - Home</title>
    <?php include './layout/head.php' ?>
    <style>
        /* Set the size of the div element that contains the map */
        #map {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
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


                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold">เยี่ยมบ้านนักเรียน</h1>
                        <?php
                        if ($user_type === "คุณครู") {
                        ?>
                            <button class="d-sm-inline-block btn btn-info" data-toggle="modal" data-target="#homeModal">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">สร้างแบบฟอร์มเยี่ยมบ้าน</span>
                            </button>
                        <?php

                        }
                        ?>


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

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link active" href="#home">
                                    <i class="bi bi-house-fill"></i> รายการเยี่ยมบ้าน
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link" href="#gps"><i class="bi bi-pin-map-fill"></i> GPS</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active py-3" id="home">
                                    <div id="home_table">

                                    </div>
                                </div>
                                <div class="tab-pane fade py-3" id="gps">
                                    <div class="map-overlay">
                                        <div id="map">

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


    <!-- Add Modal-->
    <div class="modal fade" id="homeModal" tabindex="-1" role="dialog" aria-labelledby="classModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="classModalLabel">เลือกห้องเรียนสำหรับสร้างแบบประเมิน</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="homeForm">

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="year">ห้องเรียน<span class="text-danger">*</span></label>
                                    <select class="form-control selectpicker" name="class_id" id="class_id" title="โปรดเลือกห้องเรียน" data-live-search="true">
                                    </select>
                                </div>
                            </div>
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

    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>



    <?php include 'layout/script_foot.php' ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA26X6Y2gcGOH30HP9jgrbPP2LffJ1zBew&callback=initMap&v=weekly" defer></script>
    <script>
        var term_cur;
        var session_cur;
        var class_id;
        var json;

        var session_url;
        var term_url;
        var grade_url;
        var section_url;
                    
        var user_type = "<?=$user_type?>";
        $(document).ready(function() {
            getTermCurrent();
            showClassList();
            showHomeTable();
            getlatLng();
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
                    getClassID();
                    alert("Term : " + term_cur + "\n\nSession : " + session_cur)
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
                        alert("Class ID" + class_id);
                    }
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        $('#homeForm').bootstrapValidator({
            fields: {
                classSelect: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกห้องเรียน'
                        },
                    }
                }

            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            addHomeForm();
        });


        function addHomeForm() {
            Swal.fire({
                title: 'สร้างแบบฟอร์มเยี่ยมบ้าน',
                text: "คุณต้องการสร้างแบบฟอร์มเยี่ยมบ้านใช่หรือไม่?",
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
                        url: 'ajax_home/ajax_home_add.php',
                        data: $("#homeForm").serializeArray(),
                        success: function(data) {
                            console.log("Home Add : " + data);
                            var obj = JSON.parse(data)
                            if (obj.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เพิ่มข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    //location.reload();
                                    $('#homeModal').modal('hide');
                                    showHomeTable();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เพิ่มข้อมูลไม่สำเร็จ!',
                                    text: obj.text,
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



        function showHomeTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_home/ajax_home_table.php',
                data: {
                    session: $('#session_search').val(),
                    term: $('#term_search').val(),
                    grade: $('#grade_search').val(),
                    section: $('#section_search').val(),
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



        function initMap() {

            var myLatLng = new google.maps.LatLng(-33.92, 151.25);
            const infoWindow = new google.maps.InfoWindow({
                content: "",
                disableAutoPan: true,
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(getLocation,
                    function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            };

            function handleLocationError(browserHasGeolocation, infoWindow, pos) {

                infoWindow.setPosition(pos);
                infoWindow.setContent(browserHasGeolocation ?
                    'Error: The Geolocation service failed.' :
                    'Error: Your browser doesn\'t support geolocation.');
                infoWindow.open(map);


            }


            function getLocation(my_location) {
                var my_position = new google.maps.LatLng(my_location.coords.latitude, my_location.coords.longitude);
                var icon = {
                    url: "images/here.png", // url
                    scaledSize: new google.maps.Size(50, 50), // size
                    origin: new google.maps.Point(0, 0),
                };
                marker = new google.maps.Marker({
                    position: my_position,
                    map: map,
                    icon: icon,
                    title: "You are here!"
                });
                map.setCenter(my_position);
                myLatLng = new google.maps.LatLng(my_location.coords.latitude, my_location.coords.longitude);
            }


            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: myLatLng
            });

            for (var o in json) {

                lat = json[o].lat;
                lng = json[o].lng;
                name = json[o].name;

                marker = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng),
                    name: name,
                    map: map
                });

                google.maps.event.addListener(marker, 'mouseover', function(e) {
                    infoWindow.setContent(this.name);
                    infoWindow.open(map, this);
                }.bind(marker));

                google.maps.event.addListener(marker, 'mouseout', function(e) {
                    infoWindow.close(map, this);
                }.bind(marker));


                google.maps.event.addListener(marker, 'click', function(e) {
                    var latitude = this.position.lat();
                    var longitude = this.position.lng();
                    window.open('https://maps.google.com?q=' + latitude + ',' + longitude + '', '_blank');
                }.bind(marker));

            }


        }


        function getlatLng() {
            $.ajax({
                type: 'POST',
                url: 'ajax_home/ajax_get_allHome.php',
                data: {
                    class_id
                },
                success: function(res) {
                    console.log("ALL HOME : " + res);
                    json = JSON.parse(res);
                    initMap();
                    //alert(obj.lat);
                    //alert(obj.lng);

                },
                error: function(err) {
                    alert("Error" + err)

                }
            });
        };
    </script>

</body>

</html>