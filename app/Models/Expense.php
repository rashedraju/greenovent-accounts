<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model {
    use HasFactory;

    public $timestamps = false;

    const PENDING_TRANSACTION_APROVAL_TYPE = 1;

    protected $with = ['billingPerson', 'project', 'expenseType', 'transactionType', 'aproval'];

    public static function boot() {
        parent::boot();

        static::created( function ( $expense ) {
            $transacrionAproval = new TransactionAproval();
            $transacrionAproval->transaction_aproval_type_id = self::PENDING_TRANSACTION_APROVAL_TYPE;
            $expense->aproval()->save( $transacrionAproval );
        } );
    }

    // filter expense data
    public function scopeFilter( $query, array $filters ) {

        $query->when( $filters['year'] ?? false, fn( $query, $year ) => $query->where( 'date', fn( $query ) => $query->whereYear( 'date', $year ) ) );

        $query->when( $filters['month'] ?? false, fn( $query, $month ) => $query->where( 'date', fn( $query ) => $query->whereYear( 'date', $month ) ) );

        $query->when( $filters['head'] ?? false, fn( $query, $head ) => $query
                ->where( 'head', 'like', '%' . $head . '%' )
        );

        $query->when( $filters['user_id'] ?? false, fn( $query, $userId ) => $query
                ->whereHas( 'billingPerson', fn( $query ) => $query
                        ->where( 'user_id', $userId )
                )
        );

        $query->when( $filters['project_id'] ?? false, fn( $query, $projectId ) => $query
                ->whereHas( 'project', fn( $query ) => $query
                        ->where( 'project_id', $projectId )
                )
        );

        $query->when( $filters['expense_type_id'] ?? false, fn( $query, $expenseTypeId ) => $query
                ->whereHas( 'expenseType', fn( $query ) => $query
                        ->where( 'expense_type_id', $expenseTypeId )
                )
        );

        $query->when( $filters['transaction_type_id'] ?? false, fn( $query, $transactionTypeId ) => $query
                ->whereHas( 'transactionType', fn( $query ) => $query
                        ->where( 'transaction_type_id', $transactionTypeId )
                )
        );
    }

    // format created at date
    public function getDateAttribute( $value ) {
        return date( 'Y-m-d', strtotime( $value ) );
    }

    // format created at date
    public function getModifiedAttribute( $value ) {
        return date( 'Y-m-d', strtotime( $value ) );
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
