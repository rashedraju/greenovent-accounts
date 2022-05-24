<?php

declare ( strict_types = 1 );

namespace App\Charts;

use App\Services\AccountService;
use App\Services\ProjectService;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class ProfitLossByMonthChart extends BaseChart {
    public $projectService;
    public $accountService;

    public function __construct( AccountService $accountService, ProjectService $projectService ) {
        $this->projectService = $projectService;
        $this->accountService = $accountService;
    }

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler( Request $request ): Chartisan {
        $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // get net profit by year and month
        $year = now()->year;
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $netProfitsByMonth = array_map( fn( $month ) => $this->accountService->getNetProfitByYearMonth( $year, $month ), $months );

        return Chartisan::build()
            ->labels( $labels )
            ->dataset( 'Porfit Loss By Month', $netProfitsByMonth );
    }
}
