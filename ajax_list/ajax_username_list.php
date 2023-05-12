<?php

include '../dbconfig.php';
$username = $_POST['username'];
$sql = "SELECT *
FROM (
    SELECT username FROM parent
  UNION ALL
  SELECT username FROM teacher
) alldata WHERE username='$username'";
$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows){
    $result = 404;
}else{
    $result = 200;
}
echo $result;
?>

