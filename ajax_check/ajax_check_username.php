<?php

include '../dbconfig.php';
$data = array();
$username = $_POST['username'];
$username_old = $_POST['username_old'];
if($username_old == $username){
    $data['valid'] = true;
}
else
{
$sql = "SELECT *
FROM (
    SELECT username FROM parent
  UNION ALL
  SELECT username FROM personnel
) alldata WHERE username='$username'";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows>0){
    $data['valid'] = false;
}else{
    $data['valid'] = true;
} 

}


/* $sql = "SELECT *
FROM (
    SELECT username FROM parent
  UNION ALL
  SELECT username FROM teacher
) alldata WHERE username='$username'";

$result = mysqli_query($conn, $sql);
$num_rows = mysqli_num_rows($result);
if($num_rows>0){
    $data['valid'] = true;
}else{
    $data['valid'] = true;
} */
echo json_encode($data);

?>