<?php
include '../dbconfig.php';

$id = $_POST['id'];
$session = $_POST['session'];

print_r($_POST);
$sql = "UPDATE session SET session_name='$session' 
WHERE session_id = $id";
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}

?>


