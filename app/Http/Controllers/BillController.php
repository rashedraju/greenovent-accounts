<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Client;

class BillController extends Controller {
    public function index() {
        $clients = Client::all();

        return view( 'bills.index', ['clients' => $clients] );
    }

    public function client( Client $client ) {
        $bills = collect();
        foreach ( $client->projects as $project ) {
            $bills->push( ...$project->bills );
        }

        return view( 'bills.client', ['client' => $client, 'bills' => $bills] );
    }

    public function show( Client $client, Bill $bill ) {
        return view( 'bills.show', ['client' => $client, 'bill' => $bill] );
    }
}
