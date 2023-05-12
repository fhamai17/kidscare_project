<?php

include '../dbconfig.php';

$session = ($_POST['session_search'] ? "a.session_id = '".$_POST['session_search']."'" : "");
$term = ($_POST['term_search'] ? "AND a.term_id = '".$_POST['term_search']."'" : "");
$grade = ($_POST['grade_search'] ? "AND a.grade_id = '".$_POST['grade_search']."'" : "");

$sql = "SELECT a.*,b.grade_name,c.section_name ,d.session_name,e.term_name,CONCAT(f.fname,' ',f.lname) as fullname 
FROM class a 
LEFT JOIN grade b ON a.grade_id = b.grade_id 
LEFT JOIN section c ON a.section_id = c.section_id
LEFT JOIN session d ON a.session_id = d.session_id 
LEFT JOIN term e ON a.term_id = e.term_id 
LEFT JOIN personnel f ON a.teacher_id = f.personnel_id 
WHERE $session $term $grade";
//echo $sql;
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
                                <table class="table table-hover text-center responsive"  id="classDataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ลำดับที่</th>
                                            <th>ชื่อห้องเรียน</th>
                                            <th>ระดับชั้น</th>
                                            <th>ห้องเรียน</th>
                                            <th>ปีการศึกษา</th>
                                            <th>เทอม</th>
                                            <th>คุณครูที่ปรึกษา</th>
                                            <th>ตัวเลือก</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($result){

                                            foreach($result as $row){
                                                echo "<tr>".
                                                "<td>". $row['class_id']."</td>".
                                                "<td>"."<b><a href='admin_mn_class_detail.php?class_id=".$row['class_id']."'>".$row['class_name']."</a></b>"."</td>".
                                                "<td>".$row['grade_name']."</td>".
                                                "<td>".$row['section_name']."</td>".
                                                "<td>".$row['session_name']."</td>".
                                                "<td>".$row['term_name']."</td>".
                                                "<td>".$row['fullname']."</td>".
                                                '<td>'.'<button class="badge badge-warning" onclick="showClassModal('.$row['class_id'].',\''.$row['class_name'].'\','.$row['grade_id'].','.$row['section_id'].','.$row['session_id'].','.$row['term_id'].','.$row['teacher_id'].',\''.$row['token'].'\')">
                                                    <i class="fas fa-edit"></i>
                                                <span class="text">แก้ไข</span></button>
                                                <button class="badge badge-danger" onclick="delClass('.$row['class_id'].')">
                                                <i class="fas fa-trash"></i>
                                                <span class="text">ลบ</span></button>' .'</td>'.
                                                "</tr>";
                                            }

                                        }
                                        ?>
                                </table>
                            </div>