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


$no01_arr = implode(",",$no01);
$no04_arr = implode(",",$no04);

echo "No : ".$no01_arr;
echo "No : ".$no04_arr;


$target = '../uploads/home_pics/';
$file_name = $_FILES["file"]["name"];
$file_tmp = $_FILES["file"]["tmp_name"];
$ext = pathinfo($file_name, PATHINFO_EXTENSION);
$home_pic = "";
echo "Extention : ".$ext;
$new_file_name = null;
if ($_FILES['file']['error'] > 0) {
    echo "Error:" . $_FILES['file']['error'] . "<br/>";
} 
else {

  
if(!empty($_FILES)){
    
        if (!file_exists($target . $file_name)) {
            $new_file_name =  "homeID_" . $home_id .".". $ext;
            move_uploaded_file($file_tmp, $target . $new_file_name);
        } else {
            $new_file_name =  "homeID_" . $home_id . time() .".".$ext;
            move_uploaded_file($file_tmp, $target . $new_file_name);
        }
}

$home_pic = ",pic = '$new_file_name'";
}

$sql = "UPDATE home SET NO01 = '$no01_arr', NO02 = '$no02', NO03 = '$no03', NO04 = '$no04_arr', NO05 = '$no05', 
NO06 = '$no06', NO07 = '$no07', NO08 = '$no08', NO09 = '$no09', NO10 = '$no10', NO11 = '$no11',
NO12 = '$no12',NO13 = '$no13',NO14 = '$no14',NO15 = '$no15',NO16 = '$no16',NO17 = '$no17',
NO18 = '$no18',NO19 = '$no19',NO20 = '$no20',NO21 = '$no21',NO22 = '$no22',NO23 = '$no23',NO24 = '$no24',
NO25 = '$no25',fname = '$fname',fphone='$fphone' $home_pic ,user_id = '$user_id' ,update_time=NOW(),isDone=1
WHERE home_id = $home_id";
echo $sql;
$rs = mysqli_query($conn, $sql);
if($rs){
echo "Update Successful";
}else
{
echo "Update Failed";
} 

?>


