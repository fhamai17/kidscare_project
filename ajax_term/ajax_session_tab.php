<?php

include '../dbconfig.php';
$sql = "SELECT * FROM session ORDER BY session_id ASC";
$result = mysqli_query($conn, $sql);

$i = 0;
foreach ($result as $row) {
    if ($i == 0) {
        echo '<li class="nav-item">
                <a class="nav-link active" id="stdinfo-tab" data-toggle="tab" href="#" role="tab" aria-selected="true" onclick="showSessionTabContent(' . $row['session_id'] . ')">' . $row['session_name'] . '</a>
                </li>';
            echo"<script language='javascript'>
            showSessionTabContent(".$row['session_id'].");
            </script>";
    } else {
        echo '<li class="nav-item">
        <a class="nav-link" id="stdinfo-tab" data-toggle="tab" href="#" role="tab"  aria-selected="true" onclick="showSessionTabContent(' . $row['session_id'] . ')">' . $row['session_name'] . '</a>
        </li>';
    }
    $i++;
}
