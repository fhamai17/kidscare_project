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
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <h6 class="m-0 font-weight-bold text-info">แบบประเมิน SDQ</h6>

                        </div>
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

                                <div class="col-sm-12 ">
                                    <hr>
                                </div>
                            </div>
                            <form id="sdqForm">
                                <input type="hidden" name="sdq_id" id="sdq_id" value="<?= $sdq_id ?>">
                                <div class="form-group col-sm-12 mb-3">
                                    <label for="validationServer01" class="form-label font-weight-bold">1. พฤติกรรมด้านอารมณ์</label>
                                </div>
                                <div class="form-group col-sm-12 mb-3">

                                    <table class="table table-bordered table-hover" style="width:100%">
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
                                            <tr>
                                                <th scope="row" class="text-center">1</th>
                                                <td>มักจะบ่นว่าปวดศีรษะ ปวดท้อง</td>
                                                <td class="text-center">
                                                    <input type="radio" name="no01" id="no01_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no01" id="no01_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no01" id="no01_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">2</th>
                                                <td>กังวลใจหลายเรื่อง ดูกังวลเสมอ </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no02" id="no02_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no02" id="no02_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no02" id="no02_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">3</th>
                                                <td>ดูไม่มีความสุข ท้อแท ้</td>
                                                <td class="text-center">
                                                    <input type="radio" name="no03" id="no03_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no03" id="no03_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no03" id="no03_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">4</th>
                                                <td>เครียดไม่ยอมห่างเวลาอยู่ในสถานการณ์ที่ไม่คุ้นและขาดความมั่นใจใน
                                                    ตนเอง</td>
                                                <td class="text-center">
                                                    <input type="radio" name="no04" id="no04_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no04" id="no04_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no04" id="no04_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">5</th>
                                                <td>ขี้กลัว รสู้ึกหวาดกลัวได้ง่าย </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no05" id="no05_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no05" id="no05_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no05" id="no05_3" value="2" required>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group col-sm-12 mb-3">
                                    <label for="validationServer01" class="form-label font-weight-bold">2. ด้านพฤติกรรมเกเร</label>
                                </div>
                                <div class="form-group col-sm-12 mb-3">

                                    <table class="table table-bordered table-hover" style="width:100%">
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
                                            <tr>
                                                <th scope="row" class="text-center">6</th>
                                                <td>มักจะอาละวาด หรือโมโหร้าย </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no06" id="no06_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no06" id="no06_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no06" id="no06_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">7</th>
                                                <td>เชื่อฟัง มักจะทําตามที่ผู้ใหญ่ต้องการ </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no07" id="no07_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no07" id="no07_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no07" id="no07_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">8</th>
                                                <td>มักจะมีเรื่องทะเลาะวิวาทกับเด็กอื่น หรือรังแกเด็กอื่น </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no08" id="no08_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no08" id="no08_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no08" id="no08_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">9</th>
                                                <td>ชอบโกหก หรอขื ี้โกง </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no09" id="no09_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no09" id="no09_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no09" id="no09_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">10</th>
                                                <td>ขี้ขโมยของที่บ้าน ที่โรงเรียนหรือที่อื่น</td>
                                                <td class="text-center">
                                                    <input type="radio" name="no10" id="no10_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no10" id="no10_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no10" id="no10_3" value="2" required>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group col-sm-12 mb-3">
                                    <label for="validationServer01" class="form-label font-weight-bold">3. ด้านพฤติกรรมไม่อยู่นิ่ง</label>
                                </div>
                                <div class="form-group col-sm-12 mb-3">
                                    <table class="table table-bordered table-hover" style="width:100%">
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
                                            <tr>
                                                <th scope="row" class="text-center">11</th>
                                                <td>อยู่ไม่นิ่ง นั่งนิ่ง ๆ ไม่ได้</td>
                                                <td class="text-center">
                                                    <input type="radio" name="no11" id="no11_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no11" id="no11_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no11" id="no11_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">12</th>
                                                <td> อยู่ไม่สุข วุ่นวายอย่างมาก </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no12" id="no12_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no12" id="no12_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no12" id="no12_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">13</th>
                                                <td>วอกแวกง่าย สมาธิสั้น </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no13" id="no13_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no13" id="no13_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no13" id="no13_2" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">14</th>
                                                <td>คิดก่อนทํา</td>
                                                <td class="text-center">
                                                    <input type="radio" name="no14" id="no14_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no14" id="no14_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no14" id="no14_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">15</th>
                                                <td>ทํางานได้จนเสร็จ มีความตั้งอกตั้งใจในการทางาน </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no15" id="no15_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no15" id="no15_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no15" id="no15_3" value="2" required>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group col-sm-12 mb-3">
                                    <label for="validationServer01" class="form-label font-weight-bold">4. พฤติกรรมด้านความสัมพันธ์กับเพื่อน</label>
                                </div>
                                <div class="form-group col-sm-12 mb-3">

                                    <table class="table table-bordered table-hover" style="width:100%">
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
                                            <tr>
                                                <th scope="row" class="text-center">16</th>
                                                <td>ค่อนข้างแยกตัว ชอบเล่นคนเดียว </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no16" id="no16_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no16" id="no16_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no16" id="no16_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">17</th>
                                                <td>มีเพื่อนสนิท </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no17" id="no17_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no17" id="no17_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no17" id="no17_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">18</th>
                                                <td> เป็นที่ชื่นชอบของเพื่อน </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no18" id="no18_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no18" id="no18_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no18" id="no18_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">19</th>
                                                <td>ถูกเด็กคนอื่นล้อเลียน หรือรังแก</td>
                                                <td class="text-center">
                                                    <input type="radio" name="no19" id="no19_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no19" id="no19_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no19" id="no19_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">20</th>
                                                <td>เข้ากับผู้ใหญ่ได้ดีกว่ากับเด็กวัยเดียวกัน</td>
                                                <td class="text-center">
                                                    <input type="radio" name="no20" id="no20_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no20" id="no20_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no20" id="no20_3" value="2" required>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group col-sm-12 mb-3">
                                    <label for="validationServer01" class="form-label font-weight-bold">5. พฤติกรรมด้านสัมพันธภาพทางสงคม</label>
                                </div>
                                <div class="form-group col-sm-12 mb-3">

                                    <table class="table table-bordered table-hover" style="width:100%">
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
                                            <tr>
                                                <th scope="row" class="text-center">21</th>
                                                <td>ห่วงใยความรู้สึกคนอื่น </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no21" id="no21_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no21" id="no21_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no21" id="no21_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">22</th>
                                                <td>เต็มใจแบ่งปันสิ่งของให้เพื่อน (ขนม, ของเล่น, ดินสอ เป็นต้น) </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no22" id="no22_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no22" id="no22_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no22" id="no22_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">23</th>
                                                <td> เป็นที่พึ่งได้เวลาที่คนอื่นเสียใจ อารมณ์ไม่ดีหรือไม่สบายใจ </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no23" id="no23_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no23" id="no23_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no23" id="no23_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">24</th>
                                                <td> ใจดีกับเด็กที่เล็กกว่า</td>
                                                <td class="text-center">
                                                    <input type="radio" name="no24" id="no24_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no24" id="no24_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no24" id="no24_3" value="2" required>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">25</th>
                                                <td>ชอบอาสาช่วยเหลือผู้อื่น (พ่อ แม่, ครู, เพื่อน, เด็กคนอื่น ๆ เป็นต้น) </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no25" id="no25_1" value="0" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no25" id="no25_2" value="1" required>
                                                </td>
                                                <td class="text-center">
                                                    <input type="radio" name="no25" id="no25_3" value="2" required>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div> <br>

                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-sky" type="submit" id="btn_submit">ส่งแบบประเมิน</button>
                                </div>

                            </form>



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
        //var student_id;
        //var isDone;
        var type = "<?= $type ?>";
        $(document).ready(function() {
            //showStudentTable();
            showFormDetail();
        });



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
            $("#person_check").show();
            $("#btn_submit").remove();
        }

        function enableForm() {
            $("#sdqForm :input").prop("disabled", false);
            $("#person_check").hide();
        }
        /*  $('#sdqForm').bootstrapValidator({
             fields: {
                 no06: {
                     validators: {
                         notEmpty: {
                             message: 'โปรดตอบคำถามข้อที่ 6'
                         },
                     }
                 }

             }
         }).on('success.form.bv', function(e) {
             // Prevent submit form
             e.preventDefault();
         }); */


        $("#sdqForm").on('submit', function(e) {

            e.preventDefault();
            updateSDQ();

        });

        function updateSDQ() {
            Swal.fire({
                title: 'ส่งแบบประเมิน SDQ',
                text: "คุณต้องการส่งแบบประเมิน SDQ นี้ใช่หรือไม่?",
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
                        data: $("#sdqForm").serializeArray(),
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
    </script>

</body>

</html>