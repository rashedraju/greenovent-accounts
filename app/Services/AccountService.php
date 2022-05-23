<?php

namespace App\Services;

use App\Models\Deposit;
use App\Models\Withdrawal;
use App\Services\ProjectService;

class AccountService {
    public $projectService;
    public $expenseService;
    public $creditService;

    public function __construct( ProjectService $projectService, ExpenseService $expenseService, CreditService $creditService ) {
        $this->projectService = $projectService;
        $this->expenseService = $expenseService;
        $this->creditService = $creditService;
    }

    // get total balance by year
    public function getTotalBalance( $args = [] ) {
        return $this->creditService->getTotalCreditAmount( $args ) - $this->expenseService->getTotalExpenseAmount( $args );
    }

    // get net profit by year
    public function getNetProfitByYear( $year ) {
        return $this->projectService->getTotalSalesByYear( $year ) - $this->expenseService->getTotalExpenseAmount( ['year' => $year] );
    }

    // get total net profit by year and month
    public function getNetProfitByYearMonth( $year, $month ) {
        return $this->projectService->getTotalSalesByYearAndMonth( $year, $month ) - $this->expenseService->getTotalExpenseAmount( ['year' => $year, 'month' => $month] );
    }

    // get total deposit amount by year
    public function getTotalDepositByYear( $year ) {
        return Deposit::whereYear( 'date', $year )->get()->sum( fn( $deposit ) => $deposit->amount );
    }

    // get total deposit amount by year and month
    public function getTotalDepositByYearMonth( $year, $month ) {
        return Deposit::whereYear( 'date', $year )->whereMonth('date', $month)->get()->sum( fn( $deposit ) => $deposit->amount );
    }

    // get withdrawal amount by year
    public function getTotalWithdrawalByYear( $year ) {
        return Withdrawal::whereYear( 'date', $year )->get()->sum( fn( $withdrawal ) => $withdrawal->amount );
    }

    // get withdrawal amount by year and month
    public function getTotalWithdrawalByYearMonth( $year, $month ) {
        return Withdrawal::whereYear( 'date', $year )->whereMonth('date', $month)->get()->sum( fn( $withdrawal ) => $withdrawal->amount );
    }

    // get all bank amount by year
    public function getTotalBankAmountByYear( $year ) {
        return $this->getTotalDepositByYear( $year ) - $this->getTotalWithdrawalByYear( $year );
    }

    // get all bank amount by year
    public function getTotalBankAmountByYearMonth( $year, $month ) {
        return $this->getTotalDepositByYearMonth( $year, $month ) - $this->getTotalWithdrawalByYearMonth( $year, $month );
    }

    // get total cash amount by year
    public function getTotalCashAmountByYear( $year ) {
        $amont =  $this->getTotalBalance( ['year' => $year] ) - $this->getTotalBankAmountByYear( $year );
        return $amont > 0 ? $amont : 0;
    }

    // get total cash amount by year
    public function getTotalCashAmountByYearMonth( $year, $month ) {
        $amont =  $this->getTotalBalance( ['year' => $year, 'month' => $month] ) - $this->getTotalBankAmountByYearMonth( $year, $month );
        return $amont > 0 ? $amont : 0;
    }

    /**
     * Withdrawals
     */

    // get total withdrawals amount by year
    public function getTotalWithdrawalAmountByYear( $year ) {
        return Withdrawal::whereYear( 'date', $year )->get()->sum( fn( $withdrawal ) => $withdrawal->amount );
    }
}
