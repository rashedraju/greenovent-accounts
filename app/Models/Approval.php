<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    use HasFactory;

    public function approvalable(){
        return $this->morphTo();
    }

    public function status(){
        return $this->belongsTo(ApprovalStatus::class, 'approval_status_id');
    }
}
