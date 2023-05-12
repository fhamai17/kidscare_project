<?php
include '../dbconfig.php';
$data = array();
$session = ($_POST['session'] ? "AND c.session_id = '$_POST[session]'" : "");
$term = ($_POST['term'] ? "AND c.term_id = '$_POST[term]'" : "");
$grade = ($_POST['grade'] ? "AND c.grade_id = '$_POST[grade]'" : "");
$section = ($_POST['section'] ? "AND c.section_id = '$_POST[section]'" : "");

$sql_t = "SELECT RESULT01 as '01' ,RESULT02 as '02',
RESULT03 as '03', RESULT04 as '04', RESULT05 as'05', RESULT06 as '06'
FROM sdq a
LEFT JOIN class c ON a.class_id = c.class_id
WHERE type = 'คุณครู' $session $term $grade $section";
$result_t = mysqli_query($conn, $sql_t);

$sql_p = "SELECT RESULT01 as '01' ,RESULT02 as '02',
RESULT03 as '03', RESULT04 as '04', RESULT05 as'05', RESULT06 as '06' 
FROM sdq a
LEFT JOIN class c ON a.class_id = c.class_id
WHERE type = 'ผู้ปกครอง' $session $term $grade $section";
$result_p = mysqli_query($conn, $sql_p);

$AllT01 = 0;
$AllT02 = 0;
$AllT03 = 0;

$AllP01 = 0;
$AllP02 = 0;
$AllP03 = 0;


foreach ($result_t  as $row) {

    $rt01 = $row['01'];
    $rt02 = $row['02'];
    $rt03 = $row['03'];
    $rt04 = $row['04'];
    $rt05 = $row['05'];



    if (is_null($rt01) && is_null($rt02) && is_null($rt03) && is_null($rt04) && is_null($rt05)) {
    } else {
        $t_all = $rt01 + $rt02 + $rt03 + $rt04 + $rt05;
        if ($t_all > 16) {
            $AllT01++;
            //$result_tall = '<a class="badge badge-danger">มีปัญหา</a>';
        } else if ($t_all > 13) {
            $AllT02++;
            //$result_tall = '<a class="badge badge-warning">เสี่ยง</a>';
        } else {
            $AllT03++;
            //$result_tall = '<a class="badge badge-success">ปกติ</a>';
        }
    }
}


foreach ($result_p  as $row) {

    $rp01 = $row['01'];
    $rp02 = $row['02'];
    $rp03 = $row['03'];
    $rp04 = $row['04'];
    $rp05 = $row['05'];



    if (is_null($rp01) && is_null($rp02) && is_null($rp03) && is_null($rp04) && is_null($rp05))
    {
        //
    }

    else {
        $p_all = $rp01 + $rp02 + $rp03 + $rp04 + $rp05;
        if ($t_all > 16) {
            $AllP01++;
        } else if ($t_all > 13) {
            $AllP02++;
        } else {
            $AllP03++;
        }
    }
}


/* $num = array(
  array("teacher",$AllT01,$AllT02,$AllT03),
  array("parent",$AllP01,$AllP02,$AllP03),
);

for ($i = 0; $i <= 1; $i++) {
    $data[$i]["result"] = $num[$i][0];    
    $data[$i]["problem"] = $num[$i][1]; 
    $data[$i]["risk"] = $num[$i][2];
    $data[$i]["normal"] = $num[$i][3];
} 
 */

$num = array( 
    array("normal",$AllT03,$AllP03),
    array("risk",$AllT02,$AllP02),
    array("problem",$AllT01,$AllP01),
    /* array("teacher",$AllT01,$AllT02,$AllT03),
    array("parent",$AllP01,$AllP02,$AllP03), */
);

for ($i = 0; $i < 3; $i++) {
    $data[$i]["result"] = $num[$i][0];    
    $data[$i]["teacher"] = $num[$i][1]; 
    $data[$i]["parent"] = $num[$i][2]; 
} 


echo json_encode($data);