<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCost extends Model {
    use HasFactory;

    // get formated date string
    public function getCreatedAtAttribute( $value ) {
        return date( 'd M, Y', strtotime( $value ) );
    }

    // get formated date string
    public function getUpdatedAtAttribute( $value ) {
        return date( 'd M, Y', strtotime( $value ) );
    }

    // vendor of project
    public function project() {
        return $this->belongsTo( Project::class );
    }

    // vendor excel file
    public function file() {
        return $this->morphOne( File::class, 'fileable' );
    }
}
