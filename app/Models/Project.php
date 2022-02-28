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

    // get total project budget amount
    public static function getTotalBudget() {
        return Project::pluck( 'budget' )->sum( fn( $budget ) => $budget );
    }

    // get average project budget amount
    public static function getAvgBudget() {
        return Project::pluck( 'budget' )->average( fn( $budget ) => $budget );
    }

    // get highest project budget
    public static function getHighestBudget() {
        return Project::max( 'budget' );
    }

    // get lowest project budget
    public static function getLowestBudget() {
        return Project::min( 'budget' );
    }

    // project has client
    public function client(){
        return $this->belongsTo(Client::class);
    }

    // get project start formated date
    public function getStartDateAttribute($value){
        return date('M d, Y', strtotime($value));
    }

    // get project start formated date
    public function getEndDateAttribute($value){
        return date('M d, Y', strtotime($value));
    }
}
