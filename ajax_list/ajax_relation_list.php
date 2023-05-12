<?php

include '../dbconfig.php';
$sql = "SELECT DISTINCT(relation) FROM parent_relation
WHERE relation NOT IN ('บิดา','มารดา','ปู่','ย่า','ตา','ยาย');";
$result = mysqli_query($conn, $sql);
echo '<option value="" disabled selected>-กรุณาเลือกห้อง-</option>
<option value="บิดา">บิดา</option>
<option value="มารดา">มารดา</option>
<option value="ปู่">ปู่</option>
<option value="ย่า">ย่า</option>
<option value="ตา">ตา</option>
<option value="ยาย">ยาย</option>';

foreach($result as $row){
    //echo '<option value="'.$row['section_id'].'" '.(($row['section_id']==$_POST['section'])?'selected="selected"':"").">".$row["section_name"]."</option>";
    echo '<option value="'.$row['relation'].'">'.$row['relation'].'</option>';
}

echo '<option value="อื่นๆ">อื่นๆ</option>';


?>

 