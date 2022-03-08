<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'projects', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'name' );
            $table->foreignId( 'business_manager_id' )->constrained( 'users' );
            $table->foreignId( 'client_id' );
            $table->foreignId( 'type_id' )->constrained( 'project_types' );
            $table->uuid( 'po_number' );
            $table->unsignedBigInteger( 'po_value' );
            $table->dateTime( 'start_date' );
            $table->dateTime( 'closing_date' );
            $table->unsignedDouble( 'advance_paid' )->default( 0.00 );
            $table->foreignId( 'status_id' )->default( 3 )->constrained( 'project_statuses', 'id' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'projects' );
    }
}
