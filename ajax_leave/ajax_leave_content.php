<?php
include '../dbconfig.php';
$id = $_POST["id"];
$sql = "SELECT a.* ,CONCAT(b.pname,' ',b.fname,' ',b.lname) as student_name, b.pic as student_pic,
CONCAT(c.pname,' ',c.fname,' ',c.lname) as parent_name, c.pic as parent_pic,
CONCAT(d.pname,' ',d.fname,' ',d.lname) as teacher_name,
f.grade_name , g.relation
FROM student_leave a
LEFT JOIN student b ON a.student_id = b.student_id 
LEFT JOIN parent c ON a.parent_id = c.parent_id 
LEFT JOIN personnel d ON a.teacher_id = d.personnel_id 
LEFT JOIN class e ON a.class_id = e.class_id 
LEFT JOIN grade f ON e.grade_id = f.grade_id
LEFT JOIN parent_relation g ON a.parent_id = g.parent_id 
AND a.student_id = g.student_id
WHERE leave_id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


if (empty($row['student_pic'])) {
  $student_src = 'src="images/anonymous.jpg"';
} else {
  $student_src = 'src="uploads/student_pics/' . $row['student_pic'] . '"';
}


if (empty($row['pic'])) {
  $parent_src = 'src="images/anonymous.jpg"';
} else {
  $parent_src = 'src="uploads/parent_pics/' . $row['parent_pic'] . '"';
}


?>
<style>
  /*   input[type="radio"] {
  visibility: hidden; 
  height: 0;
  width: 0; 
} */
</style>
<div class="modal-header">
  <h5 class="modal-title" id="leaveLabel">รายละเอียดการลาเรียน #<?= $row['leave_id'] ?></h5>
  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
<div class="modal-body">
  <input type="hidden" id="leave_id" value="<?=$row['leave_id']?>">
  <div class="row">
    <div class="col-sm-6">
      <label for="detailLeave" class="font-weight-bold">นักเรียน</label>
      <div class="d-flex align-items-center ml-3">
        <div class="avatar mr-3"><img class="avatar-img" <?= $student_src ?>></div>
        <div>
          <p class="font-weight-bold mb-0"><?= $row['student_id'] ?></p>
          <p class="text-muted mb-0"><?= $row['student_name'] ?></p>
        </div>
      </div>
    </div>
    <div class="col-sm-6">
      <label for="detailLeave" class="font-weight-bold">ผู้ปกครอง</label>
      <div class="d-flex align-items-center ml-3">
        <div class="avatar mr-3"><img class="avatar-img" <?= $parent_src ?>></div>
        <div>
          <p class="font-weight-bold mb-0"><?=$row['parent_name']?></p>
          <p class="text-muted mb-0">เกี่ยวข้องเป็น <span class="badge bg-secondary text-white"><?= $row['relation'] ?></span></p>
        </div>
      </div>
    </div>
  </div>

  <div class="card m-3">
    <div class="card-body">

      <div class="row">
        <div class="col-sm-3">

        </div>
        <label for="detailLeave" class="col-sm-12 col-form-label"><span class="font-weight-bold">ประเภทการลา : </span><?=$row['type']?></label>
        <label for="detailLeave" class="col-sm-6 col-form-label"><span class="font-weight-bold">วันที่ลา : </span><?=date("Y/m/d", strtotime($row['start_date']))." - ".date("Y/m/d", strtotime($row['end_date']))?></label>
        <label for="detailLeave" class="col-sm-6 col-form-label"><span class="font-weight-bold">จำนวน : </span><?=$row['days']?> วัน</label>
        <label for="detailLeave" class="col-sm-12 col-form-label"><span class="font-weight-bold">เหตุผลการลา : </span><?=$row['reason']?></label>
        <div class="col-sm-6">

          <label for="detailLeave"><span class="font-weight-bold">สถานะ : </label>
          <div class="btn-group" data-toggle="buttons">
            <label class="btn btn-outline-success <?=$row['isApprove']==1 ? 'active'  : '' ?>" style="width:100px">
              <input type="radio" name="options" id="option1" value="1"  <?=$row['isApprove']==1 ? 'checked="checked"'  : '' ?> autocomplete="off"> อนุมัติ
            </label>
            <label class="btn btn-outline-danger <?= $row['isApprove'] == 0 && $row['isApprove'] !== null ? 'active'  : '' ?>" style="width:100">
              <input type="radio" name="options" id="option2" value="0" <?= $row['isApprove'] == 0 && $row['isApprove'] !== null ? 'checked="checked"'  : '' ?> autocomplete="off"> ไม่อนุมัติ
            </label>
          </div>
        </div>
        <div class="col-sm-6">
          <textarea class="form-control" id="remark" rows="3" placeholder="หากมีหมายเหตุ โปรดระบุ"><?=$row['remark'] ? $row['remark']  : '' ?></textarea>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">

    </div>
    <div class="col-sm-6">

    </div>
  </div>
</div>
<div class="modal-footer justify-content-center">
  <button type="button" class="btn btn-info" onclick="approveLeave()">บันทึก</button>
</div>