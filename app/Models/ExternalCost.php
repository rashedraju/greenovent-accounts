<?php

namespace App\Models;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalCost extends Model {
    use HasFactory;

    // get formated date string
    public function getCreatedAtAttribute( $value ) {
        return date( 'Y-m-d', strtotime( $value ) );
    }

    // external of project
    public function project() {
        return $this->belongsTo( Project::class );
    }

    // external excel file
    public function file() {
        return $this->morphOne( File::class, 'fileable' );
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
}
