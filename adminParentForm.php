<?php
include('session.php');
if (isset($_GET['parent_id'])) {
    $parent_id = $_GET['parent_id'];
} else {
    $parent_id = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - Manage Class</title>
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
            margin-left: 25%;
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
                    <form id="parentForm" enctype="multipart/form-data" autocomplete="off">
                        <div class="card shadow mb-4">
                            <div class="card-header d-flex justify-content-center align-items-center py-3">
                                <h3 class="m-0 font-weight-bold text-dark" id="topic">เพิ่มข้อมูลผู้ปกครอง</h3>
                            </div>
                            <div class="card-body pb-5">
                                <!-- Tab Pane -->
                                <div class="container">
                                    <input type="hidden" name="parent_id" id="parent_id" value="<?php echo $parent_id ?>">
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

                                    <!--Begin Parent Row-->
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <hr>
                                            <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ข้อมูลผู้ปกครอง</h1>
                                            <div class="row">
                                                <div class="form-group col-sm-6 mb-3">
                                                    <input type="text" class="form-control " name="idcard" id="idcard" placeholder="เลขบัตรประจำตัวประชาชน">
                                                </div>
                                                <div class="form-group col-sm-6 mb-3 p-0">
                                                </div>

                                                <div class="form-group col-sm-2">
                                                    <select class="form-control selectpicker" name="pname" id="pname">
                                                        <option value="" disabled selected>คำนำหน้าชื่อ</option>
                                                        <option value="นาย">นาย</option>
                                                        <option value="นาง">นาง</option>
                                                        <option value="นางสาว" data-subtext="น.ส.">นางสาว</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-5">
                                                    <input type="text" class="form-control " name="fname" id="fname" placeholder="ชื่อจริง">
                                                </div>
                                                <div class="form-group col-sm-5">
                                                    <input type="text" class="form-control " name="lname" id="lname" placeholder="นามสกุล">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control mb-3" name="address" id="address" rows="3" placeholder="โปรดระบุรายละเอียดที่อยู่"></textarea>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-3 mb-3 ">
                                                    <select class="form-control selectpicker" name="province" id="province" data-size="5" data-live-search="true" onchange="getDistrictList()">
                                                        <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-3 mb-3 ">
                                                    <select class="form-control selectpicker" name="district" id="district" data-size="5" data-live-search="true" onchange="getSubDistrictList()">
                                                        <option value="" disabled selected>-โปรดเลือกอำเภอ-</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-3 mb-3 ">
                                                    <select class="form-control selectpicker" name="subdistrict" id="subdistrict" data-size="5" data-live-search="true" onchange="getZipcode()">
                                                        <option value="" disabled selected>-โปรดเลือกตำบล-</option>
                                                    </select>
                                                </div>

                                                <div class="form-group col-sm-3 mb-3 ">
                                                    <input type="number" class="form-control" name="zipcode" id="zipcode" placeholder="รหัสไปรษณีย์" readonly>
                                                </div>

                                                <div class="form-group col-sm-6 mb-3">
                                                    <input type="text" class="form-control " name="career" id="career" placeholder="อาชีพ">
                                                </div>
                                                <div class="form-group col-sm-6 mb-3">
                                                    <input type="number" class="form-control " name="salary" id="salary" min="0" placeholder="รายได้ (เดือน)">
                                                </div>
                                                <div class="form-group col-sm-4 mb-3">
                                                    <input type="text" class="form-control " name="phone" id="phone" placeholder="เบอร์โทรศัพท์ (+66)">
                                                </div>
                                                <div class="form-group col-sm-4 mb-3">
                                                    <input type="email" class="form-control " name="email" id="email" placeholder="อีเมลล์">
                                                </div>
                                                <div class="form-group col-sm-4 mb-3">
                                                    <input type="text" class="form-control " name="line" id="line" placeholder="ไอดีไลน์">
                                                </div>


                                            </div>


                                        </div>
                                    </div>
                                    <!--End Parent Row-->

                                    <!--Begin Type Row-->
                                    <!-- <div class="row">
                                        <div class="col-lg-12">
                                            <hr>
                                            <h1 class="h6 text-gray-900 mb-4 font-weight-bold">ความเกี่ยวข้อง</h1>
                                            <div class="row">
                                                <div class="form-group col-sm-6 mb-3">
                                                    <select class="form-control selectpicker" name="type" id="type" data-size="5" data-live-search="true">
                                                        <option value="" disabled selected>-โปรดเลือกความเกี่ยวข้อง-</option>
                                                        <option value="บิดา">บิดา</option>
                                                        <option value="มารดา">มารดา</option>
                                                        <option value="ปู่">ปู่</option>
                                                        <option value="ย่า">ย่า</option>
                                                        <option value="ตา">ตา</option>
                                                        <option value="ยาย">ยาย</option>
                                                        <option value="ลุง">ลุง</option>
                                                        <option value="ป้า">ป้า</option>
                                                        <option value="น้า">น้า</option>
                                                        <option value="อา">อา</option>
                                                        <option value="ผู้ปกครอง">ผู้ปกครอง</option>
                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                    </div> -->
                                    <!--End Type Row-->

                                </div>
                                <!-- /.container -->


                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-sky" type="submit">บันทึกข้อมูลผู้ปกครอง</button>
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
    <script src="vendor/jquery/jquery.inputmask.js"></script>
    <script>
    
        var id = "<?=$parent_id?>";
        $(document).ready(function() {
            $("#idcard").inputmask("9-9999-99999-99-9");
            $("#phone").inputmask("99-9999-9999");

            
            if (id) {
                showParentInfo();
            } else {
                showProvinceList();
            }

        })

        $('#parentForm').bootstrapValidator({
            fields: {
                idcard: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเลขบัตรประจำตัวประชาชน'
                        },
                        stringLength: {
                            min: 17,
                            max: 17,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
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
                subdistrict: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกตำบล'
                        },
                    }
                },
                career: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุอาชีพ'
                        },
                    }
                },
                salary: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเงินเดือน'
                        },
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเบอร์โทรศัพท์มือถือ'
                        },
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุอีเมลล์'
                        },
                        emailAddress: {
                            message: 'โปรดระบุอีเมลที่ถูกต้อง',
                        },
                    }
                },
                line: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุไอดีไลน์'
                        },
                    }
                },
                /* type: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกประเภทของผู้ปกครอง'
                        },
                    }
                }, */
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            var id = $('#parent_id').val();

            if (id) {

                Swal.fire({
                    title: 'แก้ไขข้อมูลผู้ปกครอง',
                    text: "คุณต้องการแก้ไขข้อมูลผู้ปกครองหรือไม่?",
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
                            html: "โปรดรอสักครู่",
                            didOpen: function() {
                                Swal.showLoading()
                            }
                        })

                        $.ajax({
                            type: 'POST',
                            url: 'ajax_person_info/ajax_parent_update.php',
                            data: new FormData(this),
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
                                        //location.reload();
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


            } else {

                Swal.fire({
                    title: 'ยืนยันการเพิ่มข้อมูลผู้ปกครอง',
                    text: "คุณต้องการยืนยันการเพิ่มข้อมูลผู้ปกครองหรือไม่?",
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
                            html: "โปรดรอสักครู่",
                            didOpen: function() {
                                Swal.showLoading()
                            }
                        })

                        $.ajax({
                            type: 'POST',
                            url: 'ajax_person_info/ajax_parent_add.php',
                            data: new FormData(this),
                            processData: false,
                            contentType: false,
                            success: function(res) {
                                console.log("Res : " + res);
                                if (res.search("Add Successful") != -1) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'เพิ่มข้อมูลสำเร็จ!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then((result) => {
                                        //location.reload();
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'เพิ่มข้อมูลไม่สำเร็จ!',
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
                    }else{
                        alert("Cancel");
                    }
                })

                /*                 $.ajax({
                                type: 'POST',
                                url: 'ajax_person_info/ajax_parent_add.php',
                                data: new FormData(this),
                                processData: false,
                                contentType: false,
                                success: function(res) {
                                    console.log("Res : " + res);
                                },
                                error: function(err) {
                                    alert("Error" + err)

                                }
                            }); */
            }

            /*  Swal.fire({
                 title: 'ยืนยันการเพิ่มข้อมูลนักเรียน',
                 text: "คุณต้องการยืนยันการเพิ่มข้อมูลนักเรียนหรือไม่?",
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
                         html: "โปรดรอสักครู่",
                         didOpen: function() {
                             Swal.showLoading()
                         }
                     })

                     $.ajax({
                         type: 'POST',
                 url: 'ajax_person_info/ajax_add.php',
                 data: new FormData(this),
                 processData: false,
                 contentType: false,
                         success: function(res) {
                             console.log("Res : " + res);
                             if (res.search("Add Successful") != -1) {
                                 Swal.fire({
                                     icon: 'success',
                                     title: 'เพิ่มข้อมูลสำเร็จ!',
                                     showConfirmButton: false,
                                     timer: 1500
                                 }).then((result) => {
                                     location.reload();
                                 })
                             } else {
                                 Swal.fire({
                                     icon: 'error',
                                     title: 'เพิ่มข้อมูลไม่สำเร็จ!',
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
             }) */
        });

        function showParentInfo() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_parent_detail.php',
                data: {
                    id
                },
                success: function(data) {
                    console.log(data);
                    const obj = JSON.parse(data);
                    if (data) {
                        $('#topic').html('แก้ไขข้อมูลผู้ปกครอง #' + obj.id);
                        if (obj.pic) {
                            $('#file_preview').attr("src", 'uploads/parent_pics/' + obj.pic);
                        }
                        $('#idcard').val(obj.idcard);
                        $('#pname').val(obj.pname);
                        $('#pname').selectpicker('refresh');
                        $('#fname').val(obj.fname);
                        $('#lname').val(obj.lname);
                        $('#address').val(obj.address);
                        $('#zipcode').val(obj.zipcode);
                        $('#career').val(obj.career);
                        $('#salary').val(obj.salary);
                        $('#phone').val(obj.phone);
                        $('#email').val(obj.email);
                        $('#line').val(obj.line);
                        showProvinceList(obj.province);
                        getDistrictList(obj.province, obj.district)
                        getSubDistrictList(obj.district, obj.subdistrict)

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


        function autoTab2(obj, typeCheck) {
            /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
            หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น  รูปแบบเลขที่บัตรประชาชน
            4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
            รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
            หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
            ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
            */
            if (typeCheck == 1) {
                var pattern = new String("_-____-_____-__-_"); // กำหนดรูปแบบในนี้
                var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้     
            } else {
                var pattern = new String("__-____-____"); // กำหนดรูปแบบในนี้
                var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้                 
            }
            var returnText = new String("");
            var obj_l = obj.value.length;
            var obj_l2 = obj_l - 1;
            for (i = 0; i < pattern.length; i++) {
                if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                    returnText += obj.value + pattern_ex;
                    obj.value = returnText;
                }
            }
            if (obj_l >= pattern.length) {
                obj.value = obj.value.substr(0, pattern.length);
            }
        }
    </script>

</body>

</html>