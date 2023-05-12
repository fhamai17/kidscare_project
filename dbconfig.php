<?php

$hostName = "203.158.3.36";
$userName = "prj65_24";
$passWord = "653007";
$dbName = "prj65_24";
$conn = mysqli_connect($hostName, $userName, $passWord, $dbName);
mysqli_set_charset($conn, "utf8");
if (mysqli_connect_error()) {
    echo "Connect falied : " . mysqli_connect_error();
} else {
    //echo "Connect Successfully.";
}

?>