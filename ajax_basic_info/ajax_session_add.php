<?php
include '../dbconfig.php';

$session = $_POST['session'];

print_r($_POST);
$sql = "INSERT INTO session (session_name)
VALUES ('$session')";
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Add Successful";
}else
{
echo "Add Failed";
}

?>


