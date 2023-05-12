<?php
include '../dbconfig.php';

$class = $_POST['class_name'];
$term = $_POST['term'];
$grade = $_POST['grade'];
$section = $_POST['section'];
$session = $_POST['session'];
$teacher = $_POST['teacher']; 
$token = $_POST['token']; 
$data = array();
$sql_check = "SELECT * FROM class 
WHERE session_id = '$session'
AND term_id = '$term'
AND grade_id = '$grade'
AND section_id = '$section'";
$rs_check = mysqli_query($conn, $sql_check);

$numResults = mysqli_num_rows($rs_check);
if ($numResults > 0) {
    $data['status'] = 404;
    $data['status_text'] = 'มีห้องนี้อยู่ในฐานข้อมูลแล้ว';
}
else {
    
    $sql = "INSERT INTO class (class_name, grade_id,section_id,session_id,term_id,teacher_id,token)
VALUES ('$class','$grade','$section','$session','$term','$teacher','$token')";
$rs = mysqli_query($conn, $sql);
if($rs){
    $data['status'] = 200;
}else
{
    $data['status'] = 404;
    $data['status_text'] = 'เกิดข้อผิดพลาด';
}

}

echo json_encode($data);


?>


