<?php

namespace App\Http\Controllers;

use App\Models\Accounts\Expenses\ProjectExpense;
use App\Models\Client;
use App\Models\EmployeeLeave;
use App\Models\Project;
use App\Services\AccountService;
use App\Services\CreditService;
use App\Services\ExpenseService;
use App\Services\PermissionService;
use App\Services\ProjectService;

class DashboardController extends Controller {
    use PermissionService;

    public $accountService;
    public $creditService;
    public $expenseService;
    public $projectService;

    public function __construct( AccountService $accountService, CreditService $creditService, ExpenseService $expenseService, ProjectService $projectService ) {
        $this->accountService = $accountService;
        $this->creditService = $creditService;
        $this->expenseService = $expenseService;
        $this->projectService = $projectService;
    }

    public function index() {
        $this->checkPermission();

        $clients = Client::orderBy( 'id', 'desc' )->get();
        $projects = Project::orderBy( 'id', 'desc' )->get();

        // finance records
        $year = now()->year;

        // sales, expenses, profit
        $sales = $this->projectService->getTotalSalesByYear( $year );
        $expense = $this->expenseService->getTotalExpenseAmount( ['year' => $year] );
        $netProfit = $this->accountService->getNetProfitByYear( $year );

        // total balance of this year
        $balance = $this->accountService->getTotalBalance( ['year' => $year] );

        // total bank balance of this year
        $bankAmount = $this->accountService->getTotalBankAmountByYear( $year );

        // get total cash amount by year
        $cashAmount = $this->accountService->getTotalCashAmountByYear( $year );

        // last 5 project expense
        $projectExpenses = ProjectExpense::orderBy( 'id', 'desc' )->take( 5 )->get();

        $leaveRecordsOfThisMonth = EmployeeLeave::whereMonth( 'created_at', now()->month )->get();

        $data = [
            'year'             => $year,
            'clients'          => $clients,
            'projects'         => $projects,
            'sales'            => $sales,
            'expense'          => $expense,
            'net_profit'       => $netProfit,
            'balance'          => $balance,
            'bank_amount'      => $bankAmount,
            'cash_amount'      => $cashAmount,
            'project_expenses' => $projectExpenses,
            'leave_records'    => $leaveRecordsOfThisMonth
        ];

        return view( 'dashboard', ['data' => $data] );
    }
}
