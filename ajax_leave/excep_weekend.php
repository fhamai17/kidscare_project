<?php
include '../dbconfig.php';

$sql_date = "SELECT start_date,end_date
        FROM student_leave 
        WHERE leave_id ='24'";
$result = mysqli_query($conn, $sql_date);
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


foreach ($dates as $date) {
    $timestamp = strtotime($date);
    $weekday = date("l", $timestamp);
    if ($weekday == "Saturday" or $weekday == "Sunday") {
       echo "Weekend";
    } else {
        echo "No Weekend";
      /*  $sql_att = "INSERT INTO attendance (date,student_id,class_id,create_time,status) 
       VALUES '$date', '$student_id','$class_id', NOW() ,'ลา')"; */
    }
}

print_r($dates);
