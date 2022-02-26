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
    public function getFullNameAttribute() {
        return ucfirst( $this->first_name ) . ' ' . ucfirst( $this->last_name );
    }

    // get first char
    public function getFirstCharAttribute() {
        return ucfirst( substr( $this->first_name, 0, 1 ) );
    }

    // get first name
    public function getFirstNameAttribute( $value ) {
        return ucfirst( $value );
    }

    // get last name
    public function getLastNameAttribute( $value ) {
        return ucfirst( $value );
    }

    /**
     * One to many relation with designation model
     * User has one designation
     *
     */
    public function designation() {
        return $this->belongsTo( UserDesignation::class );
    }

    /**
     * One to many relation with status model
     * User has one status
     *
     */
    public function status() {
        return $this->belongsTo( UserStatus::class );
    }

    /**
     * One to many relation with status model
     * User has one status
     *
     */
    public function projects() {
        return $this->hasMany( Project::class );
    }
}
