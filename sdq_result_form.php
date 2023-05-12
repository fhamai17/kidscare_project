<?php
include 'dbconfig.php';
$menu = "sdq";
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
} else {
    $class_id = "";
}

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];
} else {
    $student_id = "";
}

function getValue($result)
{
    $check_arr = array("RESULT01", "RESULT02", "RESULT03", "RESULT04", "RESULT05", "RESULT06");

    $arr = array();
    while ($row = mysqli_fetch_assoc($result)) {
        foreach ($row as $key => $value) {
            if (in_array($key, $check_arr)) {

                $arr[$key][0] = $value;
            } else {

                if ($value == 0  && !is_null($value)) {
                    $txt = "ไม่จริง";
                } else if ($value == 1) {
                    $txt = "ค่อนข้างจริง";
                } else if ($value == 2) {
                    $txt = "จริง";
                } else {
                    $txt = "";
                }
                $arr[$key][0] = $txt;
                $arr[$key][1] = $value;
            }
        }
    }

    return $arr;
}

session_start();
if (isset($_GET['sdq_id'])) {
    $sdq_id = $_GET['sdq_id'];
} else {
    $sdq_id = "";
}

$type = $_SESSION['type'];



$sql_class = "SELECT CONCAT(b.pname,' ',b.fname,' ',b.lname) AS fullname,d.grade_name as grade
FROM sdq as a 
LEFT JOIN student as b 
ON a.student_id =b.student_id
LEFT JOIN class c ON a.class_id = c.class_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
LEFT JOIN section e ON c.section_id = e.section_id 
WHERE a.student_id = '$student_id' AND a.class_id ='$class_id'
GROUP BY a.class_id,a.student_id";
$rs_class = mysqli_query($conn, $sql_class);
$row = mysqli_fetch_array($rs_class);
$fullname = $row['fullname'];
$grade = $row['grade'];

$sql_t = "SELECT NO01,NO02,NO03,NO04,NO05,NO06,NO07,NO08,NO09,NO10,
NO11,NO12,NO13,NO14,NO15,NO16,NO17,NO18,NO19,NO20,NO21,NO22,NO23,
NO24,NO25,RESULT01,RESULT02,RESULT03,RESULT04,RESULT05,RESULT06 FROM sdq
WHERE student_id = '$student_id' AND class_id ='$class_id'
AND type = 'คุณครู'";

$result_t = mysqli_query($conn, $sql_t);

$sql_p = "SELECT NO01,NO02,NO03,NO04,NO05,NO06,NO07,NO08,NO09,NO10,
NO11,NO12,NO13,NO14,NO15,NO16,NO17,NO18,NO19,NO20,NO21,NO22,NO23,
NO24,NO25,RESULT01,RESULT02,RESULT03,RESULT04,RESULT05,RESULT06 FROM sdq
WHERE student_id = '$student_id' AND class_id ='$class_id'
AND type = 'ผู้ปกครอง'";

$result_p = mysqli_query($conn, $sql_p);

$teacher_arr = getValue($result_t);
$parent_arr = getValue($result_p);

$result_t1 = $teacher_arr['RESULT01'][0];
$result_t2 = $teacher_arr['RESULT02'][0];
$result_t3 = $teacher_arr['RESULT03'][0];
$result_t4 = $teacher_arr['RESULT04'][0];
$result_t5 = $teacher_arr['RESULT05'][0];
$result_t6 = $teacher_arr['RESULT06'][0];


if($result_t6>1){
    $result_tback = '<a class="badge badge-danger">มีปัญหา</a>';
}else{
    $result_tback = '<a class="badge badge-success">ปกติ</a>';
}

