<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountsBillsController extends Controller
{
    public function index(){
        return view( 'accounts.bills.index');
    }
}
