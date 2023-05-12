<?php

include '../dbconfig.php';
$id = 'id="personnelDataTable"';
$type = "";
if(isset($_POST['type'])){
    if($_POST['type']==="teacher"){
        $id = 'id="teacherDataTable"';
        $type = "WHERE type = 'คุณครู'";
    }else if($_POST['type']==="exclusive"){
        $type = "WHERE type = 'ฝ่ายบริหาร'";
        $id = 'id="exclusiveDataTable"';
    }else if($_POST['type']==="admin"){
    $id = 'id="adminDataTable"';
    $type = "WHERE type = 'ผู้ดูแลระบบ'";
}
}

$sql = "SELECT * FROM personnel $type ORDER BY personnel_id ASC";
$result = mysqli_query($conn, $sql);
?>

<div class="table-responsive">
    <table class="table table-hover  responsive" <?=$id?> width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อ</th>
                <th>ประเภทบุคลากร</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if(empty($row['pic'])){
                    $src = 'src="images/anonymous.jpg"';
                }else{
                    $src = 'src="uploads/personnel_pics/' . $row['pic'] . '"';
                }
                echo '<tr>' .
                    '<td>'.$row['personnel_id'].'</td>'.
                    '<td>
                        <a href="#">
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" '.$src.' ></div>'.
                                '<p class="font-weight-bold mb-0" onclick="location.href=\''.'personnel_info.php?personnel_id='. $row['personnel_id'] . '\'">' . $row['pname'] . " " . $row['fname'] . " " . $row['lname'] . '</p>
                            </div>
                        </a>
                    </td>' .
                    '<td>'.$row['type'].'</td>'.
                    '<td>             
                        <button class="badge badge-warning" onclick="location.href=\''.'personnel_info.php?personnel_id='. $row['personnel_id'] . '\'">
                            <span class="icon">
                            <i class="fas fa-edit"></i>
                            </span>แก้ไข
                        </button>
                        <button class="badge badge-danger" onclick="delPersonnel('.$row['personnel_id'].')"><span class="icon">
                            <i class="fas fa-trash"></i>
                            </span>ลบ</button>' . 
                        '</td>' .
                    '</tr>';
            }
            ?>
    </table>
</div>