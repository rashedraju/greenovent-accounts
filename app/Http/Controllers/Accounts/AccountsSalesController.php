<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Services\SalesService;
use Illuminate\Http\Request;

class AccountsSalesController extends Controller {
    public $salesService;

    public function __construct( SalesService $salesService ) {
        $this->salesService = $salesService;
    }

    public function index( $year, $month ) {
        $salesData = $this->salesService->sales();

        $data = array_merge( [
            'year'  => $year,
            'month' => $month
        ], $salesData );
        
        return view( 'accounts.sales.index', ['data' => $data] );
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
