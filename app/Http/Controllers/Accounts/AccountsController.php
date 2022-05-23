<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Services\CreditService;
use App\Services\ExpenseService;
use App\Services\ProjectService;

class AccountsController extends Controller {
    public $accountService;
    public $projectService;
    public $creditService;
    public $expenseService;

    public function __construct( AccountService $accountService, ProjectService $projectService, CreditService $creditService, ExpenseService $expenseService ) {
        $this->accountService = $accountService;
        $this->projectService = $projectService;
        $this->creditService = $creditService;
        $this->expenseService = $expenseService;
    }

    public function index() {
        return view( 'accounts.index' );
    }

    public function showByYear( $year ) {
        if ( $year ) {
            // sales, expenses, profit
            $sales = $this->projectService->getTotalSalesByYear( $year );
            $expense = $this->expenseService->getTotalExpenseAmount( ['year' => $year] );
            $netProfit = $this->accountService->getNetProfitByYear( $year );

            // total balance of this year
            $balance = $this->accountService->getTotalBalance( ['year' => $year] );

            // total bank balance of this year
            $bankAmount = $this->accountService->getTotalBankAmountByYear( $year );

            // get total cash amount by year
            $cashAmount = $this->accountService->getTotalCashAmountByYear( $year );

            $data = [
                'year'        => $year,
                'sales'       => $sales,
                'expense'     => $expense,
                'net_profit'  => $netProfit,
                'balance'     => $balance,
                'bank_amount' => $bankAmount,
                'cash_amount' => $cashAmount
            ];

            return view( 'accounts.show-year', ['data' => $data] );

        } else {
            return redirect()->route( 'accounts.finances.index' )->with( 'failed', 'Records not found!' );
        }
    }

    // show finance recods of this year
    public function show( $year, $month ) {
        if ( $year && $month ) {
            // sales, expenses, profit
            $sales = $this->projectService->getTotalSalesByYearAndMonth( $year, $month );
            $expense = $this->expenseService->getTotalExpenseAmount( ['year' => $year, 'month' => $month] );
            $netProfit = $this->accountService->getNetProfitByYearMonth( $year, $month );

            // total balance of this year and month
            $balance = $this->accountService->getTotalBalance( ['year' => $year, 'month' => $month] );

            // total bank balance of this year and month
            $bankAmount = $this->accountService->getTotalBankAmountByYearMonth( $year, $month );

            // get total cash amount by year and month
            $cashAmount = $this->accountService->getTotalCashAmountByYear( $year );

            $data = [
                'year'        => $year,
                'month'       => $month,
                'sales'       => $sales,
                'expense'     => $expense,
                'net_profit'  => $netProfit,
                'balance'     => $balance,
                'bank_amount' => $bankAmount,
                'cash_amount' => $cashAmount
            ];

            return view( 'accounts.show', ['data' => $data] );

        }

        return redirect()->route( 'accounts.finances.show.year', $year )->with( 'failed', 'Finance records not found!' );
    }

}
