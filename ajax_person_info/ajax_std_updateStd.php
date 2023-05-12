<?php
include '../dbconfig.php';

$student_id = $_POST['student_id'];
$idcard = ($_POST['idcard']?preg_replace('/[^0-9]/', '', $_POST['idcard']):NULL);
$student_id = ($_POST['student_id']?$_POST['student_id']:NULL);
$pname = ($_POST['pname']?$_POST['pname']:NULL);
$fname = ($_POST['fname']?$_POST['fname']:NULL);
$lname = ($_POST['lname']?$_POST['lname']:NULL);
$gender = ($_POST['gender']?$_POST['gender']:NULL);
$nickname = ($_POST['nickname']?$_POST['nickname']:NULL);
$birthdate = ($_POST['birthdate']?$_POST['birthdate']:NULL);
$age = ($_POST['age']?$_POST['age']:NULL);
$blood_group = ($_POST['blood_group']?$_POST['blood_group']:NULL);
$religion = ($_POST['religion']?$_POST['religion']:NULL);
$national = ($_POST['national']?$_POST['national']:NULL);
$ethnicity = ($_POST['ethnicity']?$_POST['ethnicity']:NULL);
$grade_id = ($_POST['std_grade']?$_POST['std_grade']:NULL);
$status = ($_POST['std_status']?$_POST['std_status']:NULL);
$address = ($_POST['std_address']?$_POST['std_address']:NULL);
$province = ($_POST['std_province']?$_POST['std_province']:NULL);
$district = ($_POST['std_district']?$_POST['std_district']:NULL);
$sub_district = ($_POST['std_subdistrict']?$_POST['std_subdistrict']:NULL);
$zipcode = ($_POST['std_zipcode']?$_POST['std_zipcode']:NULL);
$target = '../uploads/student_pics/';
$file_name = $_FILES["file"]["name"];
$file_tmp = $_FILES["file"]["tmp_name"];
$ext = pathinfo($file_name, PATHINFO_EXTENSION);
print_r($_POST);
print_r($_FILES);
echo "Extention : " . $ext;
$new_file_name = null;

echo "ID CARD " .  $idcard;





if ($_FILES['file']['error'] > 0) {
    echo "Error:" . $_FILES['file']['error'] . "<br/>";
    $sql_pic = ""; 
} 
else {
    $new_file_name =  "studentID_" . $student_id . "." . $ext;

    $sql_pic = ", pic = '$new_file_name'";
    if (!file_exists($target . $file_name)) {
        move_uploaded_file($file_tmp, $target . $new_file_name);
        echo "File Name: " . $new_file_name;
    } else {
        unlink($new_file_name);
        move_uploaded_file($file_tmp, $target . $new_file_name);
    }
}

$sql = "UPDATE student
            SET card_id= '$idcard',pname= '$pname', 
            fname= '$fname', lname= '$lname',nickname='$nickname',gender='$gender',
            birthdate = '$birthdate',age='$age', blood_group = '$blood_group',religion = '$religion',
            national = '$national',ethnicity = '$ethnicity',
            address= '$address', sub_district= '$sub_district', district= '$district', 
            province= '$province', zipcode= '$zipcode', grade_id= '$grade_id', 
            status = '$status' $sql_pic
            WHERE student_id = '$student_id';";
$rs = mysqli_query($conn, $sql);
if ($rs) {
    echo "Update Successful";
} else {
    echo "Update Failed";
}
?>