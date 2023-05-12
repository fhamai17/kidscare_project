<?php
include '../dbconfig.php';
session_start();
//print_r($_POST);
$data = array();
$class_id = $_POST['class_id'];
$sql_class = "SELECT student_id FROM class_student WHERE class_id = '$class_id'";
$result = mysqli_query($conn, $sql_class);
if ($result) {
    foreach ($result as $row) {

        $sql_check = "SELECT * FROM home WHERE student_id = '$row[student_id]' AND class_id = '$class_id'";
        $rs_check = mysqli_query($conn, $sql_check);
        $num = mysqli_num_rows($rs_check);

        if ($num > 0) {

            $data['status']= 404;
            $data['text']= 'มีข้อมูลนักเรียนอยู่ในฐานข้อมูลแล้ว';
        } else {
            $sql = "INSERT INTO home (student_id, class_id,isDone) 
 VALUES ('$row[student_id]','$class_id',0);";
            $rs = mysqli_query($conn, $sql);
            if ($rs) {
                $data['status']= 200;
            } else {
                $data['text']= 'กรุณาลองใหม่อีกครั้ง';
            }
        }
    }
}
else {
    $data['text']= 'ไม่พบห้องเรียน';
}

echo json_encode($data);
