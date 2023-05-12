<?php
include '../dbconfig.php';
session_start();
$id = $_POST['home_id'];

$sql = "SELECT a.*,b.student_id,CONCAT( b.pname,' ',b.fname,' ',b.lname) AS student_name,
b.nickname ,b.pic as student_pic,b.birthdate  ,d.grade_name as grade ,e.section_name as section,
CONCAT( f.pname,' ',f.fname,' ',f.lname) AS teacher_name , 
g.session_name as session ,h.term_name as term
FROM home a 
LEFT JOIN student as b 
ON a.student_id =b.student_id
LEFT JOIN class c ON a.class_id = c.class_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
LEFT JOIN section e ON c.section_id = e.section_id 
LEFT JOIN teacher f ON c.teacher_id = f.teacher_id
LEFT JOIN session g ON c.session_id = g.session_id
LEFT JOIN term h ON c.term_id = h.term_id
WHERE home_id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if ($row) {
   $data = array();
   $data['term'] = $row['term'];
   $data['session'] = $row['session'];

   $data['lat'] = $row['lat'];
   $data['lng'] = $row['lng'];
   
   $data['teacher_name'] = $row['teacher_name'];
   $data['student_pic'] = $row['student_pic'];
   $data['student_id'] = $row['student_id'];
   $data['student_name'] = $row['student_name'];
   $data['birthdate'] = $row['birthdate'];
   $data['nickname'] = $row['nickname'];
   $data['grade'] = $row['grade'];
   $data['section'] = $row['section'];
   $data['fname'] = $row['fname'];
   $data['fphone'] = $row['fphone'];
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
   $data['home_pic'] = $row['pic'];

   echo (json_encode($data));
}
