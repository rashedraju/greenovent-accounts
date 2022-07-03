<?php

namespace App\Models\Accounts;

use App\Models\AccountsExpenseType;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsExpense extends Model {
    use HasFactory;

    public function type() {
        return $this->belongsTo( AccountsExpenseType::class, 'expense_type_id' );
    }

    public function transactionType() {
        return $this->belongsTo( TransactionType::class );
    }
}
