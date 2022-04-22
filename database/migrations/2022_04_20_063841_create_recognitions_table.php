<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecognitionsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'recognitions', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId( 'project_id' )->constrained( 'projects', 'id' );
            $table->date( 'date' );
            $table->foreignId( 'checked_by' )->nullable()->constrained( 'users', 'id' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'recognitions' );
    }
}
