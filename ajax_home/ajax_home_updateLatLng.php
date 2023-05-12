<?php
include '../dbconfig.php';

$id = $_POST['home_id'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];

print_r($_POST);
$sql = "UPDATE home SET lat='$lat',lng='$lng' WHERE home_id = $id";
echo $sql;
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}

?>
