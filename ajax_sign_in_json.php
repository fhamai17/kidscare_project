<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$hostName = "203.158.3.36";
$userName = "prj65_24";
$passWord = "653007";
$dbName = "prj65_24";
$conn = mysqli_connect($hostName, $userName, $passWord, $dbName);
mysqli_set_charset($conn, "utf8");
if (mysqli_connect_error()) {
    echo "Connect falied : " . mysqli_connect_error();
} else {
    echo "Connect Successfully.";
}


$username = $_POST['username'];;
$password = $_POST['password']; 

$sql = "SELECT * FROM grade";
$result = mysqli_query($conn, $sql) ;
if (!$result){
    die();
 }
$count = mysqli_num_rows($result);

$data = array();
if($count){
    $data['statusCode'] = 200;
   /*  $sql_password = "SELECT *
    FROM (
        SELECT parent_id as user_id, username,email,password,'ผู้ปกครอง' as type ,fname, lname FROM parent
    ) userlogin WHERE username = '$username' OR email ='$username'";
    $result_password = mysqli_query($conn, $sql_password);
    $row = mysqli_fetch_array($result_password);

    if(password_verify($password, $row['password'])){
        //echo "Login Successful";
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['type'] = $row['type'];
        $data['statusCode'] = 200;
        $data['type'] = $row['type'];
        
    }else{
        $data['statusCode'] = 201;
        //echo "Login Failed";
    } */
}else{
    $data['statusCode'] = 202;
    //echo "Not Found";

}

echo json_encode($data,JSON_UNESCAPED_UNICODE);