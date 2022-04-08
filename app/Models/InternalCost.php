<?php

namespace App\Models;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalCost extends Model {
    use HasFactory;

    // get formated date string
    public function getCreatedAtAttribute( $value ) {
        return date( 'd M, Y', strtotime( $value ) );
    }

    // get formated date string
    public function getUpdatedAtAttribute( $value ) {
        return date( 'd M, Y', strtotime( $value ) );
    }

    // internal of project
    public function project() {
        return $this->belongsTo( Project::class );
    }

    // internal excel file
    public function file() {
        return $this->morphOne( File::class, 'fileable' );
    }
}
