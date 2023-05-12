<?php
include '../dbconfig.php';
$id = $_POST["id"];
$sql = "SELECT a.* ,CONCAT(b.pname,' ',b.fname,' ',b.lname) as student_name,
CONCAT(c.pname,' ',c.fname,' ',c.lname) as parent_name,
CONCAT(d.pname,' ',d.fname,' ',d.lname) as teacher_name,
f.grade_name , g.relation
FROM student_leave a
LEFT JOIN student b ON a.student_id = b.student_id 
LEFT JOIN parent c ON a.parent_id = c.parent_id 
LEFT JOIN personnel d ON a.teacher_id = d.personnel_id 
LEFT JOIN class e ON e.class_id = e.class_id 
LEFT JOIN grade f ON f.grade_id = f.grade_id
LEFT JOIN parent_relation g ON a.parent_id = g.parent_id 
AND a.student_id = g.student_id
WHERE leave_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row){
   $data = array();
   $data['id'] = $row['leave_id'];
   $data['student_id'] = $row['student_id'];
   $data['student_name'] = $row['student_name'];
   $data['grade_name'] = $row['grade_name'];
   $data['type'] = $row['type'];
   $data['start_date'] = $row['start_date'];
   $data['end_date'] = $row['end_date'];
   $data['days'] = $row['days'];
   $data['reason'] = $row['reason'];
   $data['isApprove'] = $row['isApprove'];
   $data['remark'] = $row['remark'];
   $data['parent_id'] = $row['parent_id'];
   $data['parent_name'] = $row['parent_name'];
   $data['create_time'] = $row['parent_create_time'];
   $data['relation'] = $row['relation'];
   $data['teacher_name'] = $row['teacher_name'];
   $data['approve_time'] = $row['teacher_approve_time'];
   $data['remark'] = $row['remark'];
   echo (json_encode($data));
}



?>