<?php
include '../dbconfig.php';
$student_id = $_POST["student_id"];
$sql = "SELECT a.*, b.name_th as province_name,
c.name_th as district_name,d.name_th as sub_district_name,e.grade_name
FROM student a
LEFT JOIN provinces b ON a.province = b.id 
LEFT JOIN districts c ON a.district = c.id 
LEFT JOIN sub_districts d ON a.sub_district = d.id 
LEFT JOIN grade e ON a.grade_id = e.grade_id 
WHERE a.student_id ='$student_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


if(empty($row['pic'])){
    $pic = '<img src="images/anonymous.jpg" id="p_pic" class="mx-auto d-block img-preview2">';
}else{
    $pic = '<img src="uploads/student_pics/'.$row['pic'].'" id="p_pic" class="mx-auto d-block img-preview2">';
}

?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="parentModalLabel">ข้อมูลนักเรียน #<?=$row["student_id"]?></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    <div class="modal-body">
        <!-- Row -->
        <div class="row">
            <div class="col-sm-4">
                <div class="preview">
                    <?=$pic?>
                </div>

                <h1 class="h6 text-gray-900 mt-2 mb-2 font-weight-bold text-center" id="p_name"><?=$row['pname'].$row['fname']." ".$row['lname']." (".$row['nickname'].")"?></h1>


               <div class="row">
                    <div class="col-sm-6 mb-3">
                        <div class="text-center">
                            <p class="font-weight-bold mb-0">วันเกิด</p>
                            <p class="text-muted mb-0" id="p_career"><?=$row["birthdate"]?></p>
                        </div>

                    </div>

                    <div class="col-sm-6 mb-3">
                        <div class="text-center">
                            <p class="font-weight-bold mb-0">อายุ</p>
                            <p class="text-muted mb-0" ><?=$row["age"]?> ปี</p>
                        </div>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <div class="text-center">
                            <p class="font-weight-bold mb-0">เชื้อชาติ</p>
                            <p class="text-muted mb-0" ><?=$row["ethnicity"]?></p>
                        </div>
                    </div>


                    <div class="col-sm-4 mb-3">
                        <div class="text-center">
                            <p class="font-weight-bold mb-0">สัญชาติ</p>
                            <p class="text-muted mb-0" ><?=$row["national"]?></p>
                        </div>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <div class="text-center">
                            <p class="font-weight-bold mb-0">ศาสนา</p>
                            <p class="text-muted mb-0" ><?=$row["religion"]?></p>
                        </div>
                    </div>
                    <div class="col-sm-12 mb-3">
                        <div class="text-center">
                            <p class="font-weight-bold mb-0">ระดับชั้น</p>
                            <p class="text-muted mb-0" ><?=$row["grade_name"]?></p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="vertical" />
            <div class="col-sm-8">

                <div class="jumbotron d-flex align-items-center">
                    <div class="container">
                        <div class="address mt-2">
                            <p class="font-weight-bold mb-0">ที่อยู่</p>
                            <p class="pl-3 text-muted mb-0" id="p_address"><?=$row["address"]." ตำบล".$row["sub_district_name"]." อำเภอ".
                    $row["district_name"]." จังหวัด".$row["province_name"]." รหัสไปรษณีย์ ".$row["zipcode"]?></p>
                        </div>

                        <hr>

                        <div class="father mt-2">
                           <p class="font-weight-bold mb-0">ข้อมูลบิดา</p>
                           <p class="pl-3 text-muted mb-0">ชื่อ-สกุล : <span><?=$row['fa_pname'].$row['fa_fname']." ".$row['fa_lname']?></span></p>
                            <p class="pl-3 text-muted mb-0">ที่อยู่ : <span><?=$row["fa_address"]." ตำบล".$row["fa_subdistrict"]." อำเภอ".
                    $row["fa_district"]." จังหวัด".$row["fa_province"]." รหัสไปรษณีย์ ".$row["zipcode"]?></span></p>
                            <p class="pl-3 text-muted mb-0">อีเมล : <span><?=$row["fa_email"]?></span></p>
                            <p class="pl-3 text-muted mb-0">เบอร์โทรศัพท์ : <span id="p_phone"><?=$row["fa_phone"]?></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">ยกเลิก</button>
    </div>
</div>