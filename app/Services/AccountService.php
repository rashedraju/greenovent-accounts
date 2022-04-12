<?php

namespace App\Services;

use App\Models\Credit;
use App\Models\CreditCategory;
use App\Models\Deposit;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Withdrawal;

class AccountService {
    // get net profit by year
    public function getNetProfitByYear( $year ) {
        return $this->getTotalRevenueAmountByYear( $year ) - $this->getTotalExpenseAmountByYear( $year );
    }

    // get total balance
    public function getTotalAmountByYear( $year ) {
        return $this->getTotalCreditByYear( $year ) - $this->getTotalDebitByYear( $year );
    }

    // get total of credit records by year
    public function getTotalCreditByYear( $year ) {
        return Credit::whereYear( 'date', $year )->get()->sum( fn( $credit ) => $credit->amount );
    }

    // get total of debit records by year
    public function getTotalDebitByYear( $year ) {
        return Expense::whereYear( 'date', $year )->get()->sum( fn( $debit ) => $debit->amount );
    }

    // get all bank amount by year
    public function getTotalBankAmountByYear( $year ) {
        return $this->getTotalDepositByYear( $year ) - $this->getTotalWithdrawalByYear( $year );
    }

    // get total deposit amount by year
    public function getTotalDepositByYear( $year ) {
        return Deposit::whereYear( 'date', $year )->get()->sum( fn( $deposit ) => $deposit->amount );
    }

    // get withdrawal amount by year
    public function getTotalWithdrawalByYear( $year ) {
        return Withdrawal::whereYear( 'date', $year )->get()->sum( fn( $withdrawal ) => $withdrawal->amount );
    }

    // ======todo=======
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

    // get total amount debited by project
    public function getProjectDebitAmountByYear( $year ) {
        return Expense::whereNotNull( 'project_id' )->whereYear( 'date', $year )->get()->sum( fn( $expense ) => $expense->amount );
    }

    // get expenses by year
    public function getExpensesByYear( $year ) {
        return Expense::filter( ['year' => $year] )->get();
    }

    // get expenses by year and month
    public function getExpensesByYearAndMonth( $year, $month ) {
        return Expense::filter( ['year' => $year, 'month' => $month] )->get();
    }

    // get total amount of expenses of by year
    public function getTotalExpenseAmountByYear( $year ) {
        return $this->getExpensesByYear( $year )->sum( fn( $expense ) => $expense->amount );
    }

    // get total amount of expenses of by year and month
    public function getTotalExpenseAmountByYearAndMonth( $year, $month ) {
        return $this->getExpensesByYearAndMonth( $year, $month )->sum( fn( $expense ) => $expense->amount );
    }

    // get total revenues by year and month
    // notice: total revenues taken from project work order that place on this month
    public function getRevenuesByYear( $year ) {
        return Project::whereYear( 'created_at', $year )->get();
    }

    // get total revenues by year and month
    // total revenues taken from project work order that place on this month
    public function getRevenuesByYearAndMonth( $year, $month ) {
        return Project::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get();
    }

    // get total revenue amount by year and month
    public function getTotalRevenueAmountByYear( $year ) {
        return $this->getRevenuesByYear( $year )->sum( fn( $revenue ) => $revenue->po_value );
    }

    // get total revenue amount by year and month
    public function getTotalRevenueAmountByYearAndMonth( $year, $month ) {
        return $this->getRevenuesByYearAndMonth( $year, $month )->sum( fn( $revenue ) => $revenue->po_value );
    }

    public function getNetProfitByYearMonth( $year, $month ) {
        return $this->getTotalRevenueAmountByYearAndMonth( $year, $month ) - $this->getTotalExpenseAmountByYearAndMonth( $year, $month );
    }

    /**
     * Withdrawals
     */

    // get total withdrawals amount by year
    public function getTotalWithdrawalAmountByYear( $year ) {
        return Withdrawal::whereYear( 'date', $year )->get()->sum( fn( $withdrawal ) => $withdrawal->amount );
    }
}
