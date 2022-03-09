<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalCostsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'external_costs', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'project_id' )->constrained();
            $table->string( 'title' );
            $table->integer( 'quantity' );
            $table->unsignedBigInteger( 'rate' );
            $table->unsignedBigInteger( 'costs' );
            $table->string( 'description' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'external_costs' );
    }
}
