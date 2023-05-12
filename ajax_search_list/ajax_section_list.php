<?php
include '../dbconfig.php';
session_start();
$user_type = $_SESSION['type'];
if ($user_type === "คุณครู") {

    $teacher_id = $_SESSION['user_id'];
    $session_id = $_POST['session'];

    $term = ($_POST['term'] ? "AND term_id = ('$_POST[term]')" : "");
    $grade  = ($_POST['grade'] ? "AND a.grade_id = ('$_POST[grade]')" : "");
    if ($grade == "") {
        echo '<option value="" selected>ทั้งหมด</option>';
        $select = "";
    } else {
        $select = "selected";
    }
    $sql = "SELECT b.section_name,a.section_id
FROM class a 
LEFT JOIN section b on a.section_id = b.section_id 
WHERE teacher_id ='$teacher_id'
AND session_id = '$session_id' $term $grade
GROUP BY section_id";
    echo $sql;

    $result = mysqli_query($conn, $sql);
    $i = 0;
    foreach ($result as $row) {
        if ($i == 0) {
            echo '<option value="' . $row['section_id'] . '"  ' . $select . '>' . $row['section_name'] . '</option>';
        } else {
            echo '<option value="' . $row['section_id'] . '" >' . $row['section_name'] . '</option>';
        }
    }
} else {

    $grade = ($_POST['grade'] ? "WHERE grade_id = $_POST[grade]" : "");

    print_r($_POST);
    $sql = "SELECT * FROM section $grade";
    $result = mysqli_query($conn, $sql);
    echo "<option value='' disabled>-โปรดเลือกห้อง-</option>";
    echo "<option value='' selected>ทั้งหมด</option>";

    if ($grade) {
        foreach ($result as $row) {
            echo '<option value="' . $row['section_id'] . '">' . $row['section_name'] . '</option>';
        }
    }
}
