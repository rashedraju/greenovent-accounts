<?php

namespace App\Http\Controllers;

use App\Models\Credit;

class AccountsController extends Controller {
    public function index() {
        return view( 'accounts.index' );
    }

    // show finance recods of this year
    public function show( $year ) {
        if ( $year ) {
            $accountsCashFinanceByYear = $this->getAccountsCashFinanceByYear( $year );
            $accountsBankFinanceByYear = $this->getAccountsBankFinanceByYear( $year );
            $accountsLoanFinanceByYear = $this->getAccountsLoanFinanceByYear( $year );
            $accountsInvestmentFinanceByYear = $this->getAccountsInvestmentFinanceByYear( $year );

            return view( 'accounts.show', compact( ['year', 'accountsCashFinanceByYear', 'accountsBankFinanceByYear', 'accountsLoanFinanceByYear', 'accountsInvestmentFinanceByYear'] ) );
        }

        return redirect()->route( 'accounts.index' )->with( 'failed', 'Finance records not found!' );
    }

    // get all cash credit
    public function getAccountsCashFinanceByYear( $year ) {
        return Credit::whereYear( 'date', $year )->where( 'transaction_type_id', 1 )->get()->sum( fn( $credit ) => $credit->amount );
    }

    // get all bank credit
    public function getAccountsBankFinanceByYear( $year ) {
        return Credit::whereYear( 'date', $year )->where( 'transaction_type_id', 2 )->orWhere( 'transaction_type_id', 3 )->get()->sum( fn( $credit ) => $credit->amount );
    }

    // get all loan credits
    public function getAccountsLoanFinanceByYear( $year ) {
        return Credit::whereYear( 'date', $year )->whereNotNull( 'loan_lender_id' )->get()->sum( fn( $credit ) => $credit->amount );
    }

    // get all investment credits
    public function getAccountsInvestmentFinanceByYear( $year ) {
        return Credit::whereYear( 'date', $year )->whereNotNull( 'investor_id' )->get()->sum( fn( $credit ) => $credit->amount );
    }
}
