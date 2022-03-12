<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCost extends Model {
    use HasFactory;

    public function getCreatedAtAttribute( $value ) {
        return date( 'Y-m-d', strtotime( $value ) );
    }

    public function project() {
        return $this->belongsTo( Project::class );
    }
}
