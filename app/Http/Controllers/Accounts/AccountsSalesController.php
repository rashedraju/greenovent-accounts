<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class AccountsSalesController extends Controller {
    public function index( $year, $month ) {
        $projects = Project::filter( array_merge( ['year' => $year, 'month' => $month], request( ['year', 'month', 'client', 'accounts_manager'] ) ) )->get();
        // filter project by project due amount
        if ( $bill = request()->bill ) {
            if ( $bill == 1 ) {
                $projects = $projects->filter( fn( $p ) => $p->due() > 0 );
            }

            if ( $bill == 2 ) {
                $projects = $projects->filter( fn( $p ) => $p->due() <= 0 );
            }

        }

        $projectGoal = $projects->sum( fn( $p ) => $p->external?->grandTotal() );
        $sales = $projects->sum( fn( $p ) => $p->sales() );
        $asfTotal = $projects->sum( fn( $p ) => $p->external?->asfTotal() );
        $asfSubTotal = $projects->sum( fn( $p ) => $p->external?->asfSubTotal() );
        $vatTotal = $projects->sum( fn( $p ) => $p->external?->vatTotal() );
        $ait = $projects->sum( fn( $p ) => $p->ait() );
        $internalTotal = $projects->sum( fn( $p ) => $p->internal?->total );
        $totalExpense = $projects->sum( fn( $p ) => $p->totalExpense() );
        $due = $projects->sum( fn( $p ) => $p->due() );
        $grossProfit = $projects->sum( fn( $p ) => $p->grossProfit() );

        $clients = Client::all()->pluck( 'company_name', 'id' );
        $accountsManagers = User::role( 'Accounts Manager' )->get()->pluck( 'name', 'id' );

        $data = [
            'year'             => $year,
            'month'            => $month,
            'clients'          => $clients,
            'accountsManagers' => $accountsManagers,
            'projects'         => $projects,
            'projectGoal'      => $projectGoal,
            'sales'            => $sales,
            'asfTotal'         => $asfTotal,
            'asfSubTotal'      => $asfSubTotal,
            'vatTotal'         => $vatTotal,
            'ait'              => $ait,
            'internalTotal'    => $internalTotal,
            'totalExpense'     => $totalExpense,
            'due'              => $due,
            'grossProfit'      => $grossProfit
        ];
        return view( 'accounts.sales.index', ['data' => $data] );
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
