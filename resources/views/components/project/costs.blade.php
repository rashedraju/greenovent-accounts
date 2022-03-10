@props(['project'])

<div class="card my-2">
    <div class="card-header">
        <h3 class="card-title">Project Overview</h3>
    </div>
    <div class="card-body">
        <div class="card card-bordered">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="my-1">
                            Total External: <strong>
                                <x-utils.currency />{{ number_format($project->totalExternals()) }}
                            </strong>
                        </div>
                        <div class="my-1">
                            Total Internal: <strong>
                                <x-utils.currency />{{ number_format($project->totalInternals()) }}
                            </strong>
                        </div>

                        <div class="my-1">
                            Profit: <strong>
                                <x-utils.currency />{{ number_format($project->profit()) }}
                            </strong>
                        </div>
                        <hr>
                        <div class="my-1">
                            Total Advance: <strong>
                                <x-utils.currency />{{ number_format($project->totalVendorAdvance()) }}
                            </strong>
                        </div>
                        <div class="my-1">
                            Total Due: <strong>
                                <x-utils.currency />{{ number_format($project->totalVendorDue()) }}
                            </strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <canvas id="project_overview_chart" width="100" height="100"
                            style="display: block; box-sizing: border-box; height: 100px; width: 100px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card my-2">
    <div class="card-header">
        <h3 class="card-title">Project Costs</h3>
    </div>
    <div class="card-body">
        <div class="card card-bordered">
            <div class="card-body">
                <div id="internal_external_costs_chart" style="height: 350px;"></div>
            </div>
        </div>
    </div>
</div>

{{-- Get project internal costs transform format --}}
@php
// project costs bar chart
$internalCosts = $project->intenalCosts->pluck('costs');

$externalCosts = $project->externalCosts->pluck('costs');

$advanceCosts = $project->vendorCosts->pluck('advance');
$dueCosts = $project->vendorCosts->pluck('due');

$costsCountMax = max($internalCosts->count(), $externalCosts->count());

$costsCount = collect();

for ($i = 1; $i <= $costsCountMax; $i++) {
    $costsCount->push($i);
}

// project overview pie chart
$projectOverviewPieChart = collect();
$projectOverviewPieChart->push($project->totalExternals());
$projectOverviewPieChart->push($project->totalInternals());
$projectOverviewPieChart->push($project->profit());
@endphp

<x-slot name="script">
    <script>
        // project costing bar chart
        var element = document.getElementById('internal_external_costs_chart');

        if (element) {
            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var primaryColor = KTUtil.getCssVariableValue('--bs-primary');
            var dangerColor = KTUtil.getCssVariableValue('--bs-danger');
            var successColor = KTUtil.getCssVariableValue('--bs-success');
            var warningColor = KTUtil.getCssVariableValue('--bs-warning');
            var infoColor = KTUtil.getCssVariableValue('--bs-info');

            var options = {
                series: [{
                        name: 'External',
                        data: {!! $externalCosts !!}
                    },
                    {
                        name: 'Internal',
                        data: {!! $internalCosts !!}
                    },
                    {
                        name: 'Advance',
                        data: {!! $advanceCosts !!}
                    },
                    {
                        name: 'Advance',
                        data: {!! $dueCosts !!}
                    }
                ],
                chart: {
                    fontFamily: 'inherit',
                    type: 'bar',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: ['80%'],
                        endingShape: 'rounded'
                    },
                },
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: {!! $costsCount !!},
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                states: {
                    normal: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    hover: {
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    },
                    active: {
                        allowMultipleDataPointsSelection: false,
                        filter: {
                            type: 'none',
                            value: 0
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px'
                    },
                    y: {
                        formatter: function(val) {
                            return `&#2547 ${val}`;
                        }
                    }
                },
                colors: [primaryColor, dangerColor, successColor, warningColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        };

        // project overview pie chart
        var t = document.getElementById("project_overview_chart");
        if (t) {
            var e = t.getContext("2d");
            new Chart(e, {
                type: "doughnut",
                data: {
                    datasets: [{
                        data: {!! $projectOverviewPieChart !!},
                        backgroundColor: [
                            "#E4E6EF",
                            "#00A3FF",
                            "#50CD89",
                        ],
                    }, ],
                    labels: ['Externals', 'Internals', 'Profit'],
                },
                options: {
                    chart: {
                        fontFamily: "inherit"
                    },
                    cutout: "75%",
                    cutoutPercentage: 65,
                    responsive: !0,
                    maintainAspectRatio: !1,
                    title: {
                        display: !1
                    },
                    animation: {
                        animateScale: !0,
                        animateRotate: !0
                    },
                    tooltips: {
                        enabled: !0,
                        intersect: !1,
                        mode: "nearest",
                        bodySpacing: 5,
                        yPadding: 10,
                        xPadding: 10,
                        caretPadding: 0,
                        displayColors: !1,
                        backgroundColor: "#20D489",
                        titleFontColor: "#ffffff",
                        cornerRadius: 4,
                        footerSpacing: 0,
                        titleSpacing: 0,
                    },
                    plugins: {
                        legend: {
                            display: !1
                        }
                    },
                },
            });
        }
    </script>
</x-slot>
