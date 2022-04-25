<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\EmployeeLeave;
use App\Models\Project;
use App\Models\User;
use App\Services\AccountService;
use App\Services\CreditService;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    use PermissionService;

    public $accountService;
    public $creditService;

    public function __construct( AccountService $accountService, CreditService $creditService ) {
        $this->accountService = $accountService;
        $this->creditService = $creditService;
    }

    public function index( Request $request ) {
        $this->checkPermission();

        $clients = Client::orderBy( 'id', 'desc' )->get();
        $projects = Project::orderBy( 'id', 'desc' )->get();
        $users = User::paginate( 5 );

        // finance records
        $year = now()->year;
        // total balance of this year
        $totalAmountByYear = $this->accountService->getTotalAmountByYear( $year );

        // total bank balance of this year
        $totalBankAmountByYear = $this->accountService->getTotalBankAmountByYear( $year );

        $totalCashAmountByYear = $totalAmountByYear - $totalBankAmountByYear;

        $totalLoanAmountByYear = $this->accountService->getLoanAmountByYear( $year );
        $totalInvestmentAmountByYear = $this->accountService->getInvestmentAmountByYear( $year );

        // get revenue, expense, netprofit by year
        $totalRevenueOfThisYear = $this->accountService->getTotalRevenueAmountByYear( $year );
        $totalExpenseByYear = $this->accountService->getTotalExpenseAmountByYear( $year );
        $netProfitByYear = $this->accountService->getNetProfitByYear( $year );

        // project finance
        $projectCredit = $this->accountService->getProjectCreditAmountByYear( $year );
        $projectDebit = $this->accountService->getProjectDebitAmountByYear( $year );
        $netProfit = $this->accountService->getNetProfitByYear( $year );

        // latest five credit record by project
        $lastFiveCreditRecordsByProject = $this->creditService->lastFiveCreditRecordsByProject();

        $leaveRecordsOfThisMonth = EmployeeLeave::whereMonth('created_at', now()->month)->get();

        return view( 'dashboard', compact( ['clients', 'projects', 'users', 'year', 'totalAmountByYear', 'totalBankAmountByYear', 'totalCashAmountByYear', 'totalLoanAmountByYear', 'totalInvestmentAmountByYear', 'netProfit', 'totalRevenueOfThisYear', 'totalExpenseByYear', 'lastFiveCreditRecordsByProject', 'leaveRecordsOfThisMonth'] ) );
    }
}
