<?php
session_start();
include '../dbconfig.php';

$sql = "SELECT * FROM parent_relation a
LEFT JOIN student as b 
ON a.student_id =b.student_id
WHERE a.parent_id = '$_SESSION[user_id]' AND a.isApprove = '1'
 ORDER BY a.student_id";
$result = mysqli_query($conn, $sql);
echo "<option value='' disabled>-โปรดเลือกนักเรียน-</option>";

foreach($result as $row){
    $fullname = $row["pname"].' '.$row["fname"].' '.$row["lname"];
    echo "<option data-subtext='$fullname' value=".$row['student_id'].">".$row['student_id']."</option>";
   
}
/* if(isset($_POST['id'])){
    echo "<option data-subtext='$fullname' value=".$row['student_id']." ".(($row['student_id']==$_POST['id'])?'selected="selected"':"").">".$row['student_id']."</option>";
}else{
    echo "<option data-subtext='$fullname' value=".$row['student_id'].">".$row['student_id']."</option>";
} */
?>

 