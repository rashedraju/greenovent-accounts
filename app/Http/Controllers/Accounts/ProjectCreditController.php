<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Credit\ProjectCredit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectCreditController extends Controller {
    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'sometimes',
            'head'                => 'required|string',
            'description'         => 'sometimes',
            'project_id'          => ['required', Rule::exists( 'projects', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        if ( ProjectCredit::create( $attributes ) ) {
            return redirect()->back()->with( 'success', 'Project credit has been added.' );
        }

        return redirect()->back()->with( 'failed', 'Failed to add project credit.' );
    }

    public function update( ProjectCredit $projectCredit, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'sometimes',
            'head'                => 'required|string',
            'description'         => 'sometimes',
            'project_id'          => ['required', Rule::exists( 'projects', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $projectCredit->update( $attributes );

        return redirect()->back()->with( 'success', 'Project credit has been updated.' );
    }

    public function delete( ProjectCredit $projectCredit ) {

        $projectCredit->delete();

        return redirect()->back()->with( 'success', 'Project credit has been deleted.' );
    }
}
