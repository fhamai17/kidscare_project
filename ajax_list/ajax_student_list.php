<?php
session_start();
include '../dbconfig.php';
$array_exit = array();
if(isset($_SESSION)){
$sql_re = "SELECT a.student_id FROM parent_relation a
LEFT JOIN student as b 
ON a.student_id =b.student_id
WHERE a.parent_id = '$_SESSION[user_id]' AND (a.isApprove = '1' OR a.isApprove is NULL)
ORDER BY a.student_id";
$result_re = mysqli_query($conn, $sql_re);
echo $sql_re;
foreach($result_re as $row2){
    array_push($array_exit,$row2['student_id']);
} 

}

$sql = "SELECT * FROM student
ORDER BY student_id";
$result = mysqli_query($conn, $sql);
echo "<option value='' disabled>-โปรดเลือกนักเรียน-</option>";
foreach($result as $row){
echo '<option data-subtext='.$row['student_id'].' value="'.$row['student_id'].'" '.(( in_array($row['student_id'],$array_exit))?'disabled':"").'>'.$row["pname"]." ".$row["fname"]." ".$row["lname"].'</option>';
    //echo "<option data-subtext=".$row['student_id']." value=".$row['student_id'].">".$row["pname"]." ".$row["fname"]." ".$row["lname"]."</option>";
}




?>