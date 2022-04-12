<?php

namespace App\Http\Controllers;

use App\Services\AccountService;
use Illuminate\Http\Request;

class AccountsController extends Controller {
    public $accountService;

    public function __construct( AccountService $accountService ) {
        $this->accountService = $accountService;
    }

    public function index() {
        $year = now()->year;

        // total balance of this year
        $totalAmountByYear = $this->accountService->getTotalAmountByYear( $year );

        // total bank balance of this year
        $totalBankAmountByYear = $this->accountService->getTotalBankAmountByYear( $year );

        $totalCashAmountByYear = $totalAmountByYear - $totalBankAmountByYear;

        $totalLoanAmountByYear = $this->accountService->getLoanAmountByYear( $year );
        $totalInvestmentAmountByYear = $this->accountService->getInvestmentAmountByYear( $year );

        // get revenue, expense, netprofit by year
        $totalRevenueOfThisYear = $this->accountService->getTotalRevenueAmountByYear( $year );
        $totalExpenseByYear = $this->accountService->getTotalExpenseAmountByYear( $year );
        $netProfit = $this->accountService->getNetProfitByYear( $year );

        return view( 'accounts.index', compact( ['year', 'totalAmountByYear', 'totalBankAmountByYear', 'totalCashAmountByYear', 'totalLoanAmountByYear', 'totalInvestmentAmountByYear', 'totalRevenueOfThisYear', 'totalExpenseByYear', 'netProfit'] ) );

        return redirect()->route( 'accounts.finances.index', now()->year );
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
            $revenuesOfThisMonth = $this->accountService->getRevenuesByYearAndMonth( $year, $month );
            $totalRevenueAmountOfThisMonth = $this->accountService->getTotalRevenueAmountByYearAndMonth( $year, $month );
            $netProfitOfThisMonth = $this->accountService->getNetProfitByYearMonth( $year, $month );

            return view( 'accounts.show', compact( ['month', 'year', 'expensesOfThisMonth', 'totalExpenseAmountOfThisMonth', 'revenuesOfThisMonth', 'totalRevenueAmountOfThisMonth', 'netProfitOfThisMonth'] ) );

        }

        return redirect()->route( 'accounts.index' )->with( 'failed', 'Finance records not found!' );
    }

}
