<?php
include '../dbconfig.php';

$id = $_POST['term_id'];

print_r($_POST);
$sql = "UPDATE term
SET isActive = 
    CASE term_id
        WHEN $id THEN 1 
        ELSE 0  
END";
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
}
