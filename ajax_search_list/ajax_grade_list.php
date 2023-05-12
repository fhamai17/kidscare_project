<?php
include '../dbconfig.php';
session_start();
$user_type = $_SESSION['type'];
if ($user_type === "คุณครู") {

$teacher_id = $_SESSION['user_id'];
$session_id = $_POST['session'];
$term = ($_POST['term'] ? "AND term_id = ('$_POST[term]')" : "");
$sql = "SELECT b.grade_name,a.grade_id
FROM class a 
LEFT JOIN grade b on a.grade_id = b.grade_id 
WHERE teacher_id ='$teacher_id'
AND session_id = '$session_id' $term
GROUP BY grade_id";
echo $sql;

$result = mysqli_query($conn, $sql);
$rowcount = mysqli_num_rows($result);
$select = "selected";
    /* if ($rowcount > 1) {
    echo '<option value="" selected>ทั้งหมด</option>';
    $select = "";
} */
    echo '<option value="" selected>ทั้งหมด</option>';
    foreach ($result as $row) {
        echo '<option value="' . $row['grade_id'] . '" ' . $select . '>' . $row['grade_name'] . '</option>';
    }
} else {

    $sql = "SELECT * FROM grade";
    $result = mysqli_query($conn, $sql);
    echo "<option value='' disabled>-โปรดเลือกระดับชั้น-</option>";
    echo "<option value='' selected>ทั้งหมด</option>";
    foreach ($result as $row) {
        echo "<option value=" . $row['grade_id'] . ">" . $row["grade_name"] . "</option>";
    }
}
