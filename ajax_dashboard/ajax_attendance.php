<style>
    #att_pie_chart {
        width: 400px;
        margin: 2px auto;
        padding: 0;
    }

    #att_column_chart {
        width: 800px;
        margin: 2px auto;
        padding: 0;
    }
</style>
<!-- Nested Row within Card Body -->
<div class="row mt-2" id="test">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center py-3 bg-white" style="height:60px">
                <h6 class="m-0 text-info">สถานะมาเรียนวันนี้ (<?= date('Y/m/d') ?>)</h6>
            </div>
            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="att_pie_chart">

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-end align-items-center py-3 bg-white" style="height:60px">
                <div id="reportrange" class="pull-left" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;height:20">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp;
                    <span></span> <b class="caret"></b>
                </div>
            </div>
            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="att_column_chart">

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
            $('#reportrange span').html(start.format('YYYY/MM/DD') + ' - ' + end.format('YYYY/MM/DD'));
        }

        $('#reportrange').daterangepicker({
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

        showAttColumnChart();
        showPieChart();
    });


    function showAttColumnChart() {
        var date_range = $('#reportrange span').html();
        var dates = date_range.split(" - ");
        var start = dates[0];
        var end = dates[1];

        //alert(dates[1]);
        $.ajax({
            type: 'POST',
            url: 'ajax_dashboard/ajax_attendance_sql.php',
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
                console.log("ATT SQL :" + data)
                var obj = JSON.parse(data);

                var options = {
                    series: [],
                    colors: ['#50b2c0', '#f0c808','#faaa8d','#ff4000','#201e1f'],
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
                var chart = new ApexCharts(document.querySelector("#att_column_chart"), options);
                chart.render();
                var present = []
                var late = []
                var leave = []
                var absent = []
                //loop through return data 
                $(obj).each(function(i, v) {
                    //push values as x & y
                    present.push({
                        "x": v.date,
                        "y": v.present
                    })
                    late.push({
                        "x": v.date,
                        "y": v.late
                    })

                    leave.push({
                        "x": v.date,
                        "y": v.leave
                    })

                    absent.push({
                        "x": v.date,
                        "y": v.absent
                    })
                })
                chart.updateSeries([{
                    name: 'มาเรียน',
                    data: present //pass them here 
                }, {
                    name: 'สาย',
                    data: late //pass them here
                }, {
                    name: 'ลา',
                    data: leave //pass them here
                }, {
                    name: 'ขาด',
                    data: absent //pass them here
                }])

            },
            error: function(err) {
                alert("Error" + err)
            }
        });
    }



    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        showAttColumnChart();
    });

    function showPieChart() {

        $.ajax({
            type: 'POST',
            url: 'ajax_dashboard/ajax_attendance_sql.php',
            data: {
                now: 'yes',
                session: $('#session_search').val(),
                term: $('#term_search').val(),
                grade: $('#grade_search').val(),
                section: $('#section_search').val()

            },
            success: function(data) {
                console.log("Att Pie SQL :" + data)
                var obj = JSON.parse(data);


                var options = {
                    series: [parseInt(obj.present), parseInt(obj.late), parseInt(obj.leave), parseInt(obj.absent)],
                    colors: ['#50b2c0', '#f0c808','#faaa8d','#ff4000','#201e1f'],
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
                    labels: ['มาเรียน',
                        'สาย',
                        'ลา',
                        'ขาด'
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

                var chart = new ApexCharts(document.querySelector("#att_pie_chart"), options);
                chart.render();

            },
            error: function(err) {
                alert("Error" + err)
            }
        });

    }
</script>