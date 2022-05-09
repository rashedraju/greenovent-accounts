<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    // approval model type
    public function approvalable(){
        return $this->morphTo();
    }

    // approval status
    public function status(){
        return $this->belongsTo(ApprovalStatus::class, 'approval_status_id');
    }

    // approval request by
    public function requestBy(){
        return $this->belongsTo(User::class, 'request_user_id');
    }

    // approval approvers
    public function approver(){
        return $this->belongsTo(User::class, 'approver_id');
    }
}
