<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use App\Services\AccountService;
use App\Services\PermissionService;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    use PermissionService;

    public $accountService;

    public function __construct( AccountService $accountService ) {
        $this->accountService = $accountService;
    }

    public function index( Request $request ) {
        $this->checkPermission();

        $clients = Client::all();
        $projects = Project::all();
        $users = User::all();

        // finance records
        $year = now()->year;
        // total balance of this year
        $totalAmountByYear = $this->accountService->getTotalAmountByYear( $year );

        // total bank balance of this year
        $totalBankAmountByYear = $this->accountService->getTotalBankAmountByYear( $year );

        $totalCashAmountByYear = $totalAmountByYear - $totalBankAmountByYear;

        $totalLoanAmountByYear = $this->accountService->getLoanAmountByYear( $year );
        $totalInvestmentAmountByYear = $this->accountService->getInvestmentAmountByYear( $year );

        return view( 'dashboard', compact( ['clients', 'projects', 'users', 'year', 'totalAmountByYear', 'totalBankAmountByYear', 'totalCashAmountByYear', 'totalLoanAmountByYear', 'totalInvestmentAmountByYear'] ) );
    }
}
