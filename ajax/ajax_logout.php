<?php
print_r($_GET);
if(isset($_GET['argument']) && $_GET['argument'] == 'logOut')  {
    session_start();
    session_destroy();
    header("../index.php");
    echo "Logout Successful";
    exit;

}
?>