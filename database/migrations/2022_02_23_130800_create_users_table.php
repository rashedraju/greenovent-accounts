<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'users', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'name' );
            $table->string( 'profile_image' )->nullable();
            $table->string( 'email' )->unique();
            $table->string( 'phone' );
            $table->date( 'joining_date' )->nullable();
            $table->string( 'current_address' )->nullable();
            $table->string( 'permanent_address' )->nullable();
            $table->string( 'emergency_contact_name' )->nullable();
            $table->string( 'emergency_contact_no' )->nullable();
            $table->string( 'emergency_contact_relation' )->nullable();
            $table->unsignedBigInteger( 'sales_goal' )->default( 0 );
            $table->string( 'password' );
            $table->rememberToken();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'users' );
    }
}
