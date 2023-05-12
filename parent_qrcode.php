<?php
include('session.php');
error_reporting(E_ERROR | E_PARSE);
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>KidsCare - QR CODE ของฉัน</title>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info font-weight-bold">QR CODE ของฉัน</h1>
                    </div>

                    <!-- Collapsable Card Example -->
                    <div class="card shadow mb-4">
                        <!-- Card Content - Collapse -->
                        <div class="collapse show" id="collapseCardExample">
                            <div class="card-body">

                                <center>
                                    <!-- img I need full page size on card body -->
                                    <div class="view overlay zoom">
                                        <?php 
                                        $code = $_SESSION['user_id'];
                                        echo "<img src='https://chart.googleapis.com/chart?chs=400x400&cht=qr&chl=$code&choe=UTF-8' class='img-fluid' alt='QR CODE'>"; ?>
                                    </div>
                                </center>
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

</body>

</html>