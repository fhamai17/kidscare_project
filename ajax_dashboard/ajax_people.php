<?php

include '../dbconfig.php';
$sql ="SELECT ( SELECT COUNT(*) FROM student ) AS student, 
( SELECT COUNT(*) FROM parent ) AS parent, 
( SELECT COUNT(*) FROM teacher WHERE type ='คุณครู' ) AS teacher, 
( SELECT COUNT(*) FROM teacher WHERE type ='ฝ่ายบริหาร' ) AS exuclusive, 
( SELECT COUNT(*) FROM teacher WHERE type ='ผู้ดูแลระบบ' ) AS admin FROM dual;";
$result =  mysqli_query($conn, $sql);

?>