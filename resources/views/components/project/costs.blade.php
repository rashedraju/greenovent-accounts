@props(['project'])

<div class="card">
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
$internalCosts = $project->intenalCosts->transform(function ($item) {
    return $item->costs;
});

$externalCosts = $project->externalCosts->transform(function ($item) {
    return $item->costs;
});

$costsCountMax = max($internalCosts->count(), $externalCosts->count());

$costsCount = [];

for ($i = 1; $i <= $costsCountMax; $i++) {
    array_push($costsCount, $i);
}

@endphp

<x-slot name="script">
    <script>
        var element = document.getElementById('internal_external_costs_chart');

        if (element) {
            var height = parseInt(KTUtil.css(element, 'height'));
            var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
            var borderColor = KTUtil.getCssVariableValue('--bs-gray-200');
            var baseColor = KTUtil.getCssVariableValue('--bs-primary');
            var secondaryColor = KTUtil.getCssVariableValue('--bs-gray-300');

            var options = {
                series: [{
                    name: 'Net Profit',
                    data: {!! $internalCosts !!}
                }, {
                    name: 'Revenue',
                    data: {!! $externalCosts !!}
                }],
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
                        columnWidth: ['30%'],
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
                    categories: ['1', '2'],
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
                            return '$' + val + ' thousands'
                        }
                    }
                },
                colors: [baseColor, secondaryColor],
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
    </script>
</x-slot>
