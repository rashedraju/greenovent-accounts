<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model {
    use HasFactory;

    public $timestamps = false;

    const PENDING_TRANSACTION_APROVAL_TYPE = 1;

    protected $with = ['depositPerson', 'aproval'];

    public static function boot() {
        parent::boot();

        static::created( function ( $deposit ) {
            $transacrionAproval = new TransactionAproval();
            $transacrionAproval->transaction_aproval_type_id = self::PENDING_TRANSACTION_APROVAL_TYPE;
            $deposit->aproval()->save( $transacrionAproval );
        } );
    }

    // filter deposit data
    public function scopeFilter( $query, array $filters ) {

        $query->when( $filters['year'] ?? false, fn( $query, $year ) => $query->when( $filters['month'] ?? false, fn( $query, $month ) => $query->whereYear( 'date', $year )->whereMonth( 'date', $month ) ) );

        $query->when( $filters['bank_name'] ?? false, fn( $query, $bankName ) => $query
                ->where( 'bank_name', 'like', '%' . $bankName . '%' )
        );

        $query->when( $filters['user_id'] ?? false, fn( $query, $userId ) => $query
                ->whereHas( 'depositPerson', fn( $query ) => $query
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

    // deposit billing person
    public function depositPerson() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    // get the deposit aproval: aproval status from higher authorities
    public function aproval() {
        return $this->morphOne( TransactionAproval::class, 'transaction_aprovalable' );
    }
}
