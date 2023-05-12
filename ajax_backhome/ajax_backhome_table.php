<?php
session_start();
include '../dbconfig.php';
if (($_POST['student_id'])) {
    $clause = 'WHERE a.student_id = "' . $_POST['student_id'] . '"';
} else {
    $clause = 'WHERE a.parent_id = "' . $_SESSION['user_id'] . '"';
}

if (!empty($_POST['date'])) {
    $date = 'AND a.backdate = "' . $_POST['date'] . '"';
}else{
    $date = '';
}
$sql = "SELECT a.* , 
CONCAT( b.pname,' ',b.fname,' ',b.lname) AS parentName ,b.pic as parentPic, 
CONCAT( c.pname,' ',c.fname,' ',c.lname) AS stdName, c.pic as stdPic , 
d.grade_name as grade , e.relation
FROM backhome as a 
LEFT JOIN parent b ON a.parent_id = b.parent_id 
LEFT JOIN student c ON a.student_id = c.student_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
LEFT JOIN parent_relation e ON a.parent_id = e.parent_id 
AND a.student_id = e.student_id  AND e.isApprove = 1 
$clause $date
ORDER BY a.id desc;";
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
</style>


<div class="table-responsive">
    <table class="table table-hover  responsive" id="backhomeDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>วันที่</th>
                <th>ชื่อ-สกุลนักเรียน</th>
                <th>สถานะ</th>
                <th>คนมารับกลับ</th>
                <th>เกี่ยวข้องเป็น</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if (empty($row['stdPic'])) {
                    $src_std = 'src="images/anonymous.jpg"';
                } else {
                    $src_std = 'src="uploads/student_pics/' . $row['stdPic'] . '"';
                }


                if (empty($row['parentPic'])) {
                    $src_parent = 'src="images/anonymous.jpg"';
                } else {
                    $src_parent = 'src="uploads/parent_pics/' . $row['parentPic'] . '"';
                }


                $parent = '<div class="d-flex align-items-center">
                <div class="avatar mr-3"><img class="avatar-img" ' . $src_parent . ' ></div>
                    <div>
                        <p class="text-muted mb-0">' . $row['parentName'] . '</p>
                    </div>';

                if ($row['isBack'] === NULL) {
                    $status = "ยังไม่มารับ";
                    $status_color = "dark";
                    if ($row['parent_id'] === $_SESSION['user_id']) {

                        $button = '<button class="badge badge-warning" onclick="showBackHomeModal(' . $row['id'] . ',\'' . $row['backdate'] . '\',\'' . $row['student_id'] . '\',\'Edit\'' . ')">
                    <span class="icon">
                    <i class="fas fa-edit"></i>
                    </span>แก้ไข
                </button>
                <button class="badge badge-danger" onclick="delBackHome(' . $row['id'] . ')"><span class="icon">
                    <i class="fas fa-trash"></i>
                    </span>ลบ
                    </button>';
                    } else {
                        $button = '<button class="badge badge-primary" onclick="showBackHomeModal(' . $row['id'] . ',\'' . $row['backdate'] . '\',\'' . $row['student_id'] . '\'' . ')">
                        <span class="icon">
                        <i class="fas fa-eye"></i>
                        </span>ดู
                    </button>';
                    }
                } else {
                    if ($row['isBack'] == true) {
                        $status = "มารับแล้ว";
                        $status_color = "success";
                    } else if ($row['isBack'] == false) {
                        $status = "ไม่ได้รับมารับ";
                        $status_color = "danger";
                    }
                    $button = '<button class="badge badge-primary" onclick="showBackHomeModal(' . $row['id'] . ',\'' . $row['backdate'] . '\',\'' . $row['student_id'] . '\'' . ')">
                        <span class="icon">
                        <i class="fas fa-eye"></i>
                        </span>ดู
                    </button>';
                }

                echo '<tr>' .
                    '<td>' . $row['id'] . '</td>' .
                    '<td>' . $row['backdate'] . '</td>' .
                    '<td>  <div class="d-flex align-items-center">
                    <div class="avatar mr-3"><img class="avatar-img" ' . $src_std . ' ></div>
                        <div>
                            <p class="font-weight-bold mb-0">' . $row['student_id'] . '</p>
                            <p class="text-muted mb-0">' . $row['stdName'] . '</p>
                        </div>
                    </div>
                    </td>' .
                    '<td>   <button class="badge badge-' . $status_color . '" style="width:85px" disabled>
                    ' . $status . '
                  </button></td>' .
                    '<td>' . $parent . '</td>' .
                    '<td>' . $row['relation'] . '</td>' .
                    '<td>' . $button . '</td>' .
                    '</tr>';
            }
            ?>
    </table>
</div>