<?php
session_start();

include '../dbconfig.php';
$parent_id = $_SESSION['user_id'];
if (($_POST['student_id'])) {
    $clause = 'WHERE a.student_id = "' . $_POST['student_id'] . '"';
} else {
    $clause = 'WHERE a.parent_id = "' . $parent_id . '"';
}

if (!empty($_POST['date'])) {
    $date = "AND '$_POST[date]' BETWEEN a.start_date and a.end_date";
} else {
    $date = "";
}


$sql = "SELECT a.* ,CONCAT(b.pname,' ',b.fname,' ',b.lname) as fullname, b.pic,d.grade_name
FROM student_leave a
LEFT JOIN student b ON a.student_id = b.student_id 
LEFT JOIN class c ON a.class_id = c.class_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id
$clause $date";
$result = mysqli_query($conn, $sql);
//echo $sql;
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

    .table td:not(:first-child),.table th:not(:first-child){
   text-align: center;
}


/*     button:disabled,
button[disabled]{
  background-color: #cccccc;
  color: #666666;
  pointer-events: none;
} */
</style>


<div class="table-responsive">
    <table class="table table-hover  responsive" id="leaveDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อ-สกุล</th>
                <th>ระดับชั้น</th>
                <th>วันที่เริ่มต้น</th>
                <th>วันที่สิ้นสุด</th>
                <th>สถานะ</th>
                <th>หมายเหตุ</th>
                <th class="text-center">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if($row['isApprove']===NULL){
                    $status = "อยู่ระหว่างรอ";
                    $status_color = "default";
                    $button = '<button class="badge badge-warning" onclick="editOrViewLeave('.$row['leave_id'].')">
                    <span class="icon">
                    <i class="fas fa-edit"></i>
                    </span>แก้ไข
                </button>
                <button class="badge badge-danger" onclick="delLeave('.$row['leave_id'].')"><span class="icon">
                    <i class="fas fa-trash"></i>
                    </span>ลบ</button>';
                }
                else
                {
                    if ($row['isApprove'] == true) {
                        $status = "ได้รับการอนุมัติ";
                        $status_color = "success";
                    } else if ($row['isApprove'] == false) {
                        $status = "ไม่ได้รับการอนุมัติ";
                        $status_color = "danger";
                        
                    }

                    $button = '<button class="badge badge-primary" onclick="editOrViewLeave('.$row['leave_id'].')">
                    <span class="icon">
                    <i class="fas fa-eye"></i>
                    </span>ดู
                </button>';
                }

                if(empty($row['pic'])){
                    $src = 'src="images/anonymous.jpg"';
                }else{
                    $src = 'src="uploads/student_pics/' . $row['pic'] . '"';
                }
                echo '<tr>' .
                '<td>' . $row['leave_id'] . '</td>' .
                    '<td>
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" '.$src.' ></div>
                                <div>
                                    <p class="font-weight-bold mb-0">' . $row['student_id'] . '</p>
                                    <p class="text-muted mb-0">' . $row['fullname'] . '</p>
                                </div>
                            </div>
                    </td>' .
                    '<td>' . $row['grade_name'] . '</td>' .
                    '<td>' . $row['start_date'] . '</td>'.
                    '<td>' . $row['end_date'] . '</td>'.
                    '<td>   <button class="badge badge-'.$status_color.'" disabled>
                  '.$status.'
                </button></td>'.
                    '<td>' . $row['remark'] . '</td>'.
                    '<td class="text-center">
          '.$button.
                        '</td>' .
                    '</tr>';
            }
            ?>
    </table>
</div>