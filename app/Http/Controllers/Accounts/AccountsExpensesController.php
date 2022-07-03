<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\AccountsExpenseType;
use App\Models\Accounts\AccountsExpense;
use App\Models\TransactionType;
use App\Services\ExpenseService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AccountsExpensesController extends Controller {
    public $expenseService;

    public function __construct( ExpenseService $expenseService ) {
        $this->expenseService = $expenseService;
    }

    public function index( $year, $month ) {

        if ( $year && $month ) {
            // get today expenses
            $day = request()->day ?? now()->day;
            $expensesByDay = AccountsExpense::whereYear( 'date', $year )->whereMonth( 'date', $month )->whereDay( 'date', $day )->get();
            $expensesByDayAmount = $expensesByDay->sum( fn( $item ) => $item->amount );

            $expenseTypes = AccountsExpenseType::all();
            $totalExpense = AccountsExpense::whereYear( 'date', $year )->whereMonth( 'date', $month )->get()->sum( fn( $item ) => $item->amount );
            $transactionTypes = TransactionType::all();
            $startDate = now()->year( $year )->month( $month )->startOfMonth()->toDateString();
            $endDate = now()->year( $year )->month( $month )->endOfMonth()->toDateString();

            $data = [
                'year'                => $year,
                'month'               => $month,
                'startDate'           => $startDate,
                'endDate'             => $endDate,
                'expensesByDay'       => $expensesByDay,
                'expensesByDayAmount' => $expensesByDayAmount,
                'totalExpense'        => $totalExpense,
                'expenseTypes'        => $expenseTypes,
                'transactionTypes'    => $transactionTypes
            ];

            return view( 'accounts.expenses.index', ['data' => $data] );
        }

        return back()->with( 'Not found!' );
    }

    public function show( $year, $month, AccountsExpenseType $accountsExpenseType ) {
        $expenseTypes = AccountsExpenseType::all();
        $epxneses = $accountsExpenseType->expenses()->whereYear( 'date', $year )->whereMonth( 'date', $month )->get();
        $totalExpense = AccountsExpense::whereYear( 'date', $year )->whereMonth( 'date', $month )->get()->sum( fn( $item ) => $item->amount );
        $transactionTypes = TransactionType::all();
        $startDate = now()->year( $year )->month( $month )->startOfMonth()->toDateString();
        $endDate = now()->year( $year )->month( $month )->endOfMonth()->toDateString();
        $totalExpenseByType = $accountsExpenseType->expenses()->whereYear( 'date', $year )->whereMonth( 'date', $month )->get()->sum( fn( $item ) => $item->amount );

        return view( 'accounts.expenses.show', ['data' => [
            'year'                => $year,
            'month'               => $month,
            'transactionTypes'    => $transactionTypes,
            'startDate'           => $startDate,
            'endDate'             => $endDate,
            'accountsExpenseType' => $accountsExpenseType,
            'expenseTypes'        => $expenseTypes,
            'totalExpense'        => $totalExpense,
            'expenses'            => $epxneses,
            'totalExpenseByType'  => $totalExpenseByType
        ]] );
    }

    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'required',
            'expense_type_id'     => ['required', Rule::exists( 'accounts_expense_types', 'id' )],
            'item'                => 'nullable',
            'description'         => 'nullable',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        AccountsExpense::create( $attributes );

        return redirect()->back()->with( 'success', 'Expense has been added.' );
    }

    // update expense
    public function update( $year, $month, AccountsExpense $accountsExpense, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'required',
            'expense_type_id'     => ['required', Rule::exists( 'accounts_expense_types', 'id' )],
            'item'                => 'nullable',
            'description'         => 'nullable',
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $accountsExpense->update( $attributes );

        return redirect()->back()->with( 'success', 'Expense has been updated.' );
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
