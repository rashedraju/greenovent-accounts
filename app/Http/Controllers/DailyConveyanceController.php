<?php

namespace App\Http\Controllers;

class DailyConveyanceController extends Controller {
    public function index() {
        return view('accounts.daily-conveyance.index');
    }
}
