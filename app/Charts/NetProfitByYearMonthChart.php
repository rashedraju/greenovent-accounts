<?php

declare ( strict_types = 1 );

namespace App\Charts;

use App\Services\AccountService;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class NetProfitByYearMonthChart extends BaseChart {
    public $accountService;

    public function __construct( AccountService $accountService ) {
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
        $data = array_map( fn( $month ) => $this->accountService->getNetProfitByYearMonth( $year, $month ), $months );

        return Chartisan::build()
            ->labels( $labels )
            ->dataset( 'Net Porfit By Month', $data );
    }
}
