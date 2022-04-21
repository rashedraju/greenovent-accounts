<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recognition extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function person(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checkedBy(){
        return $this->belongsTo(User::class, 'checked_by');
    }

    public function approveBy(){
        return $this->belongsTo(User::class, 'approve_by');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

    // all recognition items
    public function items(){
        return $this->hasMany(RecognitionItem::class, 'recognition_id');
    }

    // get recognition start formated date
    public function getDateAttribute( $value ) {
        return date( 'M d, Y', strtotime( $value ) );
    }
}
