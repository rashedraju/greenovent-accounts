<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientContactPerson extends Model
{
    use HasFactory;

    protected $table = 'client_contact_persons';

    // contact person of a client
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
