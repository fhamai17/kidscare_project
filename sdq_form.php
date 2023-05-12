<?php
session_start();
print_r($_SESSION);
if (isset($_GET['sdq_id'])) {
    $sdq_id = $_GET['sdq_id'];
} else {
    $sdq_id = "";
}

$type = $_SESSION['type'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - SDQ</title>
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-center mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold">แบบประเมินพฤติกรรมนักเรียน (SDQ)</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12">
                                    <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลนักเรียน</h1>
                                </div>
                                <div class="col-sm-3 mb-3">
                                    <label for="validationServer01" class="form-label">คำนำหน้าชื่อ</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                                        </div>
                                        <input type="text" class="form-control " name="std_pname" id="std_pname" placeholder="โปรดระบุคำนำหน้าชื่อ" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-3  mb-3">
                                    <label for="validationServer01" class="form-label">ชื่อ</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        </div>
                                        <input type="text" class="form-control " name="std_fname" id="std_fname" placeholder="โปรดระบุชื่อจริง" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-3  mb-3">
                                    <label for="validationServer01" class="form-label">นามสกุล</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        </div>
                                        <input type="text" class="form-control " name="std_lname" id="std_lname" placeholder="โปรดระบุนามสกุล" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-3  mb-3">
                                    <label for="validationServer01" class="form-label">ระดับชั้น</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-mortarboard-fill"></i></span>
                                        </div>
                                        <input type="text" class="form-control " name="std_grade" id="std_grade" placeholder="โปรดระบุระดับชั้น" disabled>
                                    </div>
                                </div>
                            </div>


                            <!-- ฟอร์ม SDQ -->

                            <div class="col-sm-12 ">
                                <hr>
                            </div>

                            <div id="person_check">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลผู้ประเมิน</h1>
                                    </div>
                                    <div class="col-sm-3 mb-3">
                                        <label for="validationServer01" class="form-label">คำนำหน้าชื่อ</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                                            </div>
                                            <input type="text" class="form-control " name="pname" id="pname" placeholder="โปรดระบุคำนำหน้าชื่อ" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-3  mb-3">
                                        <label for="validationServer01" class="form-label">ชื่อ</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                            </div>
                                            <input type="text" class="form-control " name="fname" id="fname" placeholder="โปรดระบุชื่อจริง" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-3  mb-3">
                                        <label for="validationServer01" class="form-label">นามสกุล</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                            </div>
                                            <input type="text" class="form-control " name="lname" id="lname" placeholder="โปรดระบุนามสกุล" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-3  mb-3">
                                        <label for="validationServer01" class="form-label">เวลาที่ประเมิน</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                            </div>
                                            <input type="text" class="form-control " name="datetime" id="datetime" placeholder="โปรดระบุเวลา" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a data-toggle="tab" class="nav-link active" href="#section_one" id="tab_one">
                                        <i class="bi bi-1-circle-fill"></i> ตอนที่ 1
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#section_two" id="tab_two"><i class="bi bi-2-circle-fill"></i> ตอนที่ 2</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active py-3" id="section_one">
                                    <form id="sdqForm">
                                        <input type="hidden" name="sdq_id" id="sdq_id" value="<?= $sdq_id ?>">
                                        <div class="col-sm-12 mb-3">

                                            <table class="table table-bordered table-hover" style="width:100%" id="table_one">
                                                <thead class="table-success">
                                                    <tr>
                                                        <th scope="col" class="text-center">ข้อ</th>
                                                        <th scope="col" style="width:60%" class="text-center">คำถาม</th>
                                                        <th scope="col" class="text-center">ไม่จริง</th>
                                                        <th scope="col" class="text-center">ค่อนข้างจริง</th>
                                                        <th scope="col" class="text-center">จริง</th>
                                                    </tr>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="question01">
                                                        <th scope="row" class="text-center">1</th>
                                                        <td>ใส่ใจกับความรู้สึกของผู้อื่น
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no01" id="no01_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no01" id="no01_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no01" id="no01_3" value="2">
                                                        </td>
                                                    </tr>
                                                    <tr id="question02">
                                                        <th scope="row" class="text-center">2</th>
                                                        <td>อยู่ไม่สุข เคลื่อนไหวมาก ไม่สามารถอยู่นิ่งได้นาน
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no02" id="no02_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no02" id="no02_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no02" id="no02_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">3</th>
                                                        <td>บ่นปวดศีรษะ ปวดท้องหรือคลื่นไส้บ่อยๆ
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no03" id="no03_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no03" id="no03_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no03" id="no03_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">4</th>
                                                        <td>เต็มใจแบ่งปันกับเด็กอื่น (ขนม ของเล่น ดินสอ ฯลฯ)
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no04" id="no04_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no04" id="no04_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no04" id="no04_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">5</th>
                                                        <td>แผลงฤทธิ์บ่อย หรืออารมณ์ร้อน
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no05" id="no05_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no05" id="no05_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no05" id="no05_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">6</th>
                                                        <td>ค่อนข้างอยู่โดดเดี่ยว มักเล่นตามลำพัง
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no06" id="no06_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no06" id="no06_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no06" id="no06_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">7</th>
                                                        <td>โดยปกติแล้ว เชื่อฟัง ทำตามที่ผู้ใหญ่บอก
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no07" id="no07_1" value="2">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no07" id="no07_2" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no07" id="no07_3" value="1">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">8</th>
                                                        <td>มีความกังวลหลายเรื่อง ดูเหมือนกังวลบ่อย
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no08" id="no08_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no08" id="no08_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no08" id="no08_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">9</th>
                                                        <td>ช่วยเหลือถ้ามีใครบาดเจ็บ ไม่สบายใจหรือเจ็บป่วย
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no09" id="no09_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no09" id="no09_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no09" id="no09_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">10</th>
                                                        <td>หยุกหยิก หรือดิ้นไปดิ้นมาตลอดเวลา
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no10" id="no10_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no10" id="no10_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no10" id="no10_3" value="2">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="text-center">11</th>
                                                        <td>มีเพื่อนสนิทอย่างน้อยหนึ่งคน
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no11" id="no11_1" value="2">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no11" id="no11_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no11" id="no11_3" value="0">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">12</th>
                                                        <td>มีเรื่องต่อสู้หรือรังแกเด็กอื่นบ่อยๆ
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no12" id="no12_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no12" id="no12_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no12" id="no12_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">13</th>
                                                        <td>ไม่มีความสุข เศร้าหรือร้องไห้บ่อยๆ
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no13" id="no13_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no13" id="no13_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no13" id="no13_2" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">14</th>
                                                        <td>โดยทั่วไปเป็นที่ชอบพอของเด็กอื่น
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no14" id="no14_1" value="2">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no14" id="no14_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no14" id="no14_3" value="0">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">15</th>
                                                        <td>วอกแวกง่าย ไม่มีสมาธิ
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no15" id="no15_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no15" id="no15_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no15" id="no15_3" value="2">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="text-center">16</th>
                                                        <td>วิตกกังวลหรือติดแจเมื่ออยู่ในสถานการณ์ใหม่ เสียความมั่นใจง่าย
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no16" id="no16_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no16" id="no16_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no16" id="no16_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">17</th>
                                                        <td>ใจดีกับเด็กที่อายุน้อยกว่า
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no17" id="no17_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no17" id="no17_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no17" id="no17_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">18</th>
                                                        <td>พูดปดหรือขี้โกงบ่อยๆ
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no18" id="no18_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no18" id="no18_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no18" id="no18_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">19</th>
                                                        <td>ถูกเด็กคนอื่นแกล้งหรือรังแก
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no19" id="no19_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no19" id="no19_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no19" id="no19_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">20</th>
                                                        <td>มักอาสาช่วยเหลือผู้อื่น (พ่อแม่ ครู เด็กอื่น)
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no20" id="no20_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no20" id="no20_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no20" id="no20_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">21</th>
                                                        <td>คิดก่อนทำ
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no21" id="no21_1" value="2">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no21" id="no21_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no21" id="no21_3" value="0">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">22</th>
                                                        <td>ขโมยของที่บ้าน ที่โรงเรียน หรือที่อื่น
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no22" id="no22_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no22" id="no22_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no22" id="no22_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">23</th>
                                                        <td>เข้ากับผู้ใหญ่ได้ดีกว่าเข้ากับเด็กอื่น
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no23" id="no23_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no23" id="no23_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no23" id="no23_3" value="2">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">24</th>
                                                        <td>มีความกลัวหลายเรื่อง หวาดกลัวง่าย
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no24" id="no24_1" value="2">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no24" id="no24_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no24" id="no24_3" value="0">
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row" class="text-center">25</th>
                                                        <td>มีสมาธิในการติดตามทำงานจนเสร็จ
                                                            <div class="has-error">
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no25" id="no25_1" value="0">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no25" id="no25_2" value="1">
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="radio" name="no25" id="no25_3" value="2">
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    โปรดกรอกเพิ่มเติม ( ถ้าคุณมีความคิดเห็นอื่น )
                                                    <textarea class="form-control" name="remark" id="remark"></textarea>
                                                </div>
                                            </div>
                                        </div>


                                    </form>
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-primary float-end btnNext" id="btn_next" onclick="checkSectionOne()">ถัดไป</button>
                                        <!-- <button class="btn btn-outline-primary float-end btnNext" type="button" onclick="checkSectionOne()">ถัดไป</button> -->
                                    </div>



                                </div>
                                <div class="tab-pane fade py-3" id="section_two">
                                    <form id="sdqForm2">
                                        <label for="topic" class="form-label">โดยรวมคุณคิดว่าเด็กมีปัญหาในด้านอารมณ์ด้านสมาธิด้านพฤติกรรม หรือความสามารถเข้ากับผู้อื่นด้านใดด้านหนึ่งหรือไม่ ?</label>
                                        <div class="form-group col-sm-12  mb-3 question">
                                            <div class="form-check form-check-inline ">
                                                <input class="form-check-input" type="radio" name="problem" id="problem_1" onclick="showHideProblem()" value="0">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    ไม่มีปัญหา
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="problem" id="problem_2" onclick="showHideProblem()" value="1">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    มีปัญหาเล็กน้อย
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="problem" id="problem_3" onclick="showHideProblem()" value="2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    มีปัญหาชัดเจน
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="problem" id="problem_4" onclick="showHideProblem()" value="3">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    มีปัญหาอย่างรุนแรง
                                                </label>
                                            </div>
                                            <div class="has-error"></div>
                                        </div>

                                        <div id="hasProblem">
                                            <label>ถ้าคุณตอบ <span class="font-weight-bold">"มีปัญหา"</span> โปรดตอบข้อ 1-4 ต่อไปนี้ด้วย</label>
                                            <br>

                                            <label for="topic" class="form-label">1) ปัญหาที่มีเกิดขึ้นมานานเท่าไรแล้ว ?</label>
                                            <div class="col-sm-12  mb-3 question">
                                                <div class="form-check form-check-inline  col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio01" id="radio01_1" value="0">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        น้อยกว่า 1 เดือน
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline  col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio01" id="radio01_2" value="1">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        1-5 เดือน
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio01" id="radio01_3" value="2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        6-12 เดือน
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio01" id="radio01_4" value="3">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        มากกว่า 1 ปี
                                                    </label>
                                                </div>
                                                <div class="has-error"></div>
                                            </div>


                                            <label for="topic" class="form-label">2) เด็กรู้สึกหงุดหงิดหรือไม่สบายใจกับปัญหาที่มีหรือไม่ ?</label>
                                            <div class="col-sm-12  mb-3 question">
                                                <div class="form-check form-check-inline  col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio02" id="radio02_1" value="0">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        ไม่เลย
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline  col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio02" id="radio02_2" value="0">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        เล็กน้อย
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio02" id="radio02_3" value="1">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        ค่อนข้างมาก
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio02" id="radio02_4" value="2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        มากที่สุด
                                                    </label>
                                                </div>
                                                <div class="has-error"></div>
                                            </div>


                                            <label for="topic" class="form-label">3) ปัญหาที่มีรบกวนชีวิตประจำวันของเด็กในด้านต่าง ๆ ต่อไปนี้หรือไม่ ?</label>
                                            <div class="form-group col-sm-12 mb-3">

                                                <table class="table table-bordered table-hover" style="width:100%" id="table_two">
                                                    <thead class="table-success">
                                                        <tr>

                                                            <th scope="col" style="width:60%" class="text-center">รายการ</th>
                                                            <th scope="col" style="width:10%" class="text-center">ไม่เลย</th>
                                                            <th scope="col" style="width:10%" class="text-center">เล็กน้อย</th>
                                                            <th scope="col" style="width:10%" class="text-center">ค่อนข้างมาก</th>
                                                            <th scope="col" style="width:10%" class="text-center">มากที่สุด</th>
                                                        </tr>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>ความเป็นอยู่
                                                                <div class="has-error"></div>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_1" id="radio03_11" value="0">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_1" id="radio03_12" value="0">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_1" id="radio03_13" value="1">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_1" id="radio03_14" value="2">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>การคบเพื่อน

                                                                <div class="has-error"></div>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_2" id="radio03_21" value="0">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_2" id="radio03_22" value="0">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_2" id="radio03_23" value="1">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_2" id="radio03_24" value="2">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>การเรียนในห้องเรียน
                                                                <div class="has-error"></div>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_3" id="radio03_31" value="0">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_3" id="radio03_32" value="0">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_3" id="radio03_33" value="1">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_3" id="radio03_34" value="2">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>กิจกรรมยามว่าง
                                                                <div class="has-error"></div>
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_4" id="radio03_41" value="0">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_4" id="radio03_42" value="0">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_4" id="radio03_43" value="1">
                                                            </td>
                                                            <td class="text-center">
                                                                <input type="radio" name="radio03_4" id="radio03_44" value="2">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>


                                            </div>


                                            <label for="topic" class="form-label">4) ปัญหาที่มีทำ ให้คุณหรือชั้นเรียนเกิดความยุ่งยากหรือไม่ ?</label>
                                            <div class="col-sm-12  mb-3 question">
                                                <div class="form-check form-check-inline  col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio04" id="radio04_1" value="0">
                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                        ไม่เลย
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline  col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio04" id="radio04_2" value="1">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        เล็กน้อย
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio04" id="radio04_3" value="2">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        ค่อนข้างมาก
                                                    </label>
                                                </div>
                                                <div class="form-check form-check-inline col-sm-2">
                                                    <input class="form-check-input" type="radio" name="radio04" id="radio04_4" value="3">
                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                        มากที่สุด
                                                    </label>
                                                </div>
                                                <div class="has-error"></div>
                                            </div>

                                        </div>
                                    
                                    </form>
                                    <div class="d-flex justify-content-between">
                                            <button class="btn  btn-outline-primary float-end btnPrevious" onclick="previousTab()">ย้อนกลับ</button>
                                            <button class="btn btn-sky" type="button" onclick="checkSectionTwo()" id="btn_submit">ส่งแบบประเมิน</button>
                                        </div>



                                </div>
                            </div>





                            <!-- ฟอร์ม SDQ -->






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
        /*        $('.btnNext').click(function() {
            const nextTabLinkEl = $('.nav-tabs .active').closest('li').next('li').find('a')[0];
            const nextTab = new bootstrap.Tab(nextTabLinkEl);
            nextTab.show();
        }); */


  
        //var student_id;
        //var isDone;
        var type = "<?= $type ?>";
        var num = 1;
        var num2 = 1;
        $(document).ready(function() {
            //showStudentTable();
            showFormDetail();
        });


        function showHideProblem() {
            if ($("#problem_1").is(":checked")) {
                $("#hasProblem").hide();
            } else {
                $("#hasProblem").show();
            }
        }

        function showFormDetail() {
            $.ajax({
                type: 'POST',
                url: 'ajax_sdq/ajax_sdq_detail.php',
                data: {
                    sdq_id: $("#sdq_id").val()
                },
                success: function(data) {
                    console.log("Student ID :" + data)
                    const obj = JSON.parse(data);
                    if (data) {
                        $("#std_pname").val(obj.std_pname);
                        $("#std_fname").val(obj.std_fname);
                        $("#std_lname").val(obj.std_lname);
                        $("#std_grade").val(obj.grade);
                        $("#pname").val(obj.user_pname);
                        $("#fname").val(obj.user_fname);
                        $("#lname").val(obj.user_lname);
                        $("#datetime").val(obj.update_time);
                        $("#remark").val(obj.remark);
                        $("input:radio[name='no01'][value='" + obj.no01 + "']").prop('checked', true);
                        $("input:radio[name='no02'][value='" + obj.no02 + "']").prop('checked', true);
                        $("input:radio[name='no03'][value='" + obj.no03 + "']").prop('checked', true);
                        $("input:radio[name='no04'][value='" + obj.no04 + "']").prop('checked', true);
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
                        $("input:radio[name='problem'][value='" + obj.problem + "']").prop('checked', true);
                        $("input:radio[name='radio01'][value='" + obj.radio01 + "']").prop('checked', true);
                        $("input:radio[name='radio02'][value='" + obj.radio02 + "']").prop('checked', true);
                        $("input:radio[name='radio03_1'][value='" + obj.radio03_1 + "']").prop('checked', true);
                        $("input:radio[name='radio03_2'][value='" + obj.radio03_2 + "']").prop('checked', true);
                        $("input:radio[name='radio03_3'][value='" + obj.radio03_3 + "']").prop('checked', true);
                        $("input:radio[name='radio03_4'][value='" + obj.radio03_4 + "']").prop('checked', true);
                        $("input:radio[name='radio04'][value='" + obj.radio04 + "']").prop('checked', true);
                        showHideProblem();
                        if (obj.type != type) {
                            disabledForm()
                        } else {
                            if (obj.isDone == 1) {
                                disabledForm()
                            } else {
                                enableForm()
                            }
                        }

                    }
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });


        }


        function disabledForm() {
            $("#sdqForm :input").prop("disabled", true);
            $("#sdqForm2 :input").prop("disabled", true);
            $("#person_check").show();
            $("#btn_submit").remove();
            $("#tab_two").attr('data-toggle', 'tab');
        }

        function enableForm() {
            $("#sdqForm :input").prop("disabled", false);
            $("#sdqForm2 :input").prop("disabled", false);
            $("#person_check").hide();
        }

        /*         $("#sdqForm").on('submit', function(e) {

                    e.preventDefault();
                    updateSDQ();

                }); */
        function checkSectionTwo() {
            num2++;
            var i = 1;
            var x;
            var section_two = true;

            
            $('.question').each(function() {
                if ($(this).find('input:radio').is(':checked')) {
                    $(this).find('.has-error').html('');
                } else {
                    if (i == 1) {
                        x = $(this).offset().top;
                        i++;
                    }
                    section_two = false;
                    //var scrollTo = $(this).offset().top; 
                    $(this).find('.has-error').html('<small class="help-block">โปรดตอบคำถามข้อนี้</small>');
                }
            });

            $('#table_two tbody tr').each(function() {
                if ($(this).find('input:radio').is(':checked')) {
                    $(this).find('.has-error').html('');
                } else {
                    if (i == 1) {
                        x = $(this).offset().top;
                        i++;
                    }
                    section_two = false;
                    //var scrollTo = $(this).offset().top; 
                    $(this).find('.has-error').html('<small class="help-block">โปรดตอบคำถามข้อนี้</small>');
                }
            });

            if (x !== undefined || x !== null) {
                $('html, body').animate({
                    scrollTop: x + 'px'
                }, 500);
            }


            if($('input[name="problem"]:checked').val()==0){
                section_two = true;
            }

            if (section_two) {
                updateSDQ();
            } else {
                console.log("Form2 IsInValid");
            }


        }

        $('#sdqForm2 input:radio').change(function() {
            if (num2 > 1) {
                validateRadioTwo();
            }
        });

        function validateRadioTwo() {
            $('.question').each(function() {
                if ($(this).find('input:radio').is(':checked')) {
                    $(this).find('.has-error').html('');
                } else {
                    $(this).find('.has-error').html('<small class="help-block">โปรดตอบคำถามข้อนี้</small>');
                }
            });

            $('#table_two tbody tr').each(function() {
                if ($(this).find('input:radio').is(':checked')) {
                    $(this).find('.has-error').html('');
                } else {
                    $(this).find('.has-error').html('<small class="help-block">โปรดตอบคำถามข้อนี้</small>');
                }
            });
        }

        function updateSDQ() {
            Swal.fire({
                 title: 'ส่งแบบประเมิน SDQ',
                 text: "คุณจะไม่สามารถย้อนกลับมาแก้ไขได้ ยังยืนยันที่จะส่งหรือไม่?",
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
                         url: 'ajax_sdq/ajax_sdq_update.php',
                         data: $("#sdqForm, #sdqForm2").serializeArray(),
                         success: function(res) {
                             console.log("Res : " + res);
                             if (res.search("Update Successful") != -1) {
                                 Swal.fire({
                                     icon: 'success',
                                     title: 'ส่งแบบประเมินสำเร็จ!',
                                     showConfirmButton: false,
                                     timer: 1500
                                 }).then((result) => {
                                     location.reload();
                                 })
                             } else {
                                 Swal.fire({
                                     icon: 'error',
                                     title: 'ส่งแบบประเมินไม่สำเร็จ!',
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



        /* 
                $('#sdqForm').bootstrapValidator({
                    live: 'enabled',
                    trigger: null,
                    fields: {
                        test01: {
                            validators: {
                                notEmpty: {
                                },
                            }
                        },

                    }
                }).on('success.form.bv', function(e) {
                    // Prevent submit form
                    e.preventDefault();

                }); */

        /* $('#sdqForm2').bootstrapValidator({
            live: 'enabled',
            trigger: null,
            fields: {
                problem: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุละติจุด'
                        },
                    }
                },

            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            updateSDQ();

        }); */


        function checkSectionOne() {
            num++;
            var x;

            var section_one = true;
            var i = 1;
            $('#table_one tbody tr').each(function() {

                if ($(this).find('input:radio').is(':checked')) {

                    $(this).find('.has-error').html('');
                } else {

                    if (i == 1) {
                        x = $(this).offset().top;
                        i++;
                    }

                    section_one = false;
                    //var scrollTo = $(this).offset().top; 
                    $(this).find('.has-error').html('<small class="help-block">โปรดตอบคำถามข้อนี้</small>');
                }
            });

            if (x !== undefined || x !== null) {
                $('html, body').animate({
                    scrollTop: x + 'px'
                }, 500);
            }



            if (section_one) {
                const nextTabLinkEl = $('.nav-tabs .active').closest('li').next('li').find('a')[0];
                const nextTab = new bootstrap.Tab(nextTabLinkEl);
                nextTab.show();
            } else {
                console.log("Form1 IsInValid");
            }


        }


        function validateRadio() {
            $('#table_one tbody tr').each(function() {
                if ($(this).find('input:radio').is(':checked')) {
                    $(this).find('.has-error').html('');
                } else {
                    $(this).find('.has-error').html('<small class="help-block">โปรดตอบคำถามข้อนี้</small>');
                }
            });
        }


        $('#sdqForm input:radio').change(function() {
            if (num > 1) {
                validateRadio();
            }
        });

        function previousTab(){
            const prevTabLinkEl = $('.nav-tabs .active').closest('li').prev('li').find('a')[0];
            const prevTab = new bootstrap.Tab(prevTabLinkEl);
            prevTab.show();
        }
    </script>

</body>

</html>