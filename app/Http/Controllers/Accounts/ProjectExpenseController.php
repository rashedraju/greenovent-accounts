<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Expenses\ProjectExpense;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectExpenseController extends Controller {
    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'head'                => 'required|string',
            'description'         => 'nullable',
            'project_id'          => ['required', Rule::exists( 'projects', 'id' )],
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        if ( ProjectExpense::create( $attributes ) ) {
            return redirect()->back()->with( 'success', 'Project expense has been added.' );
        }

        return redirect()->back()->with( 'failed', 'Failed to add project expense.' );
    }

    public function update( ProjectExpense $projectExpense, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'head'                => 'required|string',
            'description'         => 'nullable',
            'project_id'          => ['required', Rule::exists( 'projects', 'id' )],
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $projectExpense->update( $attributes );

        return redirect()->back()->with( 'success', 'Project expense has been updated.' );
    }

    public function delete( ProjectExpense $projectExpense ) {

        $projectExpense->delete();

        return redirect()->back()->with( 'success', 'Project expense has been deleted.' );
    }
}
