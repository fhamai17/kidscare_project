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
                                    <h1 class="h4 text-gray-900 mb-4">SIGN IN</h1>
                                    <p class="text-muted">ระบบดูแลช่วยเหลือเด็กปฐมวัย</p>
                                </div>

                                <form class="user" id="signInForm">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                        <label for="floatingInput">Username</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                        <label for="floatingPassword">Password</label>
                                    </div>

                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
                                        <label class="form-check-label" for="rememberPasswordCheck">
                                            Remember password
                                        </label>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-success btn-login text-uppercase fw-bold" type="submit">Sign
                                            in</button>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot_password.php">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="sign_up.php">Create an Account for Parent!</a>
                                </div>

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
            });

            $('#signInForm').on('submit', function(e) {
                //var x = $('#demoForm').serialize();
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: 'ajax/ajax_sign_in_json.php',
                    data: $(this).serializeArray(),
                    success: function(data) {
                        console.log("Res : " + data);
                        var obj = JSON.parse(data);
                        if (obj.statusCode == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'เข้าสู่ระบบสำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                window.location.href = "index.php";
                            })

                        } else if (obj.statusCode == 201) {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'รหัสผ่านไม่ถูกต้อง',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ไม่พบบัญชีผู้ใช้งาน',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(err) {
                        alert("Error" + err)
                    }
                });
            })
        </script>

</body>

</html>