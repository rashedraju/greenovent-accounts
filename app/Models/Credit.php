<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model {
    use HasFactory;

    public $timestamps = false;

    const PENDING_TRANSACTION_APROVAL_TYPE = 1;

    protected $with = ['receivedPerson', 'category', 'project', 'loanLender', 'investor', 'transactionType', 'aproval'];

    public static function boot() {
        parent::boot();

        static::created( function ( $credit ) {
            $transacrionAproval = new TransactionAproval();
            $transacrionAproval->transaction_aproval_type_id = self::PENDING_TRANSACTION_APROVAL_TYPE;
            $credit->aproval()->save( $transacrionAproval );
        } );
    }

    // filter credit data by columns
    public function scopeFilter( $query, array $filters ) {

        $query->when( $filters['year'] ?? false, fn( $query, $year ) => $query->when( $filters['month'] ?? false, fn( $query, $month ) => $query->whereYear( 'date', $year )->whereMonth( 'date', $month ) ) );

        // get those credit rows that match the user id
        $query->when( $filters['user_id'] ?? false, fn( $query, $userId ) => $query
                ->whereHas( 'receivedPerson', fn( $query ) => $query
                        ->where( 'user_id', $userId )
                )
        );

        // get those credit rows that match the category id
        $query->when( $filters['category_id'] ?? false, fn( $query, $category ) => $query
                ->whereHas( 'category', fn( $query ) => $query
                        ->where( 'category_id', $category )
                )
        );

        // get those credit rows that match the loan lender id
        $query->when( $filters['loan_lender_id'] ?? false, fn( $query, $loanLender ) => $query
                ->whereHas( 'loanLender', fn( $query ) => $query
                        ->where( 'loan_lender_id', $loanLender )
                )
        );

        // get those credit rows that match the loan investor id
        $query->when( $filters['investor_id'] ?? false, fn( $query, $investor ) => $query
                ->whereHas( 'investor', fn( $query ) => $query
                        ->where( 'investor_id', $investor )
                )
        );

        // get those credit rows that match the project id
        $query->when( $filters['project_id'] ?? false, fn( $query, $projectId ) => $query
                ->whereHas( 'project', fn( $query ) => $query
                        ->where( 'project_id', $projectId )
                )
        );

        // get those credit rows that match the transaction type
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

    // credit category
    public function category() {
        return $this->belongsTo( CreditCategory::class, 'category_id' );
    }

    // credited for the project
    public function project() {
        return $this->belongsTo( Project::class, 'project_id' );
    }

    // credited for the loan lender
    public function loanLender() {
        return $this->belongsTo( CompanyLoanLender::class, 'loan_lender_id' );
    }

    // credited for the investor
    public function investor() {
        return $this->belongsTo( CompanyInvestor::class, 'investor_id' );
    }

    // credit received person
    public function receivedPerson() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    // get the credit transaction type
    public function transactionType() {
        return $this->belongsTo( TransactionType::class, 'transaction_type_id' );
    }

    // get the credit aproval: aproval status from higher authorities
    public function aproval() {
        return $this->morphOne( TransactionAproval::class, 'transaction_aprovalable' );
    }
}
