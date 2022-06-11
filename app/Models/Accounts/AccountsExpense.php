<?php

namespace App\Models\Accounts;

use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsExpense extends Model {
    use HasFactory;

    public function transactionType() {
        return $this->belongsTo( TransactionType::class );
    }
}
