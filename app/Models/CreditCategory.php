<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCategory extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function credits(){
        return $this->hasMany(Credit::class, 'category_id');
    }
}
