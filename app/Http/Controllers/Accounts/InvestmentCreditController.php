<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Credit\InvestmentCredit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InvestmentCreditController extends Controller {
    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'company_name'        => 'required|string',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        InvestmentCredit::create( $attributes );

        return redirect()->back()->with( 'success', 'Investment credit has been added.' );
    }

    public function update( InvestmentCredit $investmentCredit, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'company_name'        => 'required|string',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $investmentCredit->update( $attributes );

        return redirect()->back()->with( 'success', 'Investment credit has been updated.' );
    }

    public function delete( InvestmentCredit $investmentCredit ) {

        $investmentCredit->delete();

        return redirect()->back()->with( 'success', 'Investment credit has been deleted.' );
    }
}
