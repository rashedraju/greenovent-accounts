<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller {
    public function index() {
        return view( 'accounts.expenses.index' );
    }

    public function show( Request $request ) {
        if ( $request->date ) {
            // find expenses of this date
            $date = $request->date;
            $expenseRecords = Expense::where( 'date', $date )->get();
            return view( 'accounts.expenses.show', compact( ['expenseRecords', 'date'] ) );
        }

        return redirect()->route( 'accounts.expenses.index' )->with( 'failed', 'Expense records not found!' );
    }
}
