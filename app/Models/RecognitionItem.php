<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecognitionItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    // belongs to a recognition
    public function recognition(){
        return $this->belongsTo(Recognition::class);
    }
}
