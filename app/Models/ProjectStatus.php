<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectStatus extends Model {
    use HasFactory;

    public $timestamps = false;
    protected $table = 'project_statuses';

    public function projects() {
        return $this->hasMany( Project::class, 'status_id' );
    }
}
