<?php
include("dbconfig.php");

if (!isset($_GET["code"])) {
    exit("Can't find page.");
}

if (!isset($_GET["type"])) {
    exit("หน้าที่คุณร้องขอไม่ถูกต้อง");
}

$code = $_GET["code"];
$code = $_GET["code"];
$getEmailQuery = mysqli_query($conn, "SELECT email FROM reset_password WHERE code='$code'");
if (mysqli_num_rows($getEmailQuery) == 0) {
    exit("Can't find page.");
}

if (isset($_POST["password"])) {
    $pw = $_POST["password"];
    $pw = md5($pw);

    $row = mysqli_fetch_array($getEmailQuery);
    $email = $row["email"];

    $query = mysqli_query($conn, "UPDATE users SET 	
    password='$pw' WHERE email='$email'");

    if ($query) {
        $query = mysqli_query($con, "DELETE FROM reset_password  WHERE code='$code'");
        exit("รหัสผ่านถูกเปลี่ยนเเล้ว!");
    } else {
        exit("มีบางอย่างผิดพลาด ไม่สามารถเปลี่ยนรหัสผ่านได้!");
    }
}

?>

<!-- <form method="POST">
<input type="password" name ="password"  placeholder="New password" class="">
    <br><br>
    <input type="submit" name="submit" class="" value="Update password">
</form> -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KidCare - Login</title>
    <link href="css/kidscare_login.css" rel="stylesheet">
    <link href="css/sut_fonts.css" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.js"></script>
    <style>
        /* Error Color*/
        .has-error,
        .has-error .help-block,
        .has-error .radio,
        .has-error .checkbox,
        .has-error .radio-inline,
        .has-error .checkbox-inline,
        .has-error.radio label,
        .has-error.checkbox label,
        .has-error.radio-inline label,
        .has-error.checkbox-inline label {
            display: block;
            color: #DC0000;
        }

        .has-error .form-control {
            border-color: #DC0000;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        }

        .has-error .form-control:focus {
            border-color: #DC0000;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        }

        .has-error .input-group-addon {
            color: #DC0000;
            background-color: #f2dede;
            border-color: #DC0000;
        }

        .has-error .form-control-feedback {
            color: #DC0000;
        }

        .swal2-styled.swal2-confirm {
    border: 0;
    border-radius: 0.25em;
     background: initial; 
    background-color: #198754; 
    color: #fff;
    font-size: 1em;
}
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center" style="height: 720px;" id="test">
        <div class="container">
            <!-- Outer Row -->
            <div class="row">
                <div class="col-md-6 my-5">
                    <img src="images/login.png" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">RESET PASSWORD</h1>
                                    <p class="text-muted">ระบบดูแลช่วยเหลือเด็กปฐมวัย</p>
                                </div>

                                <form class="user" id="resetForm">
                                    <input type="hidden" name="code" value="<?php echo $_GET['code'] ?>">
                                    <input type="hidden" name="type" value="<?php echo $_GET['type'] ?>">

                                    <div class="form-group mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" placeholder="New password">
                                            <label for="floatingPassword">New Password</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="con_password" placeholder="Confirm password">
                                            <label for="floatingPassword">Confirm Password</label>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button class="btn btn-success btn-login text-uppercase fw-bold" type="submit">Update Password</button>
                                    </div>
                                </form>
                                <!-- <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="register.html">Create an Account!</a>
                                </div> -->

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                var setHeight = $(document).height() - 3;
                $('#test').height(setHeight);
                //$('.help-block').addClass('row');
            });

            $('#resetForm').bootstrapValidator({
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
                $('#resetForm button[type="submit"]').attr('disabled', !formIsValid);
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
                    url: 'ajax_reset_password/ajax_reset_password.php',
                    data: $("#resetForm").serializeArray(),
                    success: function(data) {
                        console.log("Data : " + data);
                        if (data.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เปลี่ยนรหัสผ่านสำเร็จ!',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'ไปหน้าเข้าสู่ระบบ!',
                                    showConfirmButton: true,
                                    timer: 5000
                                }).then((result) => {
                                    window.location.href = "sign_in.php";
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