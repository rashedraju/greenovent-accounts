<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionAproval extends Model {
    use HasFactory;

    /**
     * Get the parent transaction aprovalable  model
     */
    public function transaction_aprovalable() {
        return $this->morphTo();
    }

    // get aproval type name
    public function status(){
        return $this->belongsTo(TransactionAprovalType::class, 'transaction_aproval_type_id');
    }
}
