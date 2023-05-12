<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - นักเรียน</title>
    <style>
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
            margin: 0 auto;
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
            width: 90%;
            display: none;
            margin-bottom: 30px;
        }


        .img-preview {
            width: 200px !important;
            height: 200px !important;
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

                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-center align-items-center py-3">
                            <h6 class="m-0 font-weight-bold text-info">เพิ่มข้อมูลนักเรียน</h6>
                        </div>
                        <div class="card-body p-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#menu1" id="tab_one"><i class="bi bi-1-circle-fill"></i> ข้อมูลส่วนตัว</a>

                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#menu2" id="tab_two"><i class="bi bi-2-circle-fill"></i> ข้อมูลผู้ปกครอง</a>
                                        </li>
                                    </ul>

                                </div><!-- /.col-md-12 -->
                                <div class="col-md-12 pl-4 pr-4">
                                    <div class="tab-content">
                                        <div class="tab-pane active " id="menu1">
                                            <form id="studentForm" autocomplete="off">
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <h1 class="h6 text-info  font-weight-bold">ข้อมูลส่วนตัวนักเรียน
                                                            <hr class="hr1">
                                                        </h1>
                                                    </div>
                                                    <div class="col-lg-9">
                                                        <!-- <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลส่วนตัวนักเรียน</h1> -->
                                                        <div class="row">

                                                            <div class="form-group col-sm-6">
                                                                <label for="validationServer01" class="form-label">รหัสนักเรียน</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-postcard"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="student_id" id="student_id" placeholder="โปรดระบุรหัสนักเรียน" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">เลขบัตรประจำตัวประชาชน</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-person-vcard-fill"></i></span>
                                                                    </div>
                                                                    <input type="tel" class="form-control " name="idcard" id="idcard" placeholder="โปรดระบุเลขบัตรประจำตัวประชาชน" maxlength="13">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">คำนำหน้าชื่อ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                                                                    </div>
                                                                    <select name="pname" class="form-control selectpicker" id="pname">
                                                                        <option value="" disabled selected>โปรดเลือกคำนำหน้าชื่อ</option>
                                                                        <option value="เด็กชาย" data-subtext="ด.ช.">เด็กชาย</option>
                                                                        <option value="เด็กหญิง" data-subtext="ด.ญ.">เด็กหญิง</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">เพศ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                                                                    </div>
                                                                    <select name="gender" class="form-control selectpicker" id="gender">
                                                                        <option value="" disabled selected>โปรดเลือกเพศ</option>
                                                                        <option value="ชาย ">ชาย</option>
                                                                        <option value="หญิง">หญิง</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6  ">
                                                                <label for="validationServer01" class="form-label">ชื่อจริง</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="fname" id="fname" placeholder="โปรดระบุชื่อจริง">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">นามสกุล</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="lname" id="lname" placeholder="โปรดระบุนามสกุล">
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-sm-3">
                                                                <label for="validationServer01" class="form-label">ชื่อเล่น</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="nickname" id="nickname" placeholder="โปรดระบุชื่อเล่น">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">วันเกิด</label>
                                                                <div class="datepicker date input-group" id="today">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div><input type="text" autocomplete="off" name="birthdate" id="birthdate" placeholder="วันเกิด" class="form-control" data-bv-trigger="change keyup">
                               
                            </div>
                                                            </div>
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">อายุ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="fa fa-child" aria-hidden="true"></i></span>
                                                                    </div>
                                                                    <input type="number" class="form-control " name="age" id="age" placeholder="โปรดระบุอายุ">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">กรุ๊ปเลือด</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-suit-heart-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="blood_group" id="blood_group">
                                                                        <option value="" disabled selected>โปรดเลือกกรุ๊ปเลือด</option>
                                                                        <option value="A">A</option>
                                                                        <option value="B">B</option>
                                                                        <option value="AB ">AB</option>
                                                                        <option value="O">O</option>
                                                                    </select>
                                                                </div>
                                                            </div>



                                                            <div class="form-group col-sm-4 ">
                                                                <label for="validationServer01" class="form-label">ศาสนา</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="religion" id="religion" placeholder="โปรดระบุศาสนา">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-4 ">
                                                                <label for="validationServer01" class="form-label">สัญชาติ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="nationality" id="nationality" placeholder="โปรดระบุสัญชาติ">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-4 ">
                                                                <label for="validationServer01" class="form-label">เชื้อชาติ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="ethnicity" id="ethnicity" placeholder="โปรดระบุเชื้อชาติ">
                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>


                                                    <div class="col-lg-3 ">
                                                        <div class="center">
                                                            <div class="form-input">
                                                                <div class="preview">
                                                                    <img src="images/anonymous.jpg" id="file_preview" class="mx-auto d-block img-preview">
                                                                </div>
                                                                <div style="text-align: center;" id="file_name"></div>
                                                                <label for="file">อัพโหลดรูป</label>
                                                                <input class="form-control" type="file" id="file" name="file" onchange="showPreview(event);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <br>

                                                <!--Begin Address Row-->
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <h1 class="h6 text-info  font-weight-bold">ที่อยู่
                                                            <hr class="hr1">
                                                        </h1>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="validationServer01" class="form-label">รายละเอียดที่อยู่</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="bi bi-house-add-fill"></i></span>
                                                                </div>
                                                                <textarea class="form-control " id="std_address" name="std_address" rows="3" placeholder="โปรดระบุรายละเอียดที่อยู่"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3  ">
                                                                <label for="validationServer01" class="form-label">จังหวัด</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="std_province" id="std_province" data-size="5" data-live-search="true" onchange="getDistrictList('std')">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">อำเภอ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="std_district" id="std_district" data-size="5" data-live-search="true" onchange="getSubDistrictList('std')">
                                                                        <option value="" disabled selected>-โปรดเลือกอำเภอ-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">ตำบล</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="std_subdistrict" id="std_subdistrict" data-size="5" data-live-search="true" onchange="getZipcode('std')">
                                                                        <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">รหัสไปรษณีย์</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-postage-fill"></i></span>
                                                                    </div>
                                                                    <input type="tel" class="form-control" name="std_zipcode" id="std_zipcode" placeholder="รหัสไปรษณีย์" maxlength="5">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <!--End Address Row-->

                                                <!--Begin Grade Row-->
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <h1 class="h6 text-info  font-weight-bold">การศึกษา
                                                            <hr class="hr1">
                                                        </h1>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">ระดับชั้น</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-mortarboard-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="std_grade" id="std_grade" data-size="5" data-live-search="true" onchange="showSectionList()">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="form-group col-sm-3 ">
                                                            <label for="validationServer01" class="form-label">ห้อง</label>
                                                                    <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="bi bi-123"></i></span>
                                                                </div>
                                                                <select class="form-control selectpicker" name="std_section" id="std_section" data-size="5" data-live-search="true">
                                                                <option value='' disabled selected>-โปรดเลือกห้อง-</option>
                                                                </select>
                                                            </div>
                                                        </div> -->
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">สถานะ</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-123"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="std_status" id="std_status" data-size="5" data-live-search="true">
                                                                        <option value='' disabled selected>-โปรดเลือกสถานะ-</option>
                                                                        <option value='กำลังศึกษา'>กำลังศึกษา</option>
                                                                        <option value='จบการศึกษา'>จบการศึกษา</option>
                                                                        <option value='ลาออก'>ลาออก</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div><br>
                                                <!--End Grade Row-->
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-outline-primary float-end btnNext" type="submit">ถัดไป</button>
                                                </div>
                                            </form>
                                        </div><!-- /.tab-panet menu1 -->
                                        <div class="tab-pane fade" id="menu2">
                                            <form id="parentForm">
                                                <!--Begin Father Row-->
                                                <div class="row">
                                                    <div class="col-sm-12 ">
                                                        <h1 class="h6 text-info  font-weight-bold">ข้อมูลบิดา
                                                            <hr class="hr1">
                                                        </h1>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="form-group col-sm-2">
                                                                <label for="validationServer01" class="form-label">คำนำหน้าชื่อ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="fa_pname" id="fa_pname">
                                                                        <option value="" disabled selected>โปรดเลือกคำนำหน้าชื่อ</option>
                                                                        <option value="นาย">นาย</option>
                                                                        <option value="นาง">นาง</option>
                                                                        <option value="นางสาว" data-subtext="น.ส.">นางสาว</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <label for="validationServer01" class="form-label">ชื่อจริง</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="fa_fname" id="fa_fname" placeholder="โปรดระบุชื่อจริง">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <label for="validationServer01" class="form-label">นามสกุล</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="fa_lname" id="fa_lname" placeholder="โปรดระบุนามสกุล">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="validationServer01" class="form-label">รายละเอียดที่อยู่</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="bi bi-house-add-fill"></i></span>
                                                                </div>
                                                                <textarea class="form-control " name="fa_address" id="fa_address" rows="3" placeholder="โปรดระบุรายละเอียดที่อยู่"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">จังหวัด</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="fa_province" id="fa_province" data-size="5" data-live-search="true" onchange="getDistrictList('fa')">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">อำเภอ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="fa_district" id="fa_district" data-size="5" data-live-search="true" onchange="getSubDistrictList('fa')">
                                                                        <option value="" disabled selected>-โปรดเลือกอำเภอ-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">ตำบล</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="fa_subdistrict" id="fa_subdistrict" data-size="5" data-live-search="true" onchange="getZipcode('fa')">
                                                                        <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">รหัสไปรษณีย์</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-postage-fill"></i></span>
                                                                    </div>
                                                                    <input type="tel" class="form-control" name="fa_zipcode" id="fa_zipcode" placeholder="รหัสไปรษณีย์" maxlength="5">
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">อาชีพ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-briefcase-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="fa_career" id="fa_career" placeholder="โปรดระบุอาชีพ">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">รายได้</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-cash-coin"></i></span>
                                                                    </div>
                                                                    <input type="number" class="form-control " name="fa_salary" id="fa_salary" placeholder="โปรดระบุรายได้ (เดือน)">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">เบอร์โทรศัพท์</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="fa_phone" id="fa_phone" placeholder="โปรดระบุเบอร์โทรศัพท์">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">อีเมล</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="fa_email" id="fa_email" placeholder="โปรดระบุอีเมล">
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div><br>
                                                <!--End Father Row-->

                                                <!--Begin Mother Row-->
                                                <div class="row">
                                                    <div class="form-group col-sm-12 ">
                                                        <h1 class="h6 text-info  font-weight-bold">ข้อมูลมารดา
                                                            <hr class="hr1">
                                                        </h1>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                            <div class="form-group col-sm-2">
                                                                <label for="validationServer01" class="form-label">คำนำหน้าชื่อ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="mo_pname" id="mo_pname">
                                                                        <option value="" disabled selected>โปรดเลือกคำนำหน้าชื่อ</option>
                                                                        <option value="นาย">นาย</option>
                                                                        <option value="นาง">นาง</option>
                                                                        <option value="นางสาว" data-subtext="น.ส.">นางสาว</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <label for="validationServer01" class="form-label">ชื่อจริง</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="mo_fname" id="mo_fname" placeholder="โปรดระบุชื่อจริง">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <label for="validationServer01" class="form-label">นามสกุล</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="mo_lname" id="mo_lname" placeholder="โปรดระบุนามสกุล">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="validationServer01" class="form-label">รายละเอียดที่อยู่</label>
                                                            <div class="input-group ">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="bi bi-house-add-fill"></i></span>
                                                                </div>
                                                                <textarea class="form-control" name="mo_address" id="mo_address" rows="3" placeholder="โปรดระบุรายละเอียดที่อยู่"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">จังหวัด</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="mo_province" id="mo_province" data-size="5" data-live-search="true" onchange="getDistrictList('mo')">

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">อำเภอ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="mo_district" id="mo_district" data-size="5" data-live-search="true" onchange="getSubDistrictList('mo')">
                                                                        <option value="" disabled selected>-โปรดเลือกอำเภอ-</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">ตำบล</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                                    </div>
                                                                    <select class="form-control selectpicker" name="mo_subdistrict" id="mo_subdistrict" data-size="5" data-live-search="true" onchange="getZipcode('mo')">
                                                                        <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-sm-3 ">
                                                                <label for="validationServer01" class="form-label">รหัสไปรษณีย์</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-postage-fill"></i></span>
                                                                    </div>
                                                                    <input type="tel" class="form-control" name="mo_zipcode" id="mo_zipcode" placeholder="รหัสไปรษณีย์" maxlength="5">
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">อาชีพ</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-briefcase-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="mo_career" id="mo_career" placeholder="โปรดระบุอาชีพ">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">รายได้</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-cash-coin"></i></span>
                                                                    </div>
                                                                    <input type="number" class="form-control " name="mo_salary" id="mo_salary" placeholder="โปรดระบุรายได้ (เดือน)">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6 ">
                                                                <label for="validationServer01" class="form-label">เบอร์โทรศัพท์</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="mo_phone" id="mo_phone" placeholder="โปรดระบุเบอร์โทรศัพท์">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-6">
                                                                <label for="validationServer01" class="form-label">อีเมล</label>
                                                                <div class="input-group ">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control " name="mo_email" id="mo_email" placeholder="โปรดระบุอีเมล">
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!--End Mother Row-->

                                                <br>
                                                <div class="d-flex justify-content-center">
                                                    <!--  <button class="btn btn-outline-primary float-end btnNext" type="button" onclick="showPreviousSection()">ย้อนกลับ</button> -->
                                                    <button class="btn btn-sky" type="submit">บันทึกข้อมูล</button>
                                                </div>

                                            </form>
                                        </div><!-- /.tab-panet menu2 -->

                                    </div><!-- /.tab-content -->
                                </div><!-- /.col-md-12 -->
                            </div><!-- /.row -->
                        </div><!-- /.card-body -->
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script>
        $(document).ready(function() {

            //$("#idcard").mask("9 9999 99999 99 9", {});

            generateStudentID();
            showProvinceList('std');
            showProvinceList('mo');
            showProvinceList('fa');
            //showProvinceList('parent');
            showGradeList();
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,

            });
        })

        function generateStudentID() {
            $.ajax({
                url: 'ajax/ajax_generate_stdID.php',
                success: function(data) {
                    const obj = JSON.parse(data);
                    $('#student_id').val(obj.studentID);
                    /* console.log("Student_ID :" + obj.studentID) */
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        $('#studentForm').bootstrapValidator({
            fields: {
                student_id: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรหัสนักเรียน'
                        },
                    }
                },
                idcard: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเลขบัตรประจำตัวประชาชน'
                        },
                        regexp: {
                            regexp: /^\d{13}$/,
                            message: 'เลขบัตรประจำตัวประชาชนต้องประกอบไปด้วยตัวเลข 13 หลัก'
                        }
                        /*  regexp: {
                             regexp: /^(\d{-13})?$/,
                             message: 'เลขบัตรประจำตัวประชาชนต้องเป็นตัวเลข 13 ตัว'
                         } */
                    }
                },
                pname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุคำนำหน้าชื่อ'
                        },
                    }
                },
                gender: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเพศ'
                        },
                    }
                },
                fname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อจริง'
                        },
                    }
                },
                lname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุนามสกุล'
                        },
                    }
                },
                nickname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อเล่น'
                        },
                    }
                },
                birthdate: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุวันเกิด'
                        },
                    }
                },
                age: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุอายุ'
                        },
                        integer: {
                            message: 'โปรดระบุอายุให้ถูกต้อง',
                            min: 0,
                        },
                    }
                },
                blood_group: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุกรุ๊ปเลือด'
                        },
                    }
                },
                religion: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุศาสนา'
                        },
                    }
                },
                nationality: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุสัญชาติ'
                        },
                    }
                },
                ethnicity: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเชื้อชาติ'
                        },
                    }
                },
                std_address: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรายละเอียดที่อยู่'
                        },
                    }
                },
                std_province: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกจังหวัด'
                        },
                    }
                },
                std_district: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกอำเภอ'
                        },
                    }
                },
                std_subdistrict: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกตำบล'
                        },
                    }
                },
                std_zipcode: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรหัสไปรษณีย์'
                        },
                        regexp: {
                            regexp: /^\d{5}$/,
                            message: 'รหัสไปรษณีย์ต้องประกอบด้วยตัวเลข 5 ตัว'
                        }
                    }
                },
                std_grade: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกระดับชั้นที่ศึกษา'
                        },
                    }
                },
                std_status: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกสถานะนักเรียน'
                        },
                    }
                }
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            $("#tab_two").attr('data-toggle', 'tab');
            $('.nav-item .active').parent().next('li').find('a').trigger('click');
            let formIsValid = true;
            $('#studentForm button[type="submit"]').attr('disabled', !formIsValid);
        });


        $('#parentForm').bootstrapValidator({
            fields: {
                fa_pname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุคำนำหน้าชื่อ'
                        },
                    }
                },
                fa_fname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อจริง'
                        },
                    }
                },
                fa_lname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุนามสกุล'
                        },
                    }
                },
                fa_address: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรายละเอียดที่อยู่'
                        },
                    }
                },
                fa_province: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกจังหวัด'
                        },
                    }
                },
                fa_district: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกอำเภอ'
                        },
                    }
                },
                fa_subdistrict: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกตำบล'
                        },
                    }
                },
                fa_zipcode: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรหัสไปรษณีย์'
                        },
                        regexp: {
                            regexp: /^\d{5}$/,
                            message: 'รหัสไปรษณีย์ต้องประกอบด้วยตัวเลข 5 ตัว'
                        }
                    }
                },
                fa_career: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุอาชีพ'
                        },
                    }
                },
                fa_salary: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเงินเดือน'
                        },
                    }
                },
                fa_email: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุอีเมล'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'โปรดระบุที่อยู่อีเมลให้ถูกต้อง'
                        }
                    }
                },
                fa_phone: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเบอร์โทรศัพท์มือถือ'
                        },
                        phone: {
                            country: 'US',
                            message: 'The phone number is not valid'
                        }
                    }
                },
                mo_pname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุคำนำหน้าชื่อ'
                        },
                    }
                },
                mo_fname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อจริง'
                        },
                    }
                },
                mo_lname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุนามสกุล'
                        },
                    }
                },
                mo_address: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรายละเอียดที่อยู่'
                        },
                    }
                },
                mo_province: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกจังหวัด'
                        },
                    }
                },
                mo_district: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกอำเภอ'
                        },
                    }
                },
                mo_subdistrict: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกตำบล'
                        },
                    }
                },
                mo_zipcode: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรหัสไปรษณีย์'
                        },
                        regexp: {
                            regexp: /^\d{5}$/,
                            message: 'รหัสไปรษณีย์ต้องประกอบด้วยตัวเลข 5 ตัว'
                        }
                    }
                },
                mo_career: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุอาชีพ'
                        },
                    }
                },
                mo_salary: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเงินเดือน'
                        },
                    }
                },
                mo_email: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุอีเมล'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: 'โปรดระบุที่อยู่อีเมลให้ถูกต้อง'
                        }
                    }
                },
                mo_phone: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเบอร์โทรศัพท์มือถือ'
                        },
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            var formIsValid = true;
            $('#parentForm button[type="submit"]').attr('disabled', !formIsValid);
            addStudent();
        });

        function showGradeList() {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_grade_list.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#std_grade').html(data);
                    $('#std_grade').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showSectionList() {

            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_section_list.php',
                data: {
                    grade: $('#std_grade').val()
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#std_section').html(data);
                    $('#std_section').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showProvinceList(text) {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_province_list.php',
                data: {
                    function: 'provinces'
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#' + text + '_province').html(data);
                    $('#' + text + '_province').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function getDistrictList(text) {

            $.ajax({
                type: "POST",
                url: 'ajax_list/ajax_province_list.php',
                data: {
                    id: $('#' + text + '_province').val(),
                    function: 'districts'
                },
                success: function(data) {
                    console.log("Districts Select: " + data)
                    $('#' + text + '_district').html(data);
                    $('#' + text + '_district').selectpicker('refresh');
                }
            });

        }


        function getSubDistrictList(text) {
            $.ajax({
                type: "POST",
                url: 'ajax_list/ajax_province_list.php',
                data: {
                    id: $('#' + text + '_district').val(),
                    function: 'sub_districts'
                },
                success: function(data) {
                    console.log("SubDistricts Select: " + data)
                    $('#' + text + '_subdistrict').html(data);
                    $('#' + text + '_subdistrict').selectpicker('refresh');
                }
            });

        }

        function getZipcode(text) {
            $.ajax({
                type: "POST",
                url: 'ajax_list/ajax_province_list.php',
                data: {
                    id: $('#' + text + '_subdistrict').val(),
                    function: 'zipcode'
                },
                success: function(data) {
                    console.log("Zipcode : " + data)
                    $('#' + text + '_zipcode').val(data);
                    if (text === "std") {
                        $("#studentForm").bootstrapValidator('revalidateField', text + '_zipcode');
                    } else {
                        $("#parentForm").bootstrapValidator('revalidateField', text + '_zipcode');
                    }
                }
            });

        }

        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file_preview");
                var pic_name = document.getElementById("file_name");
                preview.src = src;
                preview.style.display = "block";
                pic_name.innerHTML = event.target.files[0].name
            }
        }

        function showPreviousSection() {
            $('.nav-item .active').parent().prev('li').find('a').trigger('click');
        }

        function addStudent() {
            Swal.fire({
                title: 'ยืนยันการเพิ่มข้อมูลนักเรียน',
                text: "คุณต้องการยืนยันการเพิ่มข้อมูลนักเรียนหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {

                    /*  Swal.fire({
                        title: "กำลังโหลด...",
                        html: "โปรดรอสักครู่",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    })
 */
                    let formData = new FormData($("#studentForm")[0]);
                    let formDataPrecios = new FormData($("#parentForm")[0]);
                    for (var pair of formDataPrecios.entries()) {
                        formData.append(pair[0], pair[1]);
                    }

                    $.ajax({
                        type: 'POST',
                        url: 'ajax_person_info/ajax_std_add.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Add Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เพิ่มข้อมูลนักเรียนสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                    //location.href= 'student_edit_info.php?student_id='+$('#student_id').val();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เพิ่มข้อมูลนักเรียนไม่สำเร็จ!',
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