<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\TransactionType;
use App\Models\User;
use App\Services\ExpenseService;

class ExpensesController extends Controller {
    public $expenseService;

    public function __construct( ExpenseService $expenseService ) {
        $this->expenseService = $expenseService;
    }

    public function index() {
        // total expenses of current year
        $year = now()->year;

        $project = $this->expenseService->getProjectExpenses( ['year' => $year] );
        $dailyConveyance = $this->expenseService->getDailyConveyanceExpenses( ['year' => $year] );
        $salary = $this->expenseService->getSalaryExpenses( ['year' => $year] );
        $loan = $this->expenseService->getLoanExpenses( ['year' => $year] );
        $investment = $this->expenseService->getInvestmentExpenses( ['year' => $year] );

        $projectAmount = $this->expenseService->getProjectExpenseAmount( ['year' => $year] );
        $dailyConveyanceAmount = $this->expenseService->getDailyConveyanceExpenseAmount( ['year' => $year] );
        $salaryAmount = $this->expenseService->getSalaryExpenseAmount( ['year' => $year] );
        $loanAmount = $this->expenseService->getLoanExpenseAmount( ['year' => $year] );
        $investmentAmount = $this->expenseService->getInvestmentExpenseAmount( ['year' => $year] );

        $total = $projectAmount + $dailyConveyanceAmount + $salaryAmount + $loanAmount + $investmentAmount;
        $data = [
            'year'     => $year,
            'total'    => $total,
            'expenses' => [
                'project'          => [
                    'name'    => 'Project',
                    'amount'  => $projectAmount,
                    'records' => $project
                ],
                'daily_conveyance' => [
                    'name'    => 'Daily Conveyance',
                    'amount'  => $dailyConveyanceAmount,
                    'records' => $dailyConveyance
                ],
                'salary'           => [
                    'name'    => 'Salary',
                    'amount'  => $salaryAmount,
                    'records' => $salary
                ],
                'loan'             => [
                    'name'    => 'Loan',
                    'amount'  => $loanAmount,
                    'records' => $loan
                ],
                'investment'       => [
                    'name'    => 'Investment',
                    'amount'  => $investmentAmount,
                    'records' => $investment
                ]
            ]
        ];
        return view( 'expenses.index', ['data' => $data] );
    }

    public function show( $year, $month ) {
        if ( $year && $month ) {
            $expenseRecords = $this->expenseService->getExpenses( ['year' => $year, 'month' => $month] );

            // get billing persons
            $employees = User::pluck( 'name', 'id' );

            // get projects
            $projects = Project::pluck( 'name', 'id' );

            // get transaction types
            $transactionTypes = TransactionType::pluck( 'name', 'id' );

            $totalExpensesOfThisMonth = $this->expenseService->getTotalExpenseAmount( ['year' => $year, 'month' => $month] );

            // expense heads
            $expenseHeadsOfThisMonth = $expenseRecords->pluck( 'head' );

            // projects of this month
            $projectsOfThisMonth = Project::whereYear( 'created_at', $year )->whereMonth( 'created_at', $month )->get()->pluck( 'project.name', 'project.id' );

            return view( 'expenses.show', compact( ['month', 'year', 'expenseRecords', 'employees', 'projects', 'transactionTypes', 'totalExpensesOfThisMonth', 'expenseHeadsOfThisMonth', 'projectsOfThisMonth'] ) );
        }

        return redirect()->route( 'expenses.index' )->with( 'failed', 'Expense records not found!' );
    }
}
