<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeLeavesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'employee_leaves', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'user_id' )->constrained( 'users', 'id' );
            $table->foreignId( 'approval_id' )->constrained( 'leave_approvals', 'id' );
            $table->string( 'subject' );
            $table->string( 'details' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'employee_leaves' );
    }
}
