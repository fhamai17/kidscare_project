<?php

include '../dbconfig.php';
$sql = "SELECT * FROM personnel WHERE type = 'คุณครู' ORDER BY fname";
$result = mysqli_query($conn, $sql);

foreach($result as $row){
    echo "<option value=".$row['personnel_id'].">".$row["fname"]." ".$row["lname"]."</option>";
}

?>

