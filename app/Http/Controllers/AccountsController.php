<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\AccountService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class AccountsController extends Controller {
    public $accountService;
    public $projectService;

    public function __construct( AccountService $accountService, ProjectService $projectService ) {
        $this->accountService = $accountService;
        $this->projectService = $projectService;
    }

    public function index() {
        return view( 'accounts.index' );
    }

    public function showByYear( $year ) {
        if ( $year ) {
            $sales = $this->projectService->getTotalSalesByYear( $year );

            // total balance of this year
            $totalBalanceByYear = $this->accountService->getTotalBalanceByYear( $year );

            // total bank balance of this year
            $totalBankAmountByYear = $this->accountService->getTotalBankAmountByYear( $year );

            // get total cash amount by year
            $totalCashAmountByYear = $this->accountService->getTotalCashAmountByYear( $year );

            // get total loan amount by year
            $totalLoanAmountByYear = $this->accountService->getLoanAmountByYear( $year );

            // get toal investment amount by year
            $totalInvestmentAmountByYear = $this->accountService->getInvestmentAmountByYear( $year );

            // get sales, expense, netprofit by year
            $totalExpenseByYear = $this->accountService->getTotalExpenseAmountByYear( $year );
            $netProfitByYear = $this->accountService->getNetProfitByYear( $year );

            return view( 'accounts.show-year', compact([]));

        } else {
            return redirect()->route( 'accounts.finances.index')->with('failed', 'Records not found!');
        }
    }

    // show finance recods of this year
    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            $year = $request->year;
            $month = $request->month;

            // expenses
            $expensesOfThisMonth = $this->accountService->getExpensesByYearAndMonth( $year, $month );
            $totalExpenseAmountOfThisMonth = $this->accountService->getTotalExpenseAmountByYearAndMonth( $year, $month );

            // revenues
            $projectsOfThisMonth = Project::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get();
            $totalRevenueAmountOfThisMonth = $this->accountService->getTotalSalesByYearAndMonth( $year, $month );
            $netProfitOfThisMonth = $this->accountService->getNetProfitByYearMonth( $year, $month );

            return view( 'accounts.show', compact( ['month', 'year', 'expensesOfThisMonth', 'totalExpenseAmountOfThisMonth', 'projectsOfThisMonth', 'totalRevenueAmountOfThisMonth', 'netProfitOfThisMonth'] ) );

        }

        return redirect()->route( 'accounts.index' )->with( 'failed', 'Finance records not found!' );
    }

}
