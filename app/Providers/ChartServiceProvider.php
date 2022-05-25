<?php

namespace App\Providers;

use App\Charts\ProfitLossByMonthChart;
use App\Charts\RevenueByClientChart;
use App\Charts\RevenueByMonthChart;
use ConsoleTVs\Charts\Registrar as Charts;
use Illuminate\Support\ServiceProvider;

class ChartServiceProvider extends ServiceProvider {
    /**
     * Register services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot( Charts $charts ) {
        $charts->register( [
            \App\Charts\ClientsChart::class,
            \App\Charts\ProjectsChart::class,
            \App\Charts\NetProfitByYearMonthChart::class,
            \App\Charts\BusinessManagerContributionChart::class,
            RevenueByMonthChart::class,
            RevenueByClientChart::class,
            ProfitLossByMonthChart::class
        ] );
    }
}
