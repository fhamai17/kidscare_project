<style>
    #teacher_sdq_section2,
    #parent_sdq_section2 {
        width: 400px;
        margin: 2px auto;
        padding: 0;
    }

    #teacher_sdq_section1,
    #parent_sdq_section1 {
        width: 800px;
        margin: 2px auto;
        padding: 0;
    }

    #all_sdq_chart {
        width: 800px;
        margin: 2px auto;
        padding: 0;
    }
</style>



<!-- Nested Row within Card Body -->
<div class="row">
    <div class="col-lg-12 mb-2">
        <h1 class="h6 mb-0 text-info">ครูประเมิน</h1>
    </div>

    <div class="col-lg-8 mb-3">
        <div class="card">

            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="teacher_sdq_section1"></div>
                <script>

                </script>

            </div>
        </div>
    </div>


    <div class="col-lg-4 mb-3">
        <div class="card">

            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="teacher_sdq_section2"></div>
                <script>

                </script>

            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-lg-12">
        <h1 class="h6 mb-0 text-info mb-2">ผู้ปกครอง</h1>
    </div>

    <div class="col-lg-8 mb-3">
        <div class="card">

            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="parent_sdq_section1"></div>
                <script>

                </script>

            </div>
        </div>
    </div>


    <div class="col-lg-4 mb-3">
        <div class="card">

            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="parent_sdq_section2"></div>
                <script>

                </script>

            </div>
        </div>
    </div>
</div>



<div class="row mt-2">
    <div class="col-lg-12">
        <h1 class="h6 mb-0 text-info mb-2">ภาพรวม</h1>
    </div>

    <div class="col-lg-12 mb-3">
        <div class="card">

            <div class="card-body  align-items-center d-flex justify-content-center" style="height: 400px!important;">

                <div id="all_sdq_chart"></div>
            </div>
        </div>
    </div>
</div>



<script>
    var sdqColor = ['#50b2c0', '#faaa8d', '#ff4000'];
    $(function() {
        //showSDQColumnChart();
        //showSDQPieChart();
        showSDQBehaviourChart("teacher_sdq_section1", "teacher", "behaviour");
        showSDQBehaviourChart("parent_sdq_section1", "parent", "behaviour");
        showSDQStrengthChart("teacher_sdq_section2", "teacher", "strength");
        showSDQStrengthChart("parent_sdq_section2", "parent", "strength");
        showAllSDQChart();
    });


    function showSDQBehaviourChart(id, user, chart) {
        $.ajax({
            type: 'POST',
            url: 'ajax_dashboard/ajax_sdq_sql.php',
            data: {
                user_type: user,
                chart: chart,
                session: $('#session_search').val(),
                term: $('#term_search').val(),
                grade: $('#grade_search').val(),
                section: $('#section_search').val()

            },
            success: function(data) {
                //console.log("SDQ SQL :" + data)
                //$("#text").html(data);
                var obj = JSON.parse(data);

                var options = {
                    series: [],
                    colors: sdqColor,
                    chart: {
                        height: 350,
                        type: 'bar',
                        events: {
                            click: function(chart, w, e) {
                                // console.log(chart, w, e)
                            }
                        },
                        fontFamily: 'sutregular',
                        id: "teacher_sdq_chart"
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value;
                            }
                        },
                        title: {
                            text: 'จำนวน (คน)'
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 3,
                        //colors: ['transparent']
                    },

                    xaxis: {
                        categories: [
                            'พฤติกรรมเกเร',
                            'พฤติกรรมอยู่ไม่นิ่ง',
                            'ปัญหาทางอารมณ์',
                            'ปัญหาความสัมพันธ์กับเพื่อน',
                        ],
                        labels: {
                            style: {
                                fontSize: '16px',
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#" + id), options);
                chart.render();

                var result = []
                var problem = []
                var risk = []
                var normal = []
                //loop through return data 
                $(obj).each(function(i, v) {
                    //push values as x & y
                    problem.push({
                        "x": v.result,
                        "y": v.problem
                    })
                    risk.push({
                        "x": v.result,
                        "y": v.risk
                    })

                    normal.push({
                        "x": v.result,
                        "y": v.normal
                    })
                })
                chart.updateSeries([{
                    name: 'ปกติ',
                    data: normal //pass them here 
                }, {
                    name: 'เสี่ยง',
                    data: risk //pass them here
                }, {
                    name: 'มีปัญหา',
                    data: problem //pass them here
                }])



            },
            error: function(err) {
                alert("Error" + err)
            }
        });
    }


    function showSDQStrengthChart(id, user, chart) {

        $.ajax({
            type: 'POST',
            url: 'ajax_dashboard/ajax_sdq_sql.php',
            data: {
                user_type: user,
                chart: chart,
                session: $('#session_search').val(),
                term: $('#term_search').val(),
                grade: $('#grade_search').val(),
                section: $('#section_search').val()

            },
            success: function(data) {
                //console.log("SDQ Stregth :" + data)
                var obj = JSON.parse(data);
                var options = {
                    series: [{
                        data: [{
                                x: 'มีจุดแข็ง',
                                y: parseInt(obj[0].y)
                            },
                            {
                                x: 'ไม่มีจุดแข็ง',
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
                    colors: sdqColor,
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
                    xaxis: {
                        categories: [
                            'มีจุดแข็ง',
                            'ไม่มีจุดแข็ง'
                        ],
                        labels: {
                            style: {
                                fontSize: '16px',
                            }
                        }
                    }
                };
                var chart = new ApexCharts(document.querySelector("#" + id), options);
                chart.render();
            },
            error: function(err) {
                alert("Error" + err)
            }
        });
    }


    function showAllSDQChart() {
        $.ajax({
            type: 'POST',
            url: 'ajax_dashboard/ajax_sdq_sql_all.php',
            data: {
                session: $('#session_search').val(),
                term: $('#term_search').val(),
                grade: $('#grade_search').val(),
                section: $('#section_search').val()

            },
            success: function(data) {
                console.log("ALL SDQ :" + data)
                //$("#text").html(data);
                var obj = JSON.parse(data);

                var options = {
                    series: [],
                    colors: ['#086788', '#07a0c3'],
                    chart: {
                        height: 350,
                        type: 'bar',
                        events: {
                            click: function(chart, w, e) {
                                // console.log(chart, w, e)
                            }
                        },
                        fontFamily: 'sutregular',
                        id: "all_sdq_chart"
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value) {
                                return value;
                            }
                        },
                        title: {
                            text: 'จำนวน (คน)'
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 3,
                        //colors: ['transparent']
                    },

                    xaxis: {
                        categories: [
                            'กลุ่มปกติ',
                            'กลุ่มเสี่ยง',
                            'กลุ่มมีปัญหา'
                        ],
                        labels: {
                            style: {
                                fontSize: '16px',
                            }
                        }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#all_sdq_chart"), options);
                chart.render();

                var result = []
                var parent = []
                var teacher = []
                var problem = []
                var risk = []
                var normal = []
                //loop through return data 
                $(obj).each(function(i, v) {
                    //push values as x & y
                    console.log(v);

                    teacher.push({
                        "x":   v.result,
                        "y":  v.teacher
                    })

                    parent.push({
                        "x":  v.result,
                        "y":  v.parent
                    })

                })
                chart.updateSeries([{
                    name: 'สรุปภาพรวมคุณครู',
                    data: teacher //pass them here 
                }, {
                    name: 'สรุปภาพรวมผู้ปกครอง',
                    data: parent //pass them here
                }, ])



            },
            error: function(err) {
                alert("Error" + err)
            }
        });
    }
</script>