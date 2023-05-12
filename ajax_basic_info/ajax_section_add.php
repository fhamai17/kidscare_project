<?php
include '../dbconfig.php';

$sectionName = $_POST['sectionName'];
$gradeID = $_POST['grade'];

print_r($_POST);
$sql = "INSERT INTO section (section_name, grade_id)
VALUES ('$sectionName','$gradeID')";
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Add Successful";
}else
{
echo "Add Failed";
}

?>


