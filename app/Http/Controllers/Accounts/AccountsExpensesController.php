<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Expenses\InvestmentExpense;
use App\Models\Project;
use App\Models\TransactionType;
use App\Models\User;
use App\Services\ExpenseService;
use Illuminate\Http\Request;

class AccountsExpensesController extends Controller {
    public $expenseService;

    public function __construct( ExpenseService $expenseService ) {
        $this->expenseService = $expenseService;
    }

    public function index( $year, $month ) {
        if ( $year && $month ) {
            $expenses = $this->expenseService->getExpenses( ['year' => $year, 'month' => $month] );

            $data = [
                'year'     => $year,
                'month'    => $month,
                'expenses' => $expenses
            ];

            return view( 'accounts.expenses.index', ['data' => $data] );
        }

        return back()->with( 'Not found!' );
    }

    public function showByYear( $year ) {
        if ( $year ) {
            $salaryExpenseAmount = $this->expenseService->getSalaryExpenseAmount( ['year' => $year] );
            $dailyConveyanceExpenseAmount = $this->expenseService->getDailyConveyanceExpenseAmount( ['year' => $year] );
            $projectExpenseAmount = $this->expenseService->getProjectExpenseAmount( ['year' => $year] );
            $loanExpenseAmount = $this->expenseService->getLoanExpenseAmount( ['year' => $year] );
            $investmentExpenseAmount = $this->expenseService->getInvestmentExpenseAmount( ['year' => $year] );
            $totalExpenseAmount = $salaryExpenseAmount + $dailyConveyanceExpenseAmount + $projectExpenseAmount + $loanExpenseAmount + $investmentExpenseAmount;

            $expenseData = [
                'total'         => $totalExpenseAmount,
                'expenseByType' => [
                    [
                        'name'   => 'Salary',
                        'amount' => $salaryExpenseAmount
                    ], [
                        'name'   => 'Daily Conveyance',
                        'amount' => $dailyConveyanceExpenseAmount
                    ], [
                        'name'   => 'Loan',
                        'amount' => $loanExpenseAmount
                    ], [
                        'name'   => 'Investment',
                        'amount' => $investmentExpenseAmount
                    ]
                ]
            ];
            return view( 'accounts.expenses.show-year', compact( ['year', 'expenseData'] ) );
        }

        return redirect()->route( 'accounts.expenses.index' )->with( 'failed', 'Records no found!' );
    }

    public function show( $year, $month ) {
        if ( $year && $month ) {
            $args = ['year' => $year, 'month' => $month];

            $args = array_merge( $args,
                request( ['user_id', 'head', 'received_person', 'project_id', 'company_name'] )
            );

            $salary = $this->expenseService->getSalaryExpenses( $args );
            $dailyConveyance = $this->expenseService->getDailyConveyanceExpenses( $args );
            $project = $this->expenseService->getProjectExpenses( $args );
            $loan = $this->expenseService->getLoanExpenses( $args );
            $investment = $this->expenseService->getInvestmentExpenses( $args );

            $salaryAmount = $salary->sum( fn( $expense ) => $expense->amount );
            $dailyConveyanceAmount = $dailyConveyance->sum( fn( $expense ) => $expense->amount );
            $projectAmount = $project->sum( fn( $expense ) => $expense->amount );
            $loanAmount = $loan->sum( fn( $expense ) => $expense->amount );
            $investmentAmount = $investment->sum( fn( $expense ) => $expense->amount );

            $dailyConveyanceHeads = $dailyConveyance->pluck( 'head' );
            $projectHeads = $project->pluck( 'head' );

            $total = $salaryAmount + $dailyConveyanceAmount + $projectAmount + $loanAmount + $investmentAmount;

            $projects = Project::pluck( 'name', 'id' );
            $startDate = now()->year( $year )->month( $month )->startOfMonth()->toDateString();
            $endDate = now()->year( $year )->month( $month )->endOfMonth()->toDateString();
            $employees = User::all();
            $companyNames = InvestmentExpense::pluck( 'company_name' );
            $transactionTypes = TransactionType::all();

            $data = [
                'year'              => $year,
                'month'             => $month,
                'start_date'        => $startDate,
                'end_date'          => $endDate,
                'projects'          => $projects,
                'employees'         => $employees,
                'company_names'     => $companyNames,
                'transaction_types' => $transactionTypes,
                'total'             => $total,
                'expenses'          => [
                    'salary'           => [
                        'name'    => 'Salary',
                        'records' => $salary,
                        'amount'  => $salaryAmount
                    ],
                    'daily_conveyance' => [
                        'name'    => 'Daily Conveyance',
                        'heads'   => $dailyConveyanceHeads,
                        'records' => $dailyConveyance,
                        'amount'  => $dailyConveyanceAmount
                    ],
                    'project'          => [
                        'name'    => 'Project',
                        'heads'   => $projectHeads,
                        'records' => $project,
                        'amount'  => $projectAmount
                    ],
                    'loan'             => [
                        'name'    => 'Loan',
                        'records' => $loan,
                        'amount'  => $loanAmount
                    ],
                    'investment'       => [
                        'name'    => 'Investment',
                        'records' => $investment,
                        'amount'  => $investmentAmount
                    ]
                ]
            ];

            return view( 'accounts.expenses.show-year-month', compact( ['data'] ) );
        }

        return redirect()->route( 'accounts.expenses.show.year' )->with( 'failed', 'Expense records not found!' );
    }

    // download expense records by year and month
    public function export( Request $request ) {
        if ( $request->year && $request->month ) {
            $year = $request->year;
            $month = $request->month;

            $fname = now()->month( $month )->format( 'F' ) . "_" . $year . "_expense_records.xlsx";
        }

        return redirect()->route( 'accounts.expenses.index' )->with( 'failed', 'Expense records not found!' );
    }
}
