<?php

namespace App\Http\Controllers;

use App\Services\AccountService;

class AccountsController extends Controller {
    public $accountService;

    public function __construct( AccountService $accountService ) {
        $this->accountService = $accountService;
    }

    public function index() {
        // return view( 'accounts.index' );
        // redirect to account show of this year
        return redirect()->route( 'accounts.finances.show', now()->year );
    }

    // show finance recods of this year
    public function show( $year ) {
        if ( $year ) {
            // total balance of this year
            $totalAmountByYear = $this->accountService->getTotalAmountByYear( $year );

            // total bank balance of this year
            $totalBankAmountByYear = $this->accountService->getTotalBankAmountByYear( $year );

            $totalCashAmountByYear = $totalAmountByYear - $totalBankAmountByYear;

            $totalLoanAmountByYear = $this->accountService->getLoanAmountByYear( $year );
            $totalInvestmentAmountByYear = $this->accountService->getInvestmentAmountByYear( $year );

            // get gross and net profit by year
            $grossProfit = $this->accountService->getGrossProfitByYear( $year );
            $netProfit = $this->accountService->getNetProfitByYear( $year );

            // project finance
            $projectCredit = $this->accountService->getProjectCreditAmountByYear( $year );
            $projectDebit = $this->accountService->getProjectDebitAmountByYear( $year );

            return view( 'accounts.show', compact( ['year', 'totalAmountByYear', 'totalBankAmountByYear', 'totalCashAmountByYear', 'totalLoanAmountByYear', 'totalInvestmentAmountByYear', 'grossProfit', 'netProfit', 'projectCredit', 'projectDebit'] ) );
        }

        return redirect()->route( 'accounts.index' )->with( 'failed', 'Finance records not found!' );
    }

}
