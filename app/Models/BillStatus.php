<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Bills
     * one to many relation with Bill model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills() {
        return $this->hasMany( Bill::class, 'bill_status_id' );
    }
}
