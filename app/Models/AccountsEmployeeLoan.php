<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsEmployeeLoan extends Model {
    use HasFactory;

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function due(){
        return $this->amount - $this->paid;
    }
}
