<?php include('session.php') ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidCare - ผู้ปกครอง</title>
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
                            <h6 class="m-0 font-weight-bold text-info">รายการผู้ปกครอง</h6>
                            <button class="btn btn-info" onclick="window.open('adminParentForm.php')">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus-square"></i>
                                </span>
                                <span class="text">เพิ่มผู้ปกครอง</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <div id="parent_table">

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
        });


        function showParentTable() {
            $.ajax({
                type: 'POST',
                url: 'ajax_person_info/ajax_parent_table.php',
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

    </script>

</body>

</html>