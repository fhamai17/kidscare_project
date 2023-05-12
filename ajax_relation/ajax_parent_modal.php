<?php
include '../dbconfig.php';
$parent_id = $_POST["parent_id"];
$sql = "SELECT a.*, b.name_th as province_name,
c.name_th as district_name,d.name_th as sub_district_name
FROM parent a
LEFT JOIN provinces b ON a.province = b.id 
LEFT JOIN districts c ON a.district = c.id 
LEFT JOIN sub_districts d ON a.sub_district = d.id 
WHERE a.parent_id ='$parent_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

/* if ($row) {
    $data = array();
    $data['parent_id'] = $row['parent_id'];
    $data['pname'] = $row['pname'];
    $data['fname'] = $row['fname'];
    $data['lname'] = $row['lname'];

    $data['address'] = $row['address'];
    $data['province'] = $row['province_name'];
    $data['district'] = $row['district_name'];
    $data['sub_district'] = $row['sub_district_name'];
    $data['zipcode'] = $row['zipcode'];

    $data['career'] = $row['career'];
    $data['salary'] = $row['salary'];

    $data['pic'] = $row['pic'];

    $data['email'] = $row['email'];
    $data['phone'] = $row['phone'];
    $data['line_id'] = $row['line_id'];
    $data['sql'] = $sql;
    echo (json_encode($data));
} */

if(empty($row['pic'])){
    $pic = '<img src="images/anonymous.jpg" id="p_pic" class="mx-auto d-block img-preview2">';
}else{
    $pic = '<img src="uploads/parent_pics/'.$row['pic'].'" id="p_pic" class="mx-auto d-block img-preview2">';
}

?>

<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="parentModalLabel">ข้อมูลผู้ปกครอง #<?=$row["parent_id"]?></h5>
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

                <h1 class="h6 text-gray-900 mt-2 mb-2 font-weight-bold text-center" id="p_name"><?=$row['pname'].$row['fname']." ".$row['lname']?></h1>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="text-center">
                            <p class="font-weight-bold mb-0">อาชีพ</p>
                            <p class="text-muted mb-0" id="p_career"><?=$row["career"]?></p>
                        </div>

                    </div>

                    <div class="col-sm-6">
                        <div class="text-center">
                            <p class="font-weight-bold mb-0">เงินเดือน</p>
                            <p class="text-muted mb-0" id="p_salary"><?=$row["salary"]?></p>
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

                        <div class="contact mt-2">
                            <p class="font-weight-bold mb-0">ข้อมูลการติดต่อ</p>
                            <p class="pl-3 text-muted mb-0">อีเมล : <span id="p_email"><?=$row["email"]?></span></p>
                            <p class="pl-3 text-muted mb-0">เบอร์โทรศัพท์ : <span id="p_phone"><?=$row["phone"]?></span></p>
                            <p class="pl-3 text-muted mb-0">LINE ID : <span id="p_line"><?=$row["line_id"]?></span></p>
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