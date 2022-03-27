<?php

namespace App\Http\Controllers;

use App\Exports\ExpensesExport;
use App\Models\User;
use App\Models\Expense;
use App\Models\Project;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Models\TransactionType;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ExpenseAddRequest;

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
            $expenseRecords = Expense::filter( array_merge( ['year' => $year, 'month' => $month], request( ['head', 'user_id', 'project_id', 'expense_type_id', 'transaction_type_id'] ) ) )->get();

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

        $attributes = array_merge( $attributes, [
            'modified' => now()
        ] );

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

    // download expense records by year and month
    public function export( Request $request ) {
        if ( $request->year && $request->month ) {
            $year = $request->year;
            $month = $request->month;

            $fname = now()->month( $month )->format( 'F' ) . "_" . $year . "_expense_records.xlsx";

            return Excel::download( new ExpensesExport( $year, $month ), $fname );
        }

        return redirect()->route( 'accounts.expenses.index' )->with( 'failed', 'Expense records not found!' );
    }
}