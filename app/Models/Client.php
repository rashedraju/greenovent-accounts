<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    use HasFactory;

    // client projects
    public function projects() {
        return $this->hasMany( Project::class, 'client_id' );
    }

    // get first char
    public function getFirstCharAttribute() {
        return ucfirst( substr( $this->company_name, 0, 1 ) );
    }

    // get total sales amount of current year
    public function salesThisYear() {
        return $this->projects()->whereYear( 'start_date', now()->year )->sum( 'po_value' );
    }

    // get total sales amount of all time
    public function totalSales() {
        return $this->projects->sum( 'po_value' );
    }

    // bussiness manager from company who responsible for this client
    public function businessManager(){
        return $this->belongsTo(User::class);
    }

    // A client has many contact person
    public function contactPersons(){
        return $this->hasMany( ClientContactPerson::class );
    }
}
