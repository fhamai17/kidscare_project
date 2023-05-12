<?php
include '../dbconfig.php';

$id = $_POST['school_id'];
$name = $_POST['school_name'];
print_r($_POST);
$target = '../uploads/school_pics/';
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
    $new_file_name =  "schoolID_" . $id . "." . $ext;

    $sql_pic = ", pic = '$new_file_name'";
    if (!file_exists($target . $file_name)) {
        move_uploaded_file($file_tmp, $target . $new_file_name);
        echo "File Name: " . $new_file_name;
    } else {
        unlink($new_file_name);
        move_uploaded_file($file_tmp, $target . $new_file_name);
    }
}

$sql = "UPDATE school
            SET name = '$name' $sql_pic 
            WHERE school_id = $id;";
$rs = mysqli_query($conn, $sql);
if ($rs) {
    echo "Update Successful";
} else {
    echo "Update Failed";
}
