<?php
include '../dbconfig.php';
date_default_timezone_set("Asia/Bangkok");

$data = array();
$grade = $_POST['grade'];
$section = $_POST['section'];
$term = $_POST['term'];
$session = $_POST['session'];
$date = $_POST['date'];
$student_id = $_POST['student_id'];

$sql_class = "SELECT class_id from class 
WHERE session_id = '$session'
AND term_id = '$term' AND grade_id = '$grade'
AND section_id = '$section'";

//echo $sql_class;
$rs_class = mysqli_query($conn, $sql_class);
$row = mysqli_fetch_array($rs_class);
$class_id = $row['class_id'];

$sql_time = "SELECT time_end from time_school ";
$rs_time = mysqli_query($conn, $sql_time);
$row = mysqli_fetch_array($rs_time);
$time = $row['time_end'];

$hour_day = date("H:i:s");

if($hour_day<$time){
    $status = "มาเรียน";
}else{
    $status = "สาย";
}

$sql_student = "SELECT class_id FROM student 
WHERE student_id = '$student_id'";
$rs_student = mysqli_query($conn, $sql_student);
$row = mysqli_fetch_array($rs_student);
$std_class = $row['class_id'];

if($class_id == $std_class)
{
//echo " Hour : ".$hour_day;
$sql = "UPDATE attendance SET time_in = '$hour_day',status='$status'
WHERE student_id='$student_id' AND date='$date' AND class_id ='$class_id'";
//echo " SQL : ".$sql;
$rs = mysqli_query($conn, $sql);
if ($rs) {
    $data['status'] = 200;
    //echo "Update Successful";
} else {
    //echo "Update Failed";
    $data['status'] = 404;
}

}else{
    $data['status'] = 505;
}


echo json_encode($data);
