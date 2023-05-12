<?php
include '../dbconfig.php';
$sql = "SELECT student_id FROM student ORDER BY student_id desc";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row){
   $lastid = $row['student_id']; 
}

$data = array();
if (empty($lastid)) {
    $number = "S00001";
    $data['studentID'] = $number;
} else {
    $new_id = str_replace("S", "", $lastid);
    $number = str_pad((int)$new_id + 1, 5, 0, STR_PAD_LEFT);
    $data['studentID'] = "S".$number;
}

echo json_encode($data);

?>