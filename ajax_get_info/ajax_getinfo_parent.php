<?php
include '../dbconfig.php';
$parent_id = $_POST["parent_id"];
$sql = "SELECT a.*, b.name_th as province_name,
c.name_th as district_name,d.name_th as sub_district_name
FROM parent a
LEFT JOIN provinces b ON a.province = b.id 
LEFT JOIN districts c ON a.district = c.id 
LEFT JOIN sub_districts d ON a.sub_district = d.id 
WHERE a.parent_id ='$parent_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row){
   $data = array();
   $data['parent_id'] = $row['parent_id'];
   $data['pname'] = $row['pname'];
   $data['fname'] = $row['fname'];
   $data['lname'] = $row['lname'];

   $data['address'] = $row['address'];
   $data['province'] = $row['province_name'];
   $data['district'] = $row['district_name'];
   $data['sub_district'] = $row['sub_district_name'];
   $data['zipcode'] = $row['zipcode'];

   $data['career'] = $row['career'];
   $data['salary'] = $row['salary'];

   $data['pic'] = $row['pic'];

   $data['email'] = $row['email'];
   $data['phone'] = $row['phone'];
   $data['line_id'] = $row['line_id'];
   $data['sql'] = $sql;
   echo (json_encode($data));

}



?>