<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model {
    use HasFactory;

    public $timestamps = false;

    const PENDING_TRANSACTION_APROVAL_TYPE = 1;

    protected $with = ['withdrawalPerson', 'aproval'];

    public static function boot() {
        parent::boot();

        static::created( function ( $withdrawal ) {
            $transacrionAproval = new TransactionAproval();
            $transacrionAproval->transaction_aproval_type_id = self::PENDING_TRANSACTION_APROVAL_TYPE;
            $withdrawal->aproval()->save( $transacrionAproval );
        } );
    }

    // filter withdrawal data
    public function scopeFilter( $query, array $filters ) {

        $query->when( $filters['year'] ?? false, fn( $query, $year ) => $query->where( 'date', fn( $query ) => $query->whereYear( 'date', $year ) ) );

        $query->when( $filters['month'] ?? false, fn( $query, $month ) => $query->where( 'date', fn( $query ) => $query->whereYear( 'date', $month ) ) );

        $query->when( $filters['bank_name'] ?? false, fn( $query, $bankName ) => $query
                ->where( 'bank_name', 'like', '%' . $bankName . '%' )
        );

        $query->when( $filters['user_id'] ?? false, fn( $query, $userId ) => $query
                ->whereHas( 'withdrawalPerson', fn( $query ) => $query
                        ->where( 'user_id', $userId )
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

    // withdrawal billing person
    public function withdrawalPerson() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    // get the withdrawal aproval: aproval status from higher authorities
    public function aproval() {
        return $this->morphOne( TransactionAproval::class, 'transaction_aprovalable' );
    }
}
