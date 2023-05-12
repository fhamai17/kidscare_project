<?php

include '../dbconfig.php';
$sql = "SELECT a.student_id,a.pic, a.pname, a.fname, a.lname,a.status,b.grade_name FROM `student` 
as a LEFT JOIN `grade` as b 
ON a.grade_id =b.grade_id";
$result = mysqli_query($conn, $sql);

?>
<style>
    .avatar {
        width: 2.75rem;
        height: 2.75rem;
        line-height: 3rem;
        border-radius: 50%;
        display: inline-block;
        background: transparent;
        position: relative;
        text-align: center;
        color: #868e96;
        font-weight: 700;
        vertical-align: bottom;
        font-size: 1rem;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        -o-object-fit: cover;
        object-fit: cover;
    }


    .table td,
    .table th {
        vertical-align: middle;
        margin-bottom: 10px;
    }


</style>


<div class="table-responsive">
    <table class="table table-hover  responsive" id="studentDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th>ระดับชั้น</th>
                <th>สถานะ</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if(empty($row['status'])){
                    $color ="default";
                    $status = "N/A";
                }else{
                    $status = $row['status'];
                    if($status==="กำลังศึกษา"){
                        $color ="success";
                    }else if($status==="จบการศึกษา"){
                        $color ="danger";
                    }else{
                        $color ="warning";
                    }
                    
                }

                if(empty($row['pic'])){
                    $src = 'src="images/anonymous.jpg"';
                }else{
                    $src = 'src="uploads/student_pics/' . $row['pic'] . '"';
                }
                echo '<tr>' .
                    '<td>
                        <a href="#">
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" '.$src.' ></div>
                                <div>
                                    <p class="font-weight-bold mb-0">' . $row['student_id'] . '</p>
                                    <p class="text-muted mb-0">' . $row['pname'] . " " . $row['fname'] . " " . $row['lname'] . '</p>
                                </div>
                            </div>
                        </a>
                    </td>' .
                    '<td>' . $row['grade_name'] . '</td>' .
                    '<td>'.
                    '<span class="badge badge-'.$color.'" disabled>'.
                           $status
                        .'</span>
                    </td>' .
                    '<td>             
                        <button class="badge badge-warning" onclick="location.href=\''.'student_edit_info.php?student_id='. $row['student_id'] . '\'">
                            <span class="icon">
                            <i class="fas fa-edit"></i>
                            </span>แก้ไข
                        </button>
                        <button class="badge badge-danger" onclick="delStudent(\''.$row['student_id'].'\')"><span class="icon">
                            <i class="fas fa-trash"></i>
                            </span>ลบ</button>' . 
                        '</td>' .
                    '</tr>';
            }
            ?>
    </table>
</div>