<!-- <form method="POST" class="">
    <input type="text" class="" name="email" placeholder="Email" autocomplete="off">
    <br><br>
    <input type="submit" name="submit" class="" value="Reset email">
</form> -->

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KidsCare - RESET PASSWORD</title>
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
                                    <h1 class="h4 text-gray-900 mb-4">RESET PASSWORD</h1>
                                    <p class="text-muted">ระบบดูแลช่วยเหลือเด็กปฐมวัย</p>
                                </div>

                                <form class="user" method="POST" id="requesForm">

                                    <div class="form-floating mb-3">
                                        <input input type="text" class="form-control" name="email" placeholder="Email" autocomplete="off" id="" required>
                                        <label for="floatingPassword">Email</label>
                                    </div>

                                    <div class="d-grid">
                                        <input type="submit" name="submit" class="btn btn-success btn-login text-uppercase fw-bold" value="Send Email">
                                        <!-- <button  class="btn btn-success btn-login text-uppercase fw-bold" type="submit"  value="Reset email">Reset Password</button>  -->

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
            });

            $('#requesForm').on('submit', function(e) {
                //var x = $('#demoForm').serialize();
                e.preventDefault();

                Swal.fire({
                    title: "กำลังโหลด...",
                    html: "โปรดรอสักครู่",
                    didOpen: function() {
                        Swal.showLoading()
                    }
                })
                $.ajax({
                    type: 'POST',
                    url: 'ajax_reset_password/ajax_request_reset.php',
                    data: $(this).serializeArray(),
                    success: function(data) {
                        console.log("EMAIL " + data);
                        var obj = JSON.parse(data);
                        if (obj.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ส่งอีเมลสำเร็จ!',
                                text: 'หากไม่พบอีเมล กรุณาดูในถังขยะ',
                                showConfirmButton: true,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'เข้าใจแล้ว!',
                            }).then((result) => {
                                location.reload();
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ส่งอีเมลไม่สำเร็จ!',
                                html: obj.status_text,
                                showConfirmButton: false,
                                timer: 1500
                            })
                        };
                    },
                    error: function(err) {
                        alert("Error" + err)
                    }
                });
            })
        </script>

</body>

</html>