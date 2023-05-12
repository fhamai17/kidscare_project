<?php
include '../dbconfig.php';

    print_r($_POST);

    $class_id = $_POST['class_id'];
    $studentArray = $_POST['studentArray'];
    if ($studentArray) {

        for ($count = 0; $count < count($studentArray); $count++) {


           
            $student_id = $_POST["studentArray"][$count]; 
            
            $sql = "SELECT * FROM class_student WHERE class_id='$class_id' AND student_id = '$student_id' ";
            $result = mysqli_query($conn, $sql);
            $rowcount=mysqli_num_rows($result);

            if($rowcount){
                echo "Data Exits";
            }
            else{
            $sql_re = "INSERT INTO class_student (class_id,student_id)
            VALUES('$class_id','$student_id')";

            $rs_re = mysqli_query($conn, $sql_re);
            if ($rs_re) {
                echo "Add Successful";
            } else {
                echo "Add Failed";
            }


            $sql_up = "UPDATE student SET class_id ='$class_id' WHERE student_id = '$student_id'";

            $rs_up = mysqli_query($conn, $sql_up);
            if ($rs_up) {
                echo "Update Successful";
            } else {
                echo "Update Failed";
            }


            }
            
        }
    }
