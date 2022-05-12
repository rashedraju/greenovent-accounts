<?php

namespace App\Http\Controllers;

use App\Models\Bill;

class BillController extends Controller {
    public function index() {
        $bills = Bill::orderBy( 'id', 'desc' )->paginate( 10 );

        return view( 'bills.index', ['bills' => $bills] );
    }

    public function show(Bill $bill){
        return view('bills.show', ['bill' => $bill]);
    }
}
