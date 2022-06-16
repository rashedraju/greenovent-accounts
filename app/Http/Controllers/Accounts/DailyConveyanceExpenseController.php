<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Expenses\DailyConveyanceExpense;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DailyConveyanceExpenseController extends Controller {
    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'head'                => 'required|string',
            'description'         => 'nullable',
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        if ( DailyConveyanceExpense::create( $attributes ) ) {
            return redirect()->back()->with( 'success', 'Daily Conveyance has been added.' );
        }

        return redirect()->back()->with( 'failed', 'Failed to add daily conveyance.' );
    }

    public function update( DailyConveyanceExpense $dailyConveyanceExpense, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'head'                => 'required|string',
            'description'         => 'nullable',
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $dailyConveyanceExpense->update( $attributes );

        return redirect()->back()->with( 'success', 'Daily Conveyance has been updated.' );
    }

    public function delete( DailyConveyanceExpense $dailyConveyanceExpense ) {

        $dailyConveyanceExpense->delete();

        return redirect()->back()->with( 'success', 'Daily Conveyance has been deleted.' );
    }
}
