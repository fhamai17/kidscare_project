<?php
include '../dbconfig.php';
if(isset($_POST['term_id'])){
   $sql = "SELECT a.*,b.session_name
   FROM term  a
   LEFT JOIN session b ON a.session_id = b.session_id
   WHERE a.term_id=$_POST[term_id]";

}
else{
$sql = "SELECT a.*,b.session_name
FROM term  a
LEFT JOIN session b ON a.session_id = b.session_id
WHERE a.isActive=1";
}


$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if($row){
   $data = array();
   $data['class_id'] = $row['class_id'];
   $data['class_name'] = $row['term_name'];
   $data['session_id'] = $row['session_id'];
   $data['session_name'] = $row['session_name'];
   echo (json_encode($data));
}


?>