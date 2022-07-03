<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Services\AccountService;
use App\Services\CreditService;
use App\Services\ExpenseService;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class DashboardController extends Controller {
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

    public function index( Request $request ) {
        if ( auth()->user()->cannot( 'Dashboard' ) ) {
            abort( 403 );
        }

        // find client sales by year and month
        $year = $request->year ?? now()->year;
        $month = $request->month ?? null;

        $sales = Client::all()->map( function ( $client ) use ( $year, $month ) {
            $salesAmount = 0;

            if ( $month ) {
                $salesAmount = $client->salesByYearAndMonth( $year, $month );
            }

            $salesAmount = $client->salesByYear( $year );

            return [
                'client' => $client->company_name,
                'amount' => $salesAmount
            ];
        } )->filter( fn( $item ) => $item['amount'] > 0 );

        $onGoingProjects = Project::where( 'status_id', 2 )->orderBy( 'id', 'desc' )->get();

        $completedProjects = Project::where( 'status_id', 1 )->orderBy( 'id', 'desc' )->take( 5 )->get();

        $data = [
            'sales'             => $sales,
            'onGoingProjects'   => $onGoingProjects,
            'completedProjects' => $completedProjects
        ];

        return view( 'dashboard', ['data' => $data] );
    }
}
