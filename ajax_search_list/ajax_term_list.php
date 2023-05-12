<?php
include '../dbconfig.php';
$session_id = $_POST['session'];
$sql = "SELECT * FROM term WHERE session_id = '$session_id'";
$result = mysqli_query($conn, $sql);
    echo "<option disabled>-โปรดเลือกเทอม-</option>";
    echo "<option value=''>ทั้งหมด</option>";
    foreach ($result as $row) {
        //echo "<option value=" . $row['term_id'] . ">เทอม " . $row["term_name"] . "</option>";
        echo '<option value="'.$row['term_id'].'" '.(($row['term_id']==$_POST['term_cur'])?'selected="selected"':"").'>เทอม '.$row['term_name'].'</option>';
    }
