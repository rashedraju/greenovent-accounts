<?php

namespace App\Http\Controllers;

use App\Models\BillType;
use App\Models\Client;
use App\Models\ProjectStatus;
use App\Models\ProjectType;
use App\Models\User;
use App\Services\SalesService;
use Illuminate\Http\Request;

class AccountsManagerController extends Controller {
    public $salesService;

    public function __construct( SalesService $salesService ) {
        $this->salesService = $salesService;
    }

    public function index() {
        $accountsManagers = User::role( 'Accounts Manager' )->get();
        $employees = User::orderBy( 'id', 'desc' )->get();
        $salesData = $this->salesService->sales();

        $data = array_merge( [
            'accountsManagers' => $accountsManagers,
            'employees'        => $employees
        ], $salesData );

        return view( 'accounts-manager.index', ['data' => $data] );
    }

    public function show( User $user ) {
        $clients = Client::all()->pluck( 'company_name', 'id' );
        $data = [
            'accountsManager' => $user,
            'clients'         => $clients
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
