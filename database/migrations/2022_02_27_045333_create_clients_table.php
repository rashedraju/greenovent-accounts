<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'clients', function ( Blueprint $table ) {
            $table->id();
            $table->string( 'company_name' );
            $table->string( 'office_address' )->nullable();
            $table->foreignId( 'business_manager_id' )->constrained( 'users', 'id' );
            $table->string( 'billing_cycle' )->nullable();
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
        Schema::dropIfExists( 'clients' );
    }
}
