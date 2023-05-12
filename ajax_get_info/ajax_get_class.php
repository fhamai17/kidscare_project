<?php
include '../dbconfig.php';
$session = $_POST['session'];
$term = ($_POST['term'] ? "AND term_id = '$_POST[term]'" : "");
$grade = ($_POST['grade'] ? "AND grade_id = '$_POST[grade]'" : "");
$section = ($_POST['section'] ? "AND section_id = '$_POST[section]'" : "");

$sql = "SELECT class_id FROM class 
WHERE session_id = '$session' $term $grade $section";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row){
   $data = array();
   $data['class_id'] = $row['class_id'];
   echo (json_encode($data));

}



?>