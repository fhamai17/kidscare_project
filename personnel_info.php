<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
<?php
include('session.php');
if (isset($_GET['personnel_id'])) {
    $personnel_id = $_GET['personnel_id'];
} else {
    $personnel_id = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - บุคลากร</title>
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
                    <form id="personnelForm" enctype="multipart/form-data" autocomplete="off">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-center align-items-center py-3">
                                <h6 class="m-0 font-weight-bold text-info text-center" id="personnel_topic">เพิ่มข้อมูลบุคลากร</h6>
                            </div>
                            <div class="card-body pl-5 pr-5">
                                <!-- Tab Pane -->
                                <!-- <div class="container"> -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="form-group col-sm-12">
                                                <input type="hidden" name="personnel_id" id="personnel_id" value="<?php echo $personnel_id ?>">
                                                <div class="center">
                                                    <div class="form-input">
                                                        <div class="preview">
                                                            <img src="images/anonymous.jpg" id="file_preview" class="mx-auto d-block img-preview">
                                                        </div>
                                                        <div style="text-align: center;" id="file_name"></div>
                                                        <label for="file">อัพโหลดรูป</label>
                                                        <input class="form-control" type="file" id="file" name="file" accept="image/*" onchange="showPreview(event);">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 ">
                                                <h1 class="h6 text-info font-weight-bold">ข้อมูลบัญชีผู้ใช้
                                                    <hr class="hr1">
                                                </h1>
                                            </div>
                                            <div class="form-group col-sm-6 ">
                                                <label for="validationServer01" class="form-label">Username</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-person-square"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control " name="username" id="username" placeholder="โปรดระบุ Username">
                                                </div>
                                            </div>
                                            <!-- 
                                            <div class="form-group col-sm-6 ">
                                            <label for="validationServer01" class="form-label">Password</label>
                                                <div class="input-group ">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="bi bi-person-square"></i></span>
                                                </div>
                                                <input type="password" class="form-control " name="idcard" id="idcard" placeholder="โปรดระบุ Password">
                                            </div></div> -->

                                            <div class="form-group col-sm-12 "><br>
                                                <h1 class="h6 text-info font-weight-bold">ข้อมูลทั่วไป
                                                    <hr class="hr1">
                                                </h1>
                                            </div>

                                            <div class="form-group col-sm-2">
                                                <label for="validationServer01" class="form-label">คำนำหน้าชื่อ</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-list-task"></i></span>
                                                    </div>
                                                    <select class="form-control selectpicker" name="pname" id="pname">
                                                        <option value="" disabled selected>โปรดเลือกคำนำหน้าชื่อ</option>
                                                        <option value="นาย">นาย</option>
                                                        <option value="นาง">นาง</option>
                                                        <option value="นางสาว" data-subtext="น.ส.">นางสาว</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-5">
                                                <label for="validationServer01" class="form-label">ชื่อจริง</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control " name="fname" id="fname" placeholder="โปรดระบุชื่อจริง">
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-5">
                                                <label for="validationServer01" class="form-label">นามสกุล</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control " name="lname" id="lname" placeholder="โปรดระบุนามสกุล">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="validationServer01" class="form-label">รายละเอียดที่อยู่</label>
                                            <div class="input-group ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-house-add-fill"></i></span>
                                                </div>
                                                <textarea class="form-control" name="address" id="address" rows="3" placeholder="โปรดระบุรายละเอียดที่อยู่"></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-3">
                                                <label for="validationServer01" class="form-label">จังหวัด</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                    </div>
                                                    <select class="form-control selectpicker" name="province" id="province" data-size="5" data-live-search="true" onchange="getDistrictList()">
                                                        <option value="" disabled selected>-โปรดเลือกจังหวัด-</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-3 ">
                                                <label for="validationServer01" class="form-label">อำเภอ</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                    </div>
                                                    <select class="form-control selectpicker" name="district" id="district" data-size="5" data-live-search="true" onchange="getSubDistrictList()">
                                                        <option value="" disabled selected>-โปรดเลือกอำเภอ-</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-3 ">
                                                <label for="validationServer01" class="form-label">ตำบล</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-geo-fill"></i></span>
                                                    </div>
                                                    <select class="form-control selectpicker" name="subdistrict" id="subdistrict" data-size="5" data-live-search="true" onchange="getZipcode()">
                                                        <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-3  ">
                                                <label for="validationServer01" class="form-label">รหัสไปรษณีย์</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-postage-fill"></i></span>
                                                    </div>
                                                    <input type="number" class="form-control" name="zipcode" id="zipcode" placeholder="รหัสไปรษณีย์">
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-12 "><br>
                                                <h1 class="h6 text-info font-weight-bold">ข้อมูลการติดต่อ
                                                    <hr class="hr1">
                                                </h1>
                                            </div>

                                            <div class="form-group col-sm-4 ">
                                                <label for="validationServer01" class="form-label">เบอร์โทรศัพท์</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                    </div>
                                                    <input type="tel" class="form-control " name="phone" id="phone" placeholder="โปรดระบุเบอร์โทรศัพท์" maxlength="10">
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-4 ">
                                                <label for="validationServer01" class="form-label">อีเมล</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-envelope-at-fill"></i></span>
                                                    </div>
                                                    <input type="email" class="form-control " name="email" id="email" placeholder="โปรดระบุอีเมล">
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-4 ">
                                                <label for="validationServer01" class="form-label">ไอดีไลน์</label>
                                                <div class="input-group ">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-line"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control " name="line" id="line" placeholder="โปรดระบุไอดีไลน์">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 "><br>
                                        <h1 class="h6 text-info font-weight-bold">ประเภทบุคลากร
                                            <hr class="hr1">
                                        </h1>
                                    </div>

                                    <div class="form-group col-sm-4 ">
                                        <label for="validationServer01" class="form-label">ประเภทบุคลากร</label>
                                        <select class="form-control selectpicker" name="type" id="type" data-size="5" data-live-search="true">
                                            <option value="" disabled selected>-โปรดเลือกประเภทบุคลากร-</option>
                                            <option value="คุณครู">คุณครู</option>
                                            <option value="ฝ่ายบริหาร">ฝ่ายบริหาร</option>
                                            <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
                                        </select>
                                    </div>


                                    <div class="col-lg-12 mt-4 mb-4">
                                        <div class="d-flex justify-content-center">
                                            <button class="btn btn-sky" type="submit">บันทึกข้อมูล</button>
                                        </div>
                                    </div>
                                </div><!--End Personnel Row-->
                                <!--</div> /.container -->
                            </div><!-- /.card-body -->
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
    <script src="vendor/jquery/jquery.inputmask.js"></script>
    <script>
        var id = "<?= $personnel_id ?>";
        var username_old = "";
        var email_old = "";
        $(document).ready(function() {
            //$("#idcard").inputmask("9-9999-99999-99-9");
            //$("#phone").inputmask("99-9999-9999");


            if (id) {
                showPersonnelInfo();
            } else {
                showProvinceList();
            }

        })

        function showPersonnelInfo() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_per_detail.php',
                data: {
                    id
                },
                success: function(data) {
                    console.log(data);
                    const obj = JSON.parse(data);
                    if (data) {
                        $('#personnel_topic').html('แก้ไขข้อมูลบุคลากร #' + obj.id + "<br>" + obj.pname + obj.fname + " " + obj.lname);
                        if (obj.pic) {
                            $('#file_preview').attr("src", 'uploads/personnel_pics/' + obj.pic);
                        }
                        $('#username').val(obj.username);
                        $('#pname').val(obj.pname);

                        $('#fname').val(obj.fname);
                        $('#lname').val(obj.lname);
                        $('#address').val(obj.address);
                        $('#zipcode').val(obj.zipcode);
                        $('#career').val(obj.career);
                        $('#salary').val(obj.salary);
                        $('#phone').val(obj.phone);
                        $('#email').val(obj.email);
                        $('#line').val(obj.line);
                        $('#type').val(obj.type);
                        showProvinceList(obj.province);
                        getDistrictList(obj.province, obj.district)
                        getSubDistrictList(obj.district, obj.subdistrict)
                        $('.selectpicker').selectpicker('refresh');
                        username_old = obj.username;
                        email_old = obj.email;
                    }

                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showProvinceList(province_id) {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_province_list.php',
                data: {
                    function: 'provinces',
                    province_id
                },
                success: function(data) {
                    console.log("Test :" + data)
                    $('#province').html(data);
                    $('#province').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function getDistrictList(province_id, district_id) {
            var id = $('#province').val();
            if (!id) {
                id = province_id;
            }

            $.ajax({
                type: "POST",
                url: 'ajax_list/ajax_province_list.php',
                data: {
                    id,
                    function: 'districts',
                    district_id
                },
                success: function(data) {
                    console.log("Districts Select: " + data)
                    $('#district').html(data);
                    $('#district').selectpicker('refresh');
                }
            });

        }


        function getSubDistrictList(district_id, subdistrict_id) {
            var id = $('#district').val();
            if (!id) {
                id = district_id;
            }

            $.ajax({
                type: "POST",
                url: 'ajax_list/ajax_province_list.php',
                data: {
                    id,
                    function: 'sub_districts',
                    subdistrict_id
                },
                success: function(data) {
                    console.log("SubDistricts Select: " + data)
                    $('#subdistrict').html(data);
                    $('#subdistrict').selectpicker('refresh');

                }
            });

        }

        function getZipcode() {
            $.ajax({
                type: "POST",
                url: 'ajax_list/ajax_province_list.php',
                data: {
                    id: $('#subdistrict').val(),
                    function: 'zipcode'
                },
                success: function(data) {
                    console.log("Zipcode : " + data)
                    $('#zipcode').val(data);
                    $("#personnelForm").bootstrapValidator('revalidateField', 'zipcode');
                }
            });

        }

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

        $('#personnelForm').bootstrapValidator({
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุ Username'
                        },
                        remote: {
                            url: 'ajax_check/ajax_check_username.php',
                            type: 'POST',
                            message: 'Username นี้ไม่สามารถใช้งานได้',
                            data: function(validator) {
                                return {
                                    username: $('#username').val(),
                                    username_old
                                };
                            },
                        }

                    }
                },
                pname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุคำนำหน้าชื่อ'
                        },
                    }
                },
                fname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อจริง'
                        },
                    }
                },
                lname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุนามสกุล'
                        },
                    }
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรายละเอียดที่อยู่'
                        },
                    }
                },
                province: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกจังหวัด'
                        },
                    }
                },
                district: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกอำเภอ'
                        },
                    }
                },
                subdistrict: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกตำบล'
                        },
                    }
                },
                zipcode: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรหัสไปรษณีย์'
                        },
                        regexp: {
                            regexp: /^\d{5}$/,
                            message: 'รหัสไปรษณีย์ต้องประกอบด้วยตัวเลข 5 ตัว'
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเบอร์โทรศัพท์มือถือ'
                        },
                        regexp: {
                            regexp: /^\d{10}$/,
                            message: 'โปรดระบุตัวเลขให้ครบทั้ง 10 ตัว'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุอีเมล'
                        },
                        emailAddress: {
                            message: 'โปรดระบุอีเมลที่ถูกต้อง',
                        },
                        remote: {
                            url: 'ajax_check/ajax_check_email.php',
                            type: 'POST',
                            message: 'อีเมลนี้ไม่สามารถใช้งานได้',
                            data: function(validator) {
                                return {
                                    email: $('#email').val(),
                                    email_old
                                };
                            },
                        }
                    }
                },
                line: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุไอดีไลน์'
                        },
                    }
                },
                type: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกประเภทของบุคลากร'
                        },
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            $('#personnelForm').data('bootstrapValidator').resetForm();
            e.preventDefault();
            if (id) {
                updatePersonnel();
            } else {
                addPersonnel();
            }

            let formIsValid = true;
            $('#personnelForm button[type="submit"]').attr('disabled', !formIsValid);
        });


        function updatePersonnel() {
            Swal.fire({
                title: 'แก้ไขข้อมูลบุคลากร',
                text: "คุณต้องการแก้ไขข้อมูลบุคลากรหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {

                    let formData = new FormData($("#personnelForm")[0]);
                    Swal.fire({
                        title: "กำลังโหลด...",
                        html: "โปรดรอสักครู่",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    })

                    $.ajax({
                        type: 'POST',
                        url: 'ajax_person_info/ajax_per_update.php',
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



        function addPersonnel() {
            Swal.fire({
                title: 'ยืนยันการเพิ่มข้อมูลบุคลากร',
                text: "คุณต้องการยืนยันการเพิ่มข้อมูลบุคลากรหรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData($("#personnelForm")[0]);
                    Swal.fire({
                        title: "กำลังโหลด...",
                        html: "โปรดรอสักครู่",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    })

                    $.ajax({
                        type: 'POST',
                        url: 'ajax_person_info/ajax_per_add.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {

                            console.log("Res : " + data);

                            var obj = JSON.parse(data);
                            if (obj.status == 200) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'เพิ่มข้อมูลบุคลากรสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    //location.reload();
                                    location.href = 'personnel_info.php?personnel_id=' + obj.lastid;
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'เพิ่มข้อมูลไม่สำเร็จ!',
                                    html: obj.status_txt,
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