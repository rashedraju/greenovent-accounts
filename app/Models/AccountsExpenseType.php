<?php

namespace App\Models;

use App\Models\Accounts\AccountsExpense;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsExpenseType extends Model
{
    use HasFactory;

    public function expenses(){
        return $this->hasMany(AccountsExpense::class, 'expense_type_id');
    }
}
