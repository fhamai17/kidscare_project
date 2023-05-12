<?php
include '../dbconfig.php';
$id = $_POST["id"];
$sql = "SELECT * FROM student WHERE student_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

if($row){
    foreach ($row as $key => $value) {
        $data[$key] = $value;
    }
   echo (json_encode($data));
}
