<?php

include '../dbconfig.php';
$sql = "SELECT * FROM parent ORDER BY parent_id ASC";
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
    <table class="table table-hover  responsive" id="parentDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อ</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if(empty($row['pic'])){
                    $src = 'src="images/anonymous.jpg"';
                }else{
                    $src = 'src="uploads/parent_pics/' . $row['pic'] . '"';
                }
                echo '<tr>' .
                    '<td>'.$row['parent_id'].'</td>'.
                    '<td>
                        <a href="#">
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" '.$src.' ></div>'.
                                '<p class="font-weight-bold mb-0" onclick="location.href=\''.'adminParentForm.php?parent_id='. $row['parent_id'] . '\'">' . $row['pname'] . " " . $row['fname'] . " " . $row['lname'] . '</p>
                            </div>
                        </a>
                    </td>' .
                    '<td>             
                        <button class="badge badge-warning" onclick="location.href=\''.'adminParentForm.php?parent_id='. $row['parent_id'] . '\'">
                            <span class="icon">
                            <i class="fas fa-edit"></i>
                            </span>แก้ไข
                        </button>
                        <button class="badge badge-danger" onclick="delParent('.$row['parent_id'].')"><span class="icon">
                            <i class="fas fa-trash"></i>
                            </span>ลบ</button>' . 
                        '</td>' .
                    '</tr>';
            }
            ?>
    </table>
</div>