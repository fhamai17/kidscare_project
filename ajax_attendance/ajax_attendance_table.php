<?php
session_start();
include '../dbconfig.php';
$date = ($_POST['date'] ? " a.date = ('$_POST[date]')" :"a.date IS NOT NULL");
$grade = ($_POST['grade'] ? "AND d.grade_id = ('$_POST[grade]')" : "");
$section = ($_POST['section'] ? "AND d.section_id = ('$_POST[section]')" : "");

$sql = "SELECT a.*,CONCAT( b.pname,' ',b.fname,' ',b.lname) AS stdName,b.pic as stdPic , g.backtime
FROM attendance as a 
LEFT JOIN `student` as b 
ON a.student_id =b.student_id
LEFT JOIN class d ON a.class_id = d.class_id 
LEFT JOIN grade e ON d.grade_id = e.grade_id 
LEFT JOIN section f ON d.section_id = f.section_id 
LEFT JOIN backhome g ON a.student_id =g.student_id AND a.date = g.backdate
WHERE $date
$grade  $section
AND d.teacher_id = $_SESSION[user_id]";
$result = mysqli_query($conn, $sql);

//echo $sql;
?>
<style>
    .table td,
    .table th {
        vertical-align: middle;
        margin-bottom: 10px;
    }
</style>


<div class="table-responsive">
    <table class="table table-hover  responsive" id="attDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>ชื่อ</th>
                <th>วันที่</th>
                <th>เวลามาเรียน</th>
                <?php
                if (isset($_POST['detail'])) {
                    echo "<th>เวลากลับ</th>";
                }
                ?>
                <th>สถานะ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($result as $row) {

                if (empty($row['stdPic'])) {
                    $src_std = 'src="images/anonymous.jpg"';
                } else {
                    $src_std = 'src="uploads/student_pics/' . $row['stdPic'] . '"';
                }

                if ($row['status'] == "มาเรียน") {
                    $status_color = "success";
                } else if ($row['status'] == "สาย") {
                    $status_color = "warning";
                } else if ($row['status'] == "ขาด") {
                    $status_color = "danger";
                } else if ($row['status'] == "ลา") {
                    $status_color = "primary";
                } else {
                    $status_color = "default";
                }

                echo '<tr>' .
                    '<td>' . $i . '</td>' .
                    '<td><div class="d-flex align-items-center">
                    <div class="avatar mr-3"><img class="avatar-img" ' . $src_std . ' ></div>
                        <div>
                            <p class="font-weight-bold mb-0">' . $row['student_id'] . '</p>
                            <p class="text-muted mb-0">' . $row['stdName'] . '</p>
                        </div>
                    </div>
                    </td>' .
                    '<td>' . $row['date'] . '</td>' .
                    '<td>' . $row['time_in'] . '</td>' ;
                    if (isset($_POST['detail'])) {
                        echo "<td>".$row['backtime']."</td>";
                    }
                    echo '<td>  
                    <div class="btn-group">
                    <button class="badge badge-'. $status_color.' dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width:85px">
                  ' . $row['status'] . '
                </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" onclick="updateStatusAtt('.$row['id'].',\'มาเรียน\'' . ')"> <button type="button" class="badge badge-success">
    มาเรียน
  </button></a>
    <a class="dropdown-item" onclick="updateStatusAtt('.$row['id'].',\'สาย\'' . ')"><button type="button" class="badge badge-warning">
    สาย
  </button></a>
    <a class="dropdown-item" onclick="updateStatusAtt('.$row['id'].',\'ลา\'' . ')"><button type="button" class="badge badge-primary">
    ลา
  </button></a>
    <a class="dropdown-item" onclick="updateStatusAtt('.$row['id'].',\'ขาด\'' . ')"><button type="button" class="badge badge-danger">
    ขาด
  </button></a>
  </div>
</div>'.
                '</tr>';
                $i++;
            }

            ?>
    </table>
</div>