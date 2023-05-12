<?php

include '../dbconfig.php';

$sql = "SELECT * FROM session 
ORDER BY session_name";
$result = mysqli_query($conn, $sql);
echo "<option disabled>-โปรดเลือกปีการศึกษา-</option>";
foreach($result as $row){
    echo '<option value="'.$row['session_id'].'" '.(($row['session_id']==$_POST['session'])?'selected="selected"':"").'>'.$row['session_name'].'</option>';
    //echo "<option value=".$row['session_id']." >".$row["session_name"]."</option>";
}

?>

