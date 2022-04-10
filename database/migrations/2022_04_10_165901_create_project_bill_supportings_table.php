<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectBillSupportingsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'project_bill_supportings', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId('bill_id')->constrained('bills', 'id')->cascadeOnDelete();
            $table->string('file');
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'project_bill_supportings' );
    }
}
