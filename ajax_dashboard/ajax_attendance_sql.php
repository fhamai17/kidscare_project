<?php
include '../dbconfig.php';
$session = ($_POST['session'] ? "AND c.session_id = '$_POST[session]'" : "");
$term = ($_POST['term'] ? "AND c.term_id = '$_POST[term]'" : "");
$grade = ($_POST['grade'] ? "AND c.grade_id = '$_POST[grade]'" : "");
$section = ($_POST['section'] ? "AND c.section_id = '$_POST[section]'" : "");
//print_r($_POST);
if($_POST['now'] != "no"){

$now = date("Y/m/d");

$sql = "SELECT a.date, sum(if(a.status='มาเรียน',1,0)) as present , 
sum(if(a.status='สาย',1,0)) as late, sum(if(a.status='ลา',1,0)) as nleave, 
sum(if(a.status='ขาด',1,0)) as absent 
FROM attendance  a
LEFT JOIN class c ON a.class_id = c.class_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
LEFT JOIN section e ON c.section_id = e.section_id 
WHERE a.date = '$now' $session $term $grade $section
GROUP BY a.date";
$result =  mysqli_query($conn, $sql);
$numResults = mysqli_num_rows($result);
if ($numResults > 0) {

foreach($result as $row){
    $data["date"]= $row['date'];
    $data["present"]= $row['present'];
    $data["late"]= $row['late'];
    $data["absent"]= $row['absent'];
    $data["leave"]= $row['nleave'];
}
}

else {
    $data['staus'] = 'false';
}
echo json_encode($data);
}
else
{

$start = ($_POST['start']?$_POST['start']:"");
$end = ($_POST['end']?$_POST['end']:"");
/* $sql = "SELECT date, sum(if(status='มาเรียน',1,0)) as present , 
sum(if(status='สาย',1,0)) as late, sum(if(status='ลา',1,0)) as nleave, 
sum(if(status='ขาด',1,0)) as absent FROM attendance 
WHERE date BETWEEN '$start' AND '$end'
GROUP BY date"; */
$sql = "SELECT a.date, sum(if(a.status='มาเรียน',1,0)) as present , 
sum(if(a.status='สาย',1,0)) as late, sum(if(a.status='ลา',1,0)) as nleave, 
sum(if(a.status='ขาด',1,0)) as absent FROM attendance  a
LEFT JOIN class c ON a.class_id = c.class_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
LEFT JOIN section e ON c.section_id = e.section_id
WHERE ( a.date BETWEEN '$start' AND '$end' ) $session $term $grade $section
GROUP BY a.date";
$result =  mysqli_query($conn, $sql);
$i = 0;

$numResults = mysqli_num_rows($result);
if ($numResults > 0) {
    foreach($result as $row){

        $data[$i]["date"]= $row['date'];
        $data[$i]["present"]= $row['present'];
        $data[$i]["late"]= $row['late'];
        $data[$i]["absent"]= $row['absent'];
        $data[$i]["leave"]= $row['nleave'];
        $i++;
    
    }  
}
else {
    $data['staus'] = 'false';
}
  

echo json_encode($data);

}
