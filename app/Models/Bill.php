<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Bill extends Model {
    use HasFactory;

    /**
     * Project
     * one to many inverse relation with Project model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function project() {
        return $this->belongsTo( Project::class );
    }

    // bill files
    public function file() {
        return $this->morphOne( File::class, 'fileable' );
    }

    // bill supporting files
    public function supporting() {
        return $this->hasOne( ProjectBillSupporting::class, 'bill_id' );
    }

    /**
     * Project Status
     * one to many relation with BillStatus model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status() {
        return $this->belongsTo( BillStatus::class, 'bill_status_id' );
    }

    // get calculated asf
    public function asfTotal() {
        return ( $this->asf / 100 ) * $this->total;
    }

    // get asf sub total
    public function asfSubTotal() {
        return $this->total + $this->asfTotal();
    }

    // get calculated vat
    public function vatTotal() {
        return ( $this->vat / 100 ) * $this->asfSubTotal();
    }

    // get grand total
    public function grandTotal() {
        return $this->asfSubTotal() + $this->vatTotal();
    }

    public function getCreatedAtAttribute( $value ) {
        return date( 'd-m-Y', strtotime( $value ) );
    }

    public function billMonth() {
        return Carbon::parse( $this->date )->format( 'F' );
    }

    public function billYear() {
        return Carbon::parse( $this->date )->format( 'Y' );
    }

}
