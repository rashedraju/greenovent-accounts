<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use App\Models\Project;

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

        $data = [
            'accountsManager' => $user,
            'client'         => $client
        ];

        return view( 'accounts-manager.client', ['data' => $data] );
    }
}
