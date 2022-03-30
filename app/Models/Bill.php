<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model {
    use HasFactory;

    /**
     * Project
     * one to many inverse relation with Project model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function project() {
        return $this->belongsTo( Project::class );
    }

    /**
     * Project Status
     * one to many relation with BillStatus model
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status() {
        return $this->belongsTo( BillStatus::class, 'bill_status_id' );
    }
}
