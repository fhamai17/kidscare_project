<?php 
// include("../config.php");
session_start();
include '../dbconfig.php';
$user_id = $_SESSION['user_id'];
if($_SESSION['type']==="ผู้ปกครอง"){
    $type ="parent";

    $pk = "parent_id";
}else{
    $type ="personnel";
    $pk = "personnel_id";
}

if(isset($_POST["password"])){
    $pw = $_POST["password"];
    $hash = password_hash($pw, PASSWORD_DEFAULT);

    $query = mysqli_query($conn, "UPDATE $type SET 	
    password='$hash' WHERE $pk ='$user_id'");

    if($query){
        // exit("รหัสผ่านถูกเปลี่ยนเเล้ว!");
        echo 'Update password Successful';
    }
    else{
        // exit("มีบางอย่างผิดพลาด ไม่สามารถเปลี่ยนรหัสผ่านได้!");
        echo 'Update password Error';
    }
}

?>