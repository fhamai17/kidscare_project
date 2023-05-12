<?php
include '../dbconfig.php';
session_start();
$class_id = $_POST['class_id'];

$sql = "SELECT * FROM home WHERE class_id = $class_id";
$result = mysqli_query($conn, $sql);


$locations=array();
foreach($result as $row){

    $lng = $row['lng'];                              
    $lat = $row['lat'];
    $name = $row['student_id'];
     /* Each row is added as a new array */
     $locations[]=array('name'=>$name,'lat'=>$lat, 'lng'=>$lng );

}

echo json_encode( $locations );

?>
