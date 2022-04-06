@props(['project'])

<div class="card my-2">
    <div class="card-header">
        <h3 class="card-title">Latest Internal & External</h3>
    </div>
    <div class="card-body">
        <div class="card card-bordered">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="my-1">
                            External: <strong>
                                <x-utils.currency />{{ number_format($project->external) }}
                            </strong>
                        </div>
                        <div class="my-1">
                            Total Internal: <strong>
                                {{-- <x-utils.currency />{{ number_format($project->totalInternals()) }} --}}
                            </strong>
                        </div>

                        <div class="my-1">
                            Profit: <strong>
                                {{-- <x-utils.currency />{{ number_format($project->profit()) }} --}}
                            </strong>
                        </div>
                        <hr>
                        <div class="my-1">
                            Total Advance: <strong>
                                {{-- <x-utils.currency />{{ number_format($project->totalVendorAdvance()) }} --}}
                            </strong>
                        </div>
                        <div class="my-1">
                            Total Due: <strong>
                                {{-- <x-utils.currency />{{ number_format($project->totalVendorDue()) }} --}}
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
