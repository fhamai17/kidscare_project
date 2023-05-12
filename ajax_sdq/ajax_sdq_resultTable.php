<?php
error_reporting(E_ERROR);
session_start();
include '../dbconfig.php';
$session = ($_POST['session'] ? "c.session_id = '$_POST[session]'" : "");
$term = ($_POST['term'] ? "AND c.term_id = '$_POST[term]'" : "");
$grade = ($_POST['grade'] ? "AND c.grade_id = '$_POST[grade]'" : "");
$section = ($_POST['section'] ? "AND c.section_id = '$_POST[section]'" : "");
$student = ($_POST['student_id'] ? "AND a.student_id = '$_POST[student_id]'" : "");
//$type = "ผู้บริหาร";
$sql = "SELECT a.sdq_id,a.student_id,a.class_id,CONCAT( b.pname,' ',b.fname,' ',b.lname) AS fullname,b.pic,d.grade_name,
e.section_name,sum(a.type = 'คุณครู' AND a.isDone = 1 ) as teacherCheck ,sum(a.type = 'ผู้ปกครอง' AND a.isDone = 1 ) as parentCheck
FROM sdq as a 
LEFT JOIN student as b 
ON a.student_id =b.student_id
LEFT JOIN class c ON a.class_id = c.class_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
LEFT JOIN section e ON c.section_id = e.section_id 
WHERE $session $term $grade $section $type $student
GROUP BY a.class_id,a.student_id";
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


    /*     button:disabled,
button[disabled]{
  background-color: #cccccc;
  color: #666666;
  pointer-events: none;
} */
</style>


<div class="table-responsive">
    <table class="table table-hover  responsive"  id="resultDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ-สกุล</th>
                <th>ระดับชั้น</th>
                <th>ห้อง</th>
                <th>ผลการประเมิน</th>
                <th>หมายเหตุ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
            foreach ($result as $row) {

                $warning = '';
                    if ($row['teacherCheck'] != true && $row['parentCheck'] != true ) {
                        $warning = 'class="warning"';
                        $remark = '<i class="fas fa-exclamation-triangle"></i> รอคุณครูและผู้ปกครองประเมิน';
                    }else if ($row['teacherCheck'] == true && $row['parentCheck'] != true ) {
                        $warning = 'class="warning"';
                        $remark = '<i class="fas fa-exclamation-triangle"></i> รอผู้ปกครองประเมิน';
                    }else if ($row['teacherCheck'] != true && $row['parentCheck'] == true ) {
                        $warning = 'class="warning"';
                        $remark = '<i class="fas fa-exclamation-triangle"></i> รอคุณครูประเมิน';
                    }else if ($row['teacherCheck'] == true && $row['parentCheck'] == true ) {
                        $remark = '';
                    }

                


                if (empty($row['pic'])) {
                    $src = 'src="images/anonymous.jpg"';
                    
                } else {
                    $src = 'src="uploads/student_pics/' . $row['pic'] . '"';
                }
                echo '<tr>' .
                    '<td>' . $i . '</td>' .
                    '<td>
                    <a href="sdq_form.php">
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
                 
                    '<td><button class="badge badge-success" onclick="window.open(\''.'sdq_result_form.php?student_id='. $row['student_id'] . '&class_id='. $row['class_id'].'\')" style="width:100px">
                    <span class="icon">
                    <i class="bi bi-clipboard2-check-fill"></i>
                    </span>ผลการประเมิน
                </button></td>'.   
                '<td '.$warning.'>' . $remark . '</td>' .
                    '</tr>';

                    $i++;
            }
            ?>
    </table>
</div>