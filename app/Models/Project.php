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
        return $this->belongsTo( User::class, 'business_manager_id' );
    }

    // get total amount of all project
    // calculated total amount by all project po value
    public static function getTotalBudget() {
        return Project::pluck( 'po_value' )->sum( fn( $budget ) => $budget );
    }

    /**
     * get average project budget amount
     * calculated total amount by all project po value
     * total project po value / total project count
     */
    public static function getAvgBudget() {
        return Project::pluck( 'po_value' )->average( fn( $budget ) => $budget );
    }

    // get highest project budget
    public static function getHighestBudget() {
        return Project::max( 'po_value' );
    }

    // get lowest project budget
    public static function getLowestBudget() {
        return Project::min( 'po_value' );
    }

    // project has client
    public function client() {
        return $this->belongsTo( Client::class );
    }

    // get project start formated date
    public function getStartDateAttribute( $value ) {
        return date( 'M d, Y', strtotime( $value ) );
    }

    // get project start formated date
    public function getClosingDateAttribute( $value ) {
        return date( 'M d, Y', strtotime( $value ) );
    }

    // get project type
    public function type(){
        return $this->belongsTo(ProjectType::class);
    }

    // all internal costs
    public function intenalCosts(){
        return $this->hasMany(InternalCost::class, 'project_id');
    }

    // all external costs
    public function externalCosts(){
        return $this->hasMany(ExternalCost::class, 'project_id');
    }
}
