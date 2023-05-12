<?php
session_start();
include '../dbconfig.php';
$user_id = $_SESSION['user_id'];
print_r($_POST);
$myarray = array( $_POST);
foreach ($_POST as $key => $value)
{
    $$key = $value;
}

if($problem != 0){
    $radio = ",D01 = '$radio01',D02 = '$radio02',D03_1 = '$radio03_1',D03_2 = '$radio03_2',
    D03_3 = '$radio03_3',D03_4 = '$radio03_4',D04 = '$radio04',";
}else{
    $radio = ",";
}


$result01 = $no05+$no07+$no12+$no18+$no22;
$result02 = $no02+$no10+$no15+$no21+$no25;
$result03 = $no03+$no08+$no13+$no16+$no24;
$result04 = $no06+$no11+$no14+$no19+$no23;
$result05 = $no01+$no04+$no09+$no17+$no20;
$result06 = $radio02+$radio03_1+$radio03_2+$radio03_3+$radio03_4;

echo "No : ".$no01;
$sql = "UPDATE sdq SET NO01 = '$no01', NO02 = '$no02', NO03 = '$no03', NO04 = '$no04', NO05 = '$no05', 
NO06 = '$no06', NO07 = '$no07', NO08 = '$no08', NO09 = '$no09', NO10 = '$no10', 
NO11 = '$no11', NO12 = '$no12', NO13 = '$no13', NO14 = '$no14', NO15 = '$no15', 
NO16 = '$no16', NO17 = '$no17', NO18 = '$no18', NO19 = '$no19', NO20 = '$no20',
NO21 = '$no21', NO22 = '$no22', NO23 = '$no23', NO24 = '$no24', NO25 = '$no25' ,
remark = '$remark',P01 = '$problem' $radio RESULT01 ='$result01',RESULT02 ='$result02',
RESULT03 ='$result03',RESULT04 ='$result04',RESULT05 ='$result05',RESULT06 ='$result06',
user_id = '$user_id',update_time=NOW(),isDone=1
WHERE sdq.sdq_id = $sdq_id";
echo $sql;
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
} 

?>


