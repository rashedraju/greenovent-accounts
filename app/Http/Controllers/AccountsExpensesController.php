<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseAddRequest;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Project;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\Request;

class AccountsExpensesController extends Controller {
    public function index() {
        // total expenses of current year
        $year = now()->year;

        $totalExpenseOfByYear = collect();

        $expenseTypes = ExpenseType::all();

        return view( 'accounts.expenses.index', compact( ['totalExpenseOfByYear', 'expenseTypes'] ) );
    }

    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            // find expenses of this date
            $year = $request->year;
            $month = $request->month;

            // get records
            // $expenseRecords = Expense::whereYear( 'date', '=', $year )->whereMonth( 'date', '=', $month )->get();
            $expenseRecords = collect();

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

        return redirect()->back()->with( 'failed', 'Failed to add expense.' );
    }

    public function update( ExpenseAddRequest $request ) {
        $attributes = $request->validated();

        return redirect()->back()->with( 'failed', "Failed to update expense record." );

    }

    // delete expense
    public function destory() {
        return redirect()->back()->with( 'failed', "Failed to delete expense record" );
    }

    // download expense records by year and month
    public function export( Request $request ) {
        if ( $request->year && $request->month ) {
            $year = $request->year;
            $month = $request->month;

            $fname = now()->month( $month )->format( 'F' ) . "_" . $year . "_expense_records.xlsx";
        }

        return redirect()->route( 'accounts.expenses.index' )->with( 'failed', 'Expense records not found!' );
    }
}
