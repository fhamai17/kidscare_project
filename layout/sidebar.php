<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<?php
include('dbconfig.php');
$type = $_SESSION['type'];
$user_id = $_SESSION['user_id'];
if ($type === "คุณครู") {
?>

    <ul class="navbar-nav bg-gradient-green sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="material-icons">child_care</i>
            </div>
            <div class="sidebar-brand-text mx-3">KIDS CARE <sup>2</sup></div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            เมนู
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>หน้าแรก</span></a>
        </li>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="approveRelation.php">
                <i class="bi bi-person-heart"></i>
                <span>ความสัมพันธ์</span></a>
        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAttendance" aria-expanded="true" aria-controls="collapseAttendance">
                <i class='fas fa-school'></i>
                <span>มาเรียน</span>
            </a>
            <div id="collapseAttendance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="teacher_attendance.php">สแกน QR CODE</a>
                    <a class="collapse-item" href="teacher_attendanceDetail.php">รายละเอียดการมาเรียน</a>
                </div>
            </div>
        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBackHome" aria-expanded="true" aria-controls="collapseBackHome">
                <i class="bi bi-people-fill"></i>
                <span>รับนักเรียนกลับบ้าน</span>
            </a>
            <div id="collapseBackHome" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="teacher_backHome.php">สแกน QR CODE</a>
                    <a class="collapse-item" href="teacher_backHomeDetail.php">รายละเอียดรับนักเรียนกลับบ้าน</a>
                </div>
            </div>
        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHomework" aria-expanded="true" aria-controls="collapseHomework">
                <i class="bi bi-book"></i>
                <span>แจ้งการบ้าน</span>
            </a>
            <?php

            $sql_t = "SELECT a.*,b.session_name
FROM term  a
LEFT JOIN session b ON a.session_id = b.session_id
WHERE a.isActive=1";
            $result_t = mysqli_query($conn, $sql_t);
            $row = mysqli_fetch_array($result_t);
            $term_id = $row['term_id'];
            $sql = "SELECT a.*, CONCAT (b.grade_name,' ห้อง ',c.section_name) as level
            FROM class a
            LEFT JOIN grade b ON a.grade_id = b.grade_id
            LEFT JOIN section  c ON a.section_id = c.section_id
            WHERE a.teacher_id = '$user_id'
            AND a.term_id = $term_id
            ORDER BY a.class_id";
            //echo $sql;
            $result = mysqli_query($conn, $sql);
            echo '  <div id="collapseHomework" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">';
            foreach ($result as $row) {
                echo '<a class="collapse-item" href="teacher_homework.php?class_id=' . $row["class_id"] . '&class_name=' . $row['level'] . '&term_id=' . $row['term_id'] . '">' . $row['class_name'] . '</a>';
            }
            echo '<a class="collapse-item" href="teacher_allClass.php">การบ้านทั้งหมด</a>';
            echo '</div></div>';
            ?>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_home.php">
                <i class="bi bi-house-fill"></i>
                <span>เยี่ยมบ้าน</span></a>
        </li>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_SDQ.php">
                <i class="bi bi-clipboard2-heart-fill"></i>
                <span>SDQ</span></a>
        </li>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_LeaveTable.php">
                <i class="bi bi-envelope-fill"></i>
                <span>ลาเรียน</span></a>
        </li>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_Notify.php">
                <i class="bi bi-megaphone"></i>
                <span>แจ้งข่าวสาร</span></a>
        </li>
        
        <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Heading -->
        <div class="sidebar-heading">
            ตั้งค่า
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="bi bi-diagram-3-fill"></i>
                <span>จัดห้องเรียน</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>





<?php
} else if ($type === "ผู้ปกครอง") {
?>

    <ul class="navbar-nav bg-gradient-green sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="material-icons">child_care</i>
            </div>
            <div class="sidebar-brand-text mx-3">KIDS CARE <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>หน้าแรก</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            เมนู
        </div>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="addRelation.php">
                <i class="bi bi-person-heart"></i>
                <span>ความสัมพันธ์</span></a>
        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAttendance" aria-expanded="true" aria-controls="collapseAttendance">
                <i class='fas fa-school'></i>
                <span>มาเรียน</span>
            </a>
            <?php
            $sql = "SELECT * FROM parent_relation a
            LEFT JOIN student as b 
            ON a.student_id =b.student_id
            WHERE a.parent_id = '$user_id' AND a.isApprove = '1'
            ORDER BY a.student_id";
            $result = mysqli_query($conn, $sql);
            echo '  <div id="collapseAttendance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">';
            foreach ($result as $row) {
                $fullname = $row["student_id"] . ' ' . $row["fname"] . ' ' . $row["lname"];
                echo '<a class="collapse-item" href="parent_checkAttendance.php?student_id=' . $row["student_id"] . '">' . $fullname . '</a>';;
            }
            echo '</div></div>';
            ?>

        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBackhome" aria-expanded="true" aria-controls="collapseBackhome">
                <i class="bi bi-people-fill"></i>
                <span>รับนักเรียนกลับบ้าน</span>
            </a>
            <?php
            $sql = "SELECT * FROM parent_relation a
            LEFT JOIN student as b 
            ON a.student_id =b.student_id
            WHERE a.parent_id = '$user_id' AND a.isApprove = '1'
            ORDER BY a.student_id";
            $result = mysqli_query($conn, $sql);
            echo '  <div id="collapseBackhome" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">';
            echo '<a class="collapse-item" href="parent_backHome.php">คำร้องของฉัน</a>';
            foreach ($result as $row) {
                $fullname = $row["student_id"] . ' ' . $row["fname"] . ' ' . $row["lname"];
                echo '<a class="collapse-item" href="parent_backHome.php?student_id=' . $row["student_id"] . '">' . $fullname . '</a>';;
            }
            echo '</div></div>';
            ?>

        </li>

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseHome" aria-expanded="true" aria-controls="collapseHome">
            <i class="bi bi-house-fill"></i>
                <span>เยี่ยมบ้าน</span>
            </a>
            <?php
            $sql = "SELECT * FROM parent_relation a
            LEFT JOIN student as b 
            ON a.student_id =b.student_id
            WHERE a.parent_id = '$user_id' AND a.isApprove = '1'
            ORDER BY a.student_id";
            $result = mysqli_query($conn, $sql);
            echo '  <div id="collapseHome" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">';
            foreach ($result as $row) {
                $fullname = $row["student_id"] . ' ' . $row["fname"] . ' ' . $row["lname"];
                echo '<a class="collapse-item" href="parent_home.php?student_id=' . $row["student_id"] . '">' . $fullname . '</a>';;
            }
            echo '</div></div>';
            ?>

        </li>
        
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSDQ" aria-expanded="true" aria-controls="collapseSDQ">
                <i class="bi bi-clipboard2-heart-fill"></i>
                <span>SDQ</span>
            </a>
            <?php
            $sql = "SELECT * FROM parent_relation a
LEFT JOIN student as b 
ON a.student_id =b.student_id
WHERE a.parent_id = '$user_id' AND a.isApprove = '1'
 ORDER BY a.student_id";
            $result = mysqli_query($conn, $sql);
            echo '  <div id="collapseSDQ" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">';
            foreach ($result as $row) {
                $fullname = $row["student_id"] . ' ' . $row["fname"] . ' ' . $row["lname"];
                echo '<a class="collapse-item" href="parent_SDQ.php?student_id=' . $row["student_id"] . '">' . $fullname . '</a>';;
            }
            echo '</div></div>';
            ?>

        </li>



        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLeave" aria-expanded="true" aria-controls="collapseLeave">
                <i class="bi bi-envelope-fill"></i>
                <span>ลาเรียน</span>
            </a>
            <?php
            $sql = "SELECT * FROM parent_relation a
LEFT JOIN student as b 
ON a.student_id =b.student_id
WHERE a.parent_id = '$user_id' AND a.isApprove = '1'
 ORDER BY a.student_id";
            $result = mysqli_query($conn, $sql);
            echo '  <div id="collapseLeave" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">';
            echo '<a class="collapse-item" href="parent_leaveTable.php">คำลาของฉัน</a>';;
            foreach ($result as $row) {
                $fullname = $row["student_id"] . ' ' . $row["fname"] . ' ' . $row["lname"];
                echo '<a class="collapse-item" href="parent_leaveTable.php?student_id=' . $row["student_id"] . '">' . $fullname . '</a>';;
            }
            echo '</div></div>';
            ?>

        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="parent_qrcode.php">
                <i class="bi bi-person-heart"></i>
                <span>QR CODE ของฉัน</span></a>
        </li>


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
<?php
} else if ($type === "ฝ่ายบริหาร") {
?>
    <ul class="navbar-nav bg-gradient-green sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="material-icons">child_care</i>
            </div>
            <div class="sidebar-brand-text mx-3">KIDS CARE <sup>2</sup></div>
        </a>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            เมนู
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>หน้าแรก</span></a>
        </li>






        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="approveRelation.php">
                <i class="bi bi-person-heart"></i>
                <span>ความสัมพันธ์</span></a>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_attendanceDetail.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>มาเรียน</span></a>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_backHomeDetail.php">
                <i class="bi bi-people-fill"></i>
                <span>รับนักเรียนกลับบ้าน</span></a>
        </li>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_allClass.php">
                <i class="bi bi-book"></i>
                <span>การบ้านนักเรียน</span></a>
        </li>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_home.php">
                <i class="bi bi-house-fill"></i>
                <span>เยี่ยมบ้าน</span></a>
        </li>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_SDQ.php">
                <i class="bi bi-clipboard2-heart-fill"></i>
                <span>SDQ</span></a>
        </li>


        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="teacher_LeaveTable.php">
                <i class="bi bi-envelope-fill"></i>
                <span>ลาเรียน</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">


        <!-- Heading -->
        <div class="sidebar-heading">
            ตั้งค่า
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="index.php">
                <i class="bi bi-diagram-3-fill"></i>
                <span>จัดห้องเรียน</span></a>
        </li>


        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="bi bi-person-fill-gear"></i>
                <span>จัดการข้อมูลบุคคล</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="admin_mn_student.php">ข้อมูลนักเรียน</a>
                    <a class="collapse-item" href="admin_mn_parent.php">ข้อมูลผู้ปกครอง</a>
                    <a class="collapse-item" href="admin_mn_personnel.php">ข้อมูลบุคลากร</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="bi bi-gear-fill"></i>
                <span>จัดการข้อมูลพื้นฐาน</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="admin_mn_session.php">ข้อมูลปีการศึกษา</a>
                    <a class="collapse-item" href="admin_mn_term.php">ข้อมูลเทอม</a>
                    <a class="collapse-item" href="admin_mn_grade.php">ข้อมูลระดับชั้น</a>
                    <a class="collapse-item" href="admin_mn_section.php">ข้อมูลห้อง</a>
                    <a class="collapse-item" href="admin_mn_class.php">ข้อมูลห้องเรียน</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>




<?php
} else {
?>
    <ul class="navbar-nav bg-gradient-green sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="material-icons">child_care</i>
            </div>
            <div class="sidebar-brand-text mx-3">KIDS CARE <sup>2</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>แดชบอร์ด</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading -->
        <div class="sidebar-heading">
            เมนู
        </div>

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="admin_mn_class.php">
                <i class="bi bi-diagram-3-fill"></i>
                <span>จัดห้องเรียน</span></a>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            ตั้งค่า
        </div>



        <!--Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="bi bi-person-fill-gear"></i>
                <span>จัดการข้อมูลบุคคล</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="admin_mn_student.php">ข้อมูลนักเรียน</a>
                    <a class="collapse-item" href="admin_mn_parent.php">ข้อมูลผู้ปกครอง</a>
                    <a class="collapse-item" href="admin_mn_personnel.php">ข้อมูลคุณครู</a>

                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="bi bi-gear-fill"></i>
                <span>จัดการข้อมูลพื้นฐาน</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="admin_mn_school.php">ข้อมูลโรงเรียน</a>
                    <a class="collapse-item" href="admin_mn_session.php">ข้อมูลปีการศึกษา</a>
                    <a class="collapse-item" href="admin_mn_term.php">ข้อมูลเทอม</a>
                    <a class="collapse-item" href="admin_mn_grade.php">ข้อมูลระดับชั้น</a>
                    <a class="collapse-item" href="admin_mn_section.php">ข้อมูลห้อง</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
<?php
}

$conn->close();
?>