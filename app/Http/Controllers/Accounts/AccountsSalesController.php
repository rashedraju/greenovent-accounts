<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class AccountsSalesController extends Controller {
    public function index( $year, $month ) {
        if ( $year && $month ) {
            $projects = Project::whereYear( 'start_date', $year )->whereMonth( 'start_date', $month )->get();
            $salesThisMonth = Project::whereYear( 'start_date', now()->year )->whereMonth( 'start_date', now()->month )->get()->sum( fn( $p ) => $p->sales() );
            $totalExpense = Project::whereYear( 'start_date', now()->year )->whereMonth( 'start_date', now()->month )->get()->sum( fn( $p ) => $p->totalExpense() );
            $grossProfit = Project::whereYear( 'start_date', now()->year )->get()->sum( fn( $p ) => $p->grossProfit() );

            $data = [
                'year'           => $year,
                'month'          => $month,
                'projects'       => $projects,
                'salesThisMonth' => $salesThisMonth,
                'totalExpense'   => $totalExpense,
                'grossProfit'    => $grossProfit
            ];
            return view( 'accounts.sales.index', ['data' => $data] );
        }

        return back()->with( 'Not found!' );
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
