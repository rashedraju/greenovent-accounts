<?php

namespace App\Http\Controllers;

use App\Exports\DepositsExport;
use App\Http\Requests\DepositAddRequest;
use App\Models\Deposit;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DepositsController extends Controller {
    public function index() {
        return view( 'accounts.deposits.index' );
    }

    public function show( Request $request ) {
        if ( $request->year && $request->month ) {
            // find deposits of this date
            $year = $request->year;
            $month = $request->month;

            // get deposits records
            $depositRecords = Deposit::filter( array_merge( ['year' => $year, 'month' => $month], request( ['user_id', 'bank_name'] ) ) )->get();

            // get deposits persons
            $depositPersons = User::pluck( 'name', 'id' );

            // calculate total deposits of this month
            $totalDepositsOfThisMonth = $depositRecords->sum( fn( $deposit ) => $deposit->amount );

            // data for filter
            // deposit persons of this month deposits
            $depositPersonsOfThisMonth = $depositRecords->pluck( 'depositPerson.name', 'depositPerson.id' );
            // deposit banks
            $depositBanksOfThisMonth = $depositRecords->pluck( 'bank_name' );

            return view( 'accounts.deposits.show', compact( ['month', 'year', 'depositRecords', 'depositPersons', 'totalDepositsOfThisMonth', 'depositPersonsOfThisMonth', 'depositBanksOfThisMonth'] ) );
        }

        return redirect()->route( 'accounts.deposits.index' )->with( 'failed', 'Deposits records not found!' );
    }

    // store deposit
    public function store( DepositAddRequest $request ) {
        $attributes = $request->validated();

        $attributes = array_merge( $attributes, [
            'modified' => now()
        ] );

        $deposit = Deposit::create( $attributes );

        if ( $deposit ) {
            return redirect()->back()->with( 'success', 'Deposit added.' );
        }

        return redirect()->back()->with( 'failed', 'Failed to add Deposit.' );
    }

    // update deposit to db
    public function update( Deposit $deposit, DepositAddRequest $request ) {
        $attributes = $request->validated();

        $attributes = array_merge( $attributes, [
            'modified' => now()
        ] );

        if ( $deposit->update( $attributes ) ) {
            return redirect()->back()->with( 'success', "Deposit No: {$deposit->id} updated." );
        }

        return redirect()->back()->with( 'failed', "Deposit No: {$deposit->id} Failed to update." );

    }

    // delete deposit
    public function destory( Deposit $deposit ) {
        if ( $deposit->delete() ) {
            return redirect()->back()->with( 'success', "Deposit No:{$deposit->id} deleted." );
        }

        return redirect()->back()->with( 'failed', "Deposit No:{$deposit->id} Failed to delete." );
    }

    // download deposit records by year and month
    public function export( Request $request ) {
        if ( $request->year && $request->month ) {
            $year = $request->year;
            $month = $request->month;

            $fname = now()->month( $month )->format( 'F' ) . "_" . $year . "_deposit_records.xlsx";

            return Excel::download( new DepositsExport( $year, $month ), $fname );
        }

        return redirect()->route( 'accounts.deposits.index' )->with( 'failed', 'Deposit records not found!' );
    }
}
