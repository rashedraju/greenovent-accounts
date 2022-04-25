<?php

namespace App\Services;

use App\Models\Credit;

class CreditService{
    public function lastFiveCreditRecordsByProject(){
        return Credit::whereNotNull('project_id')->latest('date')->take(1)->get();
    }
}
