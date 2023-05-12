<?php
include '../dbconfig.php';

$id = $_POST['section_id'];
$grade = $_POST['grade'];
$sectionName = $_POST['sectionName'];

print_r($_POST);
$sql = "UPDATE section SET grade_id='$grade' ,section_name = '$sectionName' WHERE section_id = $id";
echo $sql;
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}

?>


