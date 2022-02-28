<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddClientRequest;
use App\Models\Client;

class ClientsController extends Controller {
    // view all clients
    public function index() {
        return view( 'clients.index', ['clients' => Client::orderBy( 'id', 'desc' )->get()] );
    }

    // view client details
    public function show( Client $client ) {
        return view( 'clients.show', ['client' => $client] );
    }

    // add new client view
    public function create() {
        return view( 'clients.add' );
    }

    // store client
    public function store( AddClientRequest $request ) {
        $attrs = $request->validated();

        $client = Client::create( $attrs );

        if ( $client ) {
            return redirect()->route( 'clients' )->with( 'success', 'Client Added Successfully' );
        } else {
            return back()->with( 'failed', 'Failed to Add Client' );
        }
    }
}
