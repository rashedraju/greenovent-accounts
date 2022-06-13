<?php

namespace App\Http\Controllers;

use App\Models\Client;
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
        $clients = Client::where( 'business_manager_id', $user->id )->get();

        $data = [
            'accountsManager' => $user,
            'clients'         => $clients
        ];

        return view( 'accounts-manager.show', ['data' => $data] );
    }

    public function client( User $user, Client $client ) {
        $salesThisYear = $client->projects()->whereYear( 'start_date', now()->year )->get()->sum( fn( $p ) => $p->sales() );
        $salesThisMonth = $client->projects( 'start_date' )->whereYear( 'start_date', now()->year )->whereMonth( 'start_date', now()->month )->get()->sum( fn( $p ) => $p->sales() );

        $data = [
            'accountsManager' => $user,
            'client'          => $client,
            'salesThisYear'   => $salesThisYear,
            'salesThisMonth'  => $salesThisMonth
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
