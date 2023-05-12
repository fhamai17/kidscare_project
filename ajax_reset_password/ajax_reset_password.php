<?php 
// include("../config.php");
include '../dbconfig.php';

print_r($_POST);
if(!isset($_POST["code"])){
    exit("Can't find page1.");
}

$code = $_POST["code"];
$type = $_POST["type"];
$getEmailQuery = mysqli_query($conn, "SELECT email FROM reset_password WHERE code='$code'");
if(mysqli_num_rows($getEmailQuery) == 0){
    exit("Can't find page2.");
}

if(isset($_POST["password"])){
    $pw = $_POST["password"];
    $hash = password_hash($pw, PASSWORD_DEFAULT);

    $row = mysqli_fetch_array($getEmailQuery);
    $email = $row["email"];

    $query = mysqli_query($conn, "UPDATE $type SET 	
    password='$hash' WHERE email='$email'");

    if($query){
        $query = mysqli_query($conn, "DELETE FROM reset_password  WHERE code='$code'");
        // exit("รหัสผ่านถูกเปลี่ยนเเล้ว!");
        echo 'Update password Successful';
    }
    else{
        // exit("มีบางอย่างผิดพลาด ไม่สามารถเปลี่ยนรหัสผ่านได้!");
        echo 'Update password Error';
    }
}

?>