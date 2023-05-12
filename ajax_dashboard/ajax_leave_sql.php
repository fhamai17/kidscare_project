<?php
include '../dbconfig.php';
$session = ($_POST['session'] ? "AND c.session_id = '$_POST[session]'" : "");
$term = ($_POST['term'] ? "AND c.term_id = '$_POST[term]'" : "");
$grade = ($_POST['grade'] ? "AND c.grade_id = '$_POST[grade]'" : "");
$section = ($_POST['section'] ? "AND c.section_id = '$_POST[section]'" : "");

//print_r($_POST);

$now = date("Y/m/d");
if ($_POST['now'] !== "no") {

    $sql = " SELECT date, CASE WHEN personal is NULL THEN 0 ELSE personal END AS personal , CASE WHEN sick is null THEN 0 ELSE sick END AS sick
    FROM (SELECT '$now' as date, sum(if(a.type='ลากิจ' AND a.isApprove = 1,1,0)) as personal , 
    sum(if(a.type='ลาป่วย' AND a.isApprove = 1,1,0)) as sick
    from student_leave a
    LEFT JOIN class c ON a.class_id = c.class_id 
    WHERE ( '$now' BETWEEN a.start_date AND a.end_date ) $session $term $grade $section
) as a";
    $result =  mysqli_query($conn, $sql);
    $i = 0;
    $data["aaaaa"] = $sql;
    $numResults = mysqli_num_rows($result);
    if ($numResults > 0) {
        foreach ($result as $row) {

            $data["date"] = $row['date'];
            $data["personal"] = $row['personal'];
            $data["sick"] = $row['sick'];
            $i++;
        }
    } else {
        $data['status'] = 'false';
    }

    echo json_encode($data);
} else {

    $start = ($_POST['start'] ? $_POST['start'] : "");
    $end = ($_POST['end'] ? $_POST['end'] : "");
    /* SELECT date, CASE WHEN personal is NULL THEN 0 ELSE personal END AS personal , CASE WHEN sick is null THEN 0 ELSE sick END AS sick
    FROM (SELECT '$now' as date, sum(if(a.type='ลากิจ' AND a.isApprove = 1,1,0)) as personal , 
    sum(if(a.type='ลาป่วย' AND a.isApprove = 1,1,0)) as sick
    from student_leave a
    LEFT JOIN class c ON a.class_id = c.class_id 
    WHERE ( '$now' BETWEEN a.start_date AND a.end_date ) $session $term $grade $section
) as a";*/

    $period[] = new DatePeriod(new DateTime($start), new DateInterval('P1D'), new DateTime($end . '+1 day'));


    foreach ($period as $row) {
        foreach ($row as $date) {
            $dates[] = $date->format("Y-m-d");
        }
    }

    $i = 0;
    if ($dates) {

        foreach ($dates as $date) {

            $sql = "SELECT date, CASE WHEN personal is NULL THEN 0 ELSE personal END AS personal , CASE WHEN sick is null THEN 0 ELSE sick END AS sick
FROM (SELECT '$date' as date, sum(if(a.type='ลากิจ' AND a.isApprove = 1,1,0)) as personal , 
sum(if(a.type='ลาป่วย' AND a.isApprove = 1,1,0)) as sick
from student_leave a
LEFT JOIN class c ON a.class_id = c.class_id 
WHERE ( '$date' BETWEEN a.start_date AND a.end_date ) $session $term $grade $section
) as a";
            $result =  mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            $data[$i]["date"] = $row['date'];
            $data[$i]["personal"] = $row['personal'];
            $data[$i]["sick"] = $row['sick'];
            $i++;
        }
    } else {
        $data['status'] = 'false';
    }


    echo json_encode($data);
}
