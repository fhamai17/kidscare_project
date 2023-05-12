<?php
session_start();
include '../dbconfig.php';

$user_type = $_SESSION['type'];

$session = ($_POST['session_search'] ? "a.session_id = '" . $_POST['session_search'] . "'" : "");
$term = ($_POST['term_search'] ? "AND a.term_id = '" . $_POST['term_search'] . "'" : "");
$teacher_id = ($_SESSION['user_id'] ? "AND a.teacher_id = '" . $_SESSION['user_id'] . "'" : "");
if ($user_type === "คุณครู") {
    $teacher_id = ($_SESSION['user_id'] ? "AND a.teacher_id = '" . $_SESSION['user_id'] . "'" : "");
} else {
    $teacher_id = "";
}
$sql = "SELECT a.*,b.grade_name,c.section_name ,d.session_name,e.term_name,CONCAT(f.fname,' ',f.lname) as fullname 
FROM class a 
LEFT JOIN grade b ON a.grade_id = b.grade_id 
LEFT JOIN section c ON a.section_id = c.section_id
LEFT JOIN session d ON a.session_id = d.session_id 
LEFT JOIN term e ON a.term_id = e.term_id 
LEFT JOIN personnel f ON a.teacher_id = f.personnel_id 
WHERE $session $term $teacher_id";
echo $sql;
$result = mysqli_query($conn, $sql);
?>

<style>
    .table>tbody>tr>td,
    .table>tbody>tr>th,
    .table>tfoot>tr>td,
    .table>tfoot>tr>th,
    .table>thead>tr>td,
    .table>thead>tr>th {
        vertical-align: middle !important;
    }
</style>

<div class="table-responsive">
    <table class="table table-hover text-center responsive" id="classDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ลำดับที่</th>
                <th>ชื่อห้องเรียน</th>
                <th>ระดับชั้น</th>
                <th>ห้องเรียน</th>
                <th>ปีการศึกษา</th>
                <th>เทอม</th>
                <th>คุณครูที่ปรึกษา</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result) {

                foreach ($result as $row) {
                    echo "<tr>" .
                        "<td>" . $row['class_id'] . "</td>";
                    echo '<td><a class="collapse-item font-weight-bold" href="teacher_homework.php?class_id=' . $row["class_id"] . '&class_name=' . $row['grade_name'] . ' ห้อง ' . $row['section_name'] . '&term_id=' . $row["term_id"] . '">' . $row['class_name'] . '</a>';
                    echo "<td>" . $row['grade_name'] . "</td>" .
                        "<td>" . $row['section_name'] . "</td>" .
                        "<td>" . $row['session_name'] . "</td>" .
                        "<td>" . $row['term_name'] . "</td>" .
                        "<td>" . $row['fullname'] . "</td>" .
                        "</tr>";
                }
            }
            ?>
    </table>
</div>