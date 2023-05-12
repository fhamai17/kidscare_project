<?php
include '../dbconfig.php';

$id = $_POST['id'];
$status = $_POST['num'];
$type = $_POST['type'];
print_r($_POST);
if($type==="ผู้ปกครอง"){
$sql = "UPDATE parent SET status='$status' WHERE parent_id = $id";
}
else{
    $sql = "UPDATE teacher SET status='$status' WHERE teacher_id = $id";

}

$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}




?>


