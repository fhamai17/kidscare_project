<?php

include '../dbconfig.php';
$sql = "SELECT * FROM grade";
$result = mysqli_query($conn, $sql);
echo "<option value='' disabled selected>-กรุณาเลือกระดับชั้น-</option>";
foreach($result as $row){
    echo "<option value=".$row['grade_id'].">".$row["grade_name"]."</option>";
}

?>

 