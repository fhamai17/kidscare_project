<?php
include '../dbconfig.php';

$grade = $_POST['grade'];
$desc = $_POST['desc'];

print_r($_POST);
$sql = "INSERT INTO grade (grade_name, description)
VALUES ('$grade','$desc')";
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Add Successful";
}else
{
echo "Add Failed";
}

?>


