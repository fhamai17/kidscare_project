
var step = 1;
$(document).ready(function () { stepProgress(step); });
$(".next").on("click", function () {
  var nextstep = false;
  if (step == 1) {
    nextstep = true;
    //nextstep = checkForm1("useracc");
  }
  else if (step == 2) {
    nextstep = true;
    //nextstep = checkForm("userinfo");
  } else if (step == 3) {
    nextstep = true;
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
/* $(".next").on("click", function () {
  var nextstep = false;
  if (step == 1) {
    nextstep = checkForm1("useracc");
  }
  else if (step == 2) {
    nextstep = checkForm("userinfo");
  } 
  else if (step == 3) {
    nextstep = checkFormContact("usercontact");
  } else{
    nextstep == true
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
}); */

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


// ON CLICK BACK BUTTON
$(".submit").on("click", function () {
  alert("Submit");
  if(checkFormType("typepanel")){
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
              data: $('#registerForm').serializeArray(),
              success: function(res) {
                  console.log("Res : "+res);
                  if (res.search("Add Successful") != -1) {
                      Swal.fire({
                          icon: 'success',
                          title: 'ลงทะเบียนสำเร็จ!',
                          showConfirmButton: false,
                          timer: 1500
                      }).then((result) => {
                          /* location.reload(); */
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
});


function setFormFields(id) {
  if (id != false) {
    // FILL STEP 2 FORM FIELDS
    d = data.find(x => x.id === id);
    $('#fname').val(d.fname);
    $('#lname').val(d.lname);
    $('#team').val(d.team);
    $('#address').val(d.address);
    $('#tel').val(d.tel);
  } else {
    // EMPTY USER SEARCH INPUT
    $("#txt-search").val('');
    // EMPTY STEP 2 FORM FIELDS
    $('#fname').val('');
    $('#lname').val('');
    $('#team').val('');
    $('#address').val('');
    $('#tel').val('');
  }
}

function checkForm(val) {
  // CHECK IF ALL "REQUIRED" FIELD ALL FILLED IN
  var valid = true;
  $("#" + val + " input:required").each(function () {
    if ($(this).val() === "") {
      $(this).addClass("is-invalid");
      valid = false;
    } else {
      $(this).removeClass("is-invalid");
    }


  });


  $("#" + val + " select").each(function (index) {
    if ($(this).val() === "" || $(this).val() === null) {
      $(this).addClass("is-invalid");
      valid = false;
    } else {
      $(this).removeClass("is-invalid");
    }



  });
  return valid;
}


function checkForm1(val) {
  // CHECK IF ALL "REQUIRED" FIELD ALL FILLED IN
  var valid = true;

  //Check Username


  /* if(username==="teacher01"){
    alert("EXITS")
  }else{
    alert("No EXITS")
  } */
  /*     $.ajax({
        type : "POST",
        url : "ajax_list/ajax_username_list.php",
        data : {username},
        async: false,
        success : function(data) {
             if (data) {
              valid = false;
              $("#err_username").html("บัญชีนี้ถูกใช้แล้ว");
              $('#user_name').addClass("is-invalid ");
            } else{
              console.log("555")
              $('#username').removeClass("is-invalid");
            }
        }
     }); */
  /*   if(checkUserName(username)){
      alert("FALSE")
    }else{
      alert("TRUE")
    }; */


  $("#" + val + " input:required").each(function () {
    if ($(this).val() === "") {
      $(this).addClass("is-invalid");
      valid = false;
    }
    else {
      $(this).removeClass("is-invalid");

      //Check Username
      if ($(this).attr('id') === "user_name") {

        var username = $('#user_name').val();
        $.ajax({
          type: "POST",
          url: "ajax_list/ajax_username_list.php",
          data: { username },
          async: false,
          success: function (data) {
            if (data == 404) {
              console.log(data);
              valid = false;
              $("#err_username").html("บัญชีนี้ถูกใช้แล้ว");
              $('#user_name').addClass("is-invalid ");
            } else {
              valid = true;
              console.log("555")
              $('#user_name').removeClass("is-invalid");
            }
          }
        });
      }

      //Check Username
      if ($(this).attr('id') === "password") {
        if ($(".invalid")[0]) {
          // Do something if class exists
          valid = false;
          $("#err_password").html("โปรดกรอกรหัสผ่านให้ถูกต้อง");
          $('#password').addClass("is-invalid ");
        }
      } else {
        $('#password').removeClass("is-invalid");
      }


      if ($(this).attr('id') === "con_password") {
        var password = $("#password").val();
        var confirmPassword = $("#con_password").val();
        if (password != confirmPassword && password != "" && confirmPassword != "") {
          $("#err_cpassword").html("โปรดระบุรหัสผ่านให้ตรงกัน");
          $('#con_password').addClass("is-invalid ");
          valid = false;
        }
        else {
          $(this).removeClass("is-invalid");
        }

      }

    }
  });


  return valid;

}

/* 
function checkUserName(username) {

  alert(username);
  var flag=false;
  
  $.ajax({
      type : "POST",
      url : "ajax_list/ajax_username_list.php",
      data : {username},
      async: false,
      success : function(data) {
           if (data) {
            console.log(data)
              flag=true;
          } 
      }
   });
   
  return flag;
  }
 */

function checkFormContact(val) {
  // CHECK IF ALL "REQUIRED" FIELD ALL FILLED IN
  var valid = true;
  $("#" + val + " input:required").each(function () {
    if ($(this).val() === "") {
      $(this).addClass("is-invalid");
      valid = false;

    } else {
      $(this).removeClass("is-invalid");
      if ($(this).attr('id') === "email") {

        var email = $("#email").val();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email)) {
          valid = false;
          $("#err_email").html("โปรดกรอกอีเมลให้ถูกต้อง");
          $('#email').addClass("is-invalid ");
        } else {
          $('#remove').addClass("is-invalid ");
          //Check Username
          var email = $('#email').val();
          $.ajax({
            type: "POST",
            url: "ajax_list/ajax_email_list.php",
            data: { email },
            async: false,
            success: function (data) {
              if (data == 404) {
                console.log(data);
                valid = false;
                $("#err_email").html("อีเมลนี้ถูกใช้แล้ว");
                $('#email').addClass("is-invalid ");
              } else {
                valid = true;
                console.log("555")
                $('#email').removeClass("is-invalid");
              }
            }
          });
        };

      }

    }
  });
  return valid;
}




function checkFormType(val) {
  console.log("checkType")
  // CHECK IF ALL "REQUIRED" FIELD ALL FILLED IN
  var valid = true;

  var type = $('#userType').val();


  if (type === "" || type === null) {
    alert("No Type")
    $("#userType").addClass("is-invalid");
    valid = false;

  } else {
    $("#userType").removeClass("is-invalid");
  }


  if (type === 'ผู้ปกครอง') {
    console.log("ผู้ปกครอง")

    if ($("#career").val() === "") {
      $("#career").addClass("is-invalid");
      valid = false;
    } else {
      $("#career").removeClass("is-invalid");
    }

    if ($("#salary").val() === "") {
      $("#salary").addClass("is-invalid");
      valid = false;
    } else {
      $("#salary").removeClass("is-invalid");
    }

    var count = 0;
    $("#" + val + " select[name='item_student[]']").each(function () {
      alert("item_student : " + $(this).val());
      if ($(this).val() == '' || $(this).val() == null) {
        $(this).addClass("is-invalid");
        $("#std_err" + count).addClass("invalid-feedback d-block");
        valid = false;
      } else {
        $(this).removeClass("is-invalid");
        $("#std_err" + count).removeClass("invalid-feedback d-block");
      }
      count++;
    });

    var count = 0;
    $("#" + val + " select[name='item_parent[]']").each(function () {
      if ($(this).val() == '' || $(this).val() == null) {
        $(this).addClass("is-invalid");
        $("#parent_err" + count).addClass("invalid-feedback d-block");
        valid = false;
      } else {
        $(this).removeClass("is-invalid");
        $("#parent_err" + count).removeClass("invalid-feedback d-block");
      }
      count++;
    });
  }


  return valid;
}