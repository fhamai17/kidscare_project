<?php
session_start();
include '../dbconfig.php';
$topic = $_POST['topic'];
$description = $_POST['description'];
$term_id = $_POST['term_id'];
$teacher_id = $_SESSION['user_id'];
$teacher_name = $_SESSION['name'];
$today = date("Y/m/d");
print_r($_FILES);
print_r($_POST);
require('../vendor_line/autoload.php');

if (($_POST['lineNotify']) == 1) {

    $sql_class = "SELECT token from class 
    WHERE term_id = '$term_id' AND token IS NOT NULL";
} else {

    $sql_class = "SELECT token from class 
    WHERE term_id = '$term_id' AND token IS NOT NULL AND teacher_id = '$teacher_id'";
}

$rs_class = mysqli_query($conn, $sql_class);
echo $sql_class . " ";

foreach ($rs_class as $row) {

    echo " TOKEN : ".$row['token'];
    $token = $row['token'];
    $ln = new KS\Line\LineNotify($token);
    $header = "\nแจ้งข่าวสาร";
    $text = $header .
        "\n\n" . "หัวข้อ : " . $topic .
        "\n" . "รายละเอียด : " . $description .
        "\n" . "วันเวลาที่แจ้ง : " . $today .
        "\n" . "คุณครู : " . $teacher_name;

    $image_path = $_FILES['file']['tmp_name'];
    if ($ln->send($text, $image_path)) {
        echo "Notify Successful";
    } else {
        echo "Notify Failed";
    }
}
