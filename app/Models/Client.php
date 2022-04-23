<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    use HasFactory;

    const STATUS_COMPLETED_ID = 1;
    const STATUS_INPROGRESS_ID = 2;
    const STATUS_PENDING_ID = 2;

    const USER_CEO_Id = 1;
    const USER_COO_Id = 2;

    public static function boot() {
        parent::boot();

        static::created( function ( $client ) {
            $approvals = [
                ['title' => "New client [{$client->company_name}] added ", 'approver_id' => self::USER_CEO_Id],
                ['title' => "New client [{$client->company_name}] added ", 'approver_id' => self::USER_COO_Id],
            ];

            $client->approvals()->createMany( $approvals );
        } );
    }

    // client projects
    public function projects() {
        return $this->hasMany( Project::class, 'client_id' );
    }

    // get first char
    public function getFirstCharAttribute() {
        return ucfirst( substr( $this->company_name, 0, 1 ) );
    }

    // get total sales amount of current year
    public function salesByYear( $year ) {
        return $this->projects()->whereYear( 'start_date', $year )->sum( 'po_value' );
    }

    // get total sales amount of all time
    public function totalSales() {
        return $this->projects->sum( 'po_value' );
    }

    // bussiness manager from company who responsible for this client
    public function businessManager() {
        return $this->belongsTo( User::class );
    }

    // A client has many contact person
    public function contactPersons() {
        return $this->hasMany( ClientContactPerson::class );
    }

    // get client project by project status
    public function completedProjects() {
        return $this->projects->where( 'status_id', self::STATUS_COMPLETED_ID );
    }

    // get client project by project status
    public function inProgressProjects() {
        return $this->projects->where( 'status_id', self::STATUS_INPROGRESS_ID );
    }

    // get client project by project status
    public function pendingProjects() {
        return $this->projects->where( 'status_id', self::STATUS_PENDING_ID );
    }
}
