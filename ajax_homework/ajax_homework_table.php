<?php
session_start();

include '../dbconfig.php';
$teacher_id = $_SESSION['user_id'];

$class = ($_POST['class_id'] ? "WHERE a.class_id = ('$_POST[class_id]')" : "");
$end_date = ($_POST['end_date'] ? "AND a.end_date = ('$_POST[end_date]')" : "");

$sql = "SELECT a.*,CONCAT( c.pname,' ',c.fname,' ',c.lname) AS teacher_name
FROM homework a
LEFT JOIN class b ON a.class_id = b.class_id
LEFT JOIN personnel c ON a.teacher_id = c.personnel_id $class $end_date";
//echo $sql;
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

    .table td:not(:nth-child(2)),.table th:not(:nth-child(2)){
   text-align: center;
}
</style>


<div class="table-responsive">
    <table class="table table-hover  responsive" id="homeworkDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>หัวเรื่อง</th>
                <th>รายละเอียด</th>
                <th>วันที่สั่ง</th>
                <th>วันที่ส่ง</th>
                <th>คุณครู</th>
                <th class="text-center">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
 if($result){
            foreach ($result as $row) {
                echo '<tr>'.
                    '<td>' . $row['homework_id'] . '</td>' .
                    '<td>' . $row['topic'] . '</td>' .
                    '<td>' . $row['description'] . '</td>'.
                    '<td>' . $row['start_date'] . '</td>'.
                    '<td>' . $row['end_date'] . '</td>'.
                    '<td>' . $row['teacher_name'] . '</td>'.
                    '<td class="text-center"><button class="badge badge-warning" onclick="showHomeworkModal('.$row['homework_id'].',\''.$row['topic'].'\',\''.$row['description'].'\',\''.$row['start_date'].'\',\''.$row['end_date'].'\''.')">
                    <i class="fas fa-edit"></i>
                <span class="text">แก้ไข</span></button>
                <button class="badge badge-danger" onclick="delHomework('.$row['homework_id'].')">
                <i class="fas fa-trash"></i>
                <span class="text">ลบ</span></button>' .'</td>' .
                    '</tr>';

        }
    }
            ?>
             </tbody>
    </table>
</div>