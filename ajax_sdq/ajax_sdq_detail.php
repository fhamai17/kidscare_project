<?php
include '../dbconfig.php';
$sdq_id = $_POST["sdq_id"];
$sql = "SELECT a.*,b.pname as std_pname,b.fname as std_fname,b.lname as std_lname,
d.grade_name as grade, CASE 
    WHEN a.type = 'คุณครู' THEN e.pname
    WHEN a.type ='ผู้ปกครอง' THEN  f.pname
 END AS user_pname,
 CASE 
    WHEN a.type = 'คุณครู' THEN e.fname
    WHEN a.type ='ผู้ปกครอง' THEN  f.fname
 END AS user_fname,
 CASE 
    WHEN a.type = 'คุณครู' THEN e.lname
    WHEN a.type ='ผู้ปกครอง' THEN  f.lname
 END AS user_lname
FROM sdq a
LEFT JOIN student b ON a.student_id = b.student_id
LEFT JOIN class c ON a.class_id = c.class_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
LEFT JOIN personnel e ON a.user_id = e.personnel_id 
LEFT JOIN parent f ON a.user_id = f.parent_id 
WHERE a.sdq_id ='$sdq_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row){
   $data = array();
   $data['std_pname'] = $row['std_pname'];
   $data['std_lname'] = $row['std_lname'];
   $data['std_fname'] = $row['std_fname'];
   $data['grade'] = $row['grade'];
   $data['user_pname'] = $row['user_pname'];
   $data['user_lname'] = $row['user_lname'];
   $data['user_fname'] = $row['user_fname'];
   $data['update_time'] = $row['update_time'];
   $data['no01'] = $row['NO01']; 
$data['no02'] = $row['NO02']; 
$data['no03'] = $row['NO03']; 
$data['no04'] = $row['NO04']; 
$data['no05'] = $row['NO05']; 
$data['no06'] = $row['NO06']; 
$data['no07'] = $row['NO07']; 
$data['no08'] = $row['NO08']; 
$data['no09'] = $row['NO09']; 
$data['no10'] = $row['NO10']; 
$data['no11'] = $row['NO11']; 
$data['no12'] = $row['NO12']; 
$data['no13'] = $row['NO13']; 
$data['no14'] = $row['NO14']; 
$data['no15'] = $row['NO15']; 
$data['no16'] = $row['NO16']; 
$data['no17'] = $row['NO17']; 
$data['no18'] = $row['NO18']; 
$data['no19'] = $row['NO19']; 
$data['no20'] = $row['NO20']; 
$data['no21'] = $row['NO21']; 
$data['no22'] = $row['NO22']; 
$data['no23'] = $row['NO23']; 
$data['no24'] = $row['NO24']; 
$data['no25'] = $row['NO25']; 
$data['remark'] = $row['remark']; 
$data['problem'] = $row['P01']; 
$data['radio01'] = $row['D01']; 
$data['radio02'] = $row['D02']; 
$data['radio03_1'] = $row['D03_1']; 
$data['radio03_2'] = $row['D03_2'];
$data['radio03_3'] = $row['D03_3'];
$data['radio03_4'] = $row['D03_4'];
$data['radio04'] = $row['D04']; 
$data['isDone'] = $row['isDone'];
$data['type'] = $row['type'];
echo (json_encode($data));
}
