<?php
include '../dbconfig.php';
$id = $_POST["id"];
$sql = "SELECT * FROM personnel WHERE personnel_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row){
   $data = array();
   $data['id'] = $row['personnel_id'];
   $data['username'] = $row['username'];
   $data['pname'] = $row['pname'];
   $data['fname'] = $row['fname'];
   $data['lname'] = $row['lname'];
   $data['address'] = $row['address'];
   $data['province'] = $row['province'];
   $data['district'] = $row['district'];
   $data['subdistrict'] = $row['sub_district'];
   $data['zipcode'] = $row['zipcode'];
   $data['type'] = $row['type'];
   $data['pic'] = $row['pic'];
   $data['phone'] = $row['phone'];
   $data['email'] = $row['email'];
   $data['line'] = $row['line_id'];
   echo (json_encode($data));
}



?>