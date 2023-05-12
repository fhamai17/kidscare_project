<?php
include '../dbconfig.php';
$session_id = $_POST['session'];
$sql = "SELECT * FROM term WHERE session_id = '$session_id'";
$result = mysqli_query($conn, $sql);
echo "<option value='' disabled selected>-โปรดเลือกเทอม-</option>";
foreach ($result as $row) {
    //echo "<option value=" . $row['term_id'] . ">เทอม " . $row["term_name"] . "</option>";
    if ($_POST['term']) {
        echo '<option value="' . $row['term_id'] . '" ' . (($row['term_id'] == $_POST['term']) ? 'selected="selected"' : "") . '>เทอม ' . $row['term_name'] . '</option>';
    } else {
        echo '<option value="' . $row['term_id'] . '">เทอม ' . $row['term_name'] . '</option>';
    }
}
