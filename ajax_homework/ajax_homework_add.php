<?php
session_start();
include '../dbconfig.php';
$class_id = $_POST['class_id'];
$topic = $_POST['topic'];
$description = $_POST['description'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$teacher_id = $_SESSION['user_id'];
$teacher_name = $_SESSION['name'];
print_r($_POST);
$sql = "INSERT INTO homework (topic, description,start_date,end_date,class_id,teacher_id,create_time)
VALUES ('$topic','$description','$start_date','$end_date','$class_id','$teacher_id',NOW())";
$rs = mysqli_query($conn, $sql);
if ($rs) {
    echo "Add Successful";
    

    if (isset($_POST['lineNotify'])) {
    require('../vendor_line/autoload.php');

    $sql_class = "SELECT token from class WHERE class_id = '$class_id'";
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
} else {
    echo "Add Failed";
}



