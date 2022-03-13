<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    // set the bcrypt password by default whenever users create or update password
    public function setPasswordAttribute( $password ) {
        $this->attributes['password'] = bcrypt( $password );
    }

    // get full name
    public function getNameAttribute( $value ) {
        return ucfirst( $value );
    }

    // get first char
    public function getFirstCharAttribute() {
        return ucfirst( substr( $this->name, 0, 1 ) );
    }

    /**
     * One to many relation with designation model
     * User has one designation
     *
     */
    public function designation() {
        return $this->belongsTo( UserDesignation::class );
    }

    // get readable joining date
    public function getJoiningDateAttribute( $value ) {
        return date( 'M d, Y', strtotime( $value ) );
    }

    /**
     * One to many relation with status model
     * User has one status
     *
     */
    public function status() {
        return $this->belongsTo( UserStatus::class );
    }

    // a user has many client
    public function clients() {
        return $this->hasMany( Client::class );
    }

    /**
     * One to many relation with status model
     * User has one status
     *
     */
    public function projects() {
        return $this->hasMany( Project::class, 'business_manager_id' );
    }

    // user completed projects
    public function completedProjects(){
        return $this->projects->where('status_id', 1);
    }

    // user in progress projects
    public function inProgressProjects(){
        return $this->projects->where('status_id', 2);
    }

    // user in pending projects
    public function pendingProjects(){
        return $this->projects->where('status_id', 3);
    }
}
