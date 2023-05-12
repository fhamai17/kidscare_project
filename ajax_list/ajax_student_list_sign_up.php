<?php
session_start();
include '../dbconfig.php';
$sql = "SELECT * FROM student
ORDER BY student_id";
$result = mysqli_query($conn, $sql);
echo "<option value='' disabled selected>-โปรดเลือกนักเรียน-</option>";
foreach($result as $row){
echo "<option data-subtext=".$row['student_id']." value=".$row['student_id'].">".$row["pname"]." ".$row["fname"]." ".$row["lname"]."</option>";
}


?>