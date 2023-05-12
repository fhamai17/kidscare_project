<?php

include '../dbconfig.php';
if ($_POST['gradeID'] !== null || $_POST['gradeID'] !== '') {
    $gradeID = $_POST['gradeID'];
    $sql = "SELECT * FROM section WHERE grade_id='$gradeID'
    ORDER BY section_id";
} else {
    $sql = "SELECT * FROM section WHERE grade_id='$gradeID'
    ORDER BY section_id";
}

$result = mysqli_query($conn, $sql);

echo $sql;
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
    <table class="table table-hover  responsive" id="contentDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ห้อง</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result) {
                foreach ($result as $row) {

                    echo '<tr>' .
                        '<td>' . $row['section_id'] . '</td>' .
                        '<td>' . $row['section_name'] . '</td>' .
                        '<td>             
                        <button class="badge badge-warning" onclick="showSectionModal(' . $row['section_id'] . ',\'' . $row['section_name'] . '\',' . $row['grade_id'] . ')">
                            <span class="icon">
                            <i class="fas fa-edit"></i>
                            </span>แก้ไข
                        </button>
                        <button class="badge badge-danger" onclick="delSection(' . $row['section_id'] . ')"><span class="icon">
                            <i class="fas fa-trash"></i>
                            </span>ลบ</button>' .
                        '</td>' .
                        '</tr>';
                }
            }
            ?>
    </table>
</div>