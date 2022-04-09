<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectContactPerson extends Model {
    use HasFactory;

    protected $table = 'project_contact_persons';
    
    public $timestamps = false;

    public function project() {
        return $this->belongsTo( Project::class );
    }

}
