<?php

include '../dbconfig.php';
$sql = "SELECT * FROM grade";
$result = mysqli_query($conn, $sql);
echo "<option disabled>-โปรดเลือกระดับชั้น-</option>";
echo "<option value='' selected>ทั้งหมด</option>";
foreach($result as $row){
    echo "<option value=".$row['grade_id'].">".$row["grade_name"]."</option>";
}

?>

 