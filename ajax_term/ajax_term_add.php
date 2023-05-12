<?php
include '../dbconfig.php';

$session = $_POST['session'];
$term = $_POST['term'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

print_r($_POST);
$sql = "INSERT INTO term (term_name, start_date,end_date,session_id)
VALUES ('$term','$start_date','$end_date','$session')";
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Add Successful";
}else
{
echo "Add Failed";
}

?>


