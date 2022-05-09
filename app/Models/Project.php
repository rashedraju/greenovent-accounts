<?php

namespace App\Models;

use App\Models\ProjectContactPerson;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasFactory;

    const USER_CEO_Id = 1;
    const USER_COO_Id = 2;

    const APPROVAL_APPROVED_ID = 2;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['status', 'manager', 'client', 'type', 'billType'];

    public static function boot() {
        parent::boot();

        // after new project record created
        static::created( function ( $project ) {
            // auth user
            $user = auth()->user();

            // send approvals to specific approver
            $approvals = [
                ['title' => "New project ({$project->name}) added ", "request_user_id" => $user->id, 'approver_id' => self::USER_CEO_Id],
                ['title' => "New project ({$project->name}) added ", "request_user_id" => $user->id, 'approver_id' => self::USER_COO_Id]
            ];

            $project->approvals()->createMany( $approvals );
        } );
    }

    // project approvals
    public function approvals() {
        return $this->morphMany( Approval::class, 'approvalable' );
    }

    // check is approved by every approver
    public function isApprovedByEveryone() {
        $status = true;
        foreach ( $this->approvals as $approval ) {
            if ( $approval->status->id != self::APPROVAL_APPROVED_ID ) {
                $status = false;
                break;
            }
        }
        return $status;
    }

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

    public function contactPersons() {
        return $this->hasMany( ProjectContactPerson::class, 'project_id' );
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
    public function type() {
        return $this->belongsTo( ProjectType::class );
    }

    // all external costs
    public function external() {
        return $this->hasOne( ExternalCost::class, 'project_id' );
    }

    // all internal costs
    public function internal() {
        return $this->hasOne( InternalCost::class, 'project_id' );
    }

    // project requisitions
    public function requisitions() {
        return $this->hasMany( Requisition::class, 'project_id' );
    }

    // all vendor costs
    public function vendor() {
        return $this->hasOne( VendorCost::class, 'project_id' );
    }

    /**
     * Define project bill type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function billType() {
        return $this->belongsTo( BillType::class, 'bill_type' );
    }

    /**
     * Bill Status
     * latest bill status
     */

    public function billStatus() {
        return $this->bills->first()?->status->name ?? 'Not Done';
    }

    /**
     * Bills
     * one to many relation with Bill model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills() {
        return $this->hasMany( Bill::class, 'project_id' );
    }

    // gross profit
    public function grossProfit() {
        return $this->external - $this->internal;
    }

    // Cost incurred
    public function costIncurred() {
        return $this->external && $this->internal ? ( $this->internal / $this->external ) * 100 : 0;
    }
}
