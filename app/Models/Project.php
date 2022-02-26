<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasFactory;

    /**
     * One to many relation with projectStatus model
     * User has one status
     *
     */
    public function status() {
        return $this->belongsTo( ProjectStatus::class );
    }

    /**
     * One to many relation with User model
     * Project has one manager
     *
     */
    public function manager() {
        return $this->belongsTo( User::class );
    }

}
