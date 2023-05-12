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
$phone = preg_replace('/[^0-9]/', '', $_POST['phone']);
$email = $_POST['email'];
$line = $_POST['line'];
$type = $_POST['type'];
//print_r($_POST); 

$target = '../uploads/personnel_pics/';
$file_name = $_FILES["file"]["name"];
$file_tmp = $_FILES["file"]["tmp_name"];
$ext = pathinfo($file_name, PATHINFO_EXTENSION);

//echo "Extention : ".$ext;
$new_file_name = null;

$sql ="INSERT INTO personnel (username,pname, fname, lname, address, sub_district, district, province, zipcode, email, phone, line_id,type)
VALUES ('$username','$pname', '$fname', '$lname', '$address','$subdistrict','$district','$province',  '$zipcode', '$email', '$phone', '$line','$type');";
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
            $new_file_name =  "personnelID_" . $last_id .".". $ext;

            if (!file_exists($target . $file_name)) {
                move_uploaded_file($file_tmp, $target . $new_file_name);
                //echo "File Name: " . $new_file_name;
            } 
            else{
                unlink($new_file_name); 
                move_uploaded_file($file_tmp, $target . $new_file_name);
            }

            $sql ="UPDATE personnel
            SET pic = '$new_file_name'
            WHERE personnel_id = $last_id;";
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

