<?php

include '../dbconfig.php';
$session_id = $_POST['session'];
$sql = "SELECT *  FROM `term` as a 
WHERE session_id ='$session_id' ORDER BY term_name;";
$result = mysqli_query($conn, $sql);

$i = 0;  
echo '<ul class="nav nav-tabs" role="tablist">';
foreach ($result as $row) {
    if($i==0){
            echo '<li class="nav-item" onclick="showStudentTabContent(' . $row['term_id'] . ')">
            <a class="nav-link active" data-toggle="tab" href="#menu1">เทอม '.$row['term_name'].'
            <input type="hidden" id="#term_'.$i.'" value="'.$row['term_id'].'">
            </a>
         </li>';

  echo"<script language='javascript'>
  $( document ).ready(function() {
    showStudentTabContent(". $row['term_id'] . ")
});
</script>
";
    }else{
        echo '<li class="nav-item" onclick="showStudentTabContent(' . $row['term_id'] . ')">
        <input type="hidden" id="#term_'.$i.'" value="'.$row['term_id'].'">
        <a class="nav-link" data-toggle="tab" href="#menu1">เทอม '.$row['term_name'].'</a>
     </li>';
    }
$i++;
}
    echo '</ul>';
