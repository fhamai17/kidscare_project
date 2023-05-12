<?php
session_start();
include '../dbconfig.php';
$sql = "SELECT a.* , 
CONCAT( b.pname,' ',b.fname,' ',b.lname) AS teacherName ,b.pic as teacherPic, 
CONCAT( c.pname,' ',c.fname,' ',c.lname) AS stdName, c.pic as stdPic , 
d.grade_name as grade
FROM parent_relation as a 
LEFT JOIN personnel b ON a.teacher_id = b.personnel_id 
LEFT JOIN student c ON a.student_id = c.student_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
WHERE a.parent_id = '$_SESSION[user_id]'
ORDER BY a.id desc;";
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


</style>


<div class="table-responsive">
    <table class="table table-hover  responsive" id="relationDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อ-สกุลนักเรียน</th>
                <th>สถานะ</th>
                <th>หมายเหตุ</th>
                <th>ผู้อนุมัติ</th>
                <th>เวลาอนุมัติ</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if(empty($row['stdPic'])){
                    $src_std = 'src="images/anonymous.jpg"';
                }else{
                    $src_std = 'src="uploads/student_pics/' . $row['stdPic'] . '"';
                }


                if(empty($row['teacherPic'])){
                    $src_teacher = 'src="images/anonymous.jpg"';
                }else{
                    $src_teacher = 'src="uploads/teacher_pics/' . $row['teacherPic'] . '"';
                }

                if($row['isApprove']===NULL){
                    $status = "อยู่ระหว่างรอ";
                    $status_color = "dark";
                    $button = '<button class="badge badge-warning" onclick="showRelationModal('.$row['id'].',\''.$row['parent_id'].'\',\''.$row['student_id'].'\',\''.$row['relation'].'\',\'Edit\''.')">
                    <span class="icon">
                    <i class="fas fa-edit"></i>
                    </span>แก้ไข
                </button>
                <button class="badge badge-danger" onclick="delRelation('.$row['id'].')"><span class="icon">
                    <i class="fas fa-trash"></i>
                    </span>ลบ</button>';
                    $teacher = '';
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
                    $button = '<button class="badge badge-primary" onclick="showRelationModal('.$row['id'].',\''.$row['parent_id'].'\',\''.$row['student_id'].'\',\''.$row['relation'].'\',\'View\''.')">
                        <span class="icon">
                        <i class="fas fa-eye"></i>
                        </span>ดู
                    </button>';

                    $teacher='<div class="d-flex align-items-center">
                    <div class="avatar mr-3"><img class="avatar-img" '.$src_teacher.' ></div>
                        <div>
                            <p class="text-muted mb-0">' . $row['teacherName'] . '</p>
                        </div>';
                }

                echo '<tr>' .
                    '<td>'.$row['id'].'</td>'.
                    '<td>  <div class="d-flex align-items-center">
                    <div class="avatar mr-3"><img class="avatar-img" '.$src_std.' ></div>
                        <div>
                            <p class="font-weight-bold mb-0">' . $row['student_id'] . '</p>
                            <p class="text-muted mb-0">' . $row['stdName'] . '</p>
                        </div>
                    </div>
                    </td>'.
                    '<td>   <button class="badge badge-'.$status_color.'" style="width:85px" disabled>
                    '.$status.'
                  </button></td>'.
                    '<td>'.$row['remark'].'</td>'.
                    '<td>'.$teacher.'
                    </td>'.
                    '<td>'.$row['approve_time'].'</td>'.
                    '<td>'.$button.'</td>'.
                    '</tr>';
            }
            ?>
    </table>
</div>