<?php
include '../dbconfig.php';
$term = $_POST['term'];
if (isset($_POST['session'])) {
    $session = $_POST['session'];
    $term = ($_POST['term'] ? "AND term_id = '" . $_POST['term'] . "'" : "");
    $sql = "SELECT * FROM term WHERE session_id = $session $term";

} else {

    $sql = "SELECT * FROM term WHERE term_id = $term";
}



$result = mysqli_query($conn, $sql);
/*    $row = mysqli_fetch_array($result);
    $start_date = $row['start_date'];
    $end_date = $row['end_date']; */

foreach ($result as $row) {
    $period[] = new DatePeriod(new DateTime($row['start_date']), new DateInterval('P1D'), new DateTime($row['end_date'] . '+1 day'));
}


foreach ($period as $row) {
    foreach ($row as $date) {
        $dates[] = $date->format("Y-m-d");
    }
}


echo json_encode($dates);
