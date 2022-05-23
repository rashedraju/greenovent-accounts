<?php

namespace App\Models\Accounts\Expenses;

use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LoanExpense extends Model {
    use HasFactory;

    // filter credit data by columns
    public function scopeFilter( $query, array $filters ) {

        $query->when( $filters['year'] ?? false, fn( $query, $year ) => $query->whereYear( 'date', $year ) );

        $query->when( $filters['month'] ?? false, fn( $query, $month ) => $query->whereMonth( 'date', $month ) );

        $query->when( $filters['received_person'] ?? false, fn( $query, $receivedPerson ) => $query
                ->where( 'received_person', 'like', '%' . $receivedPerson . '%' )
        );

        // get those credit rows that match the transaction type
        $query->when( $filters['transaction_type_id'] ?? false, fn( $query, $transactionTypeId ) => $query
                ->whereHas( 'transactionType', fn( $query ) => $query
                        ->where( 'transaction_type_id', $transactionTypeId )
                )
        );
    }

    public function transactionType() {
        return $this->belongsTo( TransactionType::class );
    }
}
