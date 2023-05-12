<?php
include '../dbconfig.php';
$student_id = $_POST["student_id"];
$sql = "SELECT a.* ,b.pname,b.fname,b.lname,d.grade_name
FROM sdq a
LEFT JOIN student b ON a.student_id = b.student_id 
LEFT JOIN class c ON a.class_id = c.class_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
WHERE a.student_id ='$student_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row){
   $data = array();
   $data['student_id'] = $row['student_id'];
   $data['pname'] = $row['pname'];
   $data['fname'] = $row['fname'];
   $data['lname'] = $row['lname'];
   $data['grade'] = $row['grade_name'];
   $data['sql'] = $sql;
   echo (json_encode($data));

}



?>