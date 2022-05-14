<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProfitLossController extends Controller {
    public $projectService;
    public $accountService;

    public function __construct(AccountService $accountService, ProjectService $projectService ) {
        $this->projectService = $projectService;
        $this->accountService = $accountService;
    }

    public function index() {
        // total credits of current year
        $year = now()->year;

        // revenues by year
        $totalSalesByYear = $this->projectService->getTotalSalesByYear( $year );
        $totalExpensesOfProjectsByYear = $this->projectService->getTotalExpensesOfProjectsByYear( $year );
        $totalDueAmountOfProjectsByYear = $this->projectService->getTotalDueAmountOfProjectsByYear( $year );
        $totalGrossProfitOfProjectsByYear = $this->projectService->getTotalGrossProfitOfProjectsByYear( $year );

        return view( 'profit-loss.index', compact( ['totalSalesByYear', 'totalExpensesOfProjectsByYear', 'totalDueAmountOfProjectsByYear', 'totalGrossProfitOfProjectsByYear'] ) );
    }

    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            // find credits of this date
            $year = $request->year;
            $month = $request->month;

            // revenues by year and month
            $totalSalesByYearAndMonth = $this->projectService->getTotalSalesByYearAndMonth( $year, $month );
            $totalExpensesOfProjectsByYearAndMonth = $this->projectService->getTotalExpensesOfProjectsByYearAndMonth( $year, $month );
            $totalGrossProfitOfProjectsByYearAndMonth = $this->accountService->getTotalNetProfitByYearAndMonth( $year, $month );

            return view( 'profit-loss.show', compact( ['month', 'year', 'totalSalesByYearAndMonth', 'totalExpensesOfProjectsByYearAndMonth', 'totalGrossProfitOfProjectsByYearAndMonth'] ) );
        }

        return redirect()->route( 'profit-loss.index' )->with( 'failed', 'Profit/Loss records not found!' );
    }
}
