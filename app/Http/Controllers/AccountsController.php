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
        $totalSalesByYear = $this->accountService->getTotalSalesByYear( $year );
        $totalExpenseByYear = $this->accountService->getTotalExpenseAmountByYear( $year );
        $netProfitByYear = $this->accountService->getNetProfitByYear( $year );

        return view( 'accounts.index', compact( ['year', 'totalBalanceByYear', 'totalBankAmountByYear', 'totalCashAmountByYear', 'totalLoanAmountByYear', 'totalInvestmentAmountByYear', 'totalSalesByYear', 'totalExpenseByYear', 'netProfitByYear'] ) );

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
            $revenuesOfThisMonth = $this->accountService->getTotalSalesByYearAndMonth( $year, $month );
            $totalRevenueAmountOfThisMonth = $this->accountService->getTotalSalesByYearAndMonth( $year, $month );
            $netProfitOfThisMonth = $this->accountService->getNetProfitByYearMonth( $year, $month );

            return view( 'accounts.show', compact( ['month', 'year', 'expensesOfThisMonth', 'totalExpenseAmountOfThisMonth', 'revenuesOfThisMonth', 'totalRevenueAmountOfThisMonth', 'netProfitOfThisMonth'] ) );

        }

        return redirect()->route( 'accounts.index' )->with( 'failed', 'Finance records not found!' );
    }

}
