<?php

namespace App\Services;

use App\Models\Accounts\Expenses\DailyConveyanceExpense;
use App\Models\Accounts\Expenses\InvestmentExpense;
use App\Models\Accounts\Expenses\LoanExpense;
use App\Models\Accounts\Expenses\ProjectExpense;
use App\Models\Accounts\Expenses\SalaryExpense;

class ExpenseService {
    // Expense records
    public function getSalaryExpenses( $args = [] ) {
        return SalaryExpense::filter( $args )->get();
    }

    public function getDailyConveyanceExpenses( $args = [] ) {
        return DailyConveyanceExpense::filter( $args )->get();
    }

    public function getProjectExpenses( $args = [] ) {
        return ProjectExpense::filter( $args )->get();
    }

    public function getLoanExpenses( $args = [] ) {
        return LoanExpense::filter( $args )->get();
    }

    public function getInvestmentExpenses( $args = [] ) {
        return InvestmentExpense::filter( $args )->get();
    }

    // Expense amounts
    public function getSalaryExpenseAmount( $args = [] ) {
        return $this->getSalaryExpenses( $args )->sum( fn( $expense ) => $expense->amount );
    }

    public function getDailyConveyanceExpenseAmount( $args = [] ) {
        return $this->getDailyConveyanceExpenses( $args )->sum( fn( $expense ) => $expense->amount );
    }

    public function getProjectExpenseAmount( $args = [] ) {
        return $this->getProjectExpenses( $args )->sum( fn( $expense ) => $expense->amount );
    }

    public function getLoanExpenseAmount( $args = [] ) {
        return $this->getLoanExpenses( $args )->sum( fn( $expense ) => $expense->amount );
    }

    public function getInvestmentExpenseAmount( $args = [] ) {
        return $this->getInvestmentExpenses( $args )->sum( fn( $expense ) => $expense->amount );
    }

    public function getTotalExpenseAmount($args = []){
         
    }
}
