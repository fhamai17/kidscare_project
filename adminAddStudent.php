
<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - จัดการนักเรียน</title>
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
            margin-left: 25%;
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
                            <h3 class="m-0 font-weight-bold text-dark">เพิ่มข้อมูลนักเรียน</h3>
                        </div>
                        <div class="card-body pb-5">
                            <!-- Tab Pane -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-2 mb-3">
                                        <ul class="nav nav-pills flex-column" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="stdinfo-tab" data-toggle="tab" href="#stdinfo" role="tab" aria-controls="home" aria-selected="true">ข้อมูลส่วนตัว</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="parentinfo-tab" data-toggle="tab" href="#parentinfo" role="tab" aria-controls="profile" aria-selected="false">ข้อมูลผู้ปกครอง</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- /.col-md-4 -->
                                    <div class="col-md-10">
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="stdinfo" role="tabpanel" aria-labelledby="stdinfo-tab">

                                            <form id="updateStdForm" enctype="multipart/form-data" autocomplete="off">
                                                <!-- Nested Row within Card Body -->
                                                <div class="row">
                                                    <div class="col-lg-8">

                                                       
                                                            <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลส่วนตัวนักเรียน</h1>
                                                            <div class="row">

                                                                <div class="form-group col-sm-6  mb-3">
                                                                    <input type="text" class="form-control " name="student_id" id="student_id" placeholder="รหัสนักเรียน" readonly>
                                                                </div>
                                                                <div class="form-group col-sm-6 mb-3">
                                                                    <input type="text" class="form-control " name="idcard" id="idcard" placeholder="เลขบัตรประจำตัวประชาชน" maxlength="13">
                                                                </div>
                                                                <div class="form-group col-sm-6 mb-3">
                                                                    <select name="qualification" class="form-control selectpicker" id="qualification">
                                                                        <option value="" disabled selected>คำนำหน้าชื่อ</option>
                                                                        <option value="เด็กชาย" data-subtext="ด.ช.">เด็กชาย</option>
                                                                        <option value="เด็กหญิง" data-subtext="ด.ญ.">เด็กหญิง</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-6 mb-3">
                                                                    <select name="gender" class="form-control selectpicker" id="gender">
                                                                        <option value="" disabled selected>เพศ</option>
                                                                        <option value="ชาย ">ชาย</option>
                                                                        <option value="หญิง">หญิง</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-6  mb-3">
                                                                    <input type="text" class="form-control " name="fname" id="fname" placeholder="ชื่อจริง">
                                                                </div>
                                                                <div class="form-group col-sm-6  mb-3">
                                                                    <input type="text" class="form-control " name="lname" id="lname" placeholder="นามสกุล">
                                                                </div>

                                                                <div class="form-group col-sm-3 mb-3">
                                                                    <input type="text" class="form-control " name="nickname" id="nickname" placeholder="ชื่อเล่น">
                                                                </div>
                                                                <div class="form-group col-sm-3 mb-3">
                                                                    <input type="text" class="form-control " name="birthdate" id="birthdate" onfocus="(this.type='date')" onblur="if(!this.value) this.type='text'" placeholder="วันเกิด">
                                                                </div>
                                                                <div class="form-group col-sm-3 mb-3">
                                                                    <input type="number" class="form-control " name="age" id="age" placeholder="อายุ">
                                                                </div>
                                                                <div class="form-group col-sm-3 mb-3">
                                                                    <select class="form-control selectpicker" name="blood_group" id="blood_group">
                                                                        <option value="" disabled selected>กรุ๊ปเลือด</option>
                                                                        <option value="A">A</option>
                                                                        <option value="B">B</option>
                                                                        <option value="AB ">AB</option>
                                                                        <option value="O">O</option>
                                                                    </select>
                                                                </div>



                                                                <div class="form-group col-sm-4 mb-3">
                                                                    <input type="text" class="form-control " name="religion" id="religion" placeholder="ศาสนา">
                                                                </div>
                                                                <div class="form-group col-sm-4 mb-3">
                                                                    <input type="text" class="form-control " name="nationality" id="nationality" placeholder="สัญชาติ">
                                                                </div>
                                                                <div class="form-group col-sm-4 mb-3">
                                                                    <input type="text" class="form-control " name="ethnicity" id="ethnicity" placeholder="เชื้อชาติ">
                                                                </div>


                                                            </div>

                                                    </div>


                                                    <div class="col-lg-4 ">
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
                                                </div>

                                                <!--Begin Address Row-->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <hr>
                                                        <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ที่อยู่</h1>
                                                        <div class="form-group">
                                                            <textarea class="form-control mb-3" id="std_address" name="std_address" rows="3" placeholder="โปรดระบุรายละเอียดที่อยู่"></textarea>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="std_province" id="std_province" data-size="5" data-live-search="true" onchange="getDistrictList('std')">

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="std_district" id="std_district" data-size="5" data-live-search="true" onchange="getSubDistrictList('std')">
                                                                    <option value="" disabled selected>-โปรดเลือกอำเภอ-</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="std_subdistrict" id="std_subdistrict" data-size="5" data-live-search="true" onchange="getZipcode('std')">
                                                                    <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                                </select>
                                                            </div>


                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <input type="number" class="form-control" name="std_zipcode" id="std_zipcode" placeholder="รหัสไปรษณีย์" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--End Address Row-->

                                                <!--Begin Grade Row-->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <hr>
                                                        <h1 class="h6 text-gray-900 mb-4 font-weight-bold">การศึกษา</h1>

                                                        <div class="row">
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="std_grade" id="std_grade" data-size="5" data-live-search="true" onchange="showSectionList()">

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="std_section" id="std_section" data-size="5" data-live-search="true">
                                                                <option value='' disabled selected>-โปรดเลือกห้อง-</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!--End Grade Row-->

                                            </div>
                                            <div class="tab-pane fade" id="parentinfo" role="tabpanel" aria-labelledby="parentinfo-tab">

                                                <!--Begin Father Row-->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลบิดา</h1>

                                                        <div class="row">
                                                            <div class="form-group col-sm-2">
                                                                <select class="form-control selectpicker" name="fa_pname" id="fa_pname">
                                                                    <option value="" disabled selected>คำนำหน้าชื่อ</option>
                                                                    <option value="นาย">นาย</option>
                                                                    <option value="นาง">นาง</option>
                                                                    <option value="นางสาว" data-subtext="น.ส.">นางสาว</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <input type="text" class="form-control " name="fa_fname" id="fa_fname" placeholder="ชื่อจริง">
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <input type="text" class="form-control " name="fa_lname" id="fa_lname" placeholder="นามสกุล">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control mb-3" id="fa_address" rows="3" placeholder="โปรดระบุรายละเอียดที่อยู่"></textarea>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="fa_province" id="fa_province" data-size="5" data-live-search="true" onchange="getDistrictList('fa')">

                                                                </select>
                                                            </div>
                                                            <div class="form-group form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="fa_district" id="fa_district" data-size="5" data-live-search="true" onchange="getSubDistrictList('fa')">
                                                                    <option value="" disabled selected>-โปรดเลือกอำเภอ-</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="fa_subdistrict" id="fa_subdistrict" data-size="5" data-live-search="true" onchange="getZipcode('fa')">
                                                                    <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <input type="number" class="form-control" name="fa_zipcode" id="fa_zipcode" placeholder="รหัสไปรษณีย์" readonly>
                                                            </div>

                                                            <div class="form-group col-sm-6 mb-3">
                                                                <input type="text" class="form-control " name="fa_career" id="fa_career" placeholder="อาชีพ">
                                                            </div>
                                                            <div class="form-group col-sm-6 mb-3">
                                                                <input type="number" class="form-control " name="fa_salary" id="fa_salary" placeholder="รายได้ (เดือน)">
                                                            </div>
                                                            <div class="form-group col-sm-4 mb-3">
                                                                <input type="text" class="form-control " name="fa_phone" id="fa_phone" placeholder="เบอร์โทรศัพท์">
                                                            </div>
                                                            <div class="form-group col-sm-4 mb-3">
                                                                <input type="number" class="form-control " name="fa_email" id="fa_email" placeholder="อีเมลล์">
                                                            </div>
                                                            <div class="form-group col-sm-4 mb-3">
                                                                <input type="text" class="form-control " name="fa_line" id="fa_line" placeholder="ไอดีไลน์">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!--End Father Row-->

                                                <!--Begin Mother Row-->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <hr>
                                                        <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลมารดา</h1>
                                                        <div class="row">
                                                            <div class="form-group col-sm-2">
                                                                <select class="form-control selectpicker" name="mom_pname" id="mom_pname">
                                                                    <option value="" disabled selected>คำนำหน้าชื่อ</option>
                                                                    <option value="นาย">นาย</option>
                                                                    <option value="นาง">นาง</option>
                                                                    <option value="นางสาว" data-subtext="น.ส.">นางสาว</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <input type="text" class="form-control " name="mom_fname" id="mom_fname" placeholder="ชื่อจริง">
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <input type="text" class="form-control " name="mom_lname" id="mom_lname" placeholder="นามสกุล">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control mb-3" id="mom_address" rows="3" placeholder="โปรดระบุรายละเอียดที่อยู่"></textarea>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="mom_province" id="mom_province" data-size="5" data-live-search="true" onchange="getDistrictList('mom')">

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="mom_district" id="mom_district" data-size="5" data-live-search="true" onchange="getSubDistrictList('mom')">
                                                                    <option value="" disabled selected>-โปรดเลือกอำเภอ-</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="mom_subdistrict" id="mom_subdistrict" data-size="5" data-live-search="true" onchange="getZipcode('mom')">
                                                                    <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <input type="number" class="form-control" name="mom_zipcode" id="mom_zipcode" placeholder="รหัสไปรษณีย์" readonly>
                                                            </div>

                                                            <div class="form-group col-sm-6 mb-3">
                                                                <input type="text" class="form-control " name="mom_career" id="mom_career" placeholder="อาชีพ">
                                                            </div>
                                                            <div class="form-group col-sm-6 mb-3">
                                                                <input type="number" class="form-control " name="mom_salary" id="mom_salary" placeholder="รายได้ (เดือน)">
                                                            </div>
                                                            <div class="form-group col-sm-4 mb-3">
                                                                <input type="text" class="form-control " name="mom_phone" id="mom_phone" placeholder="เบอร์โทรศัพท์">
                                                            </div>
                                                            <div class="form-group col-sm-4 mb-3">
                                                                <input type="number" class="form-control " name="mom_email" id="mom_email" placeholder="อีเมลล์">
                                                            </div>
                                                            <div class="form-group col-sm-4 mb-3">
                                                                <input type="text" class="form-control " name="mom_line" id="mom_line" placeholder="ไอดีไลน์">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!--End Mother Row-->

                                                <!--Begin Parent Row-->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <hr>
                                                        <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลผู้ปกครอง</h1>
                                                        <div class="row">
                                                            <div class="form-group col-sm-2">
                                                                <select class="form-control selectpicker" name="parent_pname" id="parent_pname">
                                                                    <option value="" disabled selected>คำนำหน้าชื่อ</option>
                                                                    <option value="นาย">นาย</option>
                                                                    <option value="นาง">นาง</option>
                                                                    <option value="นางสาว" data-subtext="น.ส.">นางสาว</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <input type="text" class="form-control " name="parent_fname" id="parent_fname" placeholder="ชื่อจริง">
                                                            </div>
                                                            <div class="form-group col-sm-5">
                                                                <input type="text" class="form-control " name="parent_lname" id="parent_lname" placeholder="นามสกุล">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea class="form-control mb-3" id="parent_address" rows="3" placeholder="โปรดระบุรายละเอียดที่อยู่"></textarea>
                                                        </div>
                                                        <div class="row">
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="parent_province" id="parent_province" data-size="5" data-live-search="true" onchange="getDistrictList('parent')">

                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="parent_district" id="parent_district" data-size="5" data-live-search="true" onchange="getSubDistrictList('parent')">
                                                                    <option value="" disabled selected>-โปรดเลือกอำเภอ-</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <select class="form-control selectpicker" name="parent_subdistrict" id="parent_subdistrict" data-size="5" data-live-search="true" onchange="getZipcode('parent')">
                                                                    <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-sm-3 mb-3 ">
                                                                <input type="number" class="form-control" name="parent_zipcode" id="parent_zipcode" placeholder="รหัสไปรษณีย์" readonly>
                                                            </div>

                                                            <div class="form-group col-sm-6 mb-3">
                                                                <input type="text" class="form-control " name="parent_career" id="parent_career" placeholder="อาชีพ">
                                                            </div>
                                                            <div class="form-group col-sm-6 mb-3">
                                                                <input type="number" class="form-control " name="parent_salary" id="parent_salary" placeholder="รายได้ (เดือน)">
                                                            </div>
                                                            <div class="form-group col-sm-4 mb-3">
                                                                <input type="text" class="form-control " name="parent_phone" id="parent_phone" placeholder="เบอร์โทรศัพท์">
                                                            </div>
                                                            <div class="form-group col-sm-4 mb-3">
                                                                <input type="number" class="form-control " name="parent_email" id="parent_email" placeholder="อีเมลล์">
                                                            </div>
                                                            <div class="form-group col-sm-4 mb-3">
                                                                <input type="text" class="form-control " name="parent_line" id="parent_line" placeholder="ไอดีไลน์">
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!--End Parent Row-->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col-md-8 -->
                                </div>



                            </div>
                            <!-- /.container -->


                            <div class="d-flex justify-content-center">
                                <button class="btn btn-sky" type="submit">บันทึกข้อมูลนักเรียน</button>
                            </div>
                        </div>
                    </div>
                    </form>
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
            /*  
            $("#idcard").mask("9-9999-99999-99-9", {
                placeholder: " "
            });
            */
            generateStudentID();
            showProvinceList('std');
            showProvinceList('mom');
            showProvinceList('fa');
            showProvinceList('parent');
            showGradeList();
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

        $('#updateStdForm').bootstrapValidator({
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
                            regexp: /^(\d{13})?$/,
                            message: 'เลขบัตรประจำตัวประชาชนต้องเป็นตัวเลข 13 ตัว'
                        }
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
                std_grade: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกระดับชั้นที่ศึกษา'
                        },
                    }
                }
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_std_add.php',
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log("File Upload : " + res);
                },
                error: function(err) {
                    alert("Error" + err)

                }
            }); 
           /*  Swal.fire({
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

                    Swal.fire({
                        title: "กำลังโหลด...",
                        html: "โปรดรอสักครู่",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    })

                    $.ajax({
                        type: 'POST',
                url: 'ajax_person_info/ajax_std_add.php',
                data: new FormData(this),
                processData: false,
                contentType: false,
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Add Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เพิ่มข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เพิ่มข้อมูลไม่สำเร็จ!',
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
            }) */
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
                data:{grade : $('#std_grade').val()},
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

        /* $("#updateStdFrom").on('submit', function(e) {
            //var x = $('#demoForm').serialize();
            e.preventDefault();
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

                    Swal.fire({
                        title: "กำลังโหลด...",
                        html: "โปรดรอสักครู่",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    })

                    $.ajax({
                        type: 'POST',
                        url: 'ajax_person_info/ajax_std_add.php',
                        data: $(this).serializeArray(),
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Add Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เพิ่มข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เพิ่มข้อมูลไม่สำเร็จ!',
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
        }) */
    </script>

</body>

</html>