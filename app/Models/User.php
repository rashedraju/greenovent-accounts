<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

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
     * getRoleNames method from laravel-permission HasRoles trait
     * User has one designation
     *
     */
    public function designation() {
        return $this->getRoleNames()->first();
    }

    // get readable joining date
    public function getJoiningDateAttribute( $value ) {
        return date( 'M d, Y', strtotime( $value ) );
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
    public function completedProjects() {
        return $this->projects->where( 'status_id', 1 );
    }

    // user in progress projects
    public function inProgressProjects() {
        return $this->projects->where( 'status_id', 2 );
    }

    // user in pending projects
    public function pendingProjects() {
        return $this->projects->where( 'status_id', 3 );
    }

    // Employee performances
    public function performances() {
        return $this->hasMany( EmployeePerformance::class );
    }

    public function performancesByGroup() {
        return $this->performances->groupby( function ( $performance ) {
            return Carbon::parse( $performance->created_at )->format( 'F, Y' );
        } );
    }
}
