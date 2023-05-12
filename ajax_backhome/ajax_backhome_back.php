<?php
include '../dbconfig.php';

$grade = $_POST['grade'];
$section = $_POST['section'];
$term = $_POST['term_cur'];
$session = $_POST['session_cur'];
$back_date = $_POST['back_date'];

$sql_class = "SELECT class_id from class 
WHERE session_id = $session
AND term_id = $term AND grade_id = $grade
AND section_id = $section";

$rs_class = mysqli_query($conn, $sql_class);
$row = mysqli_fetch_array($rs_class);
$class_id = $row['class_id'];

if (isset($_POST['parent_id'])) {
    $parent_id = $_POST['parent_id'];
    $time = date("H:i:s");
    $sql = "SELECT * FROM backhome
    WHERE parent_id = '$parent_id' AND backdate = '$back_date';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);
    if ($count) {
        $sql = "UPDATE backhome SET isBack='1' ,backtime = '$time'
    WHERE parent_id = '$parent_id' AND backdate = '$back_date' AND class_id = '$class_id';";
    echo $sql;
        $rs = mysqli_query($conn, $sql);
        if ($rs) {
            echo "Update Successful";
        } else {
            echo "Update Failed";
        }  
    } 
    else {
        echo "No Data in DB";
    }
}
