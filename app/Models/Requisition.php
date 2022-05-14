<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model {
    use HasFactory;

    const USER_EXECUTIVE_DIRECTOR_Id = 1;
    const USER_ACCOUNTS_Id = 5;

    public static function boot() {
        parent::boot();

        static::created( function ( $requisition ) {
            // auth user
            $request_user = $requisition->user_id;

            // create requisition approval after requisition created
            $approvals = [
                ['title' => "Money Requisition for ({$requisition->project->name})", 'request_user_id' => $request_user, 'approver_id' => self::USER_EXECUTIVE_DIRECTOR_Id],
                ['title' => "Money Requisition for ({$requisition->project->name})", 'request_user_id' => $request_user, 'approver_id' => self::USER_ACCOUNTS_Id]
            ];

            $requisition->approvals()->createMany( $approvals );
        } );
    }

    public $timestamps = false;

    public function person() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function checkedBy() {
        return $this->belongsTo( User::class, 'checked_by' );
    }

    // requisition approvals
    public function approvals() {
        return $this->morphMany( Approval::class, 'approvalable' );
    }

    // requisition have only one approval
    public function approval() {
        return $this->approvals->first();
    }

    public function project() {
        return $this->belongsTo( Project::class );
    }

    // all requisition items
    public function items() {
        return $this->hasMany( RequisitionItem::class, 'requisition_id' );
    }

    // get requisition start formated date
    public function getDateAttribute( $value ) {
        return date( 'M d, Y', strtotime( $value ) );
    }
}
