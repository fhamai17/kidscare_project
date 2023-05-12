<?php
session_start();
include '../dbconfig.php';

$sql = "SELECT a.*,b.session_name,c.term_name,d.grade_name,e.section_name FROM class a
LEFT JOIN session b ON a.session_id = b.session_id 
LEFT JOIN term c ON a.term_id = c.term_id 
LEFT JOIN grade d ON a.grade_id = d.grade_id 
LEFT JOIN section e ON a.section_id = e.section_id 
WHERE a.teacher_id = '$_SESSION[user_id]'";

$result = mysqli_query($conn, $sql);

echo "<option value='' disabled>-โปรดเลือกห้องเรียน-</option>";
foreach($result as $row){
    $fullname = $row["grade_name"]." ห้อง ".$row["section_name"]." ปีการศึกษา ".$row["session_name"]." เทอม ".$row["term_name"];
    echo "<option value='".$row['class_id']."'>".$fullname."</option>";
}


?>

 