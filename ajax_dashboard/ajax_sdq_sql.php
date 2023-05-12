<?php
include '../dbconfig.php';
$data = array();
$user_type = ($_POST['user_type'] ? $_POST['user_type']  : "");
$chart = ($_POST['chart'] ? $_POST['chart'] : "");

$session = ($_POST['session'] ? "AND c.session_id = '$_POST[session]'" : "");
$term = ($_POST['term'] ? "AND c.term_id = '$_POST[term]'" : "");
$grade = ($_POST['grade'] ? "AND c.grade_id = '$_POST[grade]'" : "");
$section = ($_POST['section'] ? "AND c.section_id = '$_POST[section]'" : "");
if($user_type=='teacher'){
    $sql_type = 'คุณครู';
}else{
    $sql_type = 'ผู้ปกครอง';
}
$sql_t = "SELECT RESULT01 as '01' ,RESULT02 as '02',
RESULT03 as '03', RESULT04 as '04', RESULT05 as'05', RESULT06 as '06' FROM sdq a
LEFT JOIN class c ON a.class_id = c.class_id
WHERE type = '$sql_type' $session $term $grade $section";

$result_t = mysqli_query($conn, $sql_t);
$beha01 = 0;
$beha02 = 0;
$beha03 = 0;
$med01 = 0;
$med02 = 0;
$med03 = 0;
$emo01 = 0;
$emo02 = 0;
$emo03 = 0;
$rela01 = 0;
$rela02 = 0;
$rela03 = 0;
$soci01 = 0;
$soci02 = 0;
$secAll01 = 0;
$secAll02 = 0;
$secAll03 = 0;
$var = array();

foreach ($result_t  as $row) {

    $r01 = $row['01'];
    $r02 = $row['02'];
    $r03 = $row['03'];
    $r04 = $row['04'];
    $r05 = $row['05'];

    if($user_type=='teacher'){

        if (is_null($r01) && is_null($r02) && is_null($r03) && is_null($r04) && is_null($r05)) {
        } else {
            $t_all = $r01 + $r02 + $r03 + $r04 + $r05;
            if ($t_all > 16) {
                $secAll01++;
                //$result_tall = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($t_all > 13) {
                $secAll02++;
                //$result_tall = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $secAll03++;
                //$result_tall = '<a class="badge badge-success">ปกติ</a>';
            }
        }
    
        //เกเร
        if (is_null($r01)) {
            //
        } else {
            if ($r01 > 4) {
                $beha01++;
                //$result_tbeha = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($r01 > 3) {
                $beha02++;
                //$result_tbeha = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $beha03++;
                //$result_tbeha = '<a class="badge badge-success">ปกติ</a>';
            }
        }
    
        //อยู่ไม่นิ่ง
        if (is_null($r02)) {
            //
        } else {
            if ($r02 > 6) {
                $med01++;
                //$result_tmed = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($r02 > 5) {
                $med02++;
                //$result_tmed = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $med03++;
                //$result_tmed = '<a class="badge badge-success">ปกติ</a>';
            }
        }
        //อารมณ์
        if (is_null($r03)) {
            //$result_temo = "";
        } else {
            if ($r03 > 4) {
                $emo01++;
                //$result_temo = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($r03 > 3) {
                $emo02++;
                //$result_temo = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $emo03++;
                //$result_temo = '<a class="badge badge-success">ปกติ</a>';
            }
        }
    
    
        //เพื่อน
        if (is_null($r04)) {
            //
        } else {
            if ($r04 > 5) {
                $rela01++;
                //$result_trelat = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($r04 > 4) {
                $rela02++;
                //$result_trelat = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $rela03++;
                //$result_trelat = '<a class="badge badge-success">ปกติ</a>';
            }
        }
        //สัมพันธภาพ
        if (is_null($r05)) {
            //$result_tsocio = "";
        } else {
            if ($r05 > 4) {
                $soci01++;
                //$result_tsocio = '<a class="badge badge-success">มีจุดแข็ง</a>';
            } else {
                $soci02++;
                //$result_tsocio = '<a class="badge badge-danger">ไม่มีจุดแข็ง</a>';
            }
        }

    }
    else{

        if (is_null($r01) && is_null($r02) && is_null($r03) && is_null($r04) && is_null($r05)) {
        } else {
            $t_all = $r01 + $r02 + $r03 + $r04 + $r05;
            if ($t_all > 16) {
                $secAll01++;
                //$result_tall = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($t_all > 13) {
                $secAll02++;
                //$result_tall = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $secAll03++;
                //$result_tall = '<a class="badge badge-success">ปกติ</a>';
            }
        }
    
        //เกเร
        if (is_null($r01)) {
            //
        } else {
            if ($r01 > 4) {
                $beha01++;
                //$result_tbeha = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($r01 > 3) {
                $beha02++;
                //$result_tbeha = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $beha03++;
                //$result_tbeha = '<a class="badge badge-success">ปกติ</a>';
            }
        }
    
        //อยู่ไม่นิ่ง
        if (is_null($r02)) {
            //
        } else {
            if ($r02 > 6) {
                $med01++;
                //$result_tmed = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($r02 > 5) {
                $med02++;
                //$result_tmed = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $med03++;
                //$result_tmed = '<a class="badge badge-success">ปกติ</a>';
            }
        }
        //อารมณ์
        if (is_null($r03)) {
            //$result_temo = "";
        } else {
            if ($r03 > 5) {
                $emo01++;
                //$result_temo = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($r03 > 4) {
                $emo02++;
                //$result_temo = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $emo03++;
                //$result_temo = '<a class="badge badge-success">ปกติ</a>';
            }
        }
    
    
        //เพื่อน
        if (is_null($r04)) {
            //
        } else {
            if ($r04 > 5) {
                $rela01++;
                //$result_trelat = '<a class="badge badge-danger">มีปัญหา</a>';
            } else if ($r04 > 4) {
                $rela02++;
                //$result_trelat = '<a class="badge badge-warning">เสี่ยง</a>';
            } else {
                $rela03++;
                //$result_trelat = '<a class="badge badge-success">ปกติ</a>';
            }
        }
        //สัมพันธภาพ
        if (is_null($r05)) {
            //$result_tsocio = "";
        } else {
            if ($r05 > 4) {
                $soci01++;
                //$result_tsocio = '<a class="badge badge-success">มีจุดแข็ง</a>';
            } else {
                $soci02++;
                //$result_tsocio = '<a class="badge badge-danger">ไม่มีจุดแข็ง</a>';
            }
        }
    }
   
}


if($chart =='behaviour'){
$num = array(
    array("beha",$beha01,$beha02,$beha03),
  array("med",$med01,$med02,$med03),
  array("emo",$emo01,$emo02,$emo03),
  array("rela",$rela01,$rela02,$rela03),
);

for ($i = 0; $i <= 3; $i++) {
    $data[$i]["result"] = $num[$i][0];    
    $data[$i]["problem"] = $num[$i][1]; 
    $data[$i]["risk"] = $num[$i][2];
    $data[$i]["normal"] = $num[$i][3];
    
}


}
else{
    $data[0]["x"] = "strength";
    $data[0]["y"] = $soci01;
    $data[1]["x"] = "weak";
    $data[1]["y"] = $soci02;
}




echo json_encode($data);
