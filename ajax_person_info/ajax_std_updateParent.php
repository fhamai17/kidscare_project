<?php
include '../dbconfig.php';

$student_id = $_POST['student_id'];

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


$sql = "UPDATE student
            SET fa_pname= '$fa_pname', 
            fa_fname= '$fa_fname', fa_lname= '$fa_lname',
            fa_address = '$fa_address', fa_subdistrict= '$fa_subdistrict', fa_district= '$fa_district', 
            fa_province= '$fa_province', fa_zipcode= '$fa_zipcode', fa_career= '$fa_career', 
            fa_salary = '$fa_salary',fa_email='$fa_email',fa_phone='$fa_phone',
            mo_pname= '$mo_pname', mo_fname= '$mo_fname', mo_lname= '$mo_lname',
            mo_address= '$mo_address', mo_subdistrict= '$mo_subdistrict', mo_district= '$mo_district', 
            mo_province= '$mo_province', mo_zipcode= '$mo_zipcode', mo_career= '$mo_career', 
            mo_salary = '$mo_salary',mo_email='$mo_email',mo_phone='$mo_phone'
            WHERE student_id = '$student_id';";
echo $sql;
$rs = mysqli_query($conn, $sql);
if ($rs) {
    echo "Update Successful";
} else {
    echo "Update Failed";
}
?>