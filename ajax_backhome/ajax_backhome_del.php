<?php
include '../dbconfig.php';

$id = $_POST['id'];

print_r($_POST);
$sql = "DELETE FROM backhome WHERE id = $id";
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Del Successful";
}else
{
echo "Del Failed";
}

?>


