<?php
include '../dbconfig.php';
$id = $_POST["student_id"];
$sql = "SELECT a.pname, a.fname, a.lname, b.grade_name 
FROM student as a 
LEFT JOIN grade as b 
ON a.grade_id =b.grade_id 
WHERE student_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row){
   $data = array();
   $data['fullname'] = $row['pname'].' '.$row['fname'].' '.$row['lname'];
   $data['grade'] = $row['grade_name'];
   echo (json_encode($data));
}



?>