<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddClientRequest;
use App\Http\Requests\CreateClientContactPersonRequest;
use App\Http\Requests\EditClientContactPersonRequest;
use App\Http\Requests\EditClientRequest;
use App\Models\Client;
use App\Models\ClientContactPerson;
use App\Models\User;

class ClientsController extends Controller {
    // view all clients
    public function index() {
        $clients = Client::orderBy( 'id', 'desc' )->get();

        return view( 'clients.index', compact( ['clients'] ) );
    }

    // view client details
    public function show( Client $client ) {
        return view( 'clients.show', ['client' => $client] );
    }

    // edit client info
    public function edit( Client $client ) {
        // get all bussiness managers
        $bussinessManagers = User::role( 'Bussiness Manager' )->get();
        return view( 'clients.edit', ['client' => $client, 'bussinessManagers' => $bussinessManagers] );
    }

    // update client info
    public function update( Client $client, EditClientRequest $request ) {
        $attrs = $request->validated();
        $client->update( $attrs );
        return redirect()->route( 'clients.show', $client )->with( 'success', 'Client details has been updated' );
    }

    // add new client view
    public function create() {
        // get all bussiness managers
        $bussinessManagers = User::role( 'Bussiness Manager' )->get();

        return view( 'clients.add', compact( ['bussinessManagers'] ) );
    }

    // store client
    public function store( AddClientRequest $addClientRequest ) {
        $attrs = $addClientRequest->validated();
        $contactPersons = array_pop( $attrs );

        // create clilent
        $client = Client::create( $attrs );

        // create contact persons
        $client->contactPersons()->createMany( $contactPersons );

        return redirect()->route( 'accounts-manager.show', ['user' => $client->business_manager_id] )->with( 'success', 'Client Added Successfully' );
    }

    // delete client
    public function destroy( Client $client ) {
        if ( $client->delete() ) {
            return redirect()->route( 'clients.index' )->with( 'success', 'Client Removed' );
        } else {
            return redirect()->route( 'clients.index' )->with( 'failed', 'Failed to Client Removed' );
        }
    }

    // add contact person
    public function createContactPerson( Client $client ) {
        return view( 'clients.contact.add', ['client' => $client] );
    }

    // store contact person
    public function storeContactPerson( Client $client, CreateClientContactPersonRequest $request ) {
        $contactPersons = $request->validated();
        $client->contactPersons()->createMany( array_pop( $contactPersons ) );

        return redirect()->route( 'clients.show', $client )->with( 'success', 'New Contact Persons Added to Client Details' );
    }

    // edit client contact person
    public function editContactPerson( Client $client, ClientContactPerson $clientContactPerson ) {
        return view( 'clients.contact.edit', compact( ['client', 'clientContactPerson'] ) );
    }

    // update client contact person
    public function updateContactPerson( Client $client, ClientContactPerson $clientContactPerson, EditClientContactPersonRequest $request ) {
        $attrs = $request->validated();
        $clientContactPerson->update( $attrs );

        return redirect()->route( 'clients.show', $client )->with( 'success', "Client Contact Person Details Updated." );
    }
}
