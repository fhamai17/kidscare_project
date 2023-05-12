<?php

include '../dbconfig.php';
$sql = "SELECT * FROM session 
ORDER BY session_name";
$result = mysqli_query($conn, $sql);

foreach($result as $row){
    echo "<option value=".$row['session_id']." >".$row["session_name"]."</option>";
}

?>

