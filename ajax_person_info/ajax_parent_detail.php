<?php
include '../dbconfig.php';
$id = $_POST["id"];
$sql = "SELECT * FROM parent WHERE parent_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row){
   $data = array();
   $data['id'] = $row['parent_id'];
   $data['username'] = $row['username'];
   $data['pname'] = $row['pname'];
   $data['fname'] = $row['fname'];
   $data['lname'] = $row['lname'];
   $data['address'] = $row['address'];
   $data['province'] = $row['province'];
   $data['district'] = $row['district'];
   $data['subdistrict'] = $row['sub_district'];
   $data['zipcode'] = $row['zipcode'];
   $data['career'] = $row['career'];
   $data['salary'] = $row['salary'];
   $data['pic'] = $row['pic'];
   $data['phone'] = $row['phone'];
   $data['email'] = $row['email'];
   $data['line'] = $row['line_id'];
   echo (json_encode($data));
}



?>