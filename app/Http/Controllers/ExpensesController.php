<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseAddRequest;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Project;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\Request;

class ExpensesController extends Controller {
    public function index() {
        return view( 'accounts.expenses.index' );
    }

    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            // find expenses of this date
            $year = $request->year;
            $month = $request->month;

            // get records
            // $expenseRecords = Expense::whereYear( 'date', '=', $year )->whereMonth( 'date', '=', $month )->get();
            $expenseRecords = Expense::filter( request( ['year', 'month', 'head', 'user_id', 'project_id', 'expense_type_id', 'transaction_type_id'] ) )->get();

            // get billing persons
            $billingPersons = User::pluck( 'name', 'id' );

            // get projects
            $projects = Project::pluck( 'name', 'id' );

            // get expense types
            $expenseTypes = ExpenseType::pluck( 'name', 'id' );

            // get transaction types
            $transactionTypes = TransactionType::pluck( 'name', 'id' );

            // calculate total expenses of this month
            $totalExpensesOfThisMonth = $expenseRecords->sum( fn( $expense ) => $expense->amount );

            // data for filter
            // expense heads
            $expenseHeadsOfThisMonth = $expenseRecords->pluck( 'head' );
            // billing persons of this month expenses
            $billingPersonsOfThisMonth = $expenseRecords->pluck( 'billingPerson.name', 'billingPerson.id' );
            // projects of this month
            $projectsOfThisMonth = $expenseRecords->pluck( 'project.name', 'project.id' );

            return view( 'accounts.expenses.show', compact( ['month', 'year', 'expenseRecords', 'billingPersons', 'projects', 'expenseTypes', 'transactionTypes', 'totalExpensesOfThisMonth', 'expenseHeadsOfThisMonth', 'billingPersonsOfThisMonth', 'projectsOfThisMonth'] ) );
        }

        return redirect()->route( 'accounts.expenses.index' )->with( 'failed', 'Expense records not found!' );
    }

    // store expense
    public function store( ExpenseAddRequest $request ) {
        $attributes = $request->validated();

        $expense = Expense::create( $attributes );

        if ( $expense ) {
            return redirect()->back()->with( 'success', 'Expense added.' );
        }

        return redirect()->back()->with( 'failed', 'Failed to add expense.' );
    }

    public function update( Expense $expense, ExpenseAddRequest $request ) {
        $attributes = $request->validated();

        $attributes = array_merge( $attributes, [
            'modified' => now()
        ] );

        if ( $expense->update( $attributes ) ) {
            return redirect()->back()->with( 'success', "Expense No: {$expense->id} updated." );
        }

        return redirect()->back()->with( 'failed', "Expense No: {$expense->id} Failed to update." );

    }

    // delete expense
    public function destory( Expense $expense ) {
        if ( $expense->delete() ) {
            return redirect()->back()->with( 'success', "Expense No:{$expense->id} deleted." );
        }

        return redirect()->back()->with( 'failed', "Expense No:{$expense->id} Failed to delete." );
    }
}
