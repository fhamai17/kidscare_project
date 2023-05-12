<?php
include('session.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - อัปเดตรหัสผ่าน</title>
    <style>

                /* Error Color*/
                .has-error,
        .has-error .help-block
        {
            display: block;
            color: #DC0000;
        }
        
        .center {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;

        }


        .form-input {
            width: 100%;
   
        }

        .form-input input {
            display: none;

        }

        .form-input label {
            display: block;
            width: 45%;
            height: 45px;
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
            width: 100%;
            display: none;
            margin-bottom: 30px;
        }


        .img-preview2 {
            width: 200px !important;
            height: 200px !important;
            object-fit: cover !important;
            background-color: #dfdfdf;
        }

        .hr1 { 
            border: 1; border-top: 3px solid #36b9cc;
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
                    <form id="updateForm">
                        <div class="card shadow ">
                            <div class="card-header d-flex justify-content-center align-items-center py-3">
                                <h3 class="m-0 font-weight-bold text-info" id="topic">การเปลี่ยนรหัสผ่านผู้ใช้งาน </h3>
                            </div>
                            <div class="card-body pb-5">
                                <!-- Tab Pane -->
                                <div class="container">
                                    <div class="row d-flex align-items-center">
                                            <div class="col-lg-6 ">
                                            <div class="center">
                                                <div class="form-input">
                                                    <div class="preview2">
                                                        <img src="images/padlock.png" class="mx-auto d-block img-preview">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        
                                        <!--Begin Parent Row-->
                                        
                                        <div class="col-lg-6  mt-3">

                                        <div class="form-group col-sm-12 ">
                                        <h1 class="h6 text-info font-weight-bold">รหัสผ่านผู้ใช้งาน <hr class="hr1" ></h1></div>
                                    
                                            <div class="form-group col-sm-12 ">
                                            <label for="validationServer01" class="form-label">รหัสผ่านใหม่</label>
                                                    <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control " name="password" id="password" placeholder="โปรดระบุ รหัสผ่านใหม่">
                                                </div></div>

                                                <div class="form-group col-sm-12 ">
                                            <label for="validationServer01" class="form-label">ยืนยันรหัสผ่าน</label>
                                                    <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                                    </div>
                                                    <input type="password" class="form-control " name="con_password" id="con_password" placeholder="โปรดยืนยัน รหัสผ่าน">
                                                </div></div>

                                                <div class="form-group col-sm-12 mt-4">
                                       <hr class="hr1" ></h1></div>

                                        <div class="row justify-content-center">
                                            
                                            <div class="p-2">
                                            <button class="btn btn-sky" type="submit">บันทึกรหัสผ่าน</button>

                                            <!-- <button class="btn btn-sky" type="submit">บันทึกข้อมูลผู้ปกครอง</button>
                                                                                         -->
                                            </div>
     
                                        </div>

                                    </div>
                                </div>
                                    <!--End Type Row-->

                                </div>
                                <!-- /.container -->


                                
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
        $('#updateForm').bootstrapValidator({
                fields: {
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'โปรดระบุรหัสผ่าน'
                            },
                            identical: {
                                field: 'password',
                                message: 'รหัสผ่านไม่ตรงกัน'
                            },
                            stringLength: {
                                min: 8,
                                max: 30,
                                message: 'รหัสผ่านต้องมีความยาวอย่างน้อย 8 ตัวอักษร แต่ไม่เกิน 30 ตัวอักษร'
                            },
                            regexp: {
                                regexp: /^((?!.*[\s])(?=.*[A-Z])(?=.*\d).{8,30})/,
                                message: 'รหัสผ่านต้องประกอบไปด้วยตัวอักษรพิมพ์เล็ก ตัวพิมพ์ใหญ่ ตัวเลข และห้ามมีช่องว่าง'
                            }
                        }
                    },
                    con_password: {
                        validators: {
                            notEmpty: {
                                message: 'โปรดยืนยันรหัสผ่านอีกครั้ง'
                            },
                            identical: {
                                field: 'password',
                                message: 'รหัสผ่านไม่ตรงกัน'
                            },
                            /* stringLength: {
                                min: 6,
                                max: 30,
                                message: 'รหัสผ่านต้องมีความยาวอย่างน้อย 6 ตัวอักษร แต่ไม่เกิน 30 ตัวอักษร'
                            },
                            regexp: {
                                regexp: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/,
                                message: 'รหัสผ่านต้องประกอบไปด้วยตัวอักษรพิมพ์เล็ก ตัวพิมพ์ใหญ่ และตัวเลข'
                            } */
                        }
                    },
                }
            }).on('success.form.bv', function(e) {
                // Prevent submit form
                e.preventDefault();
                resetPassword();
                let formIsValid = true;
                $('#updateForm button[type="submit"]').attr('disabled', !formIsValid);
                //checkEmptyID();
            });



            function resetPassword(){

                Swal.fire({
                    title: "กำลังโหลด...",
                    html: "โปรดรอสักครู่",
                    didOpen: function() {
                        Swal.showLoading()
                    }
                })

                $.ajax({
                    type: 'POST',
                    url: 'ajax_reset_password/ajax_update_password.php',
                    data: $("#updateForm").serializeArray(),
                    success: function(data) {
                        console.log("Data : " + data);
                        if (data.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เปลี่ยนรหัสผ่านสำเร็จ!',
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เปลี่ยนรหัสผ่านไม่สำเร็จ!',
                                    text: 'กรุณาลองอีกครั้ง',
                                    timer: 1500
                                })}
                    },
                    error: function(err) {
                        alert("Error" + err)
                    }
                });
            }
    </script>

</body>

</html>