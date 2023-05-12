<?php
include '../dbconfig.php';

$username = $_POST['username'];
$password = $_POST['password']; 

$sql = "SELECT *
FROM (
    SELECT username,email,password,'ผู้ปกครอง' as type FROM parent
  UNION ALL
  SELECT username,email,password,type FROM personnel
) userlogin WHERE username = '$username' OR email ='$username'";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);

$data = array();
if($count){

    $sql_password = "SELECT *
    FROM (
        SELECT parent_id as user_id, username,email,password,'ผู้ปกครอง' as type ,fname, lname FROM parent
      UNION ALL
      SELECT personnel_id as user_id, username,email,password,type,fname, lname  FROM personnel
    ) userlogin WHERE username = '$username' OR email ='$username'";
    $result_password = mysqli_query($conn, $sql_password);
    $row = mysqli_fetch_array($result_password);

    if(password_verify($password, $row['password'])){
        //echo "Login Successful";
        session_start();
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $username;
        $_SESSION['type'] = $row['type'];
        $_SESSION['name'] = $row['fname'].' '.$row['lname'];
        $_SESSION['login'] = true;
        $data['statusCode'] = 200;
        //$data['type'] = $row['type'];
        
    }else{
        $data['statusCode'] = 201;
        //echo "Login Failed";
    }
}else{
    $data['statusCode'] = 202;
    //echo "Not Found";

}

echo json_encode($data,JSON_UNESCAPED_UNICODE);