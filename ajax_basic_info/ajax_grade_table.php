<?php

include '../dbconfig.php';
$sql = "SELECT * FROM grade";
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
                                <table class="table table-hover text-center responsive" id="gradeDataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ลำดับที่</th>
                                            <th>ระดับชั้น</th>
                                            <th>เพิ่มเติม</th>
                                            <th>ตัวเลือก</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                        foreach($result as $row){
                                            echo "<tr>".
                                            "<td>". $row['grade_id']."</td>".
                                            "<td>".$row['grade_name']."</td>".
                                            "<td>".$row['description']."</td>".
                                            '<td>'.'<button class="badge badge-warning" onclick="showGradeModal('.$row['grade_id'].',\''.$row['grade_name'].'\',\''.$row['description'].'\')">
                                                <i class="fas fa-edit"></i>
                                            <span class="text">แก้ไข</span></button>
                                            <button class="badge badge-danger" onclick="delGrade('.$row['grade_id'].')">
                                            <i class="fas fa-trash"></i>
                                            <span class="text">ลบ</span></button>' .'</td>'.
                                            "</tr>";
                                            $i++;
                                        }
                                        ?>
                                </table>
                            </div>