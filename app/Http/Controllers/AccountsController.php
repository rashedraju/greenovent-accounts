<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\Models\Deposit;
use App\Models\Expense;
use App\Models\Withdrawal;

class AccountsController extends Controller {
    public function index() {
        // return view( 'accounts.index' );
        // redirect to account show of this year
        return redirect()->route( 'accounts.finances.show', now()->year );
    }

    // show finance recods of this year
    public function show( $year ) {
        if ( $year ) {
            // total balance of this year
            $totalAmountByYear = $this->getTotalAmountByYear( $year );

            // total bank balance of this year
            $totalBankAmountByYear = $this->getTotalBankAmountByYear( $year );

            $totalCashAmountByYear = $totalAmountByYear - $totalBankAmountByYear;

            $totalLoanAmountByYear = $this->getLoanAmountByYear( $year );
            $totalInvestmentAmountByYear = $this->getInvestmentAmountByYear( $year );

            return view( 'accounts.show', compact( ['year', 'totalAmountByYear', 'totalBankAmountByYear', 'totalCashAmountByYear', 'totalLoanAmountByYear', 'totalInvestmentAmountByYear'] ) );
        }

        return redirect()->route( 'accounts.index' )->with( 'failed', 'Finance records not found!' );
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
}
