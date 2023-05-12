<?php

include '../dbconfig.php';
$grade = $_POST['grade'];

print_r($_POST);
$sql = "SELECT * FROM section WHERE grade_id = '$grade'";
$result = mysqli_query($conn, $sql);
echo "<option value='' disabled selected>-โปรดเลือกห้อง-</option>";
foreach($result as $row){
    if ($_POST['section']) {
        echo '<option value="'.$row['section_id'].'" '.(($row['section_id']==$_POST['section'])?'selected="selected"':"").'>'.$row['section_name'].'</option>';
    } else {
        echo '<option value="' . $row['section_id'] . '">' . $row['section_name'] . '</option>';
    }

    //echo '<option value="'.$row['section_id'].'" '.(($row['section_id']==$_POST['section'])?'selected="selected"':"").">".$row["section_name"]."</option>";
    //echo '<option value="'.$row['section_id'].'" '.(($row['section_id']==$_POST['section'])?'selected="selected"':"").'>'.$row['section_name'].'</option>';
}

?>

 