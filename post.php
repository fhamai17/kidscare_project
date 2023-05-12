<?php
session_start();
include 'dbconfig.php';

$topic = $_POST['topic'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date']; 
$teacher_id =$_SESSION['user_id'];
print_r($_POST);
$sql = "INSERT INTO homework (topic, description,start_date,end_date,teacher_id,create_time)
VALUES ('$topic','$description','$start_date','$end_date','$teacher_id',NOW())";
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Add Successful";
}else
{
echo "Add Failed";
}


  
require(__DIR__.'/vendor/autoload.php');

$token = 'nfTrclxvbINrm7DZyyPzjZNQuc2H35ggnoP7tbmYViY';
$ln = new KS\Line\LineNotify($token);

$header = "เเจ้งข้าวสารโรงเรียน";

    $text = $header;


    if($ln->send($text)){
        echo"<script>alert('ส่งข้อมูลเรียบร้อย'); window.location='LINE_Notify.php'</script>";
    }else{
        echo"<script>alert('ระบบผิดพลาด'); window.location='LINE_Notify.php'</script>";
    }
    
