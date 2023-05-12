<?php
include '../dbconfig.php';

$id = $_POST['id'];
$status = $_POST['status'];

print_r($_POST);
$sql = "UPDATE attendance SET status='$status' WHERE id = $id";
echo $sql;
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}

?>


