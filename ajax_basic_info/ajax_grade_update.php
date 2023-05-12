<?php
include '../dbconfig.php';

$id = $_POST['id'];
$grade = $_POST['grade'];
$desc = $_POST['desc'];

print_r($_POST);
$sql = "UPDATE grade SET grade_name='$grade' ,description = '$desc' WHERE grade_id = $id";
echo $sql;
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}

?>


