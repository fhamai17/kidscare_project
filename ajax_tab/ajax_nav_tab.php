<?php

include '../dbconfig.php';
$sql = "SELECT * FROM grade ORDER BY grade_id";
$result = mysqli_query($conn, $sql);

$i = 0;
foreach ($result as $row) {
    if ($i == 0) {
        echo '<li class="nav-item">
                <a class="nav-link active" id="stdinfo-tab" data-toggle="tab" href="#" role="tab" aria-selected="true" onclick="showClassTabContent(' . $row['grade_id'] . ')">' . $row['grade_name'] . '</a>
            </li>';
            echo"<script language='javascript'>
            showClassTabContent(".$row['grade_id'].");
            </script>";
    } else {
        echo '<li class="nav-item">
        <a class="nav-link" id="stdinfo-tab" data-toggle="tab" href="#" role="tab"  aria-selected="true" onclick="showClassTabContent(' . $row['grade_id'] . ')">' . $row['grade_name'] . '</a>
        </li>';
    }
    $i++;
}
