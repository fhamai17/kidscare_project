<?php

include '../dbconfig.php';

if (isset($_POST['function']) && $_POST['function'] == 'provinces') {

    $sql = "SELECT * FROM provinces";
    $result = mysqli_query($conn, $sql);

    echo "<option disabled selected>-โปรดเลือกจังหวัด-</option>";
    foreach ($result as $row) {
        /* echo '<option value="'.$row['id'].'">'.$row['name_th'].'</option>'; */
         echo '<option value="'.$row['id'].'" '.(($row['id']==$_POST['province_id'])?'selected':"").'>'.$row['name_th'].'</option>';
    }
}

if (isset($_POST['function']) && $_POST['function'] == 'districts') {
    
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE province_id='$id'";


    $query = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>-โปรดเลือกอำเภอ-</option>';
    foreach ($query as $value) {
        echo '<option value="'.$value['id'].'" '.(($value['id']==$_POST['district_id'])?'selected="selected"':"").'>'.$value['name_th'].'</option>';
    }
        
    }


if (isset($_POST['function']) && $_POST['function'] == 'sub_districts') {
    
    $id = $_POST['id'];
    $sql = "SELECT * FROM sub_districts WHERE district_id='$id'";
    $query = mysqli_query($conn, $sql);
    echo '<option value="" selected disabled>-โปรดเลือกตำบล-</option>';
    foreach ($query as $value2) {
        echo '<option value="'.$value2['id'].'" '.(($value2['id']==$_POST['subdistrict_id'])?'selected="selected"':"").'>'.$value2['name_th'].'</option>';
    }
}

if (isset($_POST['function']) && $_POST['function'] == 'zipcode') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM sub_districts WHERE id='$id'";
    $query3 = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($query3);
    echo $result['zip_code'];
    exit();
}

/* $sql = "SELECT * FROM provinces";
$result = mysqli_query($conn, $sql);

echo "<option value='' disabled selected>จังหวัด</option>";
foreach($result as $row){
    echo "<option value=".$row['id'].">".$row["name_th"]."</option>";
} */
