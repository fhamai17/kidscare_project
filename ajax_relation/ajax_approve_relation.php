<?php
include '../dbconfig.php';

$id = $_POST['id'];
$status = $_POST['num'];
$remark = $_POST['remark'];
print_r($_POST);
$sql = "UPDATE parent_relation SET isApprove='$status', remark ='$remark' WHERE id = $id";


$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}

?>


