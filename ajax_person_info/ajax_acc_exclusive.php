<?php
include '../dbconfig.php';
$type = $_POST['type'];
$sql = "SELECT * FROM teacher WHERE type='$type'
ORDER BY teacher_id ASC";
$result = mysqli_query($conn, $sql);
?>
<style>
    .badge {
        width: 75px;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: transparent;
        border: 1px solid transparent;
    }

    .badge-success {
        background-color: #d7f2c2;
        color: #7bd235;
    }

    .badge-success:hover {
        background-color: #7bd235;
        color: #d7f2c2;
    }

    .badge-default {
        background-color: #000;
        color: #fff;
    }

    .badge-warning {
        background-color: #FFB26B;
        color: #FF7B54;
    }

    .badge-warning:hover {
        background-color: #FF6E31;
        color: #FFB26B;
    }


    .badge-danger {
        background-color: #FD8A8A;
        color: #DC0000;
    }

    .badge-danger:hover {
        background-color: #DC0000;
        color: #FD8A8A;
    }

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


    .table td,
    .table th {
        vertical-align: middle;
        margin-bottom: 10px;
    }


</style>


<div class="table-responsive">
    <table class="table table-hover  responsive" id="exclusiveDatatable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ชื่อ</th>
                <th>การติดต่อ</th>
                <th>สถานะ</th>
                <th>ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($result as $row) {

                if(empty($row['pic'])){
                    $src = 'src="images/anonymous.jpg"';
                }else{
                    $src = 'src="uploads/teacher_pics/' . $row['pic'] . '"';
                }

                if($row['status']===NULL){
                    $status = "N/A";
                    $status_color = "default";
                }
                else
                {
                    if ($row['status'] == true) {
                        $status = "ได้รับการอนุมัติ";
                        $status_color = "success";
                    } else if ($row['status'] == false) {
                        $status = "ไม่ได้รับการอนุมัติ";
                        $status_color = "danger";
                    }
                }

                echo '<tr>' .
                    '<td>'.$row['teacher_id'].'</td>'.
                    '<td>
                        <a href="#">
                        <div class="d-flex align-items-center">
                            <div class="avatar mr-3"><img class="avatar-img" '.$src.' ></div>'.
                                '<p class="font-weight-bold mb-0" onclick="location.href=\''.'adminParentForm.php?teacher_id='. $row['teacher_id'] . '\'">' . $row['pname'] . " " . $row['fname'] . " " . $row['lname'] . '</p>
                            </div>
                        </a>
                    </td>'  .
                    '<td>
                       
                        <div class="align-items-center">
                                <p class="font-weight-bold mb-0">' . $row['email'] . '</p>
                                <p class="mb-0">' . $row['phone'] . '</p>
                                <p class="mb-0">' . 'LINE ID : '.$row['line_id'] . '</p>
                            </div>
                    </td>'  .
                    '<td>             
                       '.$status.'
                        </td>' .
                        '<td>             
                        <button class="badge badge-success" onclick="approveEx('.$row['teacher_id'].',1)">
                            <span class="icon">
                            <i class="fa fa-check"></i>
                            </span>อนุมัติ
                        </button>
                        <button class="badge badge-danger" onclick="approveEx('.$row['teacher_id'].',0)"><span class="icon">
                            <i class="fa fa-times"></i>
                            </span>ไม่อนุมัติ</button>' . 
                        '</td>' .
                    '</tr>';
            }
            ?>
    </table>
</div>

<script>
    function approveEx(id,num){
        Swal.fire({
      title: 'การอนุมัติบัญชีผู้ใช้',
      text: "คุณต้องการอนุมัติบัญชีผู้ใช้ใช่หรือไม่!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ยืนยัน',
      cancelButtonText: 'ยกเลิก',
  }).then((result) => {
      if (result.isConfirmed) {

          Swal.fire({
              title: "กำลังโหลด...",
              html: "กรุณารอสักครู่",
              didOpen: function() {
                  Swal.showLoading()
              }
          })

          $.ajax({
              type: 'POST',
              url: 'ajax/ajax_approve_acc.php',
              data: {type : 'ฝ่ายบริหาร',
                    id,
                    num
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
                          /* location.reload(); */
                          showExcluesiveTable() 
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