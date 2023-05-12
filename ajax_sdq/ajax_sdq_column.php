<?php
include '../dbconfig.php';
$sdq_id = $_POST["sdq_id"];
$sql = "SELECT * FROM sdq 
WHERE sdq_id ='$sdq_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row){
   $data = array();
   $data['student_id'] = $row['student_id'];
   $data['isDone'] = $row['isDone'];
   echo (json_encode($data));
}



?>