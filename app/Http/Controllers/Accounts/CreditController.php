<?php

namespace App\Http\Controllers\Accounts;

use App\Exports\CreditsExport;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\TransactionType;
use App\Models\User;
use App\Services\CreditService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CreditController extends Controller {
    public $creditService;

    public function __construct( CreditService $creditService ) {
        $this->creditService = $creditService;
    }

    public function index() {
        return view( 'accounts.credits.index' );
    }

    public function showByYear( $year ) {
        if ( $year ) {
            $projectCreditAmount = $this->creditService->getProjectCreditAmount( ['year' => $year] );
            $loanCreditAmount = $this->creditService->getLoanCreditAmount( ['year' => $year] );
            $investmentCreditAmount = $this->creditService->getInvestmentCreditAmount( ['year' => $year] );
            $totalCreditAmount = $projectCreditAmount + $loanCreditAmount + $investmentCreditAmount;

            $data = [
                'total'   => $totalCreditAmount,
                'credits' => [
                    [
                        'name'   => 'Project',
                        'amount' => $projectCreditAmount
                    ], [
                        'name'   => 'Loan',
                        'amount' => $loanCreditAmount
                    ], [
                        'name'   => 'Investment',
                        'amount' => $investmentCreditAmount
                    ]
                ]
            ];
            return view( 'accounts.credits.show-year', compact( ['year', 'data'] ) );
        }

        return redirect()->route( 'accounts.credits.index' )->with( 'failed', 'Records no found!' );
    }

    public function show( $year, $month ) {
        if ( $year && $month ) {
            $args = ['year' => $year, 'month' => $month];

            $project = $this->creditService->getProjectCredit( $args );
            $loan = $this->creditService->getLoanCredit( $args );
            $investment = $this->creditService->getInvestmentCredit( $args );

            $projectAmount = $project->sum( fn( $credit ) => $credit->amount );
            $loanAmount = $loan->sum( fn( $credit ) => $credit->amount );
            $investmentAmount = $investment->sum( fn( $credit ) => $credit->amount );

            $projectHeads = $project->pluck( 'head' );

            $total = $projectAmount + $loanAmount + $investmentAmount;

            $projects = Project::pluck( 'name', 'id' );
            $startDate = now()->year( $year )->month( $month )->startOfMonth()->toDateString();
            $endDate = now()->year( $year )->month( $month )->endOfMonth()->toDateString();
            $employees = User::all();
            $transactionTypes = TransactionType::all();

            $data = [
                'year'              => $year,
                'month'             => $month,
                'start_date'        => $startDate,
                'end_date'          => $endDate,
                'projects'          => $projects,
                'employees'         => $employees,
                'transaction_types' => $transactionTypes,
                'total'             => $total,
                'credits'           => [
                    'project'    => [
                        'name'    => 'Project',
                        'heads'   => $projectHeads,
                        'records' => $project,
                        'amount'  => $projectAmount
                    ],
                    'loan'       => [
                        'name'    => 'Loan',
                        'records' => $loan,
                        'amount'  => $loanAmount
                    ],
                    'investment' => [
                        'name'    => 'Investment',
                        'records' => $investment,
                        'amount'  => $investmentAmount
                    ]
                ]
            ];

            return view( 'accounts.credits.show-year-month', compact( ['data'] ) );
        }

        return redirect()->route( 'accounts.credits.show.year' )->with( 'failed', 'Credit records not found!' );
    }

    // download credit records by year and month
    public function export( Request $request ) {
        if ( $request->year && $request->month ) {
            $year = $request->year;
            $month = $request->month;

            $fname = now()->month( $month )->format( 'F' ) . "_" . $year . "_credit_records.xlsx";

            return Excel::download( new CreditsExport( $year, $month ), $fname );
        }

        return redirect()->route( 'accounts.credits.index' )->with( 'failed', 'Credit records not found!' );
    }

}
