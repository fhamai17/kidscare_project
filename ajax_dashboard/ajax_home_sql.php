<?php
include '../dbconfig.php';
$session = ($_POST['session'] ? "WHERE c.session_id = '$_POST[session]'" : "");
$term = ($_POST['term'] ? "AND c.term_id = '$_POST[term]'" : "");
$grade = ($_POST['grade'] ? "AND c.grade_id = '$_POST[grade]'" : "");
$section = ($_POST['section'] ? "AND c.section_id = '$_POST[section]'" : "");

$sql = " SELECT sum(if(a.isDone=1,1,0)) as done , 
sum(if(a.isDone != 1 , 1 ,0)) as not_done
FROM home  a
LEFT JOIN class c ON a.class_id = c.class_id 
$session $term $grade $section";
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


$data['0']["x"] = $row['done'];
$data['0']["y"] = $row['done'];
$data['1']["x"] = $row['not_done'];
$data['1']["y"] = $row['not_done'];

echo json_encode($data);

?>
