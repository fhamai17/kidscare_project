<?php
session_start();

include '../dbconfig.php';
$teacher_id = $_SESSION['user_id'];
$type_user = $_SESSION['type'];
//$type = "ผู้บริหาร";

if($type_user==="คุณครู"){
$teacher = "AND c.teacher_id = ('$teacher_id')";
}else{
$teacher ="";
}

$session = $_POST['session'];
$term = ($_POST['term'] ? "AND c.term_id = ('$_POST[term]')" : "");
$class = ($_POST['class'] ? "AND c.class_id = ('$_POST[class]')" : "");
$type = ($_POST['type'] ? " AND a.type = '$_POST[type]'" : "");
if(isset($_POST['status'])){
    if($_POST['status']==="Approve"){
        $id = 'id="leaveApproveDataTable"';
        $status = " AND a.isApprove = '1'";
    }else if($_POST['status']==="Reject"){
        $status = " AND a.isApprove = '0'";
        $id = 'id="leaveRejectDataTable"';
    }else if($_POST['status']==="Pending"){
    $id = 'id="leavePendingDataTable"';
    $status = " AND a.isApprove is Null";
}else{
    $id = 'id="leaveDataTable"';
    $status = "";
}
}


$sql = "SELECT a.* ,CONCAT(b.pname,' ',b.fname,' ',b.lname) as fullname,b.pic, c.class_name
FROM student_leave a
LEFT JOIN student b ON a.student_id = b.student_id 
LEFT JOIN class c ON a.class_id = c.class_id 
WHERE c.session_id = ('$session')
$term $class $type $teacher $status";

echo $sql;
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


/*     button:disabled,
button[disabled]{
  background-color: #cccccc;
  color: #666666;
  pointer-events: none;
} */
</style>


<div class="table-responsive">
    <table class="table table-hover  responsive"  <?=$id?> width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อ-สกุล</th>
                <th>ห้อง</th>
                <th>ประเภทการลา</th>
                <th>วันที่เริ่มลา</th>
                <th>วันที่สิ้นสุด</th>
                <th>เหตุผลการลา</th>
                <th>สถานะ</th>
                <th class="text-center">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if($row['isApprove']===NULL){
                    $status = "อยู่ระหว่างรอ";
                    $status_color = "default";
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
                }

                if(empty($row['pic'])){
                    $src = 'src="images/anonymous.jpg"';
                }else{
                    $src = 'src="uploads/student_pics/' . $row['pic'] . '"';
                }
                echo '<tr>' .
                '<td>' . $row['leave_id'] . '</td>' .
                    '<td>
                        <a href="#">
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" '.$src.' ></div>
                                <div>
                                    <p class="font-weight-bold mb-0">' . $row['student_id'] . '</p>
                                    <p class="text-muted mb-0">' . $row['fullname'] . '</p>
                                </div>
                            </div>
                        </a>
                    </td>' .
                    '<td>' . $row['class_name'] . '</td>' .
                    '<td>' . $row['type'] . '</td>' .
                    '<td>' . $row['start_date'] . '</td>'.
                    '<td>' . $row['end_date'] . '</td>'.
                    '<td>' . $row['reason'] . '</td>'.
                    '<td>   <button class="badge badge-'.$status_color.'" style="width:85px" disabled>
                  '.$status.'
                </button></td>'.
                    '<td class="text-center"><button class="badge badge-primary" onclick="viewLeaveModal('.$row['leave_id'].')">
                    <span class="icon">
                    <i class="fas fa-eye"></i>
                    </span>ดู
                </button>
                        </td>' .
                    '</tr>';
            }
            ?>
    </table>
</div>