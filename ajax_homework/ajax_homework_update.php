<?php
session_start();
include '../dbconfig.php';
$id = $_POST['homework_id'];
$topic = $_POST['topic'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date']; 
$teacher_id =$_SESSION['user_id'];
$teacher_name = $_SESSION['name'];
print_r($_POST);

$sql = "UPDATE homework SET topic = '$topic', description = '$description',
start_date='$start_date',end_date='$end_date',teacher_id='$teacher_id',create_time=NOW()
WHERE homework_id ='$id'";
$rs = mysqli_query($conn, $sql);

if($rs){
echo "Update Successful";
if (isset($_POST['lineNotify'])) {
    require('../vendor_line/autoload.php');

    $sql_class = "SELECT token from class WHERE class_id = 22";
    $rs_class = mysqli_query($conn, $sql_class);
    $row = mysqli_fetch_array($rs_class);
    $token = $row['token'];
    $ln = new KS\Line\LineNotify($token);

    $header = "\nแจ้งการบ้าน";

    if($description){
        $remark = "\n". "รายละเอียด : " .$description ;
    }else{
        $remark ="";
    }
    $text = $header.
    "\n\n". "หัวข้อ : " .$topic
    .$remark.
    "\n". "วันที่สั่ง : " .$start_date.
    "\n". "วันที่ส่ง : " .$end_date.
    "\n". "คุณครู : " .$teacher_name ;


    if ($ln->send($text)) {
        echo "<script>alert('ส่งข้อมูลเรียบร้อย'); window.location='teacher_homework.php'</script>";
    } else {
        echo "<script>alert('ระบบผิดพลาด'); window.location='teacher_homework.php'</script>";
    }
}
}else
{
echo "Update Failed";
}

?>


