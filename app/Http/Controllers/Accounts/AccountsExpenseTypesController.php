<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\AccountsExpenseType;
use Illuminate\Http\Request;

class AccountsExpenseTypesController extends Controller {
    public function store( Request $request ) {
        $attrs = $request->validate( [
            'name' => 'required|unique:accounts_expense_types,name'
        ] );

        AccountsExpenseType::create( $attrs );

        return redirect()->back()->with( 'success', 'Expense type has been added.' );
    }
}
