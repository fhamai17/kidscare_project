<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KidCare - Register</title>
    <link href="css/kidscare_login.css" rel="stylesheet">
    <link href="css/sut_fonts.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/demo.css">

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <!-- Modal -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="vendor/bootstrap/css/bootstrap.select.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        /* Error Color*/
        .has-error .help-block,
        .has-error .radio,
        .has-error .checkbox,
        .has-error .radio-inline,
        .has-error .checkbox-inline,
        .has-error.radio label,
        .has-error.checkbox label,
        .has-error.radio-inline label,
        .has-error.checkbox-inline label {
            color: #DC0000;
            display: block;
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


        /* On Invalid */
        .selectpicker.is-invalid~.dropdown-toggle {
            border-color: #dc3545 !important;
            outline: none !important;
        }

        .selectpicker.is-invalid~.dropdown-toggle:focus {
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }


        /*DataTables*/
        /* Add a green text color and a checkmark when the requirements are right */
        .valid {
            color: green;
        }

        .valid:before {
            position: relative;
            content: "✔";
        }

        /* Add a red text color and an "x" when the requirements are wrong */
        .invalid {
            color: red;
        }

        .invalid:before {
            position: relative;
            content: "✖";
        }


        table.fixed {
            table-layout: fixed;
            width: 90px;
        }


        th {
            text-align: center;
        }


        .bg-img {
            background-image: url("images/bg_1.png") !important;
            background-size: cover !important;
        }

        @media (max-width: 767px) {
            .table-responsive .dropdown-menu {
                position: static !important;
            }

        }

        @media (min-width: 768px) {
            .table-responsive {
                overflow: inherit;
            }
        }
    </style>
</head>

<body class="bg-img">

    <div class="container">
        <div class="row align-items-center vh-100">
            <div class="col-lg-6 col-sm-12 col-xs-12 mx-auto" id="respon_win">
                <div class="card shadow border">
                    <div class="card-body d-flex flex-column align-items-center">


                        <div class="col-12 col-offset-2">
                            <div class="progress mt-3" style="height: 30px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" style="font-weight:bold; font-size:15px;" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-header bg-white text-center">
                                    <h1 class="h4 text-gray-900">SIGN IN</h1>
                                    <p class="text-muted p-0">ระบบดูแลช่วยเหลือเด็กปฐมวัย</p>
                                </div>

                                <div id="useracc" class="card-body p-4 step">
                                    <form id="accForm" autocomplete="off">
                                        <div class="text-center">
                                            <h5 class="card-title font-weight-bold pb-2">ข้อมูลบัญชีผู้ใช้งาน</h5>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter Username" required>
                                                    <label for="floatingInput">Username</label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                                    <label for="floatingPassword">Password</label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-sm-12">
                                                <div class="form-floating">
                                                    <input type="password" class="form-control" id="con_password" name="con_password" placeholder="Password">
                                                    <label for="floatingPassword">Confirm Password</label>
                                                    <div class="invalid-feedback" id="err_cpassword">ข้อมูลในช่องนี้จำเป็นต้องมี</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="userinfo" class="card-body p-4 step" style="display: none">
                                    <form id="infoForm" autocomplete="off">
                                        <div class="text-center">
                                            <h5 class="card-title font-weight-bold pb-2">ข้อมูลทั่วไป</h5>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="form-floating ">
                                                    <select class="form-select" name="pname" id="pname" required="required">
                                                        <option value="" disabled selected>-โปรดเลือกคำนำหน้าชื่อ-</option>
                                                        <option value="นาย">นาย</option>
                                                        <option value="นาง">นาง</option>
                                                        <option value="นางสาว" data-subtext="น.ส.">นางสาว</option>
                                                    </select>
                                                    <label for="floatingSelect">คำนำหน้าชื่อ</label>
                                                    <div class="invalid-feedback">ข้อมูลในช่องนี้จำเป็นต้องมี</div>
                                                </div>
                                            </div>


                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="form-floating ">
                                                    <select class="form-select" name="gender" id="gender" required="required">
                                                        <option value="" disabled selected>-โปรดเลือกเพศ-</option>
                                                        <option value="ชาย ">ชาย</option>
                                                        <option value="หญิง">หญิง</option>
                                                    </select>
                                                    <label for="floatingInput">เพศ</label>
                                                    <div class="invalid-feedback">ข้อมูลในช่องนี้จำเป็นต้องมี</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" row">
                                            <div class="form-group col-sm-6">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="ชื่อ" required>
                                                    <label for="floatingInput">ชื่อจริง</label>
                                                    <div class="invalid-feedback">ข้อมูลในช่องนี้จำเป็นต้องมี</div>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="form-floating ">
                                                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="นามสกุล" required>
                                                    <label for="floatingInput">นามสกุล</label>
                                                    <div class="invalid-feedback">ข้อมูลในช่องนี้จำเป็นต้องมี</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class=" row">
                                            <div class="form-group col-sm-12 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="address" name="address" placeholder="ที่อยู่" required>
                                                    <label for="floatingInput">ที่อยู่</label>
                                                    <div class="invalid-feedback">ข้อมูลในช่องนี้จำเป็นต้องมี</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="form-floating ">
                                                    <select class="form-select" name="province" id="province" required="required" onchange="getDistrictList()">
                                                        <option disabled selected>-โปรดเลือกจังหวัด-</option>";
                                                    </select>
                                                    <label for="floatingSelect">จังหวัด</label>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="form-floating ">
                                                    <select class="form-select" name="district" id="district" required="required" onchange="getSubDistrictList()">
                                                        <option disabled selected>-โปรดเลือกอำเภอ-</option>
                                                    </select>
                                                    <label for="floatingSelect">อำเภอ</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="form-floating ">
                                                    <select class="form-select" name="subdistrict" id="subdistrict" required="required" onchange="getZipcode()">
                                                        <option disabled selected>-โปรดเลือกตำบล-</option>
                                                    </select>
                                                    <label for="floatingSelect">ตำบล</label>

                                                </div>
                                            </div>


                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="zipcode" name="zipcode" required placeholder="โปรดระบุรหัสไปรษณีย์">
                                                    <label for="floatingInput">รหัสไปรษณีย์</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="form-floating">
                                                    <input type="text" class="form-control" id="career" name="career" placeholder="อาชีพ" required>
                                                    <label for="floatingPassword">อาชีพ</label>
                                                    <div class="invalid-feedback">ข้อมูลในช่องนี้จำเป็นต้องมี</div>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-6 mb-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control" id="salary" name="salary" placeholder="รายได้ต่อเดือน(บาท)" required>
                                                    <label for="floatingPassword">รายได้ต่อเดือน(บาท)</label>
                                                    <div class="invalid-feedback">ข้อมูลในช่องนี้จำเป็นต้องมี</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="usercontact" class="card-body p-5 step" style="display: none">
                                    <form id="contactForm" autocomplete="off">
                                        <div class="row">
                                            <div class="form-group col-sm-12 mb-3">
                                                <div class="form-floating ">
                                                    <input type="email" class="form-control" id="email" name="email" required placeholder="โปรดระบุอีเมล">
                                                    <label for="floatingInput">อีเมล</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-12 mb-3">
                                                <div class="form-floating ">
                                                    <input type="text" class="form-control" id="phone" name="phone" required placeholder="โปรดระบุเบอร์โทรศัพท์" maxlength="10">
                                                    <label for="floatingInput">เบอร์โทรศัพท์</label>
                                                </div>
                                            </div>


                                            <div class="form-group col-sm-12 mb-3">
                                                <div class="form-floating ">
                                                    <input type="text" class="form-control" id="line" name="line" required placeholder="โปรดระบุไอดีไลน์">
                                                    <label for="floatingInput">ไอดีไลน์</label>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body p-5 step" id="typepanel" style="display: none">
                                    <form id="relationForm" autocomplete="off">
                                        <div class="form-group col-sm-12">
                                            <div class="form-floating mb-3">
                                                <select class="form-select" id="userType" name="userType" aria-label="Floating label select example" required="required">
                                                    <option value="" disabled>โปรดเลือกประเภทผู้ใช้งาน</option>
                                                    <option value="ผู้ปกครอง" selected>ผู้ปกครอง</option>
                                                </select>
                                                <label for="floatingSelect">Please Select Type of User</label>
                                            </div>
                                        </div>
                                        <div class="parentPanel">
                                            <div class="table-responsive">
                                                <table class="table" id="item_table">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:45%;height:100%;">นักเรียน</th>
                                                            <th style="width:45%;height:100%;">คุณเกี่ยวข้องเป็น</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                                <div class="col-md-12 text-center">
                                                    <button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i> เพิ่มนักเรียน</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer bg-white">
                                    <button class="action back btn btn-sm btn-outline-warning" style="display: none">ย้อนกลับ</button>
                                    <button class="action next btn btn-sm btn-outline-primary float-end">ถัดไป</button>
                                    <button class="action submit btn btn-sm btn-outline-success float-end" style="display: none">บันทึก</button>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery/jquery.inputmask.js"></script>
    <script>
        var username_old, email_old;
        var step = 1;

        $(document).ready(function() {
            stepProgress(step);
            showProvinceList();

            var count = 0;

            function add_input_field(count) {

                var html = '';

                html += '<tr>';

                html += `<td><div class="form-group row"><select name="item_student[]" id="std_row` + count + `" class="form-control selectpicker" data-live-search="true" onchange="checkRelation()">
<option value="" disabled selected>-โปรดเลือกนักเรียน-</option></select><div id="student_err` + count + `" style="display:none">โปรดเลือกนักเรียน</div></div></td>`;


                html += `<td><select name="item_parent[]" id="parent_row` + count + `" class="form-control selectpicker" data-live-search="true" onchange="checkRelation()">
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
                                        <option value="ผู้ปกครอง">ผู้ปกครอง</option></select><div id="parent_err` + count + `" style="display:none">โปรดเลือกความเกี่ยวข้อง</div></td>`;

                var remove_button = '<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-trash"></i></button>';

                if (count > 0) {
                    remove_button = '<button type="button" name="remove" class="btn btn-danger btn-sm remove"><i class="fas fa-trash"></i></button>';
                }

                html += '<td>' + remove_button + '</td></tr>';

                return html;

            }


            $('#item_table').append(add_input_field(0));
            getStudentList(0);

            $(document).on('click', '.add', function() {

                count++;

                $('#item_table').append(add_input_field(count));
                getStudentList(count);


            });

            $(document).on('click', '.remove', function() {

                $(this).closest('tr').remove();

            });

        });

        $(".next").on("click", function() {
            var nextstep = false;
            if (step == 1) {
                $("#accForm").bootstrapValidator();
                if ($('#accForm').bootstrapValidator('validate').has('.has-error').length === 0) {
                    // form is valid
                    nextstep = true;
                }

            } else if (step == 2) {
                $("#infoForm").bootstrapValidator();
                if ($('#infoForm').bootstrapValidator('validate').has('.has-error').length === 0) {
                    // form is valid
                    nextstep = true;
                }
                //nextstep = checkForm("userinfo");
            } else if (step == 3) {
                $("#contactForm").bootstrapValidator();
                if ($('#contactForm').bootstrapValidator('validate').has('.has-error').length === 0) {
                    // form is valid
                    nextstep = true;
                }
                //nextstep = checkFormContact("usercontact");
            } else {
                nextstep = true;
            }
            if (nextstep == true) {
                if (step < $(".step").length) {
                    $(".step").show();
                    $(".step")
                        .not(":eq(" + step++ + ")")
                        .hide();
                    stepProgress(step);
                }
                hideButtons(step);
            }
        });


        // ON CLICK BACK BUTTON
        $(".back").on("click", function() {
            if (step > 1) {
                step = step - 2;
                $(".next").trigger("click");
            }
            hideButtons(step);
        });

        // CALCULATE PROGRESS BAR
        stepProgress = function(currstep) {
            var percent = parseFloat(100 / $(".step").length) * currstep;
            percent = percent.toFixed();
            $(".progress-bar")
                .css("width", percent + "%")
                .html(percent + "%");
        };

        // DISPLAY AND HIDE "NEXT", "BACK" AND "SUMBIT" BUTTONS
        hideButtons = function(step) {
            var limit = parseInt($(".step").length);
            $(".action").hide();
            if (step < limit) {
                $(".next").show();
            }
            if (step > 1) {
                $(".back").show();
            }
            if (step == limit) {
                $(".next").hide();
                $(".submit").show();
            }
        };

        $('#accForm').bootstrapValidator({
            fields: {
                user_name: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุ Username'
                        },
                        remote: {
                            url: 'ajax_check/ajax_check_username.php',
                            type: 'POST',
                            message: 'Username นี้ถูกใช้งานแล้ว',
                            data: function(validator) {
                                return {
                                    username: $("#user_name").val(),
                                    username_old: ""
                                };
                            },
                        }

                    }
                },
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
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            $('#accForm').data('bootstrapValidator').resetForm();
            e.preventDefault();
        });


        $('#infoForm').bootstrapValidator({
            fields: {
                gender: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกเพศ'
                        },
                    }
                },
                pname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดเลือกคำนำหน้าชื่อ'
                        },
                    }
                },
                firstname: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุชื่อจริง'
                        },
                    }
                },
                lastname: {
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
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            $('#infoForm').data('bootstrapValidator').resetForm();
            e.preventDefault();
        });


        $('#contactForm').bootstrapValidator({
            fields: {
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
                            message: 'อีเมลนี้ถูกใช้งานแล้ว',
                            data: function(validator) {
                                return {
                                    email: $('#email').val(),
                                    email_old: ""
                                };
                            },
                        }
                    }
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเบอร์โทรศัพท์'
                        },
                        regexp: {
                            regexp: /^\d{10}$/,
                            message: 'โปรดระบุตัวเลขให้ครบทั้ง 10 ตัว'
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
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            $('#contactForm').data('bootstrapValidator').resetForm();
            e.preventDefault();
        });

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
                    $("#infoForm").bootstrapValidator('revalidateField', 'zipcode');
                }
            });

        }


        function getStudentList(num) {
            $.ajax({
                type: 'POST',
                url: 'ajax_list/ajax_student_list_sign_up.php',
                success: function(data) {
                    console.log("Select Picker " + data)
                    $('#std_row' + num).html(data);
                    //$('#std_row'+num).selectpicker('refresh');
                    $('.selectpicker').selectpicker('refresh');
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        $(".submit").on("click", function() {


            if (checkRelation()) {
                alert("Can Submit");
                addParent();
            }
        })


        function checkRelation() {
            var count = 0;
            var valid = true;
            $("#relationForm select[name='item_parent[]']").each(function() {
                if ($(this).val() == '' || $(this).val() == null) {
                    $(this).addClass("is-invalid");
                    $("#parent_err" + count).addClass("invalid-feedback d-block");
                    valid = false;
                } else {
                    $(this).removeClass("is-invalid");
                    $("#parent_err" + count).removeClass("invalid-feedback d-block");
                }
                count++
            })

            var count = 0;
            $("#relationForm select[name='item_student[]']").each(function() {
                if ($(this).val() == '' || $(this).val() == null) {
                    $(this).addClass("is-invalid");
                    $("#student_err" + count).addClass("invalid-feedback d-block");
                    valid = false;
                } else {
                    $(this).removeClass("is-invalid");
                    $("#student_err" + count).removeClass("invalid-feedback d-block");
                }
                count++
            })

            return valid;
        }


        function addParent() {
            Swal.fire({
                title: 'ยืนยันการลงทะเบียน',
                text: "ยืนยันการลงทะเบียนระบบดูแลช่วยเหลือเด็กปฐมวัย!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
            }).then((result) => {
                if (result.isConfirmed) {


                   /*  for (var pair of formCon.entries()) {
                        formData.append(pair[0], pair[1]);
                    }
                    for (var pair of formRela.entries()) {
                        formData.append(pair[0], pair[1]);
                    } */

                    Swal.fire({
                        title: "กำลังโหลด...",
                        html: "กรุณารอสักครู่",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    })


                    $.ajax({
                        type: 'POST',
                        url: 'ajax/ajax_sign_up.php',
                        data: $("#accForm,#infoForm,#contactForm,#relationForm").serializeArray(),
                        success: function(res) {
                            console.log("Res : " + res);
                            if (res.search("Add Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'ลงทะเบียนสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    /* location.reload(); */
                                    location.href = 'sign_in.php';
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'ลงทะเบียนไม่สำเร็จ!',
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
</body>

</html>