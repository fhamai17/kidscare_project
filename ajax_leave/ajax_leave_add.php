<?php
include '../dbconfig.php';
session_start();
$data = array();

$student_id = $_POST['student_id'];
$leave_type = $_POST['leave_type'];
$start_date = $_POST['start_date'];
$end_date =  $_POST['end_date'];
$days = $_POST['days'];
$reason = $_POST['reason'];

$sql_class = "SELECT class_id FROM student WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $sql_class);
if ($result) {
    $row = mysqli_fetch_array($result);
    $class_id = $row['class_id'];

 $sql = "INSERT INTO student_leave (student_id, class_id,
 type, start_date, end_date, days, reason, parent_id, parent_create_time) 
 VALUES ('$student_id','$class_id','$leave_type','$start_date',
 '$end_date','$days','$reason','$_SESSION[user_id]',NOW());";
    $rs = mysqli_query($conn, $sql);
    if ($rs) {
        $data['status']=200;
        $data['last_id']= mysqli_insert_id($conn);      ;
    } else {
        $data['status']=404;
        $data['last_id']= 0;   
    }
}

echo json_encode($data);