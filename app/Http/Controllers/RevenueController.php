<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class RevenueController extends Controller {
    public $projectService;

    public function __construct( ProjectService $projectService ) {
        $this->projectService = $projectService;
    }

    public function index() {
        // total credits of current year
        $year = now()->year;

        // revenues by year
        $totalSalesByYear = $this->projectService->getTotalSalesByYear( $year );
        $totalExpensesOfProjectsByYear = $this->projectService->getTotalExpensesOfProjectsByYear( $year );
        $totalDueAmountOfProjectsByYear = $this->projectService->getTotalDueAmountOfProjectsByYear( $year );
        $totalGrossProfitOfProjectsByYear = $this->projectService->getTotalGrossProfitOfProjectsByYear( $year );

        return view( 'revenue.index', compact( ['totalSalesByYear', 'totalExpensesOfProjectsByYear', 'totalDueAmountOfProjectsByYear', 'totalGrossProfitOfProjectsByYear'] ) );
    }

    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            // find credits of this date
            $year = $request->year;
            $month = $request->month;

            $projects = Project::whereYear( 'start_date', $year )->whereMonth( 'start_date', $month )->orderBy( 'id', 'desc' )->get();

            // revenues by year and month
            $totalSalesByYearAndMonth = $this->projectService->getTotalSalesByYearAndMonth( $year, $month );
            $totalExpensesOfProjectsByYearAndMonth = $this->projectService->getTotalExpensesOfProjectsByYearAndMonth( $year, $month );
            $totalGrossProfitOfProjectsByYearAndMonth = $this->projectService->getTotalGrossProfitOfProjectsByYearAndMonth( $year, $month );
            $totalDueAmountOfProjectsByYearAndMonth = $this->projectService->getTotalDueAmountOfProjectsByYearAndMonth( $year, $month );

            return view( 'revenue.show', compact( ['month', 'year', 'projects', 'totalSalesByYearAndMonth', 'totalExpensesOfProjectsByYearAndMonth', 'totalGrossProfitOfProjectsByYearAndMonth', 'totalDueAmountOfProjectsByYearAndMonth'] ) );
        }

        return redirect()->route( 'revenue.index' )->with( 'failed', 'Revenue records not found!' );
    }
}
