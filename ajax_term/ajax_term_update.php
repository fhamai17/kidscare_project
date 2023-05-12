<?php
include '../dbconfig.php';

$id = $_POST['term_id'];
$session = $_POST['session'];
$term = $_POST['term'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

print_r($_POST);
$sql = "UPDATE term SET term_name='$term' ,session_id = '$session',
start_date='$start_date' ,end_date = '$end_date'
WHERE term_id = $id";
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}

?>


