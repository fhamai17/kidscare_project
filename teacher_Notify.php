<?php
include('session.php');
if (isset($_GET['class_id'])) {
    $class_id = $_GET['class_id'];
} else {
    $class_id = "";
}

if (isset($_GET['class_name'])) {
    $class_name = $_GET['class_name'];
} else {
    $class_name = "";
}

if (isset($_GET['term_id'])) {
    $term_id = $_GET['term_id'];
} else {
    $term_id = "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - Manage Homework</title>
    <?php include './layout/head.php' ?>
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
            width: 300px !important;
            height: 150px !important;
            object-fit: cover !important;
            background-color: #dfdfdf;
        }
    </style>
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold">แจ้งข่าวสารโรงเรียน</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <h6 class="m-0 font-weight-bold text-info">เเจ้งข้อมูลข่าวสารผ่าน LINE NOTIFY</h6>
                        </div>
                        <div class="card-body">


                            <div class="row">
                                <div class="col-lg-8">
                                    <form id="notiForm" enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="form-group col-sm-12">
                                                <label for="exampleInput1" class="form-label">หัวข้อการเเจ้ง<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-card-heading"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="topic" name="topic" placeholder="โปรดระบุหัวข้อการเเจ้ง">
                                                </div>
                                            </div>

                                            <div class="form-group col-sm-12">
                                                <label for="exampleInput5" class="form-label">เนื้อหา<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="bi bi-pencil-square"></i></span>
                                                    </div>
                                                    <textarea class="form-control" id="description" name="description" rows="5" cols="33" placeholder="โปรดระบุ"></textarea>
                                                </div>
                                            </div>


                                            <div class="form-group col-sm-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="1" name="lineNotify" id="lineNotify">
                                                    <label class="form-check-label" for="lineNotify">
                                                        ทั้งโรงเรียน
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                </div>

                                <div class="col-lg-4 ">
                                    <div class="center">
                                        <div class="form-input">
                                            <div class="preview">
                                                <img src="images/news.jpg" id="file_preview" class="mx-auto d-block img-preview">
                                            </div>
                                            <div style="text-align: center;" id="file_name"></div>
                                            <label for="file">อัพโหลดรูป</label>
                                            <input class="form-control" type="file" id="file" name="file" accept="image/*" onchange="showPreview(event);">
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-lg-12 center">
                                <button type="submit" name="submit" class="btn btn-info mt-3">แจ้งข่าวสาร</button>
                                </form>
                            </div>



                        </div>
                    </div>
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
        var term_cur;
        var session_cur;
        var class_id = "<?= $class_id ?>"
        var term_id = "<?= $term_id ?>"

        $(document).ready(function() {
            getTermCurrent();
        })


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

        var term_cur;
        var session_cur;

        function getTermCurrent() {
            $.ajax({
                type: 'POST',
                url: 'ajax/ajax_term_current.php',
                async: false,
                success: function(data) {
                    console.log("Term Current :" + data)
                    const obj = JSON.parse(data);
                    if (data) {
                        term_cur = obj.term_id;
                        session_cur = obj.session_id;
                    }

                    //alert("Term : " + term_cur + "\n\nSession : " + session_cur)
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        $('#notiForm').bootstrapValidator({
            fields: {
                topic: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุเนื้อหา'
                        },
                    }
                },
                description: {
                    validators: {
                        notEmpty: {
                            message: 'โปรดระบุรายละเอียด'
                        },
                    }
                },
            }
        }).on('success.form.bv', function(e) {
            // Prevent submit form
            e.preventDefault();
            lineNotify();
        });


        function lineNotify() {
            let formData = new FormData($("#notiForm")[0]);
            formData.append("term_id",term_cur);

            Swal.fire({
                        title: "กำลังโหลด...",
                        html: "กรุณารอสักครู่",
                        didOpen: function() {
                            Swal.showLoading()
                        }
                    })

            $.ajax({
                type: 'POST',
                url: 'line/ajax_news_notify.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log("Res : " + res);
                    

                    if (res.search("Successful") != -1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'แจ้งข่าวสารสำเร็จ!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    //location.reload();
                                    //$('#homeworkModal').modal('hide');
                                    //showHomeworkTable(class_id);
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'แจ้งข่าวสารไม่สำเร็จ!',
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
    </script>

</body>

</html>