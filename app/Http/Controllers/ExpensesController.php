<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Project;
use App\Models\TransactionType;
use App\Models\User;
use Illuminate\Http\Request;

class ExpensesController extends Controller {
    public function index() {
        // total expenses of current year
        $year = now()->year;

        $totalExpenseOfByYear = Expense::whereYear( 'date', $year )->get()->sum( fn( $expense ) => $expense->amount );

        $expenseTypes = ExpenseType::all();

        return view( 'expenses.index', compact( ['totalExpenseOfByYear', 'expenseTypes'] ) );
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
            $employees = User::pluck( 'name', 'id' );

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

            return view( 'expenses.show', compact( ['month', 'year', 'expenseRecords', 'employees', 'projects', 'expenseTypes', 'transactionTypes', 'totalExpensesOfThisMonth', 'expenseHeadsOfThisMonth', 'billingPersonsOfThisMonth', 'projectsOfThisMonth'] ) );
        }

        return redirect()->route( 'expenses.index' )->with( 'failed', 'Expense records not found!' );
    }
}
