<?php

namespace App\Services;

use App\Models\Credit;
use App\Models\CreditCategory;
use App\Models\Deposit;
use App\Models\Expense;
use App\Models\Withdrawal;

class AccountService {
    // get gross profit by year
    public function getGrossProfitByYear( $year ) {
        return $this->getTotalCreditByYear( $year );
    }

    // get net profit by year
    public function getNetProfitByYear( $year ) {
        return $this->getProjectCreditAmountByYear( $year ) - $this->getProjectDebitAmountByYear( $year );
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
}
