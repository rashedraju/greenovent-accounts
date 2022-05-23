<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Expenses\SalaryExpense;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalaryExpenseController extends Controller {
    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'sometimes',
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        if(SalaryExpense::create( $attributes )){
            return redirect()->back()->with( 'success', 'Salary expense has been added.' );
        }

        return redirect()->back()->with( 'success', 'Failed to add salary expense.' );
    }

    public function update( SalaryExpense $salaryExpense, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'sometimes',
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $salaryExpense->update( $attributes );

        return redirect()->back()->with( 'success', 'Salary expense has been updated.' );
    }

    public function delete( SalaryExpense $salaryExpense ) {

        $salaryExpense->delete();

        return redirect()->back()->with( 'success', 'Salary expense has been deleted.' );
    }
}
