<?php
include '../dbconfig.php';

$id = 'id="relationDataTable"';
$status = "";
if(isset($_POST['status'])){
    if($_POST['status']==="Approve"){
        $id = 'id="approveDataTable"';
        $status = "WHERE a.isApprove = '1'";
    }else if($_POST['status']==="Reject"){
        $status = "WHERE a.isApprove = '0'";
        $id = 'id="rejectDataTable"';
    }else if($_POST['status']==="Pending"){
    $id = 'id="pendingDataTable"';
    $status = "WHERE a.isApprove is NULL";
}
}

$sql = "SELECT a.* , 
CONCAT( b.pname,' ',b.fname,' ',b.lname) AS parentName ,b.pic as parentPic, 
CONCAT( c.pname,' ',c.fname,' ',c.lname) AS stdName, c.pic as stdPic , d.grade_name as grade
FROM parent_relation as a 
LEFT JOIN parent b ON a.parent_id = b.parent_id 
LEFT JOIN student c ON a.student_id = c.student_id 
LEFT JOIN grade d ON c.grade_id = d.grade_id 
$status
ORDER BY a.id desc;";
$result = mysqli_query($conn, $sql);

?>
<style>
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


</style>


<div class="table-responsive">
    <table class="table table-hover  responsive" <?=$id?> width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>วันที่ร้องขอ</th>
                <th>ชื่อ-สกุลผู้ปกครอง</th>
                <th>เกี่ยวข้องเป็น</th>
                <th>ชื่อ-สกุลนักเรียน</th>
                <th>สถานะ</th>
                <th>หมายเหคุ</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if($row['isApprove']===NULL){
                    $status = "อยู่ระหว่างรอ";
                    $status_color = "dark";
                }
                else
                {
                    if ($row['isApprove'] == true) {
                        $status = "ได้รับการอนุมัติ";
                        $status_color = "success";
                    } else if ($row['isApprove'] == false) {
                        $status = "ไม่ได้รับการอนุมัติ";
                        $status_color = "danger";
                        
                    }
                }

                if(empty($row['stdPic'])){
                    $src_std = 'src="images/anonymous.jpg"';
                }else{
                    $src_std = 'src="uploads/student_pics/' . $row['stdPic'] . '"';
                }


                if(empty($row['parentPic'])){
                    $src_parent = 'src="images/anonymous.jpg"';
                }else{
                    $src_parent = 'src="uploads/parent_pics/' . $row['parentPic'] . '"';
                }

                echo '<tr>' .
                    '<td>'.$row['parent_id'].'</td>'.
                    '<td>'.$row['request_time'].'</td>'.
                    '<td>
                        <a href="#" onclick=showParentModal('.$row['parent_id'].')>
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" '.$src_parent.' ></div>'.
                                '<p class="font-weight-bold mb-0">' . $row['parentName'] .'</p>
                            </div>
                        </a>
                    </td>'  .
                    '<td>
                       
                        <div class="justify-content-center">
                                <p class="text-muted  mb-0">' . $row['relation'] . '</p>
                            </div>
                    </td>'  .
                    '<td>
                    
                    <div class="d-flex align-items-center">
                        <div class="avatar mr-3"><img class="avatar-img" '.$src_std.' ></div>'.
                            '<div><a href="#" onclick=showStudentModal(\''.$row['student_id'].'\')><p class="font-weight-bold mb-0">' . $row['stdName'] .'</p> </a>
                            <p class="text-muted mb-0">' . $row['grade'] .'</p></div>
                        </div>
                   
                </td>'  .
                    '<td>   
                    <a class="badge badge-'.$status_color.'" data-bs-toggle="tooltip" data-bs-placement="top"style="width:85px">' . $status .'
                        </a>
                        </td>' .
                        '<td>'.$row['remark'].'</td>'.
                        '<td>             
                        <button class="badge badge-success" onclick="approveRelation('.$row['id'].',1,\'อนุมัติ\')">
                            <span class="icon">
                            <i class="fa fa-check"></i>
                            </span>อนุมัติ
                        </button>
                        <button class="badge badge-danger" onclick="approveRelation('.$row['id'].',0,\'ปฏิเสธ\')"><span class="icon">
                            <i class="fa fa-times"></i>
                            </span>ไม่อนุมัติ</button>' . 
                        '</td>' .
                    '</tr>';
            }
            ?>
    </table>
</div>

<script>
    function approveRelation(id,num,text){
        Swal.fire({
      title: 'การอนุมัติความสัมพันธ์',
      html: `คุณต้องการ`+text+`ความสัมพันธ์ของผู้ปกครองและนักเรียนใช่หรือไม่?
      <div class="form-group">
        <textarea class="form-control mb-3" name="remark" id="remark" rows="3" placeholder="ความคิดเห็นเพิ่มเติม"></textarea>
    </div>`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ยืนยัน',
      cancelButtonText: 'ยกเลิก',
  }).then((result) => {
      if (result.isConfirmed) {

         var remark = $("#remark").val()
         Swal.fire({
              title: "กำลังโหลด...",
              html: "กรุณารอสักครู่",
              didOpen: function() {
                  Swal.showLoading()
              }
          })

          $.ajax({
              type: 'POST',
              url: 'ajax_relation/ajax_approve_relation.php',
              data: {
                    id,
                    num,
                    remark
                },
              success: function(res) {
                  console.log("Res : "+res);
                  if (res.search("Update Successful") != -1) {
                      Swal.fire({
                          icon: 'success',
                          title: 'อัปเดตสถานะสำเร็จ!',
                          showConfirmButton: false,
                          timer: 1500
                      }).then((result) => {
                        showRelationTable();
                      }) 
                  } else {
                      Swal.fire({
                          icon: 'error',
                          title: 'อัปเดตสถานะไม่สำเร็จ!',
                          text: 'กรุณาลองอีกครั้ง',
                          showConfirmButton: false,
                          timer: 1500
                      })
                  };

              },
              error: function(err) {
                  alert("Error" + err)

              }
          }); 
      }
  })
    }
</script>