<?php
include '../dbconfig.php';
if (isset($_POST['student_id'])) {

    if (is_array($_POST['student_id'])) {
        $std_array = $_POST['student_id'];
    } 
    else 
    {
        $std_array = array($_POST['student_id']);
    }


?>


    <div class="table-responsive">
        <table class="table table-hover  responsive" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>ชื่อ</th>
                    <th>ระดับชั้น</th>
                    <th>ห้อง</th>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($std_array as $value) {
                    $sql = "SELECT a.* ,d.grade_name,e.section_name
    FROM student a
    LEFT JOIN student b ON a.student_id = b.student_id 
    LEFT JOIN class c ON a.class_id = c.class_id 
    LEFT JOIN grade d ON c.grade_id = d.grade_id 
    LEFT JOIN section e ON c.section_id = e.section_id
    WHERE a.student_id = '$value'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($result);
                    if (empty($row['pic'])) {
                        $src = 'src="images/anonymous.jpg"';
                    } else {
                        $src = 'src="uploads/student_pics/' . $row['pic'] . '"';
                    }
                    echo '<tr>' .
                        '<td>
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" ' . $src . ' ></div>
                                <div>
                                    <p class="font-weight-bold mb-0">' . $row['student_id'] . '</p>
                                    <p class="text-muted mb-0">' . $row['pname'] . " " . $row['fname'] . " " . $row['lname'] . '</p>
                                </div>
                            </div>
                    </td>' .
                        '<td>' . $row['grade_name'] . '</td>' .
                        '<td>' . $row['section_name'] . '' .
                        '</tr>';
                }

                ?>
        </table>
    <?php
} else {
    exit();
}
    ?>