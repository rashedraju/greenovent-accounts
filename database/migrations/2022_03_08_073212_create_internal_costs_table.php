<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalCostsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'internal_costs', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'project_id' )->constrained();
            $table->unsignedBigInteger( 'total' );
            $table->string( 'note' )->nullable();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'internal_costs' );
    }
}
