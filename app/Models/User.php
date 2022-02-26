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
}
