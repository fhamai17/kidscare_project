var username_old;


var step = 1;
$(document).ready(function () { stepProgress(step); });
$(".next").on("click", function () {
  var nextstep = false;
  if (step == 1) {
    $("#registForm").bootstrapValidator();
    if ($('#registForm').bootstrapValidator('validate').has('.has-error').length === 0) {
        // form is valid
        nextstep = true;
    }
  }
  else if (step == 2) {
    $("#registForm").bootstrapValidator();
    if ($('#registForm').bootstrapValidator('validate').has('.has-error').length === 0) {
        // form is valid
        nextstep = true;
    }
  } else if (step == 3) {
    $("#registForm").bootstrapValidator();
    if ($('#registForm').bootstrapValidator('validate').has('.has-error').length === 0) {
        // form is valid
        nextstep = true;
    }
  } else {
    $("#registForm").bootstrapValidator();
    if ($('#registForm').bootstrapValidator('validate').has('.has-error').length === 0) {
        // form is valid
        nextstep = true;
    }
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
$(".back").on("click", function () {
  if (step > 1) {
    step = step - 2;
    $(".next").trigger("click");
  }
  hideButtons(step);
});

// CALCULATE PROGRESS BAR
stepProgress = function (currstep) {
  var percent = parseFloat(100 / $(".step").length) * currstep;
  percent = percent.toFixed();
  $(".progress-bar")
    .css("width", percent + "%")
    .html(percent + "%");
};

// DISPLAY AND HIDE "NEXT", "BACK" AND "SUMBIT" BUTTONS
hideButtons = function (step) {
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
    $("#" + val + " select[name='item_parent[]']").each(function () {
      if ($(this).val() == '' || $(this).val() == null) {
        $(this).addClass("is-invalid");
        $("#parent_err" + count).addClass("invalid-feedback d-block");
        valid = false;
      } else {
        $(this).removeClass("is-invalid");
        $("#parent_err" + count).removeClass("invalid-feedback d-block");
      }
    })
});