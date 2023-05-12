<?php
include '../dbconfig.php';

$data = array();

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
//print_r($_POST); 

$target = '../uploads/parent_pics/';
$file_name = $_FILES["file"]["name"];
$file_tmp = $_FILES["file"]["tmp_name"];
$ext = pathinfo($file_name, PATHINFO_EXTENSION);

//echo "Extention : ".$ext;
$new_file_name = null;

$sql ="INSERT INTO parent (username,pname, fname, lname, address, sub_district, district, province, zipcode, career, salary, email, phone, line_id)
VALUES ('$username','$pname', '$fname', '$lname', '$address','$subdistrict','$district','$province',  '$zipcode', '$career', '$salary', '$email', '$phone', '$line');";
$rs = mysqli_query($conn, $sql);

if ($rs) {
    //echo "Add Successful";
    $last_id = mysqli_insert_id($conn);
    $data['status'] = 200;
    $data['lastid'] = $last_id;
    //echo "New record created successfully. Last inserted ID is: " . $last_id;


    if ($_FILES['file']['error'] > 0) {
        //echo "Error:" . $_FILES['file']['error'] . "<br/>";
        $data['pic_status'] = 404;
    } 
    else {

    if(!empty($_FILES)){
            $new_file_name =  "parentID_" . $last_id .".". $ext;

            if (!file_exists($target . $file_name)) {
                move_uploaded_file($file_tmp, $target . $new_file_name);
                //echo "File Name: " . $new_file_name;
            } 
            else{
                unlink($new_file_name); 
                move_uploaded_file($file_tmp, $target . $new_file_name);
            }

            $sql ="UPDATE parent
            SET pic = '$new_file_name'
            WHERE parent_id = $last_id;";
            $rs = mysqli_query($conn, $sql);
            if ($rs) {
                $data['status'] = 200;
                //echo "Add Image Successful";
            }
            else{
                $data['status'] = 404;
                $data['status_txt'] = 'อัปเดตรูปภาพไม่สำเร็จ';
                //echo "Add Image Failed";
            }

    }

    }

} else {
    $data['status'] = 404;
    $data['status_txt'] = 'เกิดข้อผิดพลาด\nโปรดลองอีกครั้ง';
    //echo "Add Failed";
}  


echo json_encode($data);


/* 
if ($_FILES['file']['error'] > 0) {
    echo "Error:" . $_FILES['file']['error'] . "<br/>";
} else {
if(!empty($_FILES)){
    
        if (!file_exists($target . $file_name)) {
            $new_file_name =  "parentID_" . $student_id .".". $ext;
            move_uploaded_file($file_tmp, $target . $new_file_name);
        } else {
            $new_file_name =  "parentID_" . $student_id . time() .".".$ext;
            move_uploaded_file($file_tmp, $target . $new_file_name);
        }
}
}

$sql = "INSERT INTO student (student_id, pname, fname, lname, nickname, card_id, gender, birthdate, age, religion, national, ethnicity, blood_group, pic,status,grade_id)
VALUES ('$student_id', '$pname', '$fname', '$lname', '$nickname', '$idcard', '$gender', '$birthdate',  '$age','$religion', '$nationality', '$ethnicity', '$blood_group', '$new_file_name','Active',$grade);";
$rs = mysqli_multi_query($conn, $sql);

if ($rs) {
    echo "Add Successful";
} else {
    echo "Add Failed";
} 
 */