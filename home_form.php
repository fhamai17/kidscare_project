<?php
//include 'dbconfig.php';
session_start();
/* 
$sql = "SELECT lat, lng FROM home WHERE home_id = '1'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if ($row) {

    $lat = $row['lat'];
    $lng = $row['lng'];
} */
if (isset($_GET['home_id'])) {
    $home_id = $_GET['home_id'];
} else {
    $home_id = "";
}

if (isset($_GET['option'])) {
    $option = $_GET['option'];
} else {
    $option = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>KidCare - Manage Class</title>
    <style>
        /* Set the size of the div element that contains the map */
        #map,
        .jumbotron {
            height: 400px;
            /* The height is 400 pixels */
            width: 100%;
            /* The width is the width of the web page */
        }



        .center {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .form-input {
            width: 350px;
            padding: 20px;
        }

        .form-input input {
            display: none;

        }

        .form-input label {
            display: block;
            width: 45%;
            height: 45px;
            margin: 0px auto;
            line-height: 50px;
            text-align: center;
            background: #F5DEAB;

            color: #000;
            font-size: 15px;
            text-transform: Uppercase;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-input img {
            width: 100%;
            display: none;

            margin-bottom: 30px;
        }


        .img-preview {
            width: 100% !important;
            /* height: 315px !important; */
            object-fit: cover !important;
            background-color: #dfdfdf;

        }

        .img-preview2 {
            width: 200px !important;
            height: 250px !important;
            object-fit: cover !important;
            background-color: #dfdfdf;
        }

        .hr1 {
            border: 1;
            border-top: 3px solid #36b9cc;
            margin: 0;
        }
    </style>

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
                        <div class="card-header text-center py-3">
                            <h3 class="m-0 font-weight-bold text-info" id="topic">แบบบันทึกการเยี่ยมบ้านนักเรียน</h3>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-3 ">
                                    <div class="center">
                                        <div class="form-input">
                                            <img src="images/anonymous.jpg" id="student_pic" class="mx-auto d-block img-preview2">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-9">
                                    <h1 class="h6 text-info  font-weight-bold">ข้อมูลส่วนตัวนักเรียน
                                        <hr class="hr1">
                                    </h1>
                                    <div class="form-group row">

                                        <div class="form-group col-sm-6 ">
                                            <label for="validationServer01" class="form-label">ครูที่ปรึกษา</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person-circle"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="teacher_name" id="teacher_name" placeholder="กรอกอัตโนมัติ" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6 ">
                                            <label for="validationServer01" class="form-label">รหัสนักเรียน</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="student_id" id="student_id" placeholder="กรอกอัตโนมัติ" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6 ">
                                            <label for="validationServer01" class="form-label">ชื่อ-สกุล</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="student_name" id="student_name" placeholder="กรอกอัตโนมัติ" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-6 ">
                                            <label for="validationServer01" class="form-label">ชื่อเล่น</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="nickname" id="nickname" placeholder="กรอกอัตโนมัติ" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-4 ">
                                            <label for="validationServer01" class="form-label">วันเกิด</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-calendar-fill"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="birthdate" id="birthdate" placeholder="กรอกอัตโนมัติ" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-4 ">
                                            <label for="validationServer01" class="form-label">ระดับชั้น</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-mortarboard-fill"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="grade" id="grade" placeholder="กรอกอัตโนมัติ" disabled>
                                            </div>
                                        </div>

                                        <div class="form-group col-sm-4 ">
                                            <label for="validationServer01" class="form-label">ห้อง</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-123"></i></span>
                                                </div>
                                                <input type="text" class="form-control " name="section" id="section" placeholder="กรอกอัตโนมัติ" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#menu1">แผนที่</a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#menu2">แบบประเมินการเยี่ยมบ้าน</a>
                                </li>
                            </ul>



                            <div class="tab-content">
                                <div class="tab-pane active " id="menu1">

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="form-group col-sm-12 ">
                                                <h1 class="h6 text-info  font-weight-bold">แผนที่บ้าน
                                                    <hr class="hr1">
                                                </h1>
                                            </div>
                                        </div>

                                        <?php
                                        if ($_SESSION['type'] == "ผู้ปกครอง") {
                                        ?>

                                            <div class="text-center mb-4">
                                                <button type="button" class="find-me btn btn-info btn-block" onclick="findMyLocation()">ค้นหาที่อยู่ของฉัน</button>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <form id="geocoding_form">
                                            <div class="row">
                                                <div class="form-group col-sm-6 ">
                                                    <label for="latitude" class="form-label">ละติจูด</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control " name="latitude" id="latitude" placeholder="โปรดระบุละติจูด">
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-6 ">
                                                    <label for="longitude" class="form-label">ลองจิจูด</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="fas fa-map-pin"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control " name="longitude" id="longitude" placeholder="โปรดระบุลองจิจูด">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="map-overlay">
                                                <div id="map"></div>
                                            </div>

                                            <?php
                                            if ($_SESSION['type'] == "ผู้ปกครอง") {
                                            ?>
                                                <div class="d-sm-flex align-items-center justify-content-center m-4">
                                                    <button type="submit" class="btn btn-sky" id="btn_submit">
                                                        บันทึกแผนที่
                                                    </button>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                    </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="menu2">
                                    <div class="card-body">
                                        <form id="homeForm" autocomplete="off">
                                            <input type="hidden" name="home_id" id="home_id" value="<?= $home_id ?>">
                                            <div class="row">
                                                <div class="form-group col-sm-12 ">
                                                    <h1 class="h6 text-info  font-weight-bold">เกี่ยวกับตัวนักเรียน
                                                        <hr class="hr1">
                                                    </h1>
                                                </div>
                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">โรคประจำตัว</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no01[]" id="no01_1" value="1">
                                                        <label class="form-check-label" for="no01_1">ภูมิแพ้</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no01[]" id="no01_2" value="2">
                                                        <label class="form-check-label" for="no01_2">เบาหวาน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no01[]" id="no01_3" value="3">
                                                        <label class="form-check-label" for="no01_3">ไมเกรน </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no01[]" id="no01_4" value="4">
                                                        <label class="form-check-label" for="no01_4">โลหิตจาง </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no01[]" id="no01_5" value="5">
                                                        <label class="form-check-label" for="no01_5">หอบหืด </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no01[]" id="no01_6" value="6">
                                                        <label class="form-check-label" for="no01_6">ไม่มี </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no01[]" id="no01_7" value="7">
                                                        <label class="form-check-label" for="no01_7">อื่นๆ </label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">ศาสนา</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no02" id="no02_1" value="1">
                                                        <label class="form-check-label" for="no02_1">พุทธ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no02" id="no02_2" value="2">
                                                        <label class="form-check-label" for="no02_2">คริสต์</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no02" id="no02_3" value="3">
                                                        <label class="form-check-label" for="no02_3">อิสลาม</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no02" id="no02_4" value="4">
                                                        <label class="form-check-label" for="no02_4">อื่นๆ</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">สัญชาติ</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no03" id="no03_1" value="1">
                                                        <label class="form-check-label" for="no03_1">ไทย</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no03" id="no03_2" value="2">
                                                        <label class="form-check-label" for="no03_2">พม่า</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no03" id="no03_3" value="3">
                                                        <label class="form-check-label" for="no03_3">ลาว</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no03" id="no03_4" value="4">
                                                        <label class="form-check-label" for="no03_4">กัมพูชา</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no03" id="no03_5" value="5">
                                                        <label class="form-check-label" for="no03_5">อื่นๆ</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">งานอดิเรก</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no04[]" id="no04_1" value="1">
                                                        <label class="form-check-label" for="no04_1">เล่นเกมส์</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no04[]" id="no04_2" value="2">
                                                        <label class="form-check-label" for="no04_2">ดูหนัง/ฟังเพลง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no04[]" id="no04_3" value="3">
                                                        <label class="form-check-label" for="no04_3">ท่องโลกอินเทอร์เน็ต/สังคมออนไลน์ </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no04[]" id="no04_4" value="4">
                                                        <label class="form-check-label" for="no04_4">เล่นกีฬา</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no04[]" id="no04_5" value="5">
                                                        <label class="form-check-label" for="no04_5">เล่นดนตรี </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no04[]" id="no04_6" value="6">
                                                        <label class="form-check-label" for="no04_6">อ่านหนังสือ </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="checkbox" name="no04[]" id="no04_7" value="7">
                                                        <label class="form-check-label" for="no04_7">อื่นๆ </label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="form-group col-sm-12 ">
                                                    <h1 class="h6 text-info  font-weight-bold mt-3">เกี่ยวกับครอบครัว
                                                        <hr class="hr1">
                                                    </h1>
                                                </div>
                                                <div class="form-group text-gray-900 col-sm-6 ">
                                                    <label for="validationServer01" class="h6 text-gray-900 font-weight-bold">ชื่อผู้ปกครอง</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control " name="fname" id="fname" placeholder="โปรดระบุชื่อผู้ปกครอง">
                                                    </div>
                                                </div>

                                                <div class="form-group text-gray-900 col-sm-6 ">
                                                    <label for="validationServer01" class="h6 text-gray-900 font-weight-bold">เบอร์โทรศัพท์</label>
                                                    <div class="input-group ">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        </div>
                                                        <input type="tel" class="form-control " name="fphone" id="fphone" placeholder="โปรดระบุเบอร์โทรศัพท์">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">เกี่ยวข้องเป็น</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no05" id="no05_1" value="1">
                                                        <label class="form-check-label" for="no05_1">บิดา</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no05" id="no05_2" value="2">
                                                        <label class="form-check-label" for="no05_2">มารดา</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no05" id="no05_3" value="3">
                                                        <label class="form-check-label" for="no05_3">พี่ชาย</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no05" id="no05_4" value="4">
                                                        <label class="form-check-label" for="no05_4">พี่สาว</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no05" id="no05_5" value="5">
                                                        <label class="form-check-label" for="no05_5">อื่นๆ</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">อาชีพของผู้ปกครอง</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no06" id="no06_1" value="1">
                                                        <label class="form-check-label" for="no06_1">เกษตรกร</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no06" id="no06_2" value="2">
                                                        <label class="form-check-label" for="no06_2">ค้าขาย</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no06" id="no06_3" value="3">
                                                        <label class="form-check-label" for="no06_3">รับราชการ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no06" id="no06_4" value="4">
                                                        <label class="form-check-label" for="no06_4">แม่บ้าน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no06" id="no06_5" value="5">
                                                        <label class="form-check-label" for="no06_5">รับจ้าง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no06" id="no06_6" value="6">
                                                        <label class="form-check-label" for="no06_6">ไม่มีงานทำ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no06" id="no06_7" value="7">
                                                        <label class="form-check-label" for="no06_7">อื่นๆ</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">รายได้ของครอบครัว ผู้ปกครองมีรายได้ต่อเดือน ประมาณ</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no07" id="no07_1" value="1">
                                                        <label class="form-check-label" for="no07_1">น้อยกว่า 12,000 บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no07" id="no07_2" value="2">
                                                        <label class="form-check-label" for="no07_2">12,000 - 30,000 บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no07" id="no07_3" value="3">
                                                        <label class="form-check-label" for="no07_3">มากกว่า 30,000 บาท</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="form-group col-sm-12 ">
                                                    <h1 class="h6 text-info  font-weight-bold">สภาพการเป็นอยู่
                                                        <hr class="hr1">
                                                    </h1>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">นักเรียนเดินทางมาโรงเรียนโดย</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no08" id="no08_1" value="1">
                                                        <label class="form-check-label" for="no08_1">เดิน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no08" id="no08_2" value="2">
                                                        <label class="form-check-label" for="no08_2">ผู้ปกครองมาส่ง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no08" id="no08_3" value="3">
                                                        <label class="form-check-label" for="no08_3">รถรับส่ง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no08" id="no08_4" value="4">
                                                        <label class="form-check-label" for="no08_4">รถโดยสาร</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no08" id="no08_5" value="5">
                                                        <label class="form-check-label" for="no08_5">รถยนต์</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no08" id="no08_6" value="6">
                                                        <label class="form-check-label" for="no08_6">รถจักรยานยนต์</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">ระยะทางระหว่างบ้านกับโรงเรียน</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no09" id="no09_1" value="1">
                                                        <label class="form-check-label" for="no09_1">0 - 5 กิโลเมตร</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no09" id="no09_2" value="2">
                                                        <label class="form-check-label" for="no09_2">6 - 10 กิโลเมตร</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no09" id="no09_3" value="3">
                                                        <label class="form-check-label" for="no09_3">11 - 15 กิโลเมตร</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no09" id="no09_4" value="4">
                                                        <label class="form-check-label" for="no09_4">16 - 20 กิโลเมตร</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no09" id="no09_5" value="5">
                                                        <label class="form-check-label" for="no09_5">20 กิโลเมตรขึ้นไป</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">สถานภาพของบิดามารดา</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no10" id="no10_1" value="1">
                                                        <label class="form-check-label" for="no10_1">บิดามารดาอยู่ด้วยกัน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no10" id="no10_2" value="2">
                                                        <label class="form-check-label" for="no10_2">บิดามารดาหย่าร้างกัน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no10" id="no10_3" value="3">
                                                        <label class="form-check-label" for="no10_3">บิดาถึงแก่กรรม</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no10" id="no10_4" value="4">
                                                        <label class="form-check-label" for="no10_4">มารดาถึงแก่กรรม</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no10" id="no10_5" value="5">
                                                        <label class="form-check-label" for="no10_5">บิดาและมารดาถึงแก่กรรม</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no10" id="no10_6" value="6">
                                                        <label class="form-check-label" for="no10_6">ถูกทอดทิ้ง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no10" id="no10_7" value="7">
                                                        <label class="form-check-label" for="no10_7">ไม่ทราบ</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">นักเรียนอาศัยอยู่กับ</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no11" id="no11_1" value="1">
                                                        <label class="form-check-label" for="no11_1">บิดาและมารดา</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no11" id="no11_2" value="2">
                                                        <label class="form-check-label" for="no11_2">บิดา</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no11" id="no11_3" value="3">
                                                        <label class="form-check-label" for="no11_3">มารดา</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no11" id="no11_4" value="4">
                                                        <label class="form-check-label" for="no11_4">ญาติ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no11" id="no11_5" value="5">
                                                        <label class="form-check-label" for="no11_5">อยู่ตามลำพัง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no11" id="no11_6" value="6">
                                                        <label class="form-check-label" for="no11_6">ผู้อุปการะ/นายจ้าง</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">บ้านพัก</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no12" id="no12_1" value="1">
                                                        <label class="form-check-label" for="no12_1">บ้านตนเอง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no12" id="no12_2" value="2">
                                                        <label class="form-check-label" for="no12_2">บ้านนายจ้าง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no12" id="no12_3" value="3">
                                                        <label class="form-check-label" for="no12_3">บ้านเช่า/ห้องเช่า</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no12" id="no12_4" value="4">
                                                        <label class="form-check-label" for="no12_4">บ้านคนอื่น</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no12" id="no12_5" value="5">
                                                        <label class="form-check-label" for="no12_5">บ้านพักข้าราชการ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no12" id="no12_6" value="6">
                                                        <label class="form-check-label" for="no12_6">ผู้อุปการะ/นายจ้าง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no12" id="no12_7" value="7">
                                                        <label class="form-check-label" for="no12_7">บ้านพักคนงาน/ลูกจ้าง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no12" id="no12_8" value="8">
                                                        <label class="form-check-label" for="no12_8">หอพักนักกีฬา</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">ลักษณะของที่อยู่อาศัย</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no13" id="no13_1" value="1">
                                                        <label class="form-check-label" for="no13_1">บ้านชั้นเดียว</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no13" id="no13_2" value="2">
                                                        <label class="form-check-label" for="no13_2">ห้องแถว</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no13" id="no13_3" value="3">
                                                        <label class="form-check-label" for="no13_3">อาคารพาณิชย์</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no13" id="no13_4" value="4">
                                                        <label class="form-check-label" for="no13_4">บ้านพักสวัสดิการ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no13" id="no13_5" value="5">
                                                        <label class="form-check-label" for="no13_5">หอพัก</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no13" id="no13_6" value="6">
                                                        <label class="form-check-label" for="no13_6">เพิงพัก/กระท่อม</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">สภาพแวดล้อม ชุมชน ที่นักเรียนอาศัยอยู่</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no14" id="no14_1" value="1">
                                                        <label class="form-check-label" for="no14_1">ชุมชนน่าอยู่ การคมนาคมสะดวก</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no14" id="no14_2" value="2">
                                                        <label class="form-check-label" for="no14_2">ชมชนแออัด เพื่อนบ้านไม่เป็นมิตร</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no14" id="no14_3" value="3">
                                                        <label class="form-check-label" for="no14_3">ชุมชนห่างไกล การคมนาคมไม่สะดวก</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no14" id="no14_4" value="4">
                                                        <label class="form-check-label" for="no14_4">อยู่โดดเดี่ยวในสวน/ป่า</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">ลักษณะของที่อยู่อาศัย</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no15" id="no15_1" value="1">
                                                        <label class="form-check-label" for="no15_1">บิดา</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no15" id="no15_2" value="2">
                                                        <label class="form-check-label" for="no15_2">มารดา</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no15" id="no15_3" value="3">
                                                        <label class="form-check-label" for="no15_3">พี่ชาย</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no15" id="no15_4" value="4">
                                                        <label class="form-check-label" for="no15_4">พี่สาว</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no15" id="no15_5" value="5">
                                                        <label class="form-check-label" for="no15_5">น้องชาย</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no15" id="no15_6" value="6">
                                                        <label class="form-check-label" for="no15_6">น้องสาว</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no15" id="no15_6" value="7">
                                                        <label class="form-check-label" for="no15_6">อื่นๆ</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">ลักษณะการปกครองดูแลนักเรียนของผู้ปกครอง</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no16" id="no16_1" value="1">
                                                        <label class="form-check-label" for="no16_1">เข้มงวดกวดขัน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no16" id="no16_2" value="2">
                                                        <label class="form-check-label" for="no16_2">เป็นกันเองเอาใจใส่นักเรียนตามสมควร</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no16" id="no16_3" value="3">
                                                        <label class="form-check-label" for="no16_3">ไม่ค่อยมีเวลาอบรมดูแล</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no16" id="no16_4" value="4">
                                                        <label class="form-check-label" for="no16_4">ปล่อยปละละเลย</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">ความประพฤติของนักเรียนขณะอยู่บ้าน</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no17" id="no17_1" value="1">
                                                        <label class="form-check-label" for="no17_1">อยู่ในโอวาทเสมอ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no17" id="no17_2" value="2">
                                                        <label class="form-check-label" for="no17_2">เชื่อฟังเป็นบางครั้ง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no17" id="no17_3" value="3">
                                                        <label class="form-check-label" for="no17_3">ไม่เคยเชื่อฟัง</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">หน้าที่รับผิดชอบของนักเรียนภายในบ้าน</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no18" id="no18_1" value="1">
                                                        <label class="form-check-label" for="no18_1">ผู้ปกครองไม่ให้ทำ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no18" id="no18_2" value="2">
                                                        <label class="form-check-label" for="no18_2">ช่วยเหลืองานบ้านดี</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no18" id="no18_3" value="3">
                                                        <label class="form-check-label" for="no18_3">ช่วยเหลือบางครั้ง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no18" id="no18_4" value="4">
                                                        <label class="form-check-label" for="no18_4">ไม่เคยช่วยเหลือ</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="form-group col-sm-12 ">
                                                    <h1 class="h6 text-info  font-weight-bold">การใช้จ่ายของนักเรียน
                                                        <hr class="hr1">
                                                    </h1>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">นักเรียนเดินทางมาโรงเรียนโดย</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no19" id="no19_1" value="1">
                                                        <label class="form-check-label" for="no19_1">ไม่ได้รับเงินมาโรงเรียน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no19" id="no19_2" value="2">
                                                        <label class="form-check-label" for="no19_2">น้อยกว่า 35 บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no19" id="no19_3" value="3">
                                                        <label class="form-check-label" for="no19_3">เฉลี่ยวันละ 35 บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no19" id="no19_4" value="4">
                                                        <label class="form-check-label" for="no19_4">35 - 45 บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no19" id="no19_5" value="5">
                                                        <label class="form-check-label" for="no19_5">มากกว่า 45 บาท</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">นักเรียนใช้จ่ายประมาณเฉลี่ยวันละ</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no20" id="no20_1" value="1">
                                                        <label class="form-check-label" for="no20_1">ไม่ได้รับเงินมาโรงเรียน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no20" id="no20_2" value="2">
                                                        <label class="form-check-label" for="no20_2">น้อยกว่า 35 บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no20" id="no20_3" value="3">
                                                        <label class="form-check-label" for="no20_3">35 - 45 บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no20" id="no20_4" value="4">
                                                        <label class="form-check-label" for="no20_4">มากกว่า 45 บาท</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">เงินที่ได้ในแต่ละวันเพียงพอ ใช้จ่ายหรือไม่</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no21" id="no21_1" value="1">
                                                        <label class="form-check-label" for="no21_1">เพียงพอ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no21" id="no21_2" value="2">
                                                        <label class="form-check-label" for="no21_2">ไม่เพียงพอ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no21" id="no21_3" value="3">
                                                        <label class="form-check-label" for="no21_3">ขัดสนในบางครั้ง</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">นักเรียนได้เก็บออมเงินวันละ</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no22" id="no22_1" value="1">
                                                        <label class="form-check-label" for="no22_1">ไม่มี/ไม่ได้เก็บออม</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no22" id="no22_2" value="2">
                                                        <label class="form-check-label" for="no22_2">น้อยกว่า 20 บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no22" id="no22_3" value="3">
                                                        <label class="form-check-label" for="no22_3">20 - 50 บาท</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no22" id="no22_4" value="4">
                                                        <label class="form-check-label" for="no22_4">มากกว่า 50 บาท</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">นักเรียนเคยได้รับทุนการศึกษาหรือไม่</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no23" id="no23_1" value="1">
                                                        <label class="form-check-label" for="no23_1">เคย แต่นานแล้ว</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no23" id="no23_2" value="2">
                                                        <label class="form-check-label" for="no23_2">เคยเมื่อปีการศึกษาที่แล้ว</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no23" id="no23_3" value="3">
                                                        <label class="form-check-label" for="no22_3">ได้รับทุนต่อเนื่อง</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no23" id="no23_4" value="4">
                                                        <label class="form-check-label" for="no23_4">ไม่เคยได้รับทุน</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>


                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">การหารายได้พิเศษของนักเรียนในเวลา หลังเลิกเรียนหรือวันหยุด</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no24" id="no24_1" value="1">
                                                        <label class="form-check-label" for="no24_1">มีรายได้พิเศษ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no24" id="no24_2" value="2">
                                                        <label class="form-check-label" for="no24_2">ไม่มี รายได้พิเศษ</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="form-group col-sm-12 ">
                                                    <h1 class="h6 text-info  font-weight-bold">ความกังวลของผู้ปกครอง
                                                        <hr class="hr1">
                                                    </h1>
                                                </div>

                                                <div class="col-sm-12 "><label for="validationServer01" class="h6 text-gray-900 font-weight-bold">ผู้ปกครองมีความกังวลเรื่องใด มากที่สุดที่มีต่อตัวนักเรียน</label></div>
                                                <div class="form-group col-sm-12 ">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no25" id="no25_1" value="1">
                                                        <label class="form-check-label" for="no25_1">การเรียน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no25" id="no25_2" value="2">
                                                        <label class="form-check-label" for="no25_2">การคบเพื่อน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no25" id="no25_3" value="3">
                                                        <label class="form-check-label" for="no25_3">ชู้สาว</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no25" id="no25_4" value="4">
                                                        <label class="form-check-label" for="no25_4">อุบัติเหตุ</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no25" id="no25_5" value="5">
                                                        <label class="form-check-label" for="no25_5">ยาเสพติด/การพนัน</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no25" id="no25_6" value="6">
                                                        <label class="form-check-label" for="no25_6">การติดเกม/สังคมออนไลน์</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="no25" id="no25_7" value="7">
                                                        <label class="form-check-label" for="no25_7">สุขภาพ</label>
                                                    </div>
                                                    <div class="form-check"></div>
                                                </div>

                                                <div class="form-group col-sm-12 ">
                                                    <h1 class="h6 text-info  font-weight-bold">รูปภาพ บ้านของนักเรียน
                                                        <hr class="hr1">
                                                    </h1>
                                                </div>



                                                <div class="col-lg-12 ">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="form-input">
                                                            <div class="preview">
                                                                <img src="images/home.jpg" id="home_pic" class="mx-auto d-block img-preview">
                                                            </div>
                                                            <div id="upload">
                                                                <div style="text-align: center;" id="file_name"></div>
                                                                <label for="file-ip-1">อัพโหลดรูป</label>
                                                                <input type="file" id="file-ip-1" accept="image/*" name="file" onchange="showPreview(event);">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr class="hr1 mb-3">
                                            </h1>
                                            <div class="col-lg-12 ">
                                                <div class="d-flex justify-content-center">
                                                    <button class="btn btn-sky" type="submit">บันทึกผลการประเมิน </button>
                                                </div>

                                            </div>

                                    </div><!-- div row -->


                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /.container -->







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
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA26X6Y2gcGOH30HP9jgrbPP2LffJ1zBew&callback=initMap&v=weekly" defer></script>


    <!-- Script -->
    <script type="text/javascript">
        var infoWindow;
        var findMeButton = $('.find-me');
        var latitude, longitude;
        var home_id = "<?= $home_id ?>";
        var drag = "<?= $_SESSION['type'] == "ผู้ปกครอง" ?>" ? true : false;
        var user_type = "<?= $_SESSION['type'] ?>";
        var option = "<?= $_GET['option'] ?>"
        $(document).ready(function() {
            showFormDetail();
            checkUserType();
            //showStudentDetail();
        });

        function initMap() {
            if (user_type === "ผู้ปกครอง") {
                if (latitude && longitude) {
                    num1 = parseFloat(latitude);
                    num2 = parseFloat(longitude);
                    const infoWindow = new google.maps.InfoWindow({
                        content: "",
                        disableAutoPan: true,
                    });

                    //alert(num1+' '+num2);
                    var myLatLng = {
                        lat: num1,
                        lng: num2
                    };

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: myLatLng
                    });

                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        draggable: drag,
                        title: 'โปรดเลือกที่อยู่ของคุณ'
                    });

                    marker.addListener("click", () => {
                        infoWindow.setContent("บ้าน");
                        infoWindow.open(map, marker);
                    });

                    // Init listener
                    google.maps.event.addListener(marker, "dragend", function(event) {
                        $("#latitude").val(event.latLng.lat());
                        $("#longitude").val(event.latLng.lng());
                    });

                } else {
                    $("#geo").remove();
                    $("#map").html(`<div class="jumbotron d-flex align-items-center">
  <div class="container"><div class="text-center">คุณยังไม่ได้ปักหมุด</div>
  </div>
</div>`);
                }

            } else {

                if (latitude && longitude) {
                    num1 = parseFloat(latitude);
                    num2 = parseFloat(longitude);

                    const infoWindow = new google.maps.InfoWindow({
                        content: "",
                        disableAutoPan: true,
                    });

                    //alert(num1+' '+num2);
                    var myLatLng = {
                        lat: num1,
                        lng: num2
                    };

                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: myLatLng
                    });

                    var marker = new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        draggable: drag,
                        title: 'บ้านของ....'
                    });

                    marker.addListener("click", () => {
                        infoWindow.setContent("บ้าน");
                        infoWindow.open(map, marker);
                    });

                    $(".latitude").html(latitude);
                    $(".longitude").html(longitude);

                } else {
                    $("#geo").remove();
                    $("#map").html(`<div class="jumbotron d-flex align-items-center">
  <div class="container"><div class="text-center">ผู้ปกครองยังไม่ได้ปักหมุด</div>
  </div>
</div>`);
                }

            }

        }


        function findMyLocation() {
            var myLatLng = {
                lat: 13.736717,
                lng: 100.523186
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                map: map,
                draggable: drag,
                title: 'โปรดเลือกที่อยู่ของคุณ'
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
                    'ข้อผิดพลาด: โปรดให้สิทธิ์ Maps ในการเข้าถึงตำแหน่งในเบราว์เซอร์' :
                    'ข้อผิดพลาด: เบราว์เซอร์ไม่สนับสนุน Maps');
                infoWindow.open(map);
                marker.setPosition(myLatLng);

            }

            function getLocation(my_location) {
                var my_position = new google.maps.LatLng(my_location.coords.latitude, my_location.coords.longitude);
                marker.setPosition(my_position);
                map.setCenter(my_position);
                $("#latitude").val(my_location.coords.latitude)
                $("#longitude").val(my_location.coords.longitude)
                reValidate();
            }

            const infoWindow = new google.maps.InfoWindow({
                content: "",
                disableAutoPan: true,
            });

            //alert(num1+' '+num2);

            marker.addListener("click", () => {
                infoWindow.setContent("บ้านของ" + $("#student_name").val());
                infoWindow.open(map, marker);
            });

            // Init listener
            google.maps.event.addListener(marker, "dragend", function(event) {
                $("#latitude").val(event.latLng.lat())
                $("#longitude").val(event.latLng.lng())
                reValidate();
            });

        }

        function reValidate() {
            // Revalidate the content when its value is changed by Summernote
            $('#geocoding_form').bootstrapValidator('revalidateField', 'latitude');
            $('#geocoding_form').bootstrapValidator('revalidateField', 'longitude');
        }
        // set of coordinates.
        function showFormDetail() {
            $.ajax({
                type: 'POST',
                url: 'ajax_home/ajax_home_detail.php',
                data: {
                    home_id
                },
                success: function(res) {
                    console.log("Res : " + res);
                    const obj = JSON.parse(res);
                    latitude = obj.lat;
                    longitude = obj.lng;
                    initMap();
                    $("#latitude").val(obj.lat);
                    $("#longitude").val(obj.lng);
                    var no01, no04, i;
                    if (obj.no01 == null) {
                        no01 = obj.no01,
                            no04 = obj.no04
                    } else {
                        no01 = obj.no01.split(",");
                        no04 = obj.no04.split(",");
                        for (i = 0; i < no01.length; i++) {
                            $("input:checkbox[name='no01[]'][value='" + no01[i] + "']").prop('checked', true);
                        }

                        for (i = 0; i < no04.length; i++) {
                            $("input:checkbox[name='no04[]'][value='" + no04[i] + "']").prop('checked', true);
                        }

                    }


                    $("#topic").html("แบบบันทึกการเยี่ยมบ้านนักเรียน<br>ปีการศึกษา " + obj.session + " เทอม " + obj.term);
                    $("#teacher_name").val(obj.teacher_name);
                    $("#student_id").val(obj.student_id);
                    $("#student_name").val(obj.student_name);
                    $("#nickname").val(obj.nickname);
                    $("#birthdate").val(obj.birthdate);
                    $("#grade").val(obj.grade);
                    $("#section").val(obj.section);

                    if (obj.student_pic != null && obj.student_pic != "") {
                        $("#student_pic").attr('src', 'uploads/student_pics/'+obj.student_pic);
                    } else {
                        $("#student_pic").attr('src', 'images/anonymous.jpg');
                    }

                    alert("Home Pic"+obj.home_pic);
                    if (obj.home_pic != null && obj.home_pic != "") {
                        $("#home_pic").attr('src', 'uploads/home_pics/'+obj.home_pic);
                    } else {
                        $("#home_pic").attr('src', 'images/home.jpg');
                    }


                    $("#fname").val(obj.fname);
                    $("#fphone").val(obj.fphone);
                    $("input:radio[name='no02'][value='" + obj.no02 + "']").prop('checked', true);
                    $("input:radio[name='no03'][value='" + obj.no03 + "']").prop('checked', true);
                    $("input:radio[name='no05'][value='" + obj.no05 + "']").prop('checked', true);
                    $("input:radio[name='no06'][value='" + obj.no06 + "']").prop('checked', true);
                    $("input:radio[name='no07'][value='" + obj.no07 + "']").prop('checked', true);
                    $("input:radio[name='no08'][value='" + obj.no08 + "']").prop('checked', true);
                    $("input:radio[name='no09'][value='" + obj.no09 + "']").prop('checked', true);
                    $("input:radio[name='no10'][value='" + obj.no10 + "']").prop('checked', true);
                    $("input:radio[name='no11'][value='" + obj.no11 + "']").prop('checked', true);
                    $("input:radio[name='no12'][value='" + obj.no12 + "']").prop('checked', true);
                    $("input:radio[name='no13'][value='" + obj.no13 + "']").prop('checked', true);
                    $("input:radio[name='no14'][value='" + obj.no14 + "']").prop('checked', true);
                    $("input:radio[name='no15'][value='" + obj.no15 + "']").prop('checked', true);
                    $("input:radio[name='no16'][value='" + obj.no16 + "']").prop('checked', true);
                    $("input:radio[name='no17'][value='" + obj.no17 + "']").prop('checked', true);
                    $("input:radio[name='no18'][value='" + obj.no18 + "']").prop('checked', true);
                    $("input:radio[name='no19'][value='" + obj.no19 + "']").prop('checked', true);
                    $("input:radio[name='no20'][value='" + obj.no20 + "']").prop('checked', true);
                    $("input:radio[name='no21'][value='" + obj.no21 + "']").prop('checked', true);
                    $("input:radio[name='no22'][value='" + obj.no22 + "']").prop('checked', true);
                    $("input:radio[name='no23'][value='" + obj.no23 + "']").prop('checked', true);
                    $("input:radio[name='no24'][value='" + obj.no24 + "']").prop('checked', true);
                    $("input:radio[name='no25'][value='" + obj.no25 + "']").prop('checked', true);
                    //alert(obj.lat);
                    //alert(obj.lng);

                },
                error: function(err) {
                    alert("Error" + err)

                }
            });
        };


        function updateLatLng() {
            $.ajax({
                type: 'POST',
                url: 'ajax_home/ajax_home_updateLatLng.php',
                data: {
                    home_id,
                    lat: $("#latitude").val(),
                    lng: $("#longitude").val()
                },
                success: function(res) {
                    console.log("Res : " + res);
                    if (res.search("Update Successful") != -1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'อัปเดตละติจูด ลองจิจูดสำเร็จ!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        })
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'อัปเดตละติจูด ลองจิจูดไม่สำเร็จ!',
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


        /*  function showStudentDetail() {
             $.ajax({
                 type: 'POST',
                 url: 'ajax_get_info/ajax_getinfo_student.php',
                 data: {
                     student_id
                 },
                 success: function(data) {
                     console.log("Res : " + data);
                     const obj = JSON.parse(data);
                     $("#map_topic").html('แผนที่บ้าน' + obj.pname + obj.fname + " " + obj.lname);

                 },
                 error: function(err) {
                     alert("Error" + err)

                 }
             });
         } */

        $('#geocoding_form').bootstrapValidator({
            live: 'enabled',
            trigger: null,
            fields: {
                latitude: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุละติจุด'
                        },
                    }
                },
                longitude: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุลองจิจูด'
                        },
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            updateLatLng();
            let formIsValid = true;
            $('#geocoding_form button[type="submit"]').attr('disabled', !formIsValid);
        });

        $('#homeForm').bootstrapValidator({
            live: 'enabled',
            trigger: null,
            fields: {
                fname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อผู้ปกครอง'
                        },
                    }
                },
                fphone: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเบอร์โทรศัพท์'
                        },
                    }
                },
                'no01[]': {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no02: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no03: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                'no04[]': {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no05: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no06: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no07: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no08: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no09: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no10: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no11: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no12: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no13: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no14: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no15: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no16: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no17: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no18: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no19: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no20: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no21: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no22: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no23: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                },
                no24: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                }

                ,
                no25: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดตอบคำถามข้อนี้'
                        },
                    }
                }
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            updateHomeForm();
            let formIsValid = true;
            $('#homeForm button[type="submit"]').attr('disabled', !formIsValid);
        });


        function updateHomeForm() {
            Swal.fire({
                title: 'แก้ไขข้อมูลการเยี่ยมบ้าน',
                text: "คุณต้องการแก้ไขข้อมูลการเยี่ยมบ้านหรือไม่?",
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
                        url: 'ajax_home/ajax_home_update.php',
                        data: new FormData($('#homeForm')[0]),
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            console.log("Home update : " + res);
                            if (res.search("Update Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'อัปเดตการเยี่ยมบ้านสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    //location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'อัปเดตการเยี่ยมบ้านไม่สำเร็จ!',
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


        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("home_pic");
                var pic_name = document.getElementById("file_name");
                preview.src = src;
                preview.style.display = "block";
                pic_name.innerHTML = event.target.files[0].name
            }
        }



        function checkUserType() {
            if (user_type === "คุณครู") {
                if (option === "edit") {
                    enableHomeForm()
                } else {
                    disabledHomeForm()

                }
                disabledGeoForm()
            } else {
                disabledHomeForm()
            }
        }

        function disabledHomeForm() {
            $("#homeForm :input").prop("disabled", true);
            $("#homeForm #upload").remove();
            $("#homeForm :submit").remove();
        }

        function disabledGeoForm() {
            $("#geocoding_form :input").prop("disabled", true);
        }

        function enableHomeForm() {
            $("#homeForm :input").prop("disabled", false);
        }
    </script>

</body>

</html>