<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalsController extends Controller {
    public function index() {
        return view( 'accounts.withdrawals.index' );
    }

    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            // find expenses of this date
            $year = $request->year;
            $month = $request->month;

            // get withdrawal records
            $withdrawalRecords = Withdrawal::filter( request( ['year', 'month', 'user_id', 'bank_name'] ) )->get();

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
    public function store( Request $request ) {
        $attributes = $request->validated();

        $withdrawal = Withdrawal::create( $attributes );

        if ( $withdrawal ) {
            return redirect()->back()->with( 'success', 'withdrawal added.' );
        }

        return redirect()->back()->with( 'failed', 'Failed to add withdrawal.' );
    }

    // update withdrawal to db
    public function update( withdrawal $withdrawal, Request $request ) {
        $attributes = $request->validated();

        $attributes = array_merge( $attributes, [
            'modified' => now()
        ] );

        if ( $withdrawal->update( $attributes ) ) {
            return redirect()->back()->with( 'success', "Withdrawal No: {$withdrawal->id} updated." );
        }

        return redirect()->back()->with( 'failed', "Withdrawal No: {$withdrawal->id} Failed to update." );

    }

    // delete expense
    public function destory( Withdrawal $withdrawal ) {
        if ( $withdrawal->delete() ) {
            return redirect()->back()->with( 'success', "withdrawal No:{$withdrawal->id} deleted." );
        }

        return redirect()->back()->with( 'failed', "withdrawal No:{$withdrawal->id} Failed to delete." );
    }
}
