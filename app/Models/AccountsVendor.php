<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsVendor extends Model {
    use HasFactory;

    public function scopeFilter( $query, array $filters ) {
        $query->when( $filters['year'] ?? false, fn( $query, $year ) => $query->whereYear( 'date_bill', $year ) );
        $query->when( $filters['month'] ?? false, fn( $query, $month ) => $query->whereMonth( 'date_bill', $month ) );
        $query->when( $filters['vendor_id'] ?? false, fn( $query, $vendor_id ) => $query->where( 'vendor_id', $vendor_id ) );
        $query->when( $filters['bill'] ?? false, function( $query, $bill ) {
            if($bill == 'paid'){
                return $query->where('paid', '>', 0);
            }else if($bill == 'due'){
                return $query->where('due', '>', 0);
            }
            return $query;
        } );
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
