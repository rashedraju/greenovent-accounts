<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    // belongs to a requisition
    public function requisition(){
        return $this->belongsTo(Requisition::class);
    }
}
