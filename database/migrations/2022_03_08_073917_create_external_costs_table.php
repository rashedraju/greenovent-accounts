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
            $table->date( 'date' )->default( now() );
            $table->unsignedBigInteger( 'total' );
            $table->unsignedInteger( 'asf' );
            $table->unsignedInteger( 'vat' );
            $table->string( 'note' )->nullable();
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
