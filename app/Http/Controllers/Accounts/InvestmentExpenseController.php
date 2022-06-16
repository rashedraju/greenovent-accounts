<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Expenses\InvestmentExpense;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InvestmentExpenseController extends Controller {
    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'received_person'     => 'required|string',
            'company_name'        => 'required|string',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        InvestmentExpense::create( $attributes );

        return redirect()->back()->with( 'success', 'Investment expense has been added.' );
    }

    public function update( InvestmentExpense $investmentExpense, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'nullable',
            'received_person'     => 'required|string',
            'company_name'        => 'required|string',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $investmentExpense->update( $attributes );

        return redirect()->back()->with( 'success', 'Investment expense has been updated.' );
    }

    public function delete( InvestmentExpense $investmentExpense ) {

        $investmentExpense->delete();

        return redirect()->back()->with( 'success', 'Investment expense has been deleted.' );
    }
}
