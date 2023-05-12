<?php

include '../dbconfig.php';

$data = array();
$email = $_POST['email'];
$email_old = $_POST['email_old'];
if($email_old == $email){
    $data['valid'] = true;
}
else
{
$sql = "SELECT *
FROM (
    SELECT email FROM parent
  UNION ALL
  SELECT email FROM personnel
) alldata WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows>0){
    $data['valid'] = false;
}else{
    $data['valid'] = true;
}
}
echo json_encode($data);
