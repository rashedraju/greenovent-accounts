<?php

namespace App\Http\Controllers;

use App\Exports\WithdrawalsExport;
use App\Http\Requests\WithdrawalAddRequest;
use App\Models\User;
use App\Models\Withdrawal;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WithdrawalsController extends Controller {
    public $accountService;

    public function __construct( AccountService $accountService ) {
        $this->accountService = $accountService;
    }

    public function index() {
        $year = now()->year;
        $totalWithdrawalAmountOfThisYear = $this->accountService->getTotalWithdrawalAmountByYear( $year );
        return view( 'accounts.withdrawals.index', compact( ['year', 'totalWithdrawalAmountOfThisYear'] ) );
    }

    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            // find withdrawals of this date
            $year = $request->year;
            $month = $request->month;
            // get withdrawal records
            $withdrawalRecords = Withdrawal::filter( array_merge( ['year' => $year, 'month' => $month], request( ['user_id', 'bank_name'] ) ) )->get();

            // get withdrawal persons
            $withdrawalPersons = User::pluck( 'name', 'id' );

            // calculate total withdrawal of this month
            $totalWithdrawalsOfThisMonth = $withdrawalRecords->sum( fn( $withdrawal ) => $withdrawal->amount );

            // data for filter
            // withdrawal persons of this month withdrawals
            $withdrawalPersonsOfThisMonth = $withdrawalRecords->pluck( 'withdrawalPerson.name', 'withdrawalPerson.id' );
            // withdrawal banks
            $withdrawalBanksOfThisMonth = $withdrawalRecords->pluck( 'bank_name' );

            return view( 'accounts.withdrawals.show', compact( ['month', 'year', 'withdrawalRecords', 'withdrawalPersons', 'totalWithdrawalsOfThisMonth', 'withdrawalPersonsOfThisMonth', 'withdrawalBanksOfThisMonth'] ) );
        }

        return redirect()->route( 'accounts.withdrawals.index' )->with( 'failed', 'Withdrawal records not found!' );
    }

    // store withdrawal
    public function store( WithdrawalAddRequest $request ) {
        $attributes = $request->validated();

        $attributes = array_merge( $attributes, [
            'modified' => now()
        ] );

        $withdrawal = Withdrawal::create( $attributes );

        if ( $withdrawal ) {
            return redirect()->back()->with( 'success', 'withdrawal added.' );
        }

        return redirect()->back()->with( 'failed', 'Failed to add withdrawal.' );
    }

    // update withdrawal to db
    public function update( $year, $month, withdrawal $withdrawal, WithdrawalAddRequest $request ) {
        $attributes = $request->validated();

        $attributes = array_merge( $attributes, [
            'modified' => now()
        ] );

        if ( $withdrawal->update( $attributes ) ) {
            return redirect()->back()->with( 'success', "Withdrawal No: {$withdrawal->id} updated." );
        }

        return redirect()->back()->with( 'failed', "Withdrawal No: {$withdrawal->id} Failed to update." );

    }

    // delete withdrawal
    public function destory( $year, $month, Withdrawal $withdrawal ) {
        if ( $withdrawal->delete() ) {
            return redirect()->back()->with( 'success', "withdrawal No:{$withdrawal->id} deleted." );
        }

        return redirect()->back()->with( 'failed', "withdrawal No:{$withdrawal->id} Failed to delete." );
    }

    // download withdrawal records by year and month
    public function export( Request $request ) {
        if ( $request->year && $request->month ) {
            $year = $request->year;
            $month = $request->month;

            $fname = now()->month( $month )->format( 'F' ) . "_" . $year . "_withdrawal_records.xlsx";

            return Excel::download( new WithdrawalsExport( $year, $month ), $fname );
        }

        return redirect()->route( 'accounts.withdrawals.index' )->with( 'failed', 'Withdrawal records not found!' );
    }
}
