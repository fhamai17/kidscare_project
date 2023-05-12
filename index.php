<?php
session_start();
$user_type = $_SESSION['type'];

echo $user_type;
if ($user_type === "คุณครู" ||$user_type === "ฝ่ายบริหาร") {
   echo '<script type="text/javascript">
            window.location="index_teacher.php";
        </script>';
} else if ($user_type === "ผู้ปกครอง") {
    echo '<script type="text/javascript">
    window.location="index_parent.php";
</script>';
}
else {
    echo '<script type="text/javascript">
            window.location="index_admin.php";
        </script>';
}

?>