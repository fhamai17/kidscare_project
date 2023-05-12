<style>
    #home_pie_chart {
        width: 400px;
        margin: 2px auto;
        padding: 0;
    }

    #home_column_chart {
        width: 800px;
        margin: 2px auto;
        padding: 0;
    }
</style>



<!-- Nested Row within Card Body -->
<div class="row mt-2">
    <div class="col-lg-6">
        <div class="card">

            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="home_column_chart"></div>
                <script>

                </script>

            </div>
        </div>
    </div>



    <div class="col-lg-6">
        <div class="card">

            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="home_pie_chart"></div>
            </div>
        </div>
    </div>

</div>


<script>
    var homeColor = ['#50b2c0', '#faaa8d'];
    $(function() {
        showHomeColumnChart();
        showHomePieChart();
    });


    function showHomeColumnChart() {

        $.ajax({
            type: 'POST',
            url: 'ajax_dashboard/ajax_home_sql.php',
            data: {
                session: $('#session_search').val(),
                term: $('#term_search').val(),
                grade: $('#grade_search').val(),
                section: $('#section_search').val()

            },
            success: function(data) {
                console.log("Home Column :" + data)
                var obj = JSON.parse(data);
                var options = {
                    series: [{
                        data: [{
                                x: 'เสร็จสื้น',
                                y: parseInt(obj[0].y)
                            },
                            {
                                x: 'ยังไม่ได้เยี่ยม',
                                y: parseInt(obj[1].y)
                            },
                        ]
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
                        id: "home_column_chart"
                    },
                    colors: homeColor,
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value;
                            }
                        },
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '45%',
                            distributed: true,
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 3,
                        //colors: ['transparent']
                    },
                    legend: {
                        show: false
                    },
                    xaxis: {
                        categories: [
                            'เยี่ยมบ้านแล้ว',
                            'ยังไม่ได้เยี่ยม'
                        ],
                        labels: {
                            style: {
                                fontSize: '16px',
                            }
                        }
                    }
                };
                var chart = new ApexCharts(document.querySelector("#home_column_chart"), options);
                chart.render();




            },
            error: function(err) {
                alert("Error" + err)
            }
        });
    }

    function showHomePieChart() {
        $.ajax({
            type: 'POST',
            url: 'ajax_dashboard/ajax_home_sql.php',
            data: {
                session: $('#session_search').val(),
                term: $('#term_search').val(),
                grade: $('#grade_search').val(),
                section: $('#section_search').val()

            },
            success: function(data) {
                console.log("Pie SQL :" + data)
                var obj = JSON.parse(data);

                var options = {
                    series: [parseInt(obj[0].y), parseInt(obj[1].y)],
                    colors: homeColor,
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
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value;
                            }
                        },
                    },
                    labels: ['เยี่ยมบ้านแล้ว', 'ยังไม่ได้เยี่ยม'],

                    responsive: [{
                        breakpoint: 480,
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

                var chart = new ApexCharts(document.querySelector("#home_pie_chart"), options);
                chart.render();

            },
            error: function(err) {
                alert("Error" + err)
            }
        });

    }
</script>