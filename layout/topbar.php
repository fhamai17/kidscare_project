<?php

isset($_SESSION['username']) ? $username = $_SESSION['username'] : $username = "Test";
include('dbconfig.php');
$user_type = $_SESSION['type'];
$directory ="";
if ($user_type === "ผู้ปกครอง") {

    $sql = "SELECT pic FROM parent
    WHERE parent_id = '$_SESSION[user_id]'";
    $directory = "uploads/parent_pics/";
}
else{
    $sql = "SELECT pic FROM personnel
    WHERE personnel_id = '$_SESSION[user_id]'";
    $directory = "uploads/personnel_pics/";
}

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if(empty($row['pic'])){
    $directory = "images/anonymous.jpg";
}
else{
    $directory .= $row['pic'];
}
$conn->close();

?>

<nav class="navbar navbar-expand navbar-light bg-green topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

    <!-- Topbar Search -->
    <!--                     <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                    <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>


        <!--  <div class="topbar-divider d-none d-sm-block"></div> -->

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-300 small"><?= $username ?></span>
                <img id="profile" class="img-profile rounded-circle" src="<?=$directory?>">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="edit_profile.php">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    ข้อมูลส่วนตัว
                </a>
                <a class="dropdown-item" href="update_password.php">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    เปลี่ยนรหัสผ่าน
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" onclick="logOut()">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    ออกจากระบบ
                </a>
            </div>
        </li>

    </ul>

</nav>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function logOut() {
        Swal.fire({
            title: 'ออกจากระบบ',
            text: "คุณต้องการออกจากระบบหรือไม่?",
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
                    type: 'GET',
                    url: 'ajax/ajax_logout.php',
                    data: {
                        argument: "logOut"
                    },
                    success: function(res) {
                        console.log("Res : " + res);
                        if (res.search("Successful") != -1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'ออกจากระบบสำเร็จ!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then((result) => {
                                window.location.href = 'sign_in.php';
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ออกจากระบบไม่สำเร็จ!',
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