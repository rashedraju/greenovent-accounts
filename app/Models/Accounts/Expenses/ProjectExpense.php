<?php

namespace App\Models\Accounts\Expenses;

use App\Models\User;
use App\Models\Project;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectExpense extends Model
{
    use HasFactory;

    // filter credit data by columns
    public function scopeFilter( $query, array $filters ) {

        $query->when( $filters['year'] ?? false, fn( $query, $year ) => $query->whereYear( 'date', $year ) );

        $query->when( $filters['month'] ?? false, fn( $query, $month ) => $query->whereMonth( 'date', $month ) );

        $query->when( $filters['head'] ?? false, fn( $query, $head ) => $query
                ->where( 'head', 'like', '%' . $head . '%' )
        );

        // get those credit rows that match the user id
        $query->when( $filters['user_id'] ?? false, fn( $query, $userId ) => $query
                ->whereHas( 'user', fn( $query ) => $query
                        ->where( 'user_id', $userId )
                )
        );

        // get those credit rows that match the transaction type
        $query->when( $filters['transaction_type_id'] ?? false, fn( $query, $transactionTypeId ) => $query
                ->whereHas( 'transactionType', fn( $query ) => $query
                        ->where( 'transaction_type_id', $transactionTypeId )
                )
        );
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function transactionType(){
        return $this->belongsTo(TransactionType::class);
    }
}
