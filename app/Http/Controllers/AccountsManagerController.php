<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use App\Models\User;

class AccountsManagerController extends Controller {
    public function index() {
        $accountsManagers = Project::all()->map( fn( $project ) => $project->accountsManager )->unique();

        $data = [
            'accountsManagers' => $accountsManagers
        ];

        return view( 'accounts-manager.index', ['data' => $data] );
    }

    public function show( User $user ) {
        $clients = $user->projects->map( fn( $project ) => $project->client )->unique();

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
}
