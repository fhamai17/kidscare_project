<?php
include '../dbconfig.php';

$username = $_POST['user_name'];
$gender = $_POST['gender'];
$pname = $_POST['pname'];
$fname = $_POST['firstname'];

$lname = $_POST['lastname'];
$address = $_POST['address'];
$province = $_POST['province'];
$district = $_POST['district'];
$sub_district = $_POST['subdistrict'];
$zipcode = $_POST['zipcode'];
$email = $_POST['email'];
$phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
$line_id = $_POST['line'];

$career = $_POST['career'];
$salary = $_POST['salary'];
$item_student = $_POST['item_student'];
$item_parent = $_POST['item_parent'];

$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
$type = $_POST['userType'];

print_r($_POST);

if ($type === "ผู้ปกครอง") {

    $sql = "INSERT INTO parent (username, password, gender, pname, fname, lname, 
    address, sub_district, district, province, zipcode, career, salary, email, 
    phone, line_id )
    VALUES ('$username', '$hash', '$gender', '$pname', 
    '$fname', '$lname', '$address', '$sub_district', '$district', 
    '$province', '$zipcode', '$career', '$salary', '$email',
     '$phone', '$line_id')";

    $rs = mysqli_query($conn, $sql);
    if ($rs) {
        echo "Add Successful";
    } else {
        echo "Add Failed";
    }


    $last_id = mysqli_insert_id($conn);
    echo "LAST ID : ".$last_id ;
    if ($item_student) {

        for ($count = 0; $count < count($item_student); $count++) {


            $student_id = $_POST["item_student"][$count];
            $relation = $_POST["item_parent"][$count];
            $sql_re = "INSERT INTO parent_relation (parent_id,relation,student_id,request_time)
            VALUES('$last_id','$relation','$student_id',NOW())";

            $rs_re = mysqli_query($conn, $sql_re);
            if ($rs_re) {
                echo "Add Relation Successful";
            } else {
                echo "Add Relation Failed";
            }
        }
    }
} else {
    $sql = "INSERT INTO personnel (username, password, gender, pname, fname, lname, 
    address, sub_district, district, province, zipcode, email, 
    phone, line_id, type )
    VALUES ('$username', '$hash', '$gender', '$pname', 
    '$fname', '$lname', '$address', '$sub_district', '$district', 
    '$province', '$zipcode','$email',
     '$phone', '$line_id','$type' );";

    $rs = mysqli_query($conn, $sql);
    if ($rs) {
        echo "Add Successful";
    } else {
        echo "Add Failed";
    }
}
