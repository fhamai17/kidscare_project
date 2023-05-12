<?php
error_reporting(E_ERROR);
session_start();
include '../dbconfig.php';

$session = ($_POST['session'] ? "c.session_id = '$_POST[session]'" : "");
$term = ($_POST['term'] ? "AND c.term_id = '$_POST[term]'" : "");
$grade = ($_POST['grade'] ? "AND c.grade_id = '$_POST[grade]'" : "");
$section = ($_POST['section'] ? "AND c.section_id = '$_POST[section]'" : "");
$type = ($_POST['type'] ? "AND a.type = '$_POST[type]'" : "");
$student = ($_POST['student_id'] ? "AND a.student_id = '$_POST[student_id]'" : "");
//$type = "ผู้บริหาร";

if ($_POST['type'] === "คุณครู") {
    $id = 'id="teacherDataTable"';

} else {
    $type = " AND a.type = 'ผู้ปกครอง'";
    $id = 'id="parentDataTable"';
}



$sql = "SELECT a.*,CONCAT( b.pname,' ',b.fname,' ',b.lname) AS fullname,b.pic,d.grade_name,e.section_name
FROM sdq as a 
LEFT JOIN student as b 
ON a.student_id =b.student_id
LEFT JOIN class c ON a.class_id = c.class_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
LEFT JOIN section e ON c.section_id = e.section_id 
WHERE $session $term $grade $section $type $student";

//echo $sql;
$result = mysqli_query($conn, $sql);
?>
<style>
    .table td,
    .table th {
        vertical-align: middle;
        margin-bottom: 10px;
    }

    .table td:not(:nth-child(2)),
    .table th:not(:nth-child(2)) {
        text-align: center;
    }


button:disabled,
button[disabled]{
  background-color: #cccccc;
  color: #666666;
  pointer-events: none;
} 

</style>


<div class="table-responsive">
    <table class="table table-hover  responsive" <?= $id ?> width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อ-สกุล</th>
                <th>ระดับชั้น</th>
                <th>ห้อง</th>
                <th>สถานะ</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $i=1;
            foreach ($result as $row) {

                $disabled = '';
                if ($_POST['type']===$_SESSION['type']){
                    if ($row['isDone'] == true) {
                        $isDone = '<i class="bi bi-check-circle-fill success"></i>';
                        $button = ' <button class="badge badge-primary" onclick="window.open(\''.'sdq_form.php?sdq_id='. $row['sdq_id'] . '\')" style="width:100px">
                        <span class="icon">
                        <i class="fas fa-eye"></i>
                        </span>ดูแบบประเมิน
                    </button>';
                    }
                    else {
                        $isDone = '<i class="bi bi-x-circle-fill danger"></i>';
                        $button = ' <button class="badge badge-warning" onclick="window.open(\''.'sdq_form.php?sdq_id='. $row['sdq_id'] . '\')" style="width:100px">
                        <span class="icon">
                        <i class="fas fa-edit"></i>
                        </span>ทำแบบประเมิน
                    </button>';
                    }

                }else{
                    if ($row['isDone'] == true) {
                        $isDone = '<i class="bi bi-check-circle-fill success"></i>';
                       
                    }
                    else {
                        $isDone = '<i class="bi bi-x-circle-fill danger"></i>';
                        $disabled = 'disabled';
                    }
                    $button = ' <button class="badge badge-primary" '.$disabled.' onclick="window.open(\''.'sdq_form.php?sdq_id='. $row['sdq_id'] . '\')" style="width:100px">
                        <span class="icon">
                        <i class="fas fa-eye"></i>
                        </span>ดูแบบประเมิน
                    </button>';
                }


                if (empty($row['pic'])) {
                    $src = 'src="images/anonymous.jpg"';
                    
                } else {
                    $src = 'src="uploads/student_pics/' . $row['pic'] . '"';
                }
                echo '<tr>' .
                    '<td>' . $i . '</td>' .
                    '<td>
                    <a href="sdq_form.php?sdq_id='. $row['sdq_id'] .'">
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" ' . $src . ' ></div>
                                <div>
                                    <p class="font-weight-bold mb-0">' . $row['student_id'] . '</p>
                                    <p class="text-muted mb-0">' . $row['fullname'] . '</p>
                                </div>
                            </div>
                            </a>
                    </td>' .
                    '<td>' . $row['grade_name'] . '</td>' .
                    '<td>' . $row['section_name'] . '</td>' .
                    '<td>' . $isDone . '</td>' .
                    '<td class="text-center">'.$button.'
                        </td>' .
                    '</tr>';

                    $i++;
            }
            ?>
    </table>
</div>