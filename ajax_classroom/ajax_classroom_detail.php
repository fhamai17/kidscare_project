<?php
include '../dbconfig.php';
$id = $_POST["id"];
$sql = "SELECT a.*,b.grade_name,c.section_name ,d.session_name,e.term_name
FROM class a 
LEFT JOIN grade b ON a.grade_id = b.grade_id 
LEFT JOIN section c ON a.section_id = c.section_id
LEFT JOIN session d ON a.session_id = d.session_id 
LEFT JOIN term e ON a.term_id = e.term_id 
WHERE a.class_id='$id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row){
   $data = array();
   $data['class_name'] = $row['class_name'];
   $data['grade'] = $row['grade_name'];
   $data['section'] = $row['section_name'];
   $data['session_id'] = $row['session_id'];
   $data['session_name'] = $row['session_name'];
   $data['term_id'] = $row['term_id'];
   $data['term_name'] = $row['term_name'];

   echo (json_encode($data));
}


?>