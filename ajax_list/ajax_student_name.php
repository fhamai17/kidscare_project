<?php
include '../dbconfig.php';
$student_id = $_POST['student_id'];
$sql = "SELECT *
FROM student 
WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row){
    $fullname = $row["student_id"]. ' ' .$row["pname"]. ' ' . $row["fname"] . ' ' . $row["lname"];
   $data = array();
   $data['student_name'] = $fullname;
   echo (json_encode($data));
}


?>