<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Requisition;

class AccountsRequisitoinController extends Controller {
    public function index($year, $month) {
        $requisitions = Requisition::orderBy( 'id', 'desc' )->paginate( 15 );
        return view( 'accounts.requisitions.index', ['requisitions' => $requisitions] );
    }

    public function show( Requisition $requisition ) {
        $requisitions = Requisition::orderBy( 'id', 'desc' )->paginate( 15 );

        if ( $requisition ) {

            return view( 'accounts.requisitions.show', ['requisition' => $requisition, 'requisitions' => $requisitions] );
        }

        return redirect()->route( 'accounts.requisitions.index', $requisitions )->with( 'failed', 'Records not found' );
    }
}
