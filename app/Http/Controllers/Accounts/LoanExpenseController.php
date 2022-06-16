<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Expenses\LoanExpense;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoanExpenseController extends Controller {
    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'received_person'     => 'required|string',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        LoanExpense::create( $attributes );

        return redirect()->back()->with( 'success', 'Loan expense has been added.' );
    }

    public function update( LoanExpense $loanExpense, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'received_person'     => 'required|string',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $loanExpense->update( $attributes );

        return redirect()->back()->with( 'success', 'Loan expense has been updated.' );
    }

    public function delete( LoanExpense $loanExpense ) {

        $loanExpense->delete();

        return redirect()->back()->with( 'success', 'Loan expense has been deleted.' );
    }
}
