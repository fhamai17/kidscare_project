<?php
include '../dbconfig.php';
session_start();
$id = $_POST['leave_id'];
$status = $_POST['status'];
$remark = $_POST['remark'];
print_r($_POST);



$sql = "UPDATE student_leave SET isApprove ='$status' ,remark = '$remark',
teacher_id = '$_SESSION[user_id]',teacher_approve_time=NOW()
WHERE leave_id = $id";
$rs = mysqli_query($conn, $sql);
if ($rs) {

    echo "Update Successful";
    if ($status == 1) {


        $sql_date = "SELECT *
        FROM student_leave 
        WHERE leave_id =$id";
        $result = mysqli_query($conn, $sql_date);
        $row = mysqli_fetch_array($result);
        $start_date = $row['start_date'];
        $end_date = $row['end_date'];
        $student_id = $row['student_id'];
        $class_id = $row['class_id'];

        foreach ($result as $row) {
            $period[] = new DatePeriod(new DateTime($start_date), new DateInterval('P1D'), new DateTime($end_date  . '+1 day'));
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

                $sql = "SELECT * FROM attendance WHERE date = '$date' 
                AND student_id = '$student_id' AND class_id = '$class_id'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
                $count = mysqli_num_rows($result);

                if ($count > 0) {
                    $att_id = $row['id'];
                    $sql_att = "UPDATE attendance SET date = '$date',student_id ='$student_id',class_id ='$class_id',status='ลา'
                    WHERE id = '$att_id'";
                    $rs = mysqli_query($conn, $sql_att);
                    if ($rs) {
                        echo "Update Attendance Successful";
                    } else {
                        echo "Update Attendance Failed";
                    }
                } else {

                    $sql_att = "INSERT INTO attendance (date,student_id,class_id,create_time,status) 
                VALUES ('$date', '$student_id','$class_id', NOW() ,'ลา')";
                    $rs = mysqli_query($conn, $sql_att);
                    if ($rs) {
                        echo "Insert Attendance Successful";
                    } else {
                        echo "Insert Attendance Failed";
                    }
                }
            }
        }
    }
    else{

    }
} else {

    echo "Update Failed";
}
