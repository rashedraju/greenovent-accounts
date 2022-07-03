<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use App\Models\Client;
use App\Models\Project;
use App\Models\ProjectStatus;
use App\Models\ProjectType;
use App\Models\User;
use Illuminate\Http\Request;

class AccountsManagerController extends Controller {
    public function index() {
        $accountsManagers = User::role( 'Accounts Manager' )->get();
        $employees = User::orderBy( 'id', 'desc' )->get();

        $data = [
            'accountsManagers' => $accountsManagers,
            'employees'        => $employees
        ];

        return view( 'accounts-manager.index', ['data' => $data] );
    }

    public function show( User $user ) {
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

        $data = [
            'year'             => $year,
            'month'            => $month,
            'clients'          => $clients,
            'accountsManager'  => $user,
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

        return view( 'accounts-manager.show', ['data' => $data] );
    }

    public function client( User $user, Client $client ) {
        $salesThisYear = $client->projects()->whereYear( 'start_date', now()->year )->get()->sum( fn( $p ) => $p->sales() );
        $salesThisMonth = $client->projects( 'start_date' )->whereYear( 'start_date', now()->year )->whereMonth( 'start_date', now()->month )->get()->sum( fn( $p ) => $p->sales() );

        // get bussiness managers
        $bussinessManagers = User::role( 'Accounts Manager' )->get();

        $projects = $client->projects()->orderBy( 'id', 'desc' )->get();
        // get clients
        $clients = Client::all();

        // get project types
        $projectTypes = ProjectType::all();

        // get project statuses
        $projectStatuses = ProjectStatus::all();

        // bill types
        $billTypes = BillType::all();

        $data = [
            'accountsManager'   => $user,
            'projects'          => $projects,
            'bussinessManagers' => $bussinessManagers,
            'client'            => $client,
            'salesThisYear'     => $salesThisYear,
            'salesThisMonth'    => $salesThisMonth,
            'clients'           => $clients,
            'projectTypes'      => $projectTypes,
            'projectStatuses'   => $projectStatuses,
            'billTypes'         => $billTypes
        ];

        return view( 'accounts-manager.client', ['data' => $data] );
    }

    // add new accounts manager
    public function store( Request $request ) {
        $attrs = $request->validate( [
            'user_id' => 'required|exists:users,id'
        ] );

        $user = User::find( $attrs['user_id'] );

        $user->assignRole( 'Accounts Manager' );

        return redirect()->route( 'accounts-manager.index' )->with( 'New Accounts Manager has been added.' );
    }
}
