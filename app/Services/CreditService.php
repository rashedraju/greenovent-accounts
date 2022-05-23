<?php

namespace App\Services;

use App\Models\Accounts\Credit\InvestmentCredit;
use App\Models\Accounts\Credit\LoanCredit;
use App\Models\Accounts\Credit\ProjectCredit;

class CreditService {
    // credit records
    public function getProjectCredit( $args = [] ) {
        return ProjectCredit::filter( $args )->get();
    }

    public function getLoanCredit( $args = [] ) {
        return LoanCredit::filter( $args )->get();
    }

    public function getInvestmentCredit( $args = [] ) {
        return InvestmentCredit::filter( $args )->get();
    }

    // credit amount
    public function getProjectCreditAmount( $args = [] ) {
        return ProjectCredit::filter( $args )->get()->sum( fn( $credit ) => $credit->amount );
    }

    public function getLoanCreditAmount( $args = [] ) {
        return LoanCredit::filter( $args )->get()->sum( fn( $credit ) => $credit->amount );
    }

    public function getInvestmentCreditAmount( $args = [] ) {
        return InvestmentCredit::filter( $args )->get()->sum( fn( $credit ) => $credit->amount );
    }

    public function getTotalCreditAmount( $args = [] ) {
        return $this->getProjectCreditAmount( $args ) + $this->getLoanCreditAmount( $args ) + $this->getInvestmentCreditAmount( $args );
    }
}
