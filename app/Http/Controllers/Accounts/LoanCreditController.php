<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Credit\LoanCredit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LoanCreditController extends Controller {
    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'loan_provider'       => 'required|string',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        LoanCredit::create( $attributes );

        return redirect()->back()->with( 'success', 'Loan credit has been added.' );
    }

    public function update( LoanCredit $loanCredit, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'loan_provider'       => 'required|string',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $loanCredit->update( $attributes );

        return redirect()->back()->with( 'success', 'Loan credit has been updated.' );
    }

    public function delete( LoanCredit $loanCredit ) {

        $loanCredit->delete();

        return redirect()->back()->with( 'success', 'Loan credit has been deleted.' );
    }
}
