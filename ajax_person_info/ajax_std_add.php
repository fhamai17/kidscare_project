<?php
include '../dbconfig.php';

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


$fa_pname = ($_POST['fa_pname']?$_POST['fa_pname']:NULL);
$fa_fname = ($_POST['fa_fname']?$_POST['fa_fname']:NULL);
$fa_lname = ($_POST['fa_lname']?$_POST['fa_lname']:NULL);
$fa_address = ($_POST['fa_address']?$_POST['fa_address']:NULL);
$fa_province = ($_POST['fa_province']?$_POST['fa_province']:NULL);
$fa_district = ($_POST['fa_district']?$_POST['fa_district']:NULL);
$fa_subdistrict = ($_POST['fa_subdistrict']?$_POST['fa_subdistrict']:NULL);
$fa_zipcode = ($_POST['fa_zipcode']?$_POST['fa_zipcode']:NULL);
$fa_career = ($_POST['fa_career']?$_POST['fa_career']:NULL);
$fa_salary = ($_POST['fa_salary']?$_POST['fa_salary']:NULL);
$fa_email = ($_POST['fa_email']?$_POST['fa_email']:NULL);
$fa_phone = ($_POST['fa_phone']?$_POST['fa_phone']:NULL);


$mo_pname = ($_POST['mo_pname']?$_POST['mo_pname']:NULL);
$mo_fname = ($_POST['mo_fname']?$_POST['mo_fname']:NULL);
$mo_lname = ($_POST['mo_lname']?$_POST['mo_lname']:NULL);
$mo_address = ($_POST['mo_address']?$_POST['mo_address']:NULL);
$mo_province = ($_POST['mo_province']?$_POST['mo_province']:NULL);
$mo_district = ($_POST['mo_district']?$_POST['mo_district']:NULL);
$mo_subdistrict = ($_POST['mo_subdistrict']?$_POST['mo_subdistrict']:NULL);
$mo_zipcode = ($_POST['mo_zipcode']?$_POST['mo_zipcode']:NULL);
$mo_career = ($_POST['mo_career']?$_POST['mo_career']:NULL);
$mo_salary = ($_POST['mo_salary']?$_POST['mo_salary']:NULL);
$mo_email = ($_POST['mo_email']?$_POST['mo_email']:NULL);
$mo_phone = ($_POST['mo_phone']?$_POST['mo_phone']:NULL);

print_r($_POST); 
echo "PNAME : ".$pname;
$target = '../uploads/student_pics/';
$file_name = $_FILES["file"]["name"];
$file_tmp = $_FILES["file"]["tmp_name"];
$ext = pathinfo($file_name, PATHINFO_EXTENSION);

echo "Extention : ".$ext;
$new_file_name = null;
if ($_FILES['file']['error'] > 0) {
    echo "Error:" . $_FILES['file']['error'] . "<br/>";
} else {
if(!empty($_FILES)){
    
        if (!file_exists($target . $file_name)) {
            $new_file_name =  "studentID_" . $student_id .".". $ext;
            move_uploaded_file($file_tmp, $target . $new_file_name);
        } else {
            $new_file_name =  "studentID_" . $student_id . time() .".".$ext;
            move_uploaded_file($file_tmp, $target . $new_file_name);
        }
}
}

$sql = "INSERT INTO student (student_id, pname, fname, lname, nickname, card_id, gender, birthdate, age, religion, national, ethnicity, blood_group, pic,status,grade_id,
address,province,district,sub_district,zipcode,fa_pname, fa_fname, fa_lname,fa_address,fa_province,fa_district,fa_subdistrict,fa_zipcode,fa_career,fa_salary,fa_email,fa_phone,
mo_pname, mo_fname, mo_lname,mo_address,mo_province,mo_district,mo_subdistrict,mo_zipcode,mo_career,mo_salary,mo_email,mo_phone)
VALUES ('$student_id', '$pname', '$fname', '$lname', '$nickname', '$idcard', '$gender', '$birthdate',  '$age','$religion', '$national', '$ethnicity', 
'$blood_group', '$new_file_name','$status','$grade_id',
'$address','$province','$district','$sub_district','$zipcode',
'$fa_pname', '$fa_fname', '$fa_lname','$fa_address','$fa_province','$fa_district','$fa_subdistrict','$fa_zipcode','$fa_career','$fa_salary','$fa_email','$fa_phone',
'$mo_pname', '$mo_fname', '$mo_lname','$mo_address','$mo_province','$mo_district','$mo_subdistrict','$mo_zipcode','$mo_career','$mo_salary','$mo_email','$mo_phone');";
echo $sql;
$rs = mysqli_multi_query($conn, $sql);

if ($rs) {
    echo "Add Successful";
} else {
    echo "Add Failed";
} 

?>
