<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function index( Request $request ) {
        if ( auth()->user()->cannot( 'Dashboard' ) ) {
            abort( 403 );
        }

        // find client sales by year and month
        $year = now()->year;
        $month = now()->month;

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

        $onGoingProjects = Project::where( 'status_id', 2 )->orderBy( 'id', 'desc' )->get();

        $completedProjects = Project::where( 'status_id', 1 )->orderBy( 'id', 'desc' )->take( 5 )->get();

        $data = [
            'year'              => $year,
            'month'             => $month,
            'clients'           => $clients,
            'accountsManagers'  => $accountsManagers,
            'projects'          => $projects,
            'projectGoal'       => $projectGoal,
            'sales'             => $sales,
            'asfTotal'          => $asfTotal,
            'asfSubTotal'       => $asfSubTotal,
            'vatTotal'          => $vatTotal,
            'ait'               => $ait,
            'internalTotal'     => $internalTotal,
            'totalExpense'      => $totalExpense,
            'due'               => $due,
            'grossProfit'       => $grossProfit,
            'onGoingProjects'   => $onGoingProjects,
            'completedProjects' => $completedProjects
        ];

        return view( 'dashboard', ['data' => $data] );
    }
}
