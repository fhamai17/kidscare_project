
<?php include('session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - ความสัมพันธ์ผู้ปกครอง</title>
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

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <h6 class="m-0 font-weight-bold text-info">รายการคำร้องขอบัญชีผู้ใช้</h6>
                            <button class="btn btn-info" onclick="window.open('adminAddParent.php')">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มผู้ปกครอง</span>
                            </button>
                        </div>
                        <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="parent-tab" data-toggle="tab" href="#parent" role="tab" aria-controls="parent" aria-selected="true">ผู้ปกครอง</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="teacher-tab" data-toggle="tab" href="#teacher" role="tab" aria-controls="teacher" aria-selected="false">คุณครู</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="executive-tab" data-toggle="tab" href="#executive" role="tab" aria-controls="executive" aria-selected="false">ผู้บริหาร</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="parent" role="tabpanel" aria-labelledby="parent-tab">
    <div class="p-5" id="parent_table">

    </div>
</div>
  <div class="tab-pane fade" id="teacher" role="tabpanel" aria-labelledby="teacher-tab">
  <div class="p-5" id="teacher_table">

</div>
  </div>
  <div class="tab-pane fade" id="executive" role="tabpanel" aria-labelledby="executive-tab">
    <div class="p-5" id="exclusive_table">
        
    </div>
  </div>
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
        $(document).ready(function() {
            showParentTable();
            showTeacherTable();
            showExcluesiveTable();
        });


        function showParentTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_acc_parent.php',
                success: function(data) {
                    console.log("Test :" + data)
                    $('#parent_table').html(data);
                    $('#parentDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }

        function showTeacherTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_acc_teacher.php',
                data:{type:"คุณครู"},
                success: function(data) {
                    console.log("Test :" + data)
                    $('#teacher_table').html(data);
                    $('#teacherDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }


        function showExcluesiveTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_acc_exclusive.php',
                data:{type:"ฝ่ายบริหาร"},
                success: function(data) {
                    console.log("Test :" + data)
                    $('#exclusive_table').html(data);
                    $('#exclusiveDataTable').DataTable({
                        /* responsive: true */
                    });
                },
                error: function(err) {
                    alert("Error" + err)
                }
            });
        }
    </script>

</body>

</html>