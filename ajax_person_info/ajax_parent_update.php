<?php
include '../dbconfig.php';

$id = $_POST['parent_id'];
$username = $_POST['username'];
$pname = $_POST['pname'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$address = $_POST['address'];
$province = $_POST['province'];
$district = $_POST['district'];
$subdistrict = $_POST['subdistrict'];
$zipcode = $_POST['zipcode'];
$career = $_POST['career'];
$salary = $_POST['salary'];
$phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
$email = $_POST['email'];
$line = $_POST['line'];
print_r($_POST);
$target = '../uploads/parent_pics/';
$file_name = $_FILES["file"]["name"];
$file_tmp = $_FILES["file"]["tmp_name"];
$ext = pathinfo($file_name, PATHINFO_EXTENSION);
print_r($_FILES);
echo "Extention : " . $ext;
$new_file_name = null;

if ($_FILES['file']['error'] > 0) {
    echo "Error:" . $_FILES['file']['error'] . "<br/>";
    $sql_pic = ""; 
} 
else {
    $new_file_name =  "parentID_" . $id . "." . $ext;

    $sql_pic = ", pic = '$new_file_name'";
    if (!file_exists($target . $file_name)) {
        move_uploaded_file($file_tmp, $target . $new_file_name);
        echo "File Name: " . $new_file_name;
    } else {
        unlink($new_file_name);
        move_uploaded_file($file_tmp, $target . $new_file_name);
    }
}

$sql = "UPDATE parent
            SET username= '$username',pname= '$pname', 
            fname= '$fname', lname= '$lname', 
            address= '$address', sub_district= '$subdistrict', district= '$district', 
            province= '$province', zipcode= '$zipcode', career= '$career', 
            salary= '$salary', email= '$email', phone= '$phone', line_id='$line' $sql_pic 
            WHERE parent_id = $id;";
$rs = mysqli_query($conn, $sql);
if ($rs) {
    echo "Update Successful";
} else {
    echo "Update Failed";
}
