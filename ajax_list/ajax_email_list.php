<?php

include '../dbconfig.php';
$email = $_POST['email'];
$sql = "SELECT *
FROM (
    SELECT email FROM parent
  UNION ALL
  SELECT email FROM teacher
) alldata WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows){
    $result = 404;
}else{
    $result = 200;
}
echo $result;
?>

