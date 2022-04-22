<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recognition extends Model {
    use HasFactory;

    public static function boot() {
        parent::boot();

        static::created( function ( $recognition ) {
            $approvals = [
                ['title' => "Money Recognition for {$recognition->project->name}", 'approver_id' => 1]
            ];

            $recognition->approvals()->createMany( $approvals );
        } );
    }

    public $timestamps = false;

    public function person() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function checkedBy() {
        return $this->belongsTo( User::class, 'checked_by' );
    }

    // recognition approvals
    public function approvals() {
        return $this->morphMany( Approval::class, 'approvalable' );
    }

    // recognition have only one approval
    public function approval() {
        return $this->approvals->first();
    }

    public function project() {
        return $this->belongsTo( Project::class );
    }

    // all recognition items
    public function items() {
        return $this->hasMany( RecognitionItem::class, 'recognition_id' );
    }

    // get recognition start formated date
    public function getDateAttribute( $value ) {
        return date( 'M d, Y', strtotime( $value ) );
    }
}
