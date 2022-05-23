<?php

namespace App\Services;

use App\Models\Credit;
use App\Models\CreditCategory;
use App\Models\Deposit;
use App\Models\Project;
use App\Models\Withdrawal;

class AccountService {
    /**
     * 1. get total of expense records by year
     * 2. sum expense amount
     *
     */
    public function getTotalDebitByYear( $year ) {
        return 0;
    }

    // get total of credit records by year
    public function getTotalCreditByYear( $year ) {
        return Credit::whereYear( 'date', $year )->get()->sum( fn( $credit ) => $credit->amount );
    }

    // get total balance by year
    public function getTotalBalanceByYear( $year ) {
        return $this->getTotalCreditByYear( $year ) - $this->getTotalDebitByYear( $year );
    }

    // get net profit by year
    public function getNetProfitByYear( $year ) {
        return $this->getTotalSalesByYear( $year ) - $this->getTotalExpenseAmountByYear( $year );
    }

    // get total sales by year and month
    public function getTotalSalesByYearAndMonth( $year, $month ) {
        return Project::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get()->sum( fn( $project ) => $project->po_value );
    }

    /**
     * 1. get total of expense records by year and month
     * 2. sum expense amount
     *
     */
    public function getTotalExpenseAmountByYearAndMonth( $year, $month ) {
        return 0;
    }

    // get total net profit by year and month
    public function getNetProfitByYearMonth( $year, $month ) {
        return $this->getTotalSalesByYearAndMonth( $year, $month ) - $this->getTotalExpenseAmountByYearAndMonth( $year, $month );
    }

    public function getTotalNetProfitByYearAndMonth( $year, $month ) {
        return $this->getTotalSalesByYearAndMonth( $year, $month ) - $this->getTotalExpenseAmountByYearAndMonth( $year, $month );
    }

    // get total deposit amount by year
    public function getTotalDepositByYear( $year ) {
        return Deposit::whereYear( 'date', $year )->get()->sum( fn( $deposit ) => $deposit->amount );
    }

    // get withdrawal amount by year
    public function getTotalWithdrawalByYear( $year ) {
        return Withdrawal::whereYear( 'date', $year )->get()->sum( fn( $withdrawal ) => $withdrawal->amount );
    }

    // get all bank amount by year
    public function getTotalBankAmountByYear( $year ) {
        return $this->getTotalDepositByYear( $year ) - $this->getTotalWithdrawalByYear( $year );
    }

    // get total cash amount by year
    public function getTotalCashAmountByYear( $year ) {
        return $this->getTotalBalanceByYear( $year ) - $this->getTotalBankAmountByYear( $year );
    }

    // get all loan amount
    public function getLoanAmountByYear( $year ) {
        return Credit::whereYear( 'date', $year )->whereNotNull( 'loan_lender_id' )->get()->sum( fn( $credit ) => $credit->amount );
    }

    // get all investment amount
    public function getInvestmentAmountByYear( $year ) {
        return Credit::whereYear( 'date', $year )->whereNotNull( 'investor_id' )->get()->sum( fn( $credit ) => $credit->amount );
    }

    // get total amount credited from project
    public function getProjectCreditAmountByYear( $year ) {
        return CreditCategory::find( 1 )->credits()->whereYear( 'date', $year )->get()->sum( fn( $credit ) => $credit->amount );
    }

    /**
     * 1. get total expense amount by project
     * 2. sum expense amount
     *
     */
    public function getProjectDebitAmountByYear( $year ) {
        return 0;
    }

    // get all expenses by year
    public function getExpensesByYear( $year ) {
        return collect();
    }

    // get expenses by year and month
    public function getExpensesByYearAndMonth( $year, $month ) {
        return collect();
    }

    // get total amount of expenses of by year
    public function getTotalExpenseAmountByYear( $year ) {
        return 0;
    }

    // get total revenues by year and month
    // notice: total revenues taken from project work order that place on this month
    public function getRevenuesByYear( $year ) {
        return Project::whereYear( 'created_at', $year )->get();
    }

    /**
     * Withdrawals
     */

    // get total withdrawals amount by year
    public function getTotalWithdrawalAmountByYear( $year ) {
        return Withdrawal::whereYear( 'date', $year )->get()->sum( fn( $withdrawal ) => $withdrawal->amount );
    }
}
