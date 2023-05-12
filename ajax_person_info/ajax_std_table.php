<?php

include '../dbconfig.php';
$sql = "SELECT * FROM student ORDER BY student_id";
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
                                <table class="table table-bordered text-center" id="studentDataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>รหัสประจำตัวนักเรียน</th>
                                            <th>ชื่อ</th>
                                            <th>ตัวเลือก</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1;
                                        foreach($result as $row){
                                            echo "<tr>".
                                            "<td>". $row['student_id']."</td>".
                                            "<td>".$row['pname']." ".$row['fname']." ".$row['lname']."</td>".
                                            '<td>'.'<button class="btn btn-warning mr-5" onclick="showStdInfo('.$row['student_id'].')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-edit"></i>
                                            </span>
                                            <span class="text">แก้ไข</span></button>
                                            <button class="btn btn-danger" onclick="delStudent('.$row['student_id'].')">
                                            <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">ลบ</span></button>' .'</td>'.
                                            "</tr>";
                                        }
                                        ?>
                                </table>
                            </div>