if (is_null($result_t1) && is_null($result_t2) && is_null($result_t3) && is_null($result_t4) && is_null($result_t5)) {
   $t_all = "";
   $result_tall = "";
} else { 
    $t_all = $result_t1 + $result_t2 + $result_t3 + $result_t4 + $result_t5;
    if ($t_all > 16) {
        $result_tall = '<a class="badge badge-danger">มีปัญหา</a>';
    } else if ($t_all > 13) {
        $result_tall = '<a class="badge badge-warning">เสี่ยง</a>';
    } else {
        $result_tall = '<a class="badge badge-success">ปกติ</a>';
    }
    
}

$result_p1 = $parent_arr['RESULT01'][0];
$result_p2 = $parent_arr['RESULT02'][0];
$result_p3 = $parent_arr['RESULT03'][0];
$result_p4 = $parent_arr['RESULT04'][0];
$result_p5 = $parent_arr['RESULT05'][0];
$result_p6 = $parent_arr['RESULT06'][0];

if($result_p6>1){
    $result_pback = '<a class="badge badge-danger">มีปัญหา</a>';
}else{
    $result_pback = '<a class="badge badge-success">ปกติ</a>';
}

if (is_null($result_p1) && is_null($result_p2) && is_null($result_p3) && is_null($result_p4) && is_null($result_p5)) {
   $p_all = "";
   $result_pall = "";
} else { 
    $p_all = $result_p1 + $result_p2 + $result_p3 + $result_p4 + $result_p5;
        if ($t_all > 18) {
            $result_pall = '<a class="badge badge-danger">มีปัญหา</a>';
        } else if ($p_all > 15) {
            $result_pall = '<a class="badge badge-warning">เสี่ยง</a>';
        } else {
            $result_pall = '<a class="badge badge-success">ปกติ</a>';
        }
        
}


//เกเร
if (is_null($result_t1)) {
    $result_tbeha = "";
} else {
    if ($result_t1 > 4) {
        $result_tbeha = '<a class="badge badge-danger">มีปัญหา</a>';
    } else if ($result_t1 > 3) {
        $result_tbeha = '<a class="badge badge-warning">เสี่ยง</a>';
    } else {
        $result_tbeha = '<a class="badge badge-success">ปกติ</a>';
    }
}

//อยู่ไม่นิ่ง
if (is_null($result_t2)) {
    $result_tmed = "";
} else {
    if ($result_t2 > 6) {
        $result_tmed = '<a class="badge badge-danger">มีปัญหา</a>';
    } else if ($result_t2 > 5) {
        $result_tmed = '<a class="badge badge-warning">เสี่ยง</a>';
    } else {
        $result_tmed = '<a class="badge badge-success">ปกติ</a>';
    }
}
//อารมณ์
if (is_null($result_t3)) {
    $result_temo = "";
} else {
    if ($result_t3 > 4) {
        $result_temo = '<a class="badge badge-danger">มีปัญหา</a>';
    } else if ($result_t3 > 3) {
        $result_temo = '<a class="badge badge-warning">เสี่ยง</a>';
    } else {
        $result_temo = '<a class="badge badge-success">ปกติ</a>';
    }
}


//เพื่อน
if (is_null($result_t4)) {
    $result_trelat = "";
} else {
    if ($result_t4 > 5) {
        $result_trelat = '<a class="badge badge-danger">มีปัญหา</a>';
    } else if ($result_t4 > 4) {
        $result_trelat = '<a class="badge badge-warning">เสี่ยง</a>';
    } else {
        $result_trelat = '<a class="badge badge-success">ปกติ</a>';
    }
}
//สัมพันธภาพ
if (is_null($result_t5)) {
    $result_tsocio = "";
} else {
    if ($result_t5 > 4) {
        $result_tsocio = '<a class="badge badge-success">มีจุดแข็ง</a>';
    } else {
        $result_tsocio = '<a class="badge badge-danger">ไม่มีจุดแข็ง</a>';
    }
}


if (is_null($result_p1)) {
    $result_pbeha = "";
} else {
    if ($result_p1 > 4) {
        $result_pbeha = '<a class="badge badge-danger">มีปัญหา</a>';
    } else if ($result_p1 > 3) {
        $result_pbeha = '<a class="badge badge-warning">เสี่ยง</a>';
    } else {
        $result_pbeha = '<a class="badge badge-success">ปกติ</a>';
    }
}

