<?php

include '../dbconfig.php';
if ($_POST['session_id'] !== null || $_POST['session_id'] !== '') {
    $session_id = $_POST['session_id'];
    $sql = "SELECT * FROM term WHERE session_id='$session_id'
    ORDER BY session_id";
} else {
    exit();
}

$result = mysqli_query($conn, $sql);
//echo $sql;
?>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .switch .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .switch .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .switch .slider.round {
        border-radius: 34px;
    }

    .switch .slider.round.round:before {
        border-radius: 50%;
    }

    .switch.active .slider {
        background-color: #2196F3;
    }

    .switch.active .slider {
        -webkit-box-shadow: 0 0 1px #2196F3;
        -moz-box-shadow: 0 0 1px #2196F3;
        -ms-box-shadow: 0 0 1px #2196F3;
    }

    .switch.active .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
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
    <table class="table table-hover  responsive" id="contentDataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>เทอม</th>
                <th>วันที่เริ่มต้น</th>
                <th>วันที่สิ้นสุด</th>
                <th>สถานะ</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($result as $row) {
                    if ($row['isActive'] === NULL) {
                        $active = "";
                    } else {
                        if ($row['isActive'] == true) {
                            $active = "active";
                        } else if ($row['isActive'] == false) {
                            $active = "";
                        }
                    }

                    echo '<tr>' .
                        '<td>' . $row['term_id'] . '</td>' .
                        '<td>' . $row['term_name'] . '</td>' .
                        '<td>' . $row['start_date'] . '</td>' .
                        '<td>' . $row['end_date'] . '</td>' .
                        '<td><label class="switch ' . $active . '">
                        <input type="checkbox" value="'.$row['term_id'].'">
                        <span class="slider"></span>
                        </label></td>' .
                        '<td>             
                        <button class="badge badge-warning" onclick="showTermModal(' . $row['term_id'] . ' ,' . $row['session_id'] . ',' . $row['term_name'] . ',\'' . $row['start_date'] . '\',\'' . $row['end_date'] . '\')">
                            <span class="icon">
                            <i class="fas fa-edit"></i>
                            </span>แก้ไข
                        </button>
                        <button class="badge badge-danger" onclick="delTerm(' . $row['term_id'] . ')"><span class="icon">
                            <i class="fas fa-trash"></i>
                            </span>ลบ</button>' .
                        '</td>' .
                        '</tr>';
                }
            ?>
    </table>
</div>


<script>
    $(function() {
        $('.switch input').on("click", function() {

            
            $.ajax({
            type: 'POST',
            url: 'ajax_term/ajax_term_active.php',
            data: {term_id:  $(this).val()},
            success: function(res) {
                console.log("Res : " + res);
                $(this).parent().toggleClass('active');
                showSessionTabContent(session_active)
            }
        });

        });
    });

 
</script>