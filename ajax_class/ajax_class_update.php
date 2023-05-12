<?php
include '../dbconfig.php';
$id = $_POST['class_id'];
$class = $_POST['class_name'];
$term = $_POST['term'];
$grade = $_POST['grade'];
$section = $_POST['section'];
$session = $_POST['session'];
$teacher = $_POST['teacher'];
$token = $_POST['token'];
print_r($_POST);

$sql = "UPDATE class SET class_name='$class' ,grade_id = '$grade',
section_id = '$section',session_id='$session',term_id='$term',
teacher_id = '$teacher',token='$token'  WHERE class_id = $id";
echo $sql;
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}

?>


