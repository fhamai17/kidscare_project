<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<?php
include('session.php');
include('dbconfig.php');


$sql = "SELECT * FROM school LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$school_id =  $row['school_id'];
$pic =  $row['pic'];
$school_name =  $row['name'];

if(empty($pic)){
    $dir = 'images/home.jpg';
}else{
    $dir = 'uploads/school_pics/'.$row['pic'];
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - โรงเรียน</title>
    <style>
        .center {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;

        }


        .form-input {
            width: 350px;
            padding: 20px;
        }

        .form-input input {
            display: none;

        }

        .form-input label {
            display: block;
            width: 45%;
            height: 45px;
            margin: 0 auto;
            line-height: 50px;
            text-align: center;
            background: #F5DEAB;

            color: #000;
            font-size: 15px;
            text-transform: Uppercase;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-input img {
            width: 90%;
            display: none;

            margin-bottom: 30px;
        }


        .img-preview {
            width: 200px !important;
            height: 200px !important;
            object-fit: cover !important;
            background-color: #dfdfdf;
        }

        .hr1 {
            border: 1;
            border-top: 3px solid #36b9cc;
            margin: 0;
        }
    </style>

    <?php include './layout/head.php' ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include './layout/sidebar.php' ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include './layout/topbar.php' ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <form id="schoolForm" enctype="multipart/form-data" autocomplete="off">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-center align-items-center py-3">
                                <h6 class="m-0 font-weight-bold text-info text-center" id="personnel_topic">แก้ไขข้อมูลโรงเรียน</h6>
                            </div>
                            <div class="card-body pl-5 pr-5">
                                <!-- Tab Pane -->
                                <!-- <div class="container"> -->
                                <div class="row">
                                    <div class="col-lg-12">

                                        <input type="hidden" name="school_id" id="school_id" value="<?php echo $school_id ?>">
                                        <div class="center">
                                            <div class="form-input">
                                                <div class="preview">
                                                    <img src="<?=$dir?>" id="file_preview" class="mx-auto d-block img-preview">
                                                </div>
                                                <div style="text-align: center;" id="file_name"></div>
                                                <label for="file">อัพโหลดรูป</label>
                                                <input class="form-control" type="file" id="file" name="file" accept="image/*" onchange="showPreview(event);">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 ">
                                        <h1 class="h6 text-info font-weight-bold">ข้อมูลโรงเรียน
                                            <hr class="hr1">
                                        </h1>
                                    </div>

                                  
                                        <div class="col-sm-12">
                                              <div class="form-group">
                                        <label for="validationServer01" class="form-label">ชื่อโรงเรียน<span class="text-danger">*</span></label>
                                        <div class="input-group ">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-house-add-fill"></i></span>
                                            </div>
                                            <textarea class="form-control" name="school_name" id="school_name" rows="3" placeholder="โปรดระบุชื่อโรงเรียน"><?=$school_name?></textarea>
                                        </div>
                            

                                        </div>
                                    </div>
                                  

                                    <div class="col-lg-12 mt-4 mb-4">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-sky" type="submit">บันทึกข้อมูล</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include './layout/footer.php' ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include './layout/scrolltop.php' ?>

    <?php include 'layout/script_foot.php' ?>
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file_preview");
                var pic_name = document.getElementById("file_name");
                preview.src = src;
                preview.style.display = "block";
                pic_name.innerHTML = event.target.files[0].name
            }
        }
        
        $('#schoolForm').bootstrapValidator({
            fields: {
                school_name: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อโรงเรียน'
                        },

                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            $('#schoolForm').data('bootstrapValidator').resetForm();
            e.preventDefault();
            updateSchool();
            let formIsValid = true;
            $('#schoolForm button[type="submit"]').attr('disabled', !formIsValid);
        });


        function updateSchool() {
            Swal.fire({
                title: 'แก้ไขข้อมูลโรงเรียน',
                text: "คุณต้องการแก้ไขข้อมูลโรงเรียนหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {

                    let formData = new FormData($("#schoolForm")[0]);
                    Swal.fire({
                        title: "กำลังโหลด...",
                        html: "โปรดรอสักครู่",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    })

                    $.ajax({
                        type: 'POST',
                        url: 'ajax_basic_info/ajax_school_update.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Update Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'แก้ไขข้อมูลสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'แก้ไขข้อมูลไม่สำเร็จ!',
                                    text: 'โปรดลองอีกครั้ง',
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

</body>

</html>