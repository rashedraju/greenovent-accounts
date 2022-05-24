<?php

namespace App\Http\Controllers;

class AccountsBillsController extends Controller {
    public function index() {
        return view( 'accounts.bills.index' );
    }
}
