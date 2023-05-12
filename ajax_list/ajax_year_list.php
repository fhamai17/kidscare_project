<?php

include '../dbconfig.php';
$sql = "SELECT DISTINCT session_name FROM session 
ORDER BY session_name";
$result = mysqli_query($conn, $sql);

foreach($result as $row){
    echo "<option value=".$row['session_name']." >".$row["session_name"]."</option>";
}

?>

