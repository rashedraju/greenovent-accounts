<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientContactPersonsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'client_contact_persons', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'client_id' );
            $table->string( 'name' );
            $table->string( 'designation' )->nullable();
            $table->string( 'department' )->nullable();
            $table->string( 'email' )->nullable();
            $table->string( 'phone' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'client_contact_persons' );
    }
}
