<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Accounts\Expenses\SalaryExpense;
use App\Models\TransactionType;
use App\Models\User;
use App\Services\ExpenseService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SalaryExpenseController extends Controller {
    public $expenseService;

    public function __construct( ExpenseService $expenseService ) {
        $this->expenseService = $expenseService;
    }

    public function index( $year, $month ) {

        $salary = $this->expenseService->getSalaryExpenses( ['year' => $year, 'month' => $month] );
        $salaryAmount = $this->expenseService->getSalaryExpenseAmount( ['year' => $year] );
        $users = User::all();
        $transactionTypes = TransactionType::all();
        $startDate = now()->year( $year )->month( $month )->startOfMonth()->toDateString();
        $endDate = now()->year( $year )->month( $month )->endOfMonth()->toDateString();

        $data = [
            'year'              => $year,
            'month'             => $month,
            'employees'         => $users,
            'transaction_types' => $transactionTypes,
            'start_date'        => $startDate,
            'end_date'          => $endDate,
            'expenses'          => [
                'name'    => 'Salary',
                'amount'  => $salaryAmount,
                'records' => $salary
            ]
        ];

        return view( 'accounts.expenses.salary', ['data' => $data] );
    }

    public function store( Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'sometimes',
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        SalaryExpense::create( $attributes );

        return redirect()->back()->with( 'success', 'Salary expense has been added.' );
    }

    public function update( SalaryExpense $salaryExpense, Request $request ) {
        $attributes = $request->validate( [
            'date'                => 'sometimes',
            'user_id'             => ['required', Rule::exists( 'users', 'id' )],
            'amount'              => 'required|integer',
            'transaction_type_id' => ['required', Rule::exists( 'transaction_types', 'id' )]
        ] );

        $salaryExpense->update( $attributes );

        return redirect()->back()->with( 'success', 'Salary expense has been updated.' );
    }

    public function delete( SalaryExpense $salaryExpense ) {

        $salaryExpense->delete();

        return redirect()->back()->with( 'success', 'Salary expense has been deleted.' );
    }
}
