<?php

include '../dbconfig.php';

$class_id = $_POST["class_id"];
$sql_g = "SELECT grade_id FROM
class WHERE class_id = '$class_id'";
$result_g = mysqli_query($conn, $sql_g);
$row = mysqli_fetch_array($result_g);
$grade_id = $row['grade_id'];

$sql = "SELECT a.student_id,a.pic, a.pname, a.fname, a.lname, b.grade_name
FROM `student` 
as a LEFT JOIN `grade` as b 
ON a.grade_id =b.grade_id
WHERE a.status = 'กำลังศึกษา' AND a.grade_id  = $grade_id  ";
$result = mysqli_query($conn, $sql);

?>
<style>
    .badge {
        width: 75px;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
    }

    .badge-success {
        background-color: #d7f2c2;
        color: #7bd235;
    }

    .badge-default {
        background-color: #000;
        color: #fff;
    }

    .badge-warning {
        background-color: #FFB26B;
        color: #FF7B54;
    }

    .badge-warning:hover {
        background-color: #FF6E31;
        color: #FFB26B;
    }


    .badge-danger {
        background-color: #FD8A8A;
        color: #DC0000;
    }

    .badge-danger:hover {
        background-color: #DC0000;
        color: #FD8A8A;
    }

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
    <table class="table table-hover  responsive" id="studentListDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th></th>
                <th>ชื่อ</th>
                <th>ระดับชั้น</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if(empty($row['pic'])){
                    $src = 'src="images/anonymous.jpg"';
                }else{
                    $src = 'src="uploads/student_pics/' . $row['pic'] . '"';
                }
                echo '<tr>' .
                '<td>
                <input type="checkbox" class="stdCheck" value="'.$row['student_id'].'">
                </td>'.
                    '<td>
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" '.$src.' ></div>
                                <div>
                                    <p class="font-weight-bold mb-0">' . $row['student_id'] . '</p>
                                    <p class="text-muted mb-0">' . $row['pname'] . " " . $row['fname'] . " " . $row['lname'] . '</p>
                                </div>
                            </div>
                    </td>' .
                    '<td>' . $row['grade_name'] . '</td>' .
                    '</tr>';
            }
            ?>
    </table>
</div>