<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\EmployeeLeave;
use App\Models\Project;
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

        // finance records
        $year = now()->year;

        // total balance of this year
        $totalBalanceByYear = $this->accountService->getTotalBalanceByYear( $year );

        // total bank balance of this year
        $totalBankAmountByYear = $this->accountService->getTotalBankAmountByYear( $year );

        // get total cash amount by year
        $totalCashAmountByYear = $this->accountService->getTotalCashAmountByYear( $year );

        // get total loan amount by year
        $totalLoanAmountByYear = $this->accountService->getLoanAmountByYear( $year );

        // get toal investment amount by year
        $totalInvestmentAmountByYear = $this->accountService->getInvestmentAmountByYear( $year );

        // get sales, expense, netprofit by year
        $totalSalesByYear = $this->accountService->getTotalSalesByYear( $year );
        $totalExpenseByYear = $this->accountService->getTotalExpenseAmountByYear( $year );
        $netProfitByYear = $this->accountService->getNetProfitByYear( $year );

        // project finance
        $projectCredit = $this->accountService->getProjectCreditAmountByYear( $year );
        $projectDebit = $this->accountService->getProjectDebitAmountByYear( $year );
        $netProfit = $this->accountService->getNetProfitByYear( $year );

        // latest five credit record by project
        $lastFiveCreditRecordsByProject = $this->creditService->lastFiveCreditRecordsByProject();

        $leaveRecordsOfThisMonth = EmployeeLeave::whereMonth( 'created_at', now()->month )->get();

        return view( 'dashboard', compact( ['clients', 'projects', 'year', 'totalBalanceByYear', 'totalBankAmountByYear', 'totalCashAmountByYear', 'totalLoanAmountByYear', 'totalInvestmentAmountByYear', 'totalSalesByYear', 'totalExpenseByYear', 'netProfitByYear', 'lastFiveCreditRecordsByProject', 'leaveRecordsOfThisMonth'] ) );
    }
}
