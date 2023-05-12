<?php
include '../dbconfig.php';
session_start();
$teacher_id = $_SESSION['user_id'];
$session_id = $_POST['session'];

$term = ($_POST['term'] ? "AND term_id = ('$_POST[term]')" : "");

$sql = "SELECT * FROM class 
WHERE teacher_id ='$teacher_id'
AND session_id = '$session_id' $term";
$result = mysqli_query($conn, $sql);
    echo '<option value="" selected>ทั้งหมด</option>';
    foreach ($result as $row) {
        //echo "<option value=" . $row['term_id'] . ">เทอม " . $row["term_name"] . "</option>";
        echo '<option value="'.$row['class_id'].'">'.$row['class_name'].'</option>';
    }
