<?php
session_start();
//print_r($_SESSION);
include 'dbconfig.php';
$sql = "SELECT ( SELECT COUNT(*) FROM student ) AS student, 
( SELECT COUNT(*) FROM parent ) AS parent, 
( SELECT COUNT(*) FROM personnel WHERE type ='คุณครู' ) AS teacher, 
( SELECT COUNT(*) FROM personnel WHERE type ='ฝ่ายบริหาร' ) AS exuclusive, 
( SELECT COUNT(*) FROM personnel WHERE type ='ผู้ดูแลระบบ' ) AS admin FROM dual;";
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$total = $row['student']+ $row['parent']+ $row['teacher']+ $row['exuclusive']+ $row['admin'];
$data = array($row['student'], $row['parent'], $row['teacher'], $row['exuclusive'], $row['admin']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <title>KidCare - แดชบอร์ด</title>
    <?php include './layout/head.php' ?>
    <style>
        #pie_chart, #column_chart {
            width: 500px;
            margin: 2px auto;
            padding: 0;
        }

        .dash-primary{
  color: #008FFB !important;
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

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-info">แดชบอร์ด</h1>
                    </div>

                    <div class="row">


                        <!-- Student -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-300 py-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-dark mb-1">
                                                นักเรียน</div>
                                            <div><span class="h3 mb-0 font-weight-bold text-gray-800"><?=$data[0]?></span> คน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-3x fa-user-graduate" style="  color: #008FFB"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Parent -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-300 py-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-dark mb-1">
                                                ผู้ปกครอง</div>
                                            <div><span class="h3 mb-0 font-weight-bold text-gray-800"><?=$data[1]?></span> คน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-3x fas fa-users" style="  color: #00E396"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Teacher -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-300 py-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-dark mb-1">
                                                คุณครู</div>
                                            <div><span class="h3 mb-0 font-weight-bold text-gray-800"><?=$data[2]?></span> คน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-3x fas fa-chalkboard-teacher" style="  color: #FEB019"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Exclusive Teacher -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-300 py-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-dark mb-1">
                                                ฝ่ายบริหาร</div>
                                            <div><span class="h3 mb-0 font-weight-bold text-gray-800"><?=$data[3]?></span> คน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-3x fas fa-book-reader" style="color: #FF4560"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <!-- Admin -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-300 py-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-dark mb-1">
                                                ผู้ดูแลระบบ</div>
                                            <div><span class="h3 mb-0 font-weight-bold text-gray-800"><?=$data[4]?></span> คน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-3x fas fa-user-cog" style="  color: #775DD0"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Total -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card shadow h-300 py-1">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xl font-weight-bold text-dark mb-1">
                                                ทั้งหมด</div>
                                            <div><span class="h3 mb-0 font-weight-bold text-gray-800"><?=$total?></span> คน</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-3x fas fa-user-edit text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card shadow mb-4 ">

                                <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                                    <div id="column_chart"></div>
                                    <script>

                                    </script>

                                </div>
                            </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="card shadow mb-4 ">

                                <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                                    <div id="pie_chart"></div>
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
        const people = <?= json_encode($data) ?>;
        $(document).ready(function() {
            showColumnChart();
            showPieChart();
        })


        function showColumnChart() {
            var colors = [
                '#008FFB',
                '#00E396',
                '#FEB019',
                '#FF4560',
                '#775DD0'
            ]
            var options = {
                series: [{
                    data: people
                }],
                chart: {
                    height: 350,
                    type: 'bar',
                    events: {
                        click: function(chart, w, e) {
                            // console.log(chart, w, e)
                        }
                    },
                    fontFamily: 'sutregular',
                    id: "people_chart"
                },
                colors: colors,
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                legend: {
                    show: false
                },
                xaxis: {
                    categories: [
                        'นักเรียน',
                        'ผู้ปกครอง',
                        'คุณครู',
                        'ฝ่ายบริหาร',
                        'ผู้ดูแลระบบ'
                    ],
                    labels: {
                        style: {
                            colors: colors,
                            fontSize: '16px',
                        }
                    }
                }
            };
            var chart = new ApexCharts(document.querySelector("#column_chart"), options);
            chart.render();
        }



        function showPieChart() {
            console.log((people));
        
            
            var options = {
                series: [parseInt(people[0]),parseInt(people[1]),parseInt(people[2]),parseInt(people[3]),parseInt(people[4])],
                chart: {
                    type: 'donut',
                    fontFamily: 'sutregular'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    showAlways: true,
                                    show: true
                                },
                                
                            }
                        }
                    }
                },
                labels: ['นักเรียน',
                    'ผู้ปกครอง',
                    'คุณครู',
                    'ฝ่ายบริหาร',
                    'ผู้ดูแลระบบ'
                ],
                 responsive: [{
                 breakpoint:480,
                 options: {
                     chart: {
                     width: 400
                     },
                 legend: {
                     position: 'bottom'
                     }
                 }
                 }]
            };

            var chart = new ApexCharts(document.querySelector("#pie_chart"), options);
            chart.render();
        }
    </script>
</body>

</html>