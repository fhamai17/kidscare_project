<style>
    #leave_pie_chart {
        width: 400px;
        margin: 2px auto;
        padding: 0;
    }

    #leave_column_chart {
        width: 800px;
        margin: 2px auto;
        padding: 0;
    }

</style>
<!-- Nested Row within Card Body -->
<div class="row mt-2">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3 bg-white" style="height:60px">
                <h6 class="m-0 text-info">ลาเรียนวันนี้ (<?= date('Y/m/d') ?>)</h6>
            </div>
            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="leave_pie_chart">

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-end align-items-center py-3 bg-white" style="height:60px">
                <div id="leave_reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;height:20">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="leave_column_chart">

                </div>
            </div>
        </div>
    </div>

</div>


<script>
    $(function() {

        var start = moment().subtract(6, 'days');
        var end = moment();

        function cb(start, end) {
            $('#leave_reportrange span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
        }

        $('#leave_reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'วันนี้': [moment(), moment()],
                'เมื่อวาน': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'สัปดาห์ที่ผ่านมา': [moment().subtract(6, 'days'), moment()],
                '30 วันที่ผ่านมา': [moment().subtract(29, 'days'), moment()],
                'เดือนนี้': [moment().startOf('month'), moment().endOf('month')],
                'เดือนที่แล้ว': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);

        showLeaveColumnChart();
        showLeavePieChart();
    });


    function showLeaveColumnChart() {
        var date_range = $('#leave_reportrange span').html();
        var dates = date_range.split(" - ");
        var start = dates[0];
        var end = dates[1];

        //alert(dates[1]);
        //alert($('#session_search').val())
        $.ajax({
            type: 'POST',
            url: 'ajax_dashboard/ajax_leave_sql.php',
            data: {
                now: "no",
                start,
                end,
                session: $('#session_search').val(),
                term: $('#term_search').val(),
                grade: $('#grade_search').val(),
                section: $('#section_search').val()

            },
            success: function(data) {
                console.log("Leave Column :" + data)
                var obj = JSON.parse(data);
               var options = {
                    series: [],
                    colors:['#50b2c0', '#faaa8d'],
                    chart: {
                        height: 350,
                        zoom: {
                            enabled: true
                        },
                        fontFamily: 'sutregular'
                    },
                    dataLabels: {
                        enabled: true
                    },
                    stroke: {
                        curve: 'straight',
                        width: 1.5,
                    },
                    grid: {
                        row: {
                            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                            opacity: 0.5
                        },
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value;
                            }
                        },
                    },
                };
                var chart = new ApexCharts(document.querySelector("#leave_column_chart"), options);
                chart.render();
                var personal = []
                var sick = []
                //loop through return data 
                $(obj).each(function(i, v) {
                    //push values as x & y
                    personal.push({
                        "x": v.date,
                        "y": v.personal
                    })
                    sick.push({
                        "x": v.date,
                        "y": v.sick
                    })
                })
                chart.updateSeries([{
                    name: 'ลากิจ',
                    data: personal //pass them here 
                }, {
                    name: 'ลาป่วย',
                    data: sick //pass them here
                }])

            },
            error: function(err) {
                alert("Error" + err)
            }
        });
    }



    $('#leave_reportrange').on('apply.daterangepicker', function(ev, picker) {
        showLeaveColumnChart();
    });

    function showLeavePieChart() {

        $.ajax({
            type: 'POST',
            url: 'ajax_dashboard/ajax_leave_sql.php',
            data: {
                now: 'yes',
                session: $('#session_search').val(),
                term: $('#term_search').val(),
                grade: $('#grade_search').val(),
                section: $('#section_search').val()

            },
            success: function(data) {
                console.log("Pie SQL :" + data)
                var obj = JSON.parse(data);

                //alert(obj.personal)
                //alert(obj.sick)
                var options = {
                    series: [parseInt(obj.personal), parseInt(obj.sick)],
                    colors:['#50b2c0', '#faaa8d'],
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
                    labels: ['ลากิจ',
                        'ลาป่วย',
                    ],
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

                var chart = new ApexCharts(document.querySelector("#leave_pie_chart"), options);
                chart.render();

            },
            error: function(err) {
                alert("Error" + err)
            }
        });

    }
</script>