if (is_null($result_p2)) {
    $result_pmed = "";
} else {
    if ($result_p2 > 6) {
        $result_pmed = '<a class="badge badge-danger">มีปัญหา</a>';
    } else if ($result_p2 > 5) {
        $result_pmed = '<a class="badge badge-warning">เสี่ยง</a>';
    } else {
        $result_pmed = '<a class="badge badge-success">ปกติ</a>';
    }
}



if (is_null($result_p3)) {
    $result_pemo = "";
} else {
    if ($result_p3 > 5) {
        $result_pemo = '<a class="badge badge-danger">มีปัญหา</a>';
    } else if ($result_p3 > 4) {
        $result_pemo = '<a class="badge badge-warning">เสี่ยง</a>';
    } else {
        $result_pemo = '<a class="badge badge-success">ปกติ</a>';
    }
}




if (is_null($result_p4)) {
    $result_prelat = "";
} else {
    if ($result_p4 > 5) {
        $result_prelat = '<a class="badge badge-danger">มีปัญหา</a>';
    } else if ($result_p4 > 4) {
        $result_prelat = '<a class="badge badge-warning">เสี่ยง</a>';
    } else {
        $result_prelat = '<a class="badge badge-success">ปกติ</a>';
    }
}




if (is_null($result_p5)) {
    $result_psocio = "";
} else {
    if ($result_p5 > 4) {
        $result_psocio = '<a class="badge badge-success">มีจุดแข็ง</a>';
    } else {
        $result_psocio = '<a class="badge badge-danger">ไม่มีจุดแข็ง</a>';
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - SDQ</title>
    <?php include './layout/head.php' ?>
    <style>
        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 0px !important;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #e3e6f0;
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
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-center align-items-center py-3">
                            <h6 class="m-0 font-weight-bold text-info">ผลการประเมิน SDQ</h6>

                        </div>
                        <div class="card-body">
                            <div class="row p-3 pb-0">
                                <div class="col-sm-12">
                                    <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลนักเรียน</h1>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label><span class="font-weight-bold">ชื่อ-สกุลนักเรียน : </span><?=$fullname?></label>
                                </div>
                                <div class="col-sm-6  mb-3">
                                    <label><span class="font-weight-bold">ระดับชั้นการศึกษา : </span><?=$grade?></label>
                                </div>
                                <hr>
                            </div>

                            <div class="col-sm-12">
                                <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ผลการวิเคราะห์ SDQ ตอนที่ 1</h1>
                            </div>

                            <form id="sdqForm">

                                <div class="form-group col-sm-12">
                                    <label for="validationServer01" class="form-label font-weight-bold">ด้านที่ 1 พฤติกรรมเกเร (Conduct problems)</label>
                                </div>

                                <div class="form-group col-sm-12">

                                    <table class="table table-bordered table-hover" >
                                        <thead class="table-success">
                                            <tr>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">ข้อ</th>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;width:60%">รายการ</th>
                                                <th scope="col" colspan="2" class="text-center">คุณครู</th>
                                                <th scope="col" colspan="2" class="text-center">ผู้ปกครอง</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">5</th>
                                                <td>แผลงฤทธิ์บ่อย หรืออารมณ์ร้อน</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO05'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO05'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO05'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO05'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">7</th>
                                                <td>โดยปกติแล้ว เชื่อฟัง ทำตามที่ผู้ใหญ่บอก</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO07'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO07'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO07'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO07'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">12</th>
                                                <td>มีเรื่องต่อสู้หรือรังแกเด็กอื่นบ่อยๆ</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO12'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO12'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO12'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO12'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">18</th>
                                                <td>พูดปดหรือขี้โกงบ่อยๆ</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO18'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO18'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO18'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO18'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">22</th>
                                                <td>ขโมยของที่บ้าน ที่โรงเรียน หรือที่อื่น</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO22'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO22'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO22'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO22'][1] ?>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td colspan="2" class="text-center font-weight-bold">รวม</td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $teacher_arr['RESULT01'][0] ?>
                                                </td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $parent_arr['RESULT01'][0] ?>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group col-sm-12 mb-3">
                                    <label for="validationServer01" class="form-label font-weight-bold">ด้านที่ 2 พฤติกรรมอยู่ไม่นิ่ง (Hyperactivity)</label>
                                </div>
                                <div class="form-group col-sm-12 mb-3">

                                    <table class="table table-bordered table-hover" >
                                        <thead class="table-success">
                                            <tr>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">ข้อ</th>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;width:60%">รายการ</th>
                                                <th scope="col" colspan="2" class="text-center">คุณครู</th>
                                                <th scope="col" colspan="2" class="text-center">ผู้ปกครอง</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">2</th>
                                                <td>อยู่ไม่สุข เคลื่อนไหวมาก ไม่สามารถอยู่นิ่งได้นาน</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO02'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO02'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO02'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO02'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">10</th>
                                                <td>หยุกหยิก หรือดิ้นไปดิ้นมาตลอดเวลา</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO10'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO10'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO10'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO10'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">15</th>
                                                <td>วอกแวกง่าย ไม่มีสมาธิ</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO15'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO15'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO15'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO15'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">21</th>
                                                <td>คิดก่อนทำ</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO21'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO21'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO21'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO21'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">25</th>
                                                <td>มีสมาธิในการติดตามทำงานจนเสร็จ</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO25'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO25'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO25'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO25'][1] ?>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td colspan="2" class="text-center font-weight-bold">รวม</td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $teacher_arr['RESULT02'][0] ?>
                                                </td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $parent_arr['RESULT02'][0] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group col-sm-12 mb-3">
                                    <label for="validationServer01" class="form-label font-weight-bold">ด้านที่ 3 ปัญหาทางอารมณ์ (Emotional problems)</label>
                                </div>
                                <div class="form-group col-sm-12">
                                    <table class="table table-bordered table-hover" >
                                        <thead class="table-success">
                                            <tr>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">ข้อ</th>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;width:60%;">รายการ</th>
                                                <th scope="col" colspan="2" class="text-center">คุณครู</th>
                                                <th scope="col" colspan="2" class="text-center">ผู้ปกครอง</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">3</th>
                                                <td>บ่นปวดศีรษะ ปวดท้องหรือคลื่นไส้บ่อยๆ</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO03'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO03'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO03'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO03'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">8</th>
                                                <td>มีความกังวลหลายเรื่อง ดูเหมือนกังวลบ่อย/td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO08'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO08'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO08'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO08'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">13</th>
                                                <td>ไม่มีความสุข เศร้าหรือร้องไห้บ่อยๆ</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO13'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO13'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO13'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO13'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">16</th>
                                                <td>วิตกกังวลหรือติดแจเมื่ออยู่ในสถานการณ์ใหม่ เสียความมั่นใจง่าย</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO16'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO16'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO16'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO16'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">24</th>
                                                <td>มีความกลัวหลายเรื่อง หวาดกลัวง่าย</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO24'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO24'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO24'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO24'][1] ?>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td colspan="2" class="text-center font-weight-bold">รวม</td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $teacher_arr['RESULT03'][0] ?>
                                                </td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $parent_arr['RESULT03'][0] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group col-sm-12 mb-3">
                                    <label for="validationServer01" class="form-label font-weight-bold">ด้านที่ 4 ปัญหาความสัมพันธ์กับเพื่อน (Peer problems)</label>
                                </div>
                                <div class="form-group col-sm-12">
                                    <table class="table table-bordered table-hover" >
                                        <thead class="table-success">
                                            <tr>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">ข้อ</th>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;width:60%;">รายการ</th>
                                                <th scope="col" colspan="2" class="text-center">คุณครู</th>
                                                <th scope="col" colspan="2" class="text-center">ผู้ปกครอง</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">6</th>
                                                <td>ค่อนข้างอยู่โดดเดี่ยว มักเล่นตามลำพัง</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO06'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO06'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO06'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO06'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">11</th>
                                                <td>มีเพื่อนสนิทอย่างน้อยหนึ่งคน</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO11'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO11'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO11'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO11'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">14</th>
                                                <td>โดยทั่วไปเป็นที่ชอบพอของเด็กอื่น</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO14'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO14'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO14'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO14'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">19</th>
                                                <td>ถูกเด็กคนอื่นแกล้งหรือรังแก</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO19'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO19'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO19'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO19'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">23</th>
                                                <td>เข้ากับผู้ใหญ่ได้ดีกว่าเข้ากับเด็กอื่น</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO23'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO23'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO23'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO23'][1] ?>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td colspan="2" class="text-center font-weight-bold">รวม</td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $teacher_arr['RESULT04'][0] ?>
                                                </td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $parent_arr['RESULT04'][0] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="form-group col-sm-12 mb-3">
                                    <label for="validationServer01" class="form-label font-weight-bold">ด้านที่ 5 พฤติกรรมสัมพันธภาพทางสังคม (Pro-social behavior)</label>
                                </div>
                                <div class="form-group col-sm-12">

                                    <table class="table table-bordered table-hover" >
                                        <thead class="table-success">
                                            <tr>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;">ข้อ</th>
                                                <th scope="col" rowspan="2" class="text-center" style="vertical-align : middle;text-align:center;width:60%;">รายการ</th>
                                                <th scope="col" colspan="2" class="text-center">คุณครู</th>
                                                <th scope="col" colspan="2" class="text-center">ผู้ปกครอง</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                                <th scope="col" class="text-center">ประเมิน</th>
                                                <th scope="col" class="text-center">คะแนน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" class="text-center">1</th>
                                                <td>ใส่ใจกับความรู้สึกของผู้อื่น</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO01'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO01'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO01'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO01'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">4</th>
                                                <td>เต็มใจแบ่งปันกับเด็กอื่น (ขนม ของเล่น ดินสอ ฯลฯ)</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO04'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO04'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO04'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO04'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">9</th>
                                                <td>ช่วยเหลือถ้ามีใครบาดเจ็บ ไม่สบายใจหรือเจ็บป่วย </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO09'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO09'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO09'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO09'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">17</th>
                                                <td>ใจดีกับเด็กที่อายุน้อยกว่า</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO17'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO17'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO17'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO17'][1] ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row" class="text-center">20</th>
                                                <td>มักอาสาช่วยเหลือผู้อื่น (พ่อแม่ ครู เด็กอื่น)</td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO20'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $teacher_arr['NO20'][1] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO20'][0] ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= $parent_arr['NO20'][1] ?>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td colspan="2" class="text-center font-weight-bold">รวม</td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $teacher_arr['RESULT05'][0] ?>
                                                </td>
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center font-weight-bold">
                                                    <?= $parent_arr['RESULT05'][0] ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                <div class="row p-3">
                                    <div class="col-sm-12">
                                    <label for="validationServer01" class="form-label font-weight-bold">แปลผล</label>
                                    </div>
                                    <div class="form-group col-sm-12 mb-3">

                                        <table class="table table-bordered table-hover" >
                                            <thead class="table-success">
                                                <tr>

                                                    <th scope="col" rowspan="4" class="text-center" style="vertical-align : middle;text-align:center;width:60%;">ด้าน</th>
                                                    <th scope="col" colspan="2" class="text-center" style="width:20%;">คุณครู</th>
                                                    <th scope="col" colspan="2" class="text-center" style="width:20%;">ผู้ปกครอง</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" class="text-center" style="width: 10%;">คะแนน</th>
                                                    <th scope="col" class="text-center">ผล</th>
                                                    <th scope="col" class="text-center" style="width: 10%;">คะแนน</th>
                                                    <th scope="col" class="text-center">ผล</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="font-weight-bold">ภาพรวม</td>
                                                    <td class="text-center"><?= $t_all ?></td>
                                                    <td class="text-center"><?= $result_tall ?></td>
                                                    <td class="text-center"><?= $p_all ?></td>
                                                    <td class="text-center"><?= $result_pall ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>พฤติกรรมเกเร (Conduct problems)</td>
                                                    <td class="text-center"><?= $result_t1 ?></td>
                                                    <td class="text-center"><?= $result_tbeha ?></td>
                                                    <td class="text-center"><?= $result_p1 ?></td>
                                                    <td class="text-center"><?= $result_pbeha ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>พฤติกรรมอยู่ไม่นิ่ง (Hyperactivity)</td>
                                                    <td class="text-center"><?= $result_t2 ?></td>
                                                    <td class="text-center"><?= $result_tmed ?></td>
                                                    <td class="text-center"><?= $result_p2 ?></td>
                                                    <td class="text-center"><?= $result_pmed ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>ปัญหาทางอารมณ์ (Emotional problems)</td>
                                                    <td class="text-center"><?= $result_t3 ?></td>
                                                    <td class="text-center"><?= $result_temo ?></td>
                                                    <td class="text-center"><?= $result_p3 ?></td>
                                                    <td class="text-center"><?= $result_pemo ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>ปัญหาความสัมพันธ์กับเพื่อน (Peer problems)</td>
                                                    <td class="text-center"><?= $result_t4 ?></td>
                                                    <td class="text-center"><?= $result_trelat ?></td>
                                                    <td class="text-center"><?= $result_p4 ?></td>
                                                    <td class="text-center"><?= $result_prelat ?></td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>พฤติกรรมสัมพันธภาพทางสังคม (Pro-social behavior)</td>
                                                    <td class="text-center"><?= $result_t5 ?></td>
                                                    <td class="text-center"><?= $result_tsocio ?></td>
                                                    <td class="text-center"><?= $result_p5 ?></td>
                                                    <td class="text-center"><?= $result_psocio ?></td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            <div class="col-sm-12">
                                <h1 class="h6 text-gray-900 font-weight-bold">ผลการวิเคราะห์ SDQ ตอนที่ 2</h1>
                            </div>

                            <div class="row p-3">
                                    <div class="col-sm-12">
                                    <label for="validationServer01" class="form-label font-weight-bold">แปลผล</label>
                                    </div>
                                    <div class="form-group col-sm-12">

                                        <table class="table table-bordered table-hover" >
                                            <thead class="table-success">
                                                <tr>

                                                    <th scope="col" rowspan="4" class="text-center" style="vertical-align : middle;text-align:center;width:60%;">ด้าน</th>
                                                    <th scope="col" colspan="2" class="text-center" style="width:20%;">คุณครู</th>
                                                    <th scope="col" colspan="2" class="text-center" style="width:20%;">ผู้ปกครอง</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col" class="text-center" style="width: 10%;">คะแนน</th>
                                                    <th scope="col" class="text-center">ผล</th>
                                                    <th scope="col" class="text-center" style="width: 10%;">คะแนน</th>
                                                    <th scope="col" class="text-center">ผล</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td class="font-weight-bold">โดยรวมคุณคิดว่าเด็กมีปัญหาในด้านอารมณ์ด้านสมาธิด้านพฤติกรรม หรือความสามารถเข้ากับผู้อื่นด้านใดด้านหนึ่ง</td>
                                                    <td class="text-center"><?= $result_t6 ?></td>
                                                    <td class="text-center"><?= $result_tback ?></td>
                                                    <td class="text-center"><?= $result_p6 ?></td>
                                                    <td class="text-center"><?= $result_pback ?></td>
                                                    
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                        </div>
                        </form>
                            <!-- ฟอร์ม SDQ -->
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

</body>

</html>