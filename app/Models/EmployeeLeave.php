<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model {
    use HasFactory;

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function apporval(){
        return $this->belongsTo(LeaveApproval::class, 'approval_id');
    }

    // get formated date string
    public function getCreatedAtAttribute( $value ) {
        return date( 'H:i A, d M, Y', strtotime( $value ) );
    }
}
