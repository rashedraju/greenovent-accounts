<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model {
    use HasFactory;

    public $timestamps = false;

    const PENDING_TRANSACTION_APROVAL_TYPE = 1;

    public static function boot() {
        parent::boot();

        static::created( function ( $expense ) {
            $transacrionAproval = new TransactionAproval();
            $transacrionAproval->transaction_aproval_type_id = self::PENDING_TRANSACTION_APROVAL_TYPE;
            $expense->aproval()->save( $transacrionAproval );
        } );
    }

    // format created at date
    public function getDateAttribute( $value ) {
        return date( 'M d, Y', strtotime( $value ) );
    }

    // format created at date
    public function getModifiedAttribute( $value ) {
        return date( 'M d, Y', strtotime( $value ) );
    }

    // expense billing person
    public function billingPerson() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    // expense project
    public function project() {
        return $this->belongsTo( Project::class, 'project_id' );
    }

    // get the expense type
    public function expenseType() {
        return $this->belongsTo( ExpenseType::class, 'expense_type_id' );
    }

    // get the expense transaction type
    public function transactionType() {
        return $this->belongsTo( TransactionType::class, 'transaction_type_id' );
    }

    // get the expense aproval: aproval status from higher authorities
    public function aproval() {
        return $this->morphOne( TransactionAproval::class, 'transaction_aprovalable' );
    }
